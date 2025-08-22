<?php

return [
    'daemon_connection_failed' => 'デーモンとの通信中に例外が発生し、HTTP/:codeのレスポンスコードが返されました。この例外はログに記録されました。',
    'node' => [
        'servers_attached' => 'ノードを削除するには、サーバーが1つもリンクされていない必要があります。',
        'daemon_off_config_updated' => 'デーモンの設定は<strong>更新されました</strong>が、デーモン側の設定ファイルを自動的に更新しようとした際にエラーが発生しました。これらの変更を適用するには、デーモンの設定ファイル (config.yml) を手動で更新する必要があります。',
    ],
    'allocations' => [
        'server_using' => 'この割り当てには現在サーバーが割り当てられています。割り当ては、サーバーが割り当てられていない場合にのみ削除できます。',
        'too_many_ports' => '一度に1000個を超えるポートを単一の範囲で追加することはサポートされていません。',
        'invalid_mapping' => ':portの指定は無効であり、処理できませんでした。',
        'cidr_out_of_range' => 'CIDR表記では、/25から/32の間のマスクのみが許可されています。',
        'port_out_of_range' => '割り当てのポートは1024より大きく、65535以下である必要があります。',
    ],
    'nest' => [
        'delete_has_servers' => 'アクティブなサーバーがアタッチされているNestは、パネルから削除できません。',
        'egg' => [
            'delete_has_servers' => 'アクティブなサーバーがアタッチされているEggは、パネルから削除できません。',
            'invalid_copy_id' => 'スクリプトのコピー元として選択されたEggは存在しないか、またはそれ自体がスクリプトをコピー中です。',
            'must_be_child' => 'このEggの「設定のコピー元」の指示は、選択されたNestの子オプションである必要があります。',
            'has_children' => 'このEggは1つ以上の他のEggの親です。このEggを削除する前に、それらのEggを削除してください。',
        ],
        'variables' => [
            'env_not_unique' => '環境変数 :name はこのEgg内で一意である必要があります。',
            'reserved_name' => '環境変数 :name は保護されているため、変数に割り当てることはできません。',
            'bad_validation_rule' => 'バリデーションルール ":rule" は、このアプリケーションでは有効なルールではありません。',
        ],
        'importer' => [
            'json_error' => 'JSONファイルの解析中にエラーが発生しました: :error。',
            'file_error' => '提供されたJSONファイルは無効でした。',
            'invalid_json_provided' => '提供されたJSONファイルは認識できる形式ではありません。',
        ],
    ],
    'subusers' => [
        'editing_self' => '自分自身のサブユーザーアカウントの編集は許可されていません。',
        'user_is_owner' => 'サーバーの所有者をこのサーバーのサブユーザーとして追加することはできません。',
        'subuser_exists' => 'このメールアドレスを持つユーザーは、すでにこのサーバーのサブユーザーとして割り当てられています。',
    ],
    'databases' => [
        'delete_has_databases' => 'アクティブなデータベースがリンクされているデータベースホストサーバーは削除できません。',
    ],
    'tasks' => [
        'chain_interval_too_long' => 'チェーンされたタスクの最大間隔時間は15分です。',
    ],
    'locations' => [
        'has_nodes' => 'アクティブなノードがアタッチされているロケーションは削除できません。',
    ],
    'users' => [
        'node_revocation_failed' => '<a href=":link">ノード #:node</a> でキーの取り消しに失敗しました。:error',
    ],
    'deployment' => [
        'no_viable_nodes' => '自動デプロイメントに指定された要件を満たすノードは見つかりませんでした。',
        'no_viable_allocations' => '自動デプロイメントの要件を満たす割り当ては見つかりませんでした。',
    ],
    'api' => [
        'resource_not_found' => '要求されたリソースはこのサーバーには存在しません。',
    ],
];
