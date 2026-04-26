<?php

return [
    'validation' => [
        'fqdn_not_resolvable' => '指定されたFQDNまたはIPアドレスは、有効なIPアドレスに解決できません。',
        'fqdn_required_for_ssl' => 'このノードでSSLを使用するには、公開IPアドレスに解決される完全修飾ドメイン名が必要です。',
    ],
    'notices' => [
        'allocations_added' => 'このノードに割り当てを正常に追加しました。',
        'node_deleted' => 'ノードをパネルから正常に削除しました。',
        'location_required' => 'このパネルにノードを追加する前に、少なくとも1つのロケーションを構成する必要があります。',
        'node_created' => '新しいノードを正常に作成しました。このマシン上のデーモンは、\'Configuration\' タブから自動構成できます。サーバーを追加する前に、少なくとも1つのIPアドレスとポートを割り当てる必要があります。',
        'node_updated' => 'ノード情報が更新されました。デーモン設定を変更した場合、それらを反映するには再起動が必要です。',
        'unallocated_deleted' => '<code>:ip</code> の未割り当てポートをすべて削除しました。',
    ],
];
