<?php

return [
    'location' => [
        'no_location_found' => '指定された短いコードに一致するレコードが見つかりませんでした。',
        'ask_short' => 'ロケーションの短いコード',
        'ask_long' => 'ロケーションの説明',
        'created' => '新しいロケーション (:name) がID :id で正常に作成されました。',
        'deleted' => '要求されたロケーションを正常に削除しました。',
    ],
    'user' => [
        'search_users' => 'ユーザー名、ユーザーID、またはメールアドレスを入力',
        'select_search_user' => '削除するユーザーのIDを入力 (再検索するには \'0\' を入力)',
        'deleted' => 'ユーザーはパネルから正常に削除されました。',
        'confirm_delete' => '本当にこのユーザーをパネルから削除しますか？',
        'no_users_found' => '指定された検索語に一致するユーザーは見つかりませんでした。',
        'multiple_found' => '指定されたユーザーに対して複数のアカウントが見つかりました。--no-interaction フラグのため、ユーザーを削除できません。',
        'ask_admin' => 'このユーザーは管理者ですか？',
        'ask_email' => 'メールアドレス',
        'ask_username' => 'ユーザー名',
        'ask_name_first' => '名',
        'ask_name_last' => '姓',
        'ask_password' => 'パスワード',
        'ask_password_tip' => 'ランダムなパスワードをユーザーにメールで送信してアカウントを作成する場合は、このコマンド (CTRL+C) を再実行し、`--no-password` フラグを渡してください。',
        'ask_password_help' => 'パスワードは少なくとも8文字の長さで、大文字と数字を1つ以上含む必要があります。',
        '2fa_help_text' => [
            'このコマンドは、ユーザーのアカウントで2要素認証が有効になっている場合に無効にします。これは、ユーザーがアカウントからロックアウトされた場合の回復コマンドとしてのみ使用してください。',
            'これが意図した操作でない場合は、CTRL+Cを押してこのプロセスを終了してください。',
        ],
        '2fa_disabled' => ':email の2要素認証は無効になりました。',
    ],
    'schedule' => [
        'output_line' => '`:schedule` (:hash) の最初のタスクのジョブをディスパッチしています。',
    ],
    'maintenance' => [
        'deleting_service_backup' => 'サービスバックアップファイル :file を削除しています。',
    ],
    'server' => [
        'rebuild_failed' => 'ノード ":node" 上の ":name" (#:id) の再構築リクエストがエラー: :message で失敗しました。',
        'reinstall' => [
            'failed' => 'ノード ":node" 上の ":name" (#:id) の再インストールリクエストがエラー: :message で失敗しました。',
            'confirm' => 'サーバーグループに対して再インストールを実行しようとしています。続行しますか？',
        ],
        'power' => [
            'confirm' => ':count 個のサーバーに対して :action を実行しようとしています。続行しますか？',
            'action_failed' => 'ノード ":node" 上の ":name" (#:id) の電源操作リクエストがエラー: :message で失敗しました。',
        ],
    ],
    'environment' => [
        'mail' => [
            'ask_smtp_host' => 'SMTPホスト (例: smtp.gmail.com)',
            'ask_smtp_port' => 'SMTPポート',
            'ask_smtp_username' => 'SMTPユーザー名',
            'ask_smtp_password' => 'SMTPパスワード',
            'ask_mailgun_domain' => 'Mailgunドメイン',
            'ask_mailgun_endpoint' => 'Mailgunエンドポイント',
            'ask_mailgun_secret' => 'Mailgunシークレット',
            'ask_mandrill_secret' => 'Mandrillシークレット',
            'ask_postmark_username' => 'Postmark APIキー',
            'ask_driver' => 'メール送信に使用するドライバーを選択してください。',
            'ask_mail_from' => '送信元のメールアドレス',
            'ask_mail_name' => 'メールの送信者名',
            'ask_encryption' => '使用する暗号化方式',
        ],
    ],
];