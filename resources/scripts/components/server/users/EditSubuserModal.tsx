import React, { useContext, useEffect, useRef } from 'react';
import { Subuser } from '@/state/server/subusers';
import { Form, Formik } from 'formik';
import { array, object, string } from 'yup';
import Field from '@/components/elements/Field';
import { Actions, useStoreActions, useStoreState } from 'easy-peasy';
import { ApplicationStore } from '@/state';
import createOrUpdateSubuser from '@/api/server/users/createOrUpdateSubuser';
import { ServerContext } from '@/state/server';
import FlashMessageRender from '@/components/FlashMessageRender';
import Can from '@/components/elements/Can';
import { usePermissions } from '@/plugins/usePermissions';
import { useDeepCompareMemo } from '@/plugins/useDeepCompareMemo';
import tw from 'twin.macro';
import Button from '@/components/elements/Button';
import PermissionTitleBox from '@/components/server/users/PermissionTitleBox';
import asModal from '@/hoc/asModal';
import PermissionRow from '@/components/server/users/PermissionRow';
import ModalContext from '@/context/ModalContext';

type Props = {
    subuser?: Subuser;
};

interface Values {
    email: string;
    permissions: string[];
}

const permissionGroupDescriptions: Record<string, string> = {
    control: 'サーバーの電源状態の制御やコマンド送信に関する権限です。',
    user: 'サーバー上の他のサブユーザーを管理するための権限です。自分自身のアカウント編集や、自分が持たない権限の付与はできません。',
    file: 'このサーバーのファイルシステムを変更するための権限です。',
    backup: 'サーバーバックアップの生成と管理に関する権限です。',
    allocation: 'このサーバーのポート割り当てを変更するための権限です。',
    startup: 'このサーバーの起動パラメーターを表示または変更するための権限です。',
    database: 'このサーバーのデータベース管理に関する権限です。',
    schedule: 'このサーバーのスケジュール管理に関する権限です。',
    settings: 'このサーバーの設定へアクセスするための権限です。',
    activity: 'サーバーのアクティビティログへアクセスするための権限です。',
};

const EditSubuserModal = ({ subuser }: Props) => {
    const ref = useRef<HTMLHeadingElement>(null);
    const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);
    const appendSubuser = ServerContext.useStoreActions((actions) => actions.subusers.appendSubuser);
    const { clearFlashes, clearAndAddHttpError } = useStoreActions(
        (actions: Actions<ApplicationStore>) => actions.flashes
    );
    const { dismiss, setPropOverrides } = useContext(ModalContext);

    const isRootAdmin = useStoreState((state) => state.user.data!.rootAdmin);
    const permissions = useStoreState((state) => state.permissions.data);
    // The currently logged in user's permissions. We're going to filter out any permissions
    // that they should not need.
    const loggedInPermissions = ServerContext.useStoreState((state) => state.server.permissions);
    const [canEditUser] = usePermissions(subuser ? ['user.update'] : ['user.create']);

    // The permissions that can be modified by this user.
    const editablePermissions = useDeepCompareMemo(() => {
        const cleaned = Object.keys(permissions).map((key) =>
            Object.keys(permissions[key].keys).map((pkey) => `${key}.${pkey}`)
        );

        const list: string[] = ([] as string[]).concat.apply([], Object.values(cleaned));

        if (isRootAdmin || (loggedInPermissions.length === 1 && loggedInPermissions[0] === '*')) {
            return list;
        }

        return list.filter((key) => loggedInPermissions.indexOf(key) >= 0);
    }, [isRootAdmin, permissions, loggedInPermissions]);

    const submit = (values: Values) => {
        setPropOverrides({ showSpinnerOverlay: true });
        clearFlashes('user:edit');

        createOrUpdateSubuser(uuid, values, subuser)
            .then((subuser) => {
                appendSubuser(subuser);
                dismiss();
            })
            .catch((error) => {
                console.error(error);
                setPropOverrides(null);
                clearAndAddHttpError({ key: 'user:edit', error });

                if (ref.current) {
                    ref.current.scrollIntoView();
                }
            });
    };

    useEffect(
        () => () => {
            clearFlashes('user:edit');
        },
        []
    );

    return (
        <Formik
            onSubmit={submit}
            initialValues={
                {
                    email: subuser?.email || '',
                    permissions: subuser?.permissions || [],
                } as Values
            }
            validationSchema={object().shape({
                email: string()
                    .max(191, 'メールアドレスは 191 文字以内である必要があります。')
                    .email('有効なメールアドレスを入力してください。')
                    .required('有効なメールアドレスを入力してください。'),
                permissions: array().of(string()),
            })}
        >
            <Form>
                <div css={tw`flex justify-between`}>
                    <h2 css={tw`text-2xl`} ref={ref}>
                        {subuser
                            ? `${subuser.email} の権限を${canEditUser ? '変更' : '表示'}`
                            : '新しいサブユーザーを作成'}
                    </h2>
                    <div>
                        <Button type={'submit'} css={tw`w-full sm:w-auto`}>
                            {subuser ? '保存' : 'ユーザーを招待'}
                        </Button>
                    </div>
                </div>
                <FlashMessageRender byKey={'user:edit'} css={tw`mt-4`} />
                {!isRootAdmin && loggedInPermissions[0] !== '*' && (
                    <div css={tw`mt-4 pl-4 py-2 border-l-4 border-cyan-400`}>
                        <p css={tw`text-sm text-neutral-300`}>
                            他のユーザーを作成または変更するときは、現在あなたのアカウントに割り当てられている権限のみ選択できます。
                        </p>
                    </div>
                )}
                {!subuser && (
                    <div css={tw`mt-6`}>
                        <Field
                            name={'email'}
                            label={'ユーザーのメールアドレス'}
                            description={
                                'このサーバーのサブユーザーとして招待するユーザーのメールアドレスを入力してください。'
                            }
                        />
                    </div>
                )}
                <div css={tw`my-6`}>
                    {Object.keys(permissions)
                        .filter((key) => key !== 'websocket')
                        .map((key, index) => (
                            <PermissionTitleBox
                                key={`permission_${key}`}
                                title={key}
                                isEditable={canEditUser}
                                permissions={Object.keys(permissions[key].keys).map((pkey) => `${key}.${pkey}`)}
                                css={index > 0 ? tw`mt-4` : undefined}
                            >
                                <p css={tw`text-sm text-neutral-400 mb-4`}>
                                    {permissionGroupDescriptions[key] || permissions[key].description}
                                </p>
                                {Object.keys(permissions[key].keys).map((pkey) => (
                                    <PermissionRow
                                        key={`permission_${key}.${pkey}`}
                                        permission={`${key}.${pkey}`}
                                        disabled={!canEditUser || editablePermissions.indexOf(`${key}.${pkey}`) < 0}
                                    />
                                ))}
                            </PermissionTitleBox>
                        ))}
                </div>
                <Can action={subuser ? 'user.update' : 'user.create'}>
                    <div css={tw`pb-6 flex justify-end`}>
                        <Button type={'submit'} css={tw`w-full sm:w-auto`}>
                            {subuser ? '保存' : 'ユーザーを招待'}
                        </Button>
                    </div>
                </Can>
            </Form>
        </Formik>
    );
};

export default asModal<Props>({
    top: false,
})(EditSubuserModal);
