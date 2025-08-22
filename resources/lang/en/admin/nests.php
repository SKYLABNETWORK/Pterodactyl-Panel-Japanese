<?php

return [
    'notices' => [
        'created' => '新しいNest「:name」が正常に作成されました。',
        'deleted' => '要求されたNestをパネルから正常に削除しました。',
        'updated' => 'Nestの設定オプションを正常に更新しました。',
    ],
    'eggs' => [
        'notices' => [
            'imported' => 'このEggとそれに関連する変数を正常にインポートしました。',
            'updated_via_import' => '提供されたファイルを使用して、このEggが更新されました。',
            'deleted' => '要求されたEggをパネルから正常に削除しました。',
            'updated' => 'Eggの設定が正常に更新されました。',
            'script_updated' => 'Eggのインストールスクリプトが更新され、サーバーがインストールされるたびに実行されます。',
            'egg_created' => '新しいEggが正常に作成されました。この新しいEggを適用するには、実行中のデーモンを再起動する必要があります。',
        ],
    ],
    'variables' => [
        'notices' => [
            'variable_deleted' => '変数「:variable」が削除され、再構築後はサーバーで利用できなくなります。',
            'variable_updated' => '変数「:variable」が更新されました。変更を適用するには、この変数を使用しているすべてのサーバーを再構築する必要があります。',
            'variable_created' => '新しい変数が正常に作成され、このEggに割り当てられました。',
        ],
    ],
];
