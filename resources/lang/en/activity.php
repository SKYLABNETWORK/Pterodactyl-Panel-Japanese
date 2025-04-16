<?php

/**
 * 様々なアクティビティログイベントの翻訳文字列をすべて含みます。
 * これらのキーは、イベント名のコロン(:)の前の値に対応している必要があります。
 * コロンが存在しない場合は、トップレベルに配置する必要があります。
 */
return [
    'auth' => [
        'fail' => 'ログイン失敗',
        'success' => 'ログイン',
        'password-reset' => 'パスワードリセット',
        'reset-password' => 'パスワードリセットを要求',
        'checkpoint' => '二段階認証を要求',
        'recovery-token' => '二段階認証リカバリートークンを使用',
        'token' => '二段階認証チャレンジを解決',
        'ip-blocked' => '未登録のIPアドレスからの :identifier に対するリクエストをブロック',
        'sftp' => [
            'fail' => 'SFTPログイン失敗',
        ],
    ],
    'user' => [
        'account' => [
            'email-changed' => 'メールアドレスを :old から :new に変更',
            'password-changed' => 'パスワードを変更',
        ],
        'api-key' => [
            'create' => '新しいAPIキー :identifier を作成',
            'delete' => 'APIキー :identifier を削除',
        ],
        'ssh-key' => [
            'create' => 'SSHキー :fingerprint をアカウントに追加',
            'delete' => 'SSHキー :fingerprint をアカウントから削除',
        ],
        'two-factor' => [
            'create' => '二段階認証を有効化',
            'delete' => '二段階認証を無効化',
        ],
    ],
    'server' => [
        'reinstall' => 'サーバーを再インストール',
        'console' => [
            'command' => 'サーバー上で ":command" を実行',
        ],
        'power' => [
            'start' => 'サーバーを起動',
            'stop' => 'サーバーを停止',
            'restart' => 'サーバーを再起動',
            'kill' => 'サーバープロセスを強制終了',
        ],
        'backup' => [
            'download' => ':name バックアップをダウンロード',
            'delete' => ':name バックアップを削除',
            'restore' => ':name バックアップを復元 (削除されたファイル: :truncate)',
            'restore-complete' => ':name バックアップの復元を完了',
            'restore-failed' => ':name バックアップの復元に失敗',
            'start' => '新しいバックアップ :name を開始',
            'complete' => ':name バックアップを完了としてマーク',
            'fail' => ':name バックアップを失敗としてマーク',
            'lock' => ':name バックアップをロック',
            'unlock' => ':name バックアップをアンロック',
        ],
        'database' => [
            'create' => '新しいデータベース :name を作成',
            'rotate-password' => 'データベース :name のパスワードをローテーション',
            'delete' => 'データベース :name を削除',
        ],
        'file' => [
            'compress_one' => ':directory 内の :file を圧縮',
            'compress_other' => ':directory 内の :count 個のファイルを圧縮',
            'read' => ':file の内容を表示',
            'copy' => ':file のコピーを作成',
            'create-directory' => ':directory 内に :name ディレクトリを作成',
            'decompress' => ':directory 内の :files を解凍',
            'delete_one' => ':directory 内の :files.0 を削除',
            'delete_other' => ':directory 内の :count 個のファイルを削除',
            'download' => ':file をダウンロード',
            'pull' => 'リモートファイル :url を :directory にダウンロード',
            'rename_one' => ':directory 内の :files.0.from を :files.0.to に改名',
            'rename_other' => ':directory 内の :count 個のファイルの名前を変更',
            'write' => ':file に新しいコンテンツを書き込み',
            'upload' => 'ファイルのアップロードを開始',
            'uploaded' => ':directory 内の :file をアップロード',
        ],
        'sftp' => [
            'denied' => '権限がないためSFTPアクセスを拒否',
            'create_one' => ':files.0 を作成',
            'create_other' => ':count 個の新しいファイルを作成',
            'write_one' => ':files.0 の内容を変更',
            'write_other' => ':count 個のファイルの内容を変更',
            'delete_one' => ':files.0 を削除',
            'delete_other' => ':count 個のファイルを削除',
            'create-directory_one' => ':files.0 ディレクトリを作成',
            'create-directory_other' => ':count 個のディレクトリを作成',
            'rename_one' => ':files.0.from を :files.0.to に改名',
            'rename_other' => ':count 個のファイルの名前を変更または移動',
        ],
        'allocation' => [
            'create' => ':allocation をサーバーに追加',
            'notes' => ':allocation のノートを ":old" から ":new" に更新',
            'primary' => ':allocation をサーバーのプライマリアロケーションに設定',
            'delete' => ':allocation アロケーションを削除',
        ],
        'schedule' => [
            'create' => ':name スケジュールを作成',
            'update' => ':name スケジュールを更新',
            'execute' => ':name スケジュールを手動で実行',
            'delete' => ':name スケジュールを削除',
        ],
        'task' => [
            'create' => ':name スケジュールに新しい ":action" タスクを作成',
            'update' => ':name スケジュールの ":action" タスクを更新',
            'delete' => ':name スケジュールのタスクを削除',
        ],
        'settings' => [
            'rename' => 'サーバーの名前を :old から :new に変更',
            'description' => 'サーバーの説明を :old から :new に変更',
        ],
        'startup' => [
            'edit' => ':variable 変数を ":old" から ":new" に変更',
            'image' => 'サーバーのDockerイメージを :old から :new に更新',
        ],
        'subuser' => [
            'create' => ':email をサブユーザーとして追加',
            'update' => ':email のサブユーザー権限を更新',
            'delete' => ':email をサブユーザーから削除',
        ],
    ],
];