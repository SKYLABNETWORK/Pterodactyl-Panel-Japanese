import React from 'react';
import { ServerContext } from '@/state/server';
import ScreenBlock from '@/components/elements/ScreenBlock';
import ServerInstallSvg from '@/assets/images/server_installing.svg';
import ServerErrorSvg from '@/assets/images/server_error.svg';
import ServerRestoreSvg from '@/assets/images/server_restore.svg';

export default () => {
    const status = ServerContext.useStoreState((state) => state.server.data?.status || null);
    const isTransferring = ServerContext.useStoreState((state) => state.server.data?.isTransferring || false);
    const isNodeUnderMaintenance = ServerContext.useStoreState(
        (state) => state.server.data?.isNodeUnderMaintenance || false
    );

    return status === 'installing' || status === 'install_failed' || status === 'reinstall_failed' ? (
        <ScreenBlock
            title={'インストーラー実行中'}
            image={ServerInstallSvg}
            message={'サーバーはまもなく準備が完了します。数分後にもう一度お試しください。'}
        />
    ) : status === 'suspended' ? (
        <ScreenBlock
            title={'サーバー中断'}
            image={ServerErrorSvg}
            message={'このサーバーは中断されており、アクセスできません。'}
        />
    ) : isNodeUnderMaintenance ? (
        <ScreenBlock
            title={'ノードメンテナンス中'}
            image={ServerErrorSvg}
            message={'このサーバーのノードは現在メンテナンス中です。'}
        />
    ) : (
        <ScreenBlock
            title={isTransferring ? '転送中' : 'バックアップから復元中'}
            image={ServerRestoreSvg}
            message={
                isTransferring
                    ? 'サーバーは新しいノードに転送中です。後ほど再度ご確認ください。'
                    : 'サーバーは現在バックアップから復元中です。数分後にもう一度お試しください。'
            }
        />
    );
};