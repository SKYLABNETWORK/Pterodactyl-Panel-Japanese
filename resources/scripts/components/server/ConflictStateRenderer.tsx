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
            title={'インストーラーを実行中'}
            image={ServerInstallSvg}
            message={'サーバーはまもなく利用可能になります。数分後にもう一度お試しください。'}
        />
    ) : status === 'suspended' ? (
        <ScreenBlock
            title={'サーバーは停止されています'}
            image={ServerErrorSvg}
            message={'このサーバーは停止されているためアクセスできません。'}
        />
    ) : isNodeUnderMaintenance ? (
        <ScreenBlock
            title={'ノードはメンテナンス中です'}
            image={ServerErrorSvg}
            message={'このサーバーのノードは現在メンテナンス中です。'}
        />
    ) : (
        <ScreenBlock
            title={isTransferring ? '転送中' : 'バックアップから復元中'}
            image={ServerRestoreSvg}
            message={
                isTransferring
                    ? 'サーバーを新しいノードへ転送しています。後でもう一度確認してください。'
                    : 'サーバーをバックアップから復元しています。数分後にもう一度確認してください。'
            }
        />
    );
};
