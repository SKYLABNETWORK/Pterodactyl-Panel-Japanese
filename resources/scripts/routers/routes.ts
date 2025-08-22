import React, { lazy } from 'react';
import ServerConsole from '@/components/server/console/ServerConsoleContainer';
import DatabasesContainer from '@/components/server/databases/DatabasesContainer';
import ScheduleContainer from '@/components/server/schedules/ScheduleContainer';
import UsersContainer from '@/components/server/users/UsersContainer';
import BackupContainer from '@/components/server/backups/BackupContainer';
import NetworkContainer from '@/components/server/network/NetworkContainer';
import StartupContainer from '@/components/server/startup/StartupContainer';
import FileManagerContainer from '@/components/server/files/FileManagerContainer';
import SettingsContainer from '@/components/server/settings/SettingsContainer';
import AccountOverviewContainer from '@/components/dashboard/AccountOverviewContainer';
import AccountApiContainer from '@/components/dashboard/AccountApiContainer';
import AccountSSHContainer from '@/components/dashboard/ssh/AccountSSHContainer';
import ActivityLogContainer from '@/components/dashboard/activity/ActivityLogContainer';
import ServerActivityLogContainer from '@/components/server/ServerActivityLogContainer';

// 各ルーターファイルはすでに適切にコード分割されています。
// したがって、上記の項目は、そのルーターがロードされたときにのみロードされます。
//
// これらの特定の遅延ロードされたルートは、特定のインスタンスにのみ必要な
// サーバーダッシュボードの重い画面をロードしないようにするためのものです。
const FileEditContainer = lazy(() => import('@/components/server/files/FileEditContainer'));
const ScheduleEditContainer = lazy(() => import('@/components/server/schedules/ScheduleEditContainer'));

interface RouteDefinition {
    path: string;
    // undefined が渡された場合、このルートはルーター自体にレンダリングされますが、
    // サブナビゲーションメニューにはナビゲーションリンクが表示されません。
    name: string | undefined;
    component: React.ComponentType;
    exact?: boolean;
}

interface ServerRouteDefinition extends RouteDefinition {
    permission: string | string[] | null;
}

interface Routes {
    // "/account" 以下で利用可能なすべてのルート
    account: RouteDefinition[];
    // "/server/:id" 以下で利用可能なすべてのルート
    server: ServerRouteDefinition[];
}

export default {
    account: [
        {
            path: '/',
            name: 'アカウント',
            component: AccountOverviewContainer,
            exact: true,
        },
        {
            path: '/api',
            name: 'API 認証情報',
            component: AccountApiContainer,
        },
        {
            path: '/ssh',
            name: 'SSH キー',
            component: AccountSSHContainer,
        },
        {
            path: '/activity',
            name: 'アクティビティ',
            component: ActivityLogContainer,
        },
    ],
    server: [
        {
            path: '/',
            permission: null,
            name: 'コンソール',
            component: ServerConsole,
            exact: true,
        },
        {
            path: '/files',
            permission: 'file.*',
            name: 'ファイル',
            component: FileManagerContainer,
        },
        {
            path: '/files/:action(edit|new)',
            permission: 'file.*',
            name: undefined,
            component: FileEditContainer,
        },
        {
            path: '/databases',
            permission: 'database.*',
            name: 'データベース',
            component: DatabasesContainer,
        },
        {
            path: '/schedules',
            permission: 'schedule.*',
            name: 'スケジュール',
            component: ScheduleContainer,
        },
        {
            path: '/schedules/:id',
            permission: 'schedule.*',
            name: undefined,
            component: ScheduleEditContainer,
        },
        {
            path: '/users',
            permission: 'user.*',
            name: 'ユーザー',
            component: UsersContainer,
        },
        {
            path: '/backups',
            permission: 'backup.*',
            name: 'バックアップ',
            component: BackupContainer,
        },
        {
            path: '/network',
            permission: 'allocation.*',
            name: 'ネットワーク',
            component: NetworkContainer,
        },
        {
            path: '/startup',
            permission: 'startup.*',
            name: 'スタートアップ',
            component: StartupContainer,
        },
        {
            path: '/settings',
            permission: ['settings.*', 'file.sftp'],
            name: '設定',
            component: SettingsContainer,
        },
        {
            path: '/activity',
            permission: 'activity.*',
            name: 'アクティビティ',
            component: ServerActivityLogContainer,
        },
    ],
} as Routes;
