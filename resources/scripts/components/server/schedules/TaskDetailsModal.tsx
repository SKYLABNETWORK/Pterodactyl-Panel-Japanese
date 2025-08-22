import React, { useContext, useEffect } from 'react';
import { Schedule, Task } from '@/api/server/schedules/getServerSchedules';
import { Field as FormikField, Form, Formik, FormikHelpers, useField } from 'formik';
import { ServerContext } from '@/state/server';
import createOrUpdateScheduleTask from '@/api/server/schedules/createOrUpdateScheduleTask';
import { httpErrorToHuman } from '@/api/http';
import Field from '@/components/elements/Field';
import FlashMessageRender from '@/components/FlashMessageRender';
import { boolean, number, object, string } from 'yup';
import useFlash from '@/plugins/useFlash';
import FormikFieldWrapper from '@/components/elements/FormikFieldWrapper';
import tw from 'twin.macro';
import Label from '@/components/elements/Label';
import { Textarea } from '@/components/elements/Input';
import { Button } from '@/components/elements/button/index';
import Select from '@/components/elements/Select';
import ModalContext from '@/context/ModalContext';
import asModal from '@/hoc/asModal';
import FormikSwitch from '@/components/elements/FormikSwitch';

interface Props {
    schedule: Schedule;
    // タスクが渡されていれば編集モード、なければ新規作成モードです。
    task?: Task;
}

interface Values {
    action: string;
    payload: string;
    timeOffset: string;
    continueOnFailure: boolean;
}

const schema = object().shape({
    action: string().required().oneOf(['command', 'power', 'backup']),
    payload: string().when('action', {
        is: (v) => v !== 'backup',
        then: string().required('タスクのペイロードは必須です。'),
        otherwise: string(),
    }),
    continueOnFailure: boolean(),
    timeOffset: number()
        .typeError('タイムオフセットは0〜900の有効な数値でなければなりません。')
        .required('タイムオフセットの値を入力してください。')
        .min(0, 'タイムオフセットは0秒以上でなければなりません。')
        .max(900, 'タイムオフセットは900秒未満でなければなりません。'),
});

const ActionListener = () => {
    const [{ value }, { initialValue: initialAction }] = useField<string>('action');
    const [, { initialValue: initialPayload }, { setValue, setTouched }] = useField<string>('payload');

    useEffect(() => {
        if (value !== initialAction) {
            setValue(value === 'power' ? 'start' : '');
            setTouched(false);
        } else {
            setValue(initialPayload || '');
            setTouched(false);
        }
    }, [value]);

    return null;
};

const TaskDetailsModal = ({ schedule, task }: Props) => {
    const { dismiss } = useContext(ModalContext);
    const { clearFlashes, addError } = useFlash();

    const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);
    const appendSchedule = ServerContext.useStoreActions((actions) => actions.schedules.appendSchedule);
    const backupLimit = ServerContext.useStoreState((state) => state.server.data!.featureLimits.backups);

    useEffect(() => {
        return () => {
            clearFlashes('schedule:task');
        };
    }, []);

    const submit = (values: Values, { setSubmitting }: FormikHelpers<Values>) => {
        clearFlashes('schedule:task');
        if (backupLimit === 0 && values.action === 'backup') {
            setSubmitting(false);
            addError({
                message: "サーバーのバックアップ上限が0に設定されている場合、バックアップタスクは作成できません。",
                key: 'schedule:task',
            });
        } else {
            createOrUpdateScheduleTask(uuid, schedule.id, task?.id, values)
                .then((task) => {
                    let tasks = schedule.tasks.map((t) => (t.id === task.id ? task : t));
                    if (!schedule.tasks.find((t) => t.id === task.id)) {
                        tasks = [...tasks, task];
                    }

                    appendSchedule({ ...schedule, tasks });
                    dismiss();
                })
                .catch((error) => {
                    console.error(error);
                    setSubmitting(false);
                    addError({ message: httpErrorToHuman(error), key: 'schedule:task' });
                });
        }
    };

    return (
        <Formik
            onSubmit={submit}
            validationSchema={schema}
            initialValues={{
                action: task?.action || 'command',
                payload: task?.payload || '',
                timeOffset: task?.timeOffset.toString() || '0',
                continueOnFailure: task?.continueOnFailure || false,
            }}
        >
            {({ isSubmitting, values }) => (
                <Form css={tw`m-0`}>
                    <FlashMessageRender byKey={'schedule:task'} css={tw`mb-4`} />
                    <h2 css={tw`text-2xl mb-6`}>{task ? 'タスクを編集' : 'タスクを作成'}</h2>
                    <div css={tw`flex`}>
                        <div css={tw`mr-2 w-1/3`}>
                            <Label>アクション</Label>
                            <ActionListener />
                            <FormikFieldWrapper name={'action'}>
                                <FormikField as={Select} name={'action'}>
                                    <option value={'command'}>コマンドを送信</option>
                                    <option value={'power'}>電源操作を送信</option>
                                    <option value={'backup'}>バックアップを作成</option>
                                </FormikField>
                            </FormikFieldWrapper>
                        </div>
                        <div css={tw`flex-1 ml-6`}>
                            <Field
                                name={'timeOffset'}
                                label={'タイムオフセット（秒単位）'}
                                description={
                                    '前のタスク実行後、このタスクを実行するまでの待機時間です。スケジュール内の最初のタスクの場合は適用されません。'
                                }
                            />
                        </div>
                    </div>
                    <div css={tw`mt-6`}>
                        {values.action === 'command' ? (
                            <div>
                                <Label>ペイロード</Label>
                                <FormikFieldWrapper name={'payload'}>
                                    <FormikField as={Textarea} name={'payload'} rows={6} />
                                </FormikFieldWrapper>
                            </div>
                        ) : values.action === 'power' ? (
                            <div>
                                <Label>ペイロード</Label>
                                <FormikFieldWrapper name={'payload'}>
                                    <FormikField as={Select} name={'payload'}>
                                        <option value={'start'}>サーバーを起動</option>
                                        <option value={'restart'}>サーバーを再起動</option>
                                        <option value={'stop'}>サーバーを停止</option>
                                        <option value={'kill'}>サーバーを強制終了</option>
                                    </FormikField>
                                </FormikFieldWrapper>
                            </div>
                        ) : (
                            <div>
                                <Label>除外ファイル</Label>
                                <FormikFieldWrapper
                                    name={'payload'}
                                    description={
                                        '任意です。このバックアップで除外するファイルやフォルダを指定します。デフォルトでは .pteroignore ファイルの内容が使われます。バックアップ上限に達した場合は古いバックアップから順に削除されます。'
                                    }
                                >
                                    <FormikField as={Textarea} name={'payload'} rows={6} />
                                </FormikFieldWrapper>
                            </div>
                        )}
                    </div>
                    <div css={tw`mt-6 bg-neutral-700 border border-neutral-800 shadow-inner p-4 rounded`}>
                        <FormikSwitch
                            name={'continueOnFailure'}
                            description={'このタスクが失敗しても後続のタスクを実行します。'}
                            label={'失敗時も継続'}
                        />
                    </div>
                    <div css={tw`flex justify-end mt-6`}>
                        <Button type={'submit'} disabled={isSubmitting}>
                            {task ? '変更を保存' : 'タスクを作成'}
                        </Button>
                    </div>
                </Form>
            )}
        </Formik>
    );
};

export default asModal<Props>()(TaskDetailsModal);
