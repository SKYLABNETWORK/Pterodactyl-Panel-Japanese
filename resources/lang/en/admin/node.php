<?php

return [
    'validation' => [
        'fqdn_not_resolvable' => '指定されたFQDNまたはIPアドレスは、有効なIPアドレスに解決できません。',
        'fqdn_required_for_ssl' => 'このノードでSSLを使用するには、パブリックIPアドレスに解決される完全修飾ドメイン名が必要です。',
    ],
    'notices' => [
        'allocations_added' => '割り当てがこのノードに正常に追加されました。',
        'node_deleted' => 'ノードがパネルから正常に削除されました。',
        'location_required' => 'このパネルにノードを追加する前に、少なくとも1つのロケーションを設定する必要があります。',
        'node_created' => '新しいノードが正常に作成されました。「構成」タブにアクセスすると、このマシン上のデーモンを自動的に構成できます。**サーバーを追加する前に、少なくとも1つのIPアドレスとポートを割り当てる必要があります。**',
        'node_updated' => 'ノード情報が更新されました。デーモンの設定が変更された場合は、変更を有効にするために再起動する必要があります。',
        'unallocated_deleted' => '<code>:ip</code> の未割り当てポートをすべて削除しました。',
    ],
];