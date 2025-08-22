<?php

return [
    'location' => [
        'no_location_found' => '指定されたショートコードに一致するレコードが見つかりませんでした。',
        'ask_short' => 'ロケーションショートコード',
        'ask_long' => 'ロケーションの説明',
        'created' => '新しいロケーション (:name) をID :idで正常に作成しました。',
        'deleted' => 'リクエストされたロケーションを正常に削除しました。',
    ],
    'user' => [
        'search_users' => 'ユーザー名、ユーザーID、またはEメールアドレスを入力してください',
        'select_search_user' => '削除するユーザーのID（再検索するには「0」を入力）',
        'deleted' => 'ユーザーはパネルから正常に削除されました。',
        'confirm_delete' => 'このユーザーをパネルから削除してもよろしいですか？',
        'no_users_found' => '指定された検索語に一致するユーザーは見つかりませんでした。',
        'multiple_found' => '指定されたユーザーに対して複数のアカウントが見つかりました。--no-interactionフラグのため、ユーザーを削除できません。',
        'ask_admin' => 'このユーザーは管理者ですか？',
        'ask_email' => 'Eメールアドレス',
        'ask_username' => 'ユーザー名',
        'ask_name_first' => '名',
        'ask_name_last' => '姓',
        'ask_password' => 'パスワード',
        'ask_password_tip' => 'ランダムなパスワードを持つアカウントを作成し、そのパスワードをユーザーにメールで送信したい場合は、このコマンドを再実行（CTRL+C）して、`--no-password`フラグを渡してください。',
        'ask_password_help' => 'パスワードは8文字以上で、大文字と数字をそれぞれ1文字以上含める必要があります。',
        '2fa_help_text' => [
            'このコマンドは、ユーザーアカウントで2要素認証が有効になっている場合、それを無効にします。これは、ユーザーがアカウントからロックアウトされた場合の、アカウント復旧コマンドとしてのみ使用してください。',
            'これを実行したくない場合は、CTRL+Cを押してこのプロセスを終了してください。',
        ],
        '2fa_disabled' => ':emailの2要素認証は無効になりました。',
    ],
    'schedule' => [
        'output_line' => '`:schedule`の最初のタスクのジョブをディスパッチしています（:hash）。',
    ],
    'maintenance' => [
        'deleting_service_backup' => 'サービスバックアップファイル:fileを削除しています。',
    ],
    'server' => [
        'rebuild_failed' => 'ノード`:node`上の`:name`（#:id）の再構築リクエストは、エラー`:message`で失敗しました。',
        'reinstall' => [
            'failed' => 'ノード`:node`上の`:name`（#:id）の再インストールリクエストは、エラー`:message`で失敗しました。',
            'confirm' => 'サーバーグループに対して再インストールを実行しようとしています。続行しますか？',
        ],
        'power' => [
            'confirm' => ':count台のサーバーに対して`:action`を実行しようとしています。続行しますか？',
            'action_failed' => 'ノード`:node`上の`:name`（#:id）のパワーアクションリクエストは、エラー`:message`で失敗しました。',
        ],
    ],
    'environment' => [
        'mail' => [
            'ask_smtp_host' => 'SMTPホスト（例: smtp.gmail.com）',
            'ask_smtp_port' => 'SMTPポート',
            'ask_smtp_username' => 'SMTPユーザー名',
            'ask_smtp_password' => 'SMTPパスワード',
            'ask_mailgun_domain' => 'Mailgunドメイン',
            'ask_mailgun_endpoint' => 'Mailgunエンドポイント',
            'ask_mailgun_secret' => 'Mailgunシークレット',
            'ask_mandrill_secret' => 'Mandrillシークレット',
            'ask_postmark_username' => 'Postmark APIキー',
            'ask_driver' => 'メール送信に使用するドライバー',
            'ask_mail_from' => 'メールの送信元となるメールアドレス',
            'ask_mail_name' => 'メールの送信元として表示される名前',
            'ask_encryption' => '使用する暗号化方式',
        ],
    ],
];
