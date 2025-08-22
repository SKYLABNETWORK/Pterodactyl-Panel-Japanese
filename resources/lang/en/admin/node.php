<?php

return [
    'validation' => [
        'fqdn_not_resolvable' => '提供されたFQDNまたはIPアドレスは、有効なIPアドレスに解決されません。',
        'fqdn_required_for_ssl' => 'このノードでSSLを使用するには、パブリックIPアドレスに解決される完全修飾ドメイン名が必要です。',
    ],
    'notices' => [
        'allocations_added' => '割り当てがこのノードに正常に追加されました。',
        'node_deleted' => 'ノードがパネルから正常に削除されました。',
        'location_required' => 'このパネルにノードを追加する前に、少なくとも1つのロケーションを構成する必要があります。',
        'node_created' => '新しいノードが正常に作成されました。「Configuration」タブにアクセスして、このマシンでデーモンを自動的に構成できます。<strong>サーバーを追加する前に、まず少なくとも1つのIPアドレスとポートを割り当てる必要があります。</strong>',
        'node_updated' => 'ノード情報が更新されました。デーモンの設定が変更された場合、それらの変更を有効にするには再起動する必要があります。',
        'unallocated_deleted' => '<code>:ip</code>の割り当てられていないすべてのポートを削除しました。',
    ],
];
