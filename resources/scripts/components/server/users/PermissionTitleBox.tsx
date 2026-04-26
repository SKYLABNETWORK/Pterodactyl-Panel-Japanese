import React, { memo, useCallback } from 'react';
import { useField } from 'formik';
import TitledGreyBox from '@/components/elements/TitledGreyBox';
import tw from 'twin.macro';
import Input from '@/components/elements/Input';
import isEqual from 'react-fast-compare';

interface Props {
    isEditable: boolean;
    title: string;
    permissions: string[];
    className?: string;
}

const permissionTitles: Record<string, string> = {
    control: '制御',
    user: 'ユーザー',
    file: 'ファイル',
    backup: 'バックアップ',
    allocation: '割り当て',
    startup: '起動',
    database: 'データベース',
    schedule: 'スケジュール',
    settings: '設定',
    activity: 'アクティビティ',
};

const PermissionTitleBox: React.FC<Props> = memo(({ isEditable, title, permissions, className, children }) => {
    const [{ value }, , { setValue }] = useField<string[]>('permissions');

    const onCheckboxClicked = useCallback(
        (e: React.ChangeEvent<HTMLInputElement>) => {
            if (e.currentTarget.checked) {
                setValue([...value, ...permissions.filter((p) => !value.includes(p))]);
            } else {
                setValue(value.filter((p) => !permissions.includes(p)));
            }
        },
        [permissions, value]
    );

    return (
        <TitledGreyBox
            title={
                <div css={tw`flex items-center`}>
                    <p css={tw`text-sm uppercase flex-1`}>{permissionTitles[title] || title}</p>
                    {isEditable && (
                        <Input
                            type={'checkbox'}
                            checked={permissions.every((p) => value.includes(p))}
                            onChange={onCheckboxClicked}
                        />
                    )}
                </div>
            }
            className={className}
        >
            {children}
        </TitledGreyBox>
    );
}, isEqual);

export default PermissionTitleBox;
