import styled from 'styled-components/macro';
import tw from 'twin.macro';
import Checkbox from '@/components/elements/Checkbox';
import React from 'react';
import { useStoreState } from 'easy-peasy';
import Label from '@/components/elements/Label';

const Container = styled.label`
    ${tw`flex items-center border border-transparent rounded md:p-2 transition-colors duration-75`};
    text-transform: none;

    &:not(.disabled) {
        ${tw`cursor-pointer`};

        &:hover {
            ${tw`border-neutral-500 bg-neutral-800`};
        }
    }

    &:not(:first-of-type) {
        ${tw`mt-4 sm:mt-2`};
    }

    &.disabled {
        ${tw`opacity-50`};

        & input[type='checkbox']:not(:checked) {
            ${tw`border-0`};
        }
    }
`;

interface Props {
    permission: string;
    disabled: boolean;
}

const permissionLabels: Record<string, string> = {
    connect: '接続',
    console: 'コンソール',
    start: '起動',
    stop: '停止',
    restart: '再起動',
    create: '作成',
    read: '表示',
    update: '更新',
    delete: '削除',
    'read-content': '内容表示',
    archive: 'アーカイブ',
    sftp: 'SFTP',
    download: 'ダウンロード',
    restore: '復元',
    'docker-image': 'Docker イメージ',
    view_password: 'パスワード表示',
    rename: '名前変更',
    reinstall: '再インストール',
};

const permissionDescriptions: Record<string, string> = {
    'control.console': 'コンソールからサーバーインスタンスへコマンドを送信できます。',
    'control.start': '停止中のサーバーを起動できます。',
    'control.stop': '実行中のサーバーを停止できます。',
    'control.restart': 'サーバーを再起動できます。オフライン時は起動できますが、完全な停止状態にはできません。',
    'user.create': 'このサーバーの新しいサブユーザーを作成できます。',
    'user.read': 'このサーバーのサブユーザーと権限を表示できます。',
    'user.update': '他のサブユーザーを変更できます。',
    'user.delete': 'サーバーからサブユーザーを削除できます。',
    'file.create': 'パネルまたは直接アップロードで、追加のファイルやフォルダーを作成できます。',
    'file.read': 'ディレクトリの内容を表示できますが、ファイルの内容表示やダウンロードはできません。',
    'file.read-content': '指定されたファイルの内容を表示できます。ファイルのダウンロードも可能になります。',
    'file.update': '既存のファイルまたはディレクトリの内容を更新できます。',
    'file.delete': 'ファイルまたはディレクトリを削除できます。',
    'file.archive': 'ディレクトリ内容のアーカイブ作成、および既存アーカイブの展開ができます。',
    'file.sftp': 'SFTP に接続し、割り当て済みの他のファイル権限を使ってサーバーファイルを管理できます。',
    'backup.create': 'このサーバーの新しいバックアップを作成できます。',
    'backup.read': 'このサーバーに存在するすべてのバックアップを表示できます。',
    'backup.delete': 'システムからバックアップを削除できます。',
    'backup.download': 'サーバーのバックアップをダウンロードできます。注意: バックアップ内の全ファイルへアクセス可能になります。',
    'backup.restore': 'サーバーのバックアップを復元できます。注意: 処理中にサーバーファイルを削除できます。',
    'allocation.read': 'このサーバーに現在割り当てられているすべての割り当てを表示できます。プライマリ割り当ては、どのアクセス権でも常に表示できます。',
    'allocation.create': 'サーバーへ追加の割り当てを割り当てできます。',
    'allocation.update': 'プライマリ割り当てを変更し、各割り当てにメモを追加できます。',
    'allocation.delete': 'サーバーから割り当てを削除できます。',
    'startup.read': 'サーバーの起動変数を表示できます。',
    'startup.update': 'サーバーの起動変数を変更できます。',
    'startup.docker-image': 'サーバー実行時に使用する Docker イメージを変更できます。',
    'database.create': 'このサーバーの新しいデータベースを作成できます。',
    'database.read': 'このサーバーに関連付けられたデータベースを表示できます。',
    'database.update': 'データベースインスタンスのパスワードを再生成できます。パスワード表示権限がない場合、更新後のパスワードは表示されません。',
    'database.delete': 'このサーバーからデータベースインスタンスを削除できます。',
    'database.view_password': 'このサーバーのデータベースインスタンスに関連付けられたパスワードを表示できます。',
    'schedule.create': 'このサーバーの新しいスケジュールを作成できます。',
    'schedule.read': 'このサーバーのスケジュールと関連タスクを表示できます。',
    'schedule.update': 'このサーバーのスケジュールとスケジュールタスクを更新できます。',
    'schedule.delete': 'このサーバーのスケジュールを削除できます。',
    'settings.rename': 'このサーバーの名前変更と説明変更ができます。',
    'settings.reinstall': 'このサーバーの再インストールを実行できます。',
    'activity.read': 'このサーバーのアクティビティログを表示できます。',
};

const PermissionRow = ({ permission, disabled }: Props) => {
    const [key, pkey] = permission.split('.', 2);
    const permissions = useStoreState((state) => state.permissions.data);

    return (
        <Container htmlFor={`permission_${permission}`} className={disabled ? 'disabled' : undefined}>
            <div css={tw`p-2`}>
                <Checkbox
                    id={`permission_${permission}`}
                    name={'permissions'}
                    value={permission}
                    css={tw`w-5 h-5 mr-2`}
                    disabled={disabled}
                />
            </div>
            <div css={tw`flex-1`}>
                <Label as={'p'} css={tw`font-medium`}>
                    {permissionLabels[pkey] || pkey}
                </Label>
                {permissions[key].keys[pkey].length > 0 && (
                    <p css={tw`text-xs text-neutral-400 mt-1`}>
                        {permissionDescriptions[permission] || permissions[key].keys[pkey]}
                    </p>
                )}
            </div>
        </Container>
    );
};

export default PermissionRow;
