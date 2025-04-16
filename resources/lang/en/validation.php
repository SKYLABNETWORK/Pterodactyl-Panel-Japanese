<?php

return [
    /*
    |--------------------------------------------------------------------------
    | バリデーション言語設定
    |--------------------------------------------------------------------------
    |
    | 以下の言語設定は、バリデータークラスが使用するデフォルトのエラーメッセージを含んでいます。
    | sizeルールのように、複数のバージョンを持つルールもあります。
    | ここでこれらのメッセージを自由に調整してください。
    |
    */

    'accepted' => ':attribute を承認する必要があります。',
    'active_url' => ':attribute は有効なURLではありません。',
    'after' => ':attribute は :date より後の日付である必要があります。',
    'after_or_equal' => ':attribute は :date 以降の日付である必要があります。',
    'alpha' => ':attribute は文字のみを含むことができます。',
    'alpha_dash' => ':attribute は文字、数字、ダッシュ(-)のみを含むことができます。',
    'alpha_num' => ':attribute は文字と数字のみを含むことができます。',
    'array' => ':attribute は配列である必要があります。',
    'before' => ':attribute は :date より前の日付である必要があります。',
    'before_or_equal' => ':attribute は :date 以前の日付である必要があります。',
    'between' => [
        'numeric' => ':attribute は :min から :max の間でなければなりません。',
        'file' => ':attribute は :min から :max キロバイトの間でなければなりません。',
        'string' => ':attribute は :min から :max 文字の間でなければなりません。',
        'array' => ':attribute は :min から :max 個のアイテムを持たなければなりません。',
    ],
    'boolean' => ':attribute フィールドは true か false である必要があります。',
    'confirmed' => ':attribute の確認が一致しません。',
    'date' => ':attribute は有効な日付ではありません。',
    'date_format' => ':attribute はフォーマット :format と一致しません。',
    'different' => ':attribute と :other は異なる必要があります。',
    'digits' => ':attribute は :digits 桁である必要があります。',
    'digits_between' => ':attribute は :min から :max 桁の間でなければなりません。',
    'dimensions' => ':attribute の画像サイズが無効です。',
    'distinct' => ':attribute フィールドには重複した値があります。',
    'email' => ':attribute は有効なメールアドレスである必要があります。',
    'exists' => '選択された :attribute は無効です。',
    'file' => ':attribute はファイルである必要があります。',
    'filled' => ':attribute フィールドは必須です。',
    'image' => ':attribute は画像である必要があります。',
    'in' => '選択された :attribute は無効です。',
    'in_array' => ':attribute フィールドは :other に存在しません。',
    'integer' => ':attribute は整数である必要があります。',
    'ip' => ':attribute は有効なIPアドレスである必要があります。',
    'json' => ':attribute は有効なJSON文字列である必要があります。',
    'max' => [
        'numeric' => ':attribute は :max より大きくてはいけません。',
        'file' => ':attribute は :max キロバイトより大きくてはいけません。',
        'string' => ':attribute は :max 文字より大きくてはいけません。',
        'array' => ':attribute は :max 個より多くのアイテムを持ってはいけません。',
    ],
    'mimes' => ':attribute は :values タイプのファイルである必要があります。',
    'mimetypes' => ':attribute は :values タイプのファイルである必要があります。',
    'min' => [
        'numeric' => ':attribute は少なくとも :min でなければなりません。',
        'file' => ':attribute は少なくとも :min キロバイトでなければなりません。',
        'string' => ':attribute は少なくとも :min 文字でなければなりません。',
        'array' => ':attribute は少なくとも :min 個のアイテムを持たなければなりません。',
    ],
    'not_in' => '選択された :attribute は無効です。',
    'numeric' => ':attribute は数値である必要があります。',
    'present' => ':attribute フィールドが存在する必要があります。',
    'regex' => ':attribute の形式が無効です。',
    'required' => ':attribute フィールドは必須です。',
    'required_if' => ':other が :value の場合、:attribute フィールドは必須です。',
    'required_unless' => ':other が :values にない限り、:attribute フィールドは必須です。',
    'required_with' => ':values が存在する場合、:attribute フィールドは必須です。',
    'required_with_all' => ':values がすべて存在する場合、:attribute フィールドは必須です。',
    'required_without' => ':values が存在しない場合、:attribute フィールドは必須です。',
    'required_without_all' => ':values が一つも存在しない場合、:attribute フィールドは必須です。',
    'same' => ':attribute と :other は一致する必要があります。',
    'size' => [
        'numeric' => ':attribute は :size である必要があります。',
        'file' => ':attribute は :size キロバイトである必要があります。',
        'string' => ':attribute は :size 文字である必要があります。',
        'array' => ':attribute は :size 個のアイテムを含む必要があります。',
    ],
    'string' => ':attribute は文字列である必要があります。',
    'timezone' => ':attribute は有効なタイムゾーンである必要があります。',
    'unique' => ':attribute はすでに使用されています。',
    'uploaded' => ':attribute のアップロードに失敗しました。',
    'url' => ':attribute の形式が無効です。',

    /*
    |--------------------------------------------------------------------------
    | カスタムバリデーション属性
    |--------------------------------------------------------------------------
    |
    | 以下の言語設定は、属性のプレースホルダーを、より読みやすいもの（例えば「email」の代わりに「Eメールアドレス」）
    | に置き換えるために使用されます。これにより、メッセージを少しきれいにすることができます。
    |
    */

    'attributes' => [],

    // Pterodactylの内部バリデーションロジック
    'internal' => [
        'variable_value' => ':env 変数',
        'invalid_password' => '提供されたパスワードはこのアカウントに対して無効です。',
    ],
];