import React from 'react';
import { Field, Form, Formik, FormikHelpers } from 'formik';
import { object, string } from 'yup';
import FormikFieldWrapper from '@/components/elements/FormikFieldWrapper';
import SpinnerOverlay from '@/components/elements/SpinnerOverlay';
import tw from 'twin.macro';
import Button from '@/components/elements/Button';
import Input, { Textarea } from '@/components/elements/Input';
import styled from 'styled-components/macro';
import { useFlashKey } from '@/plugins/useFlash';
import { createSSHKey, useSSHKeys } from '@/api/account/ssh-keys';

interface Values {
    name: string;
    publicKey: string;
}

const CustomTextarea = styled(Textarea)`
    ${tw`h-32`}
`;

export default () => {
    const { clearAndAddHttpError } = useFlashKey('account');
    const { mutate } = useSSHKeys();

    const submit = (values: Values, { setSubmitting, resetForm }: FormikHelpers<Values>) => {
        clearAndAddHttpError();

        createSSHKey(values.name, values.publicKey)
            .then((key) => {
                resetForm();
                mutate((data) => (data || []).concat(key));
            })
            .catch((error) => clearAndAddHttpError(error))
            .then(() => setSubmitting(false));
    };

    return (
        <>
            <Formik
                onSubmit={submit}
                initialValues={{ name: '', publicKey: '' }}
                validationSchema={object().shape({
                    name: string().required('SSHキー名を入力してください'),
                    publicKey: string().required('公開SSHキーを入力してください'),
                })}
            >
                {({ isSubmitting }) => (
                    <Form>
                        <SpinnerOverlay visible={isSubmitting} />
                        <FormikFieldWrapper label={'SSHキー名'} name={'name'} css={tw`mb-6`}>
                            <Field name={'name'} as={Input} />
                        </FormikFieldWrapper>
                        <FormikFieldWrapper
                            label={'公開鍵'}
                            name={'publicKey'}
                            description={'公開SSHキーを入力してください。'}
                        >
                            <Field name={'publicKey'} as={CustomTextarea} />
                        </FormikFieldWrapper>
                        <div css={tw`flex justify-end mt-6`}>
                            <Button>保存</Button>
                        </div>
                    </Form>
                )}
            </Formik>
        </>
    );
};