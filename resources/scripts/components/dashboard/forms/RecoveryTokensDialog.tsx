import React from 'react';
import { Dialog, DialogProps } from '@/components/elements/dialog';
import { Button } from '@/components/elements/button/index';
import CopyOnClick from '@/components/elements/CopyOnClick';
import { Alert } from '@/components/elements/alert';

interface RecoveryTokenDialogProps extends DialogProps {
    tokens: string[];
}

export default ({ tokens, open, onClose }: RecoveryTokenDialogProps) => {
    const grouped = [] as [string, string][];
    tokens.forEach((token, index) => {
        if (index % 2 === 0) {
            grouped.push([token, tokens[index + 1] || '']);
        }
    });

    return (
        <Dialog
            open={open}
            onClose={onClose}
            title={'2段階認証が有効になりました'}
            description={
                '下のコードを安全な場所に保管してください。携帯電話にアクセスできなくなった場合、これらのバックアップコードを使用してサインインできます。'
            }
            hideCloseIcon
            preventExternalClose
        >
            <Dialog.Icon position={'container'} type={'success'} />
            <CopyOnClick text={tokens.join('\n')} showInNotification={false}>
                <pre className={'bg-gray-800 rounded p-2 mt-6'}>
                    {grouped.map((value) => (
                        <span key={value.join('_')} className={'block'}>
                            {value[0]}
                            <span className={'mx-2 selection:bg-gray-800'}>&nbsp;</span>
                            {value[1]}
                            <span className={'selection:bg-gray-800'}>&nbsp;</span>
                        </span>
                    ))}
                </pre>
            </CopyOnClick>
            <Alert type={'danger'} className={'mt-3'}>
                これらのコードは再度表示されません。
            </Alert>
            <Dialog.Footer>
                <Button.Text onClick={onClose}>完了</Button.Text>
            </Dialog.Footer>
        </Dialog>
    );
};
