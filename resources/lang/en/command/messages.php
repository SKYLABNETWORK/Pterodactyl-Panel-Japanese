<?php

return [
    'location' => [
        'no_location_found' => '指定されたショートコードに一致するレコードが見つかりませんでした。',
        'ask_short' => 'ロケーションのショートコード',
        'ask_long' => 'ロケーションの説明',
        'created' => 'ID :id の新しいロケーション（:name）を正常に作成しました。',
        'deleted' => '要求されたロケーションを正常に削除しました。',
    ],
    'user' => [
        'search_users' => 'ユーザー名、ユーザーID、またはメールアドレスを入力してください',
        'select_search_user' => '削除するユーザーのID（再検索するには \'0\' を入力）',
        'deleted' => 'ユーザーをパネルから正常に削除しました。',
        'confirm_delete' => 'このユーザーをパネルから削除してもよろしいですか？',
        'no_users_found' => '指定された検索語に一致するユーザーは見つかりませんでした。',
        'multiple_found' => '指定されたユーザーに対して複数のアカウントが見つかったため、--no-interaction フラグによりユーザーを削除できません。',
        'ask_admin' => 'このユーザーは管理者ですか？',
        'ask_email' => 'メールアドレス',
        'ask_username' => 'ユーザー名',
        'ask_name_first' => '名',
        'ask_name_last' => '姓',
        'ask_password' => 'パスワード',
        'ask_password_tip' => 'ランダムなパスワードをメール送信してアカウントを作成する場合は、このコマンドを再実行（CTRL+C）し、`--no-password` フラグを渡してください。',
        'ask_password_help' => 'パスワードは8文字以上で、少なくとも1つの大文字と数字を含める必要があります。',
        '2fa_help_text' => [
            'このコマンドは、有効になっている場合にユーザーアカウントの2要素認証を無効にします。ユーザーがアカウントからロックアウトされた場合のアカウント復旧コマンドとしてのみ使用してください。',
            'これが意図した操作でない場合は、CTRL+C を押してこの処理を終了してください。',
        ],
        '2fa_disabled' => ':email の2要素認証を無効にしました。',
    ],
    'schedule' => [
        'output_line' => '`:schedule` の最初のタスクのジョブをディスパッチしています（:hash）。',
    ],
    'maintenance' => [
        'deleting_service_backup' => 'サービスバックアップファイル :file を削除しています。',
    ],
    'server' => [
        'rebuild_failed' => 'ノード ":node" 上の ":name"（#:id）の再ビルド要求がエラーで失敗しました: :message',
        'reinstall' => [
            'failed' => 'ノード ":node" 上の ":name"（#:id）の再インストール要求がエラーで失敗しました: :message',
            'confirm' => '複数のサーバーに対して再インストールを実行しようとしています。続行しますか？',
        ],
        'power' => [
            'confirm' => ':count 台のサーバーに対して :action を実行しようとしています。続行しますか？',
            'action_failed' => 'ノード ":node" 上の ":name"（#:id）の電源操作要求がエラーで失敗しました: :message',
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
            'ask_driver' => 'メール送信に使用するドライバーはどれですか？',
            'ask_mail_from' => 'メールの送信元メールアドレス',
            'ask_mail_name' => 'メールの送信者名として表示する名前',
            'ask_encryption' => '使用する暗号化方式',
        ],
    ],
];
