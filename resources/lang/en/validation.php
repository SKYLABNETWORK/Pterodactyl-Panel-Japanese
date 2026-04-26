<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute を承認してください。',
    'active_url' => ':attribute は有効なURLではありません。',
    'after' => ':attribute には :date より後の日付を指定してください。',
    'after_or_equal' => ':attribute には :date 以降の日付を指定してください。',
    'alpha' => ':attribute には文字のみ使用できます。',
    'alpha_dash' => ':attribute には文字、数字、ダッシュのみ使用できます。',
    'alpha_num' => ':attribute には文字と数字のみ使用できます。',
    'array' => ':attribute は配列である必要があります。',
    'before' => ':attribute には :date より前の日付を指定してください。',
    'before_or_equal' => ':attribute には :date 以前の日付を指定してください。',
    'between' => [
        'numeric' => ':attribute は :min から :max の間である必要があります。',
        'file' => ':attribute は :min から :max キロバイトの間である必要があります。',
        'string' => ':attribute は :min から :max 文字の間である必要があります。',
        'array' => ':attribute の項目数は :min から :max の間である必要があります。',
    ],
    'boolean' => ':attribute フィールドは true または false である必要があります。',
    'confirmed' => ':attribute の確認用入力が一致しません。',
    'date' => ':attribute は有効な日付ではありません。',
    'date_format' => ':attribute は :format 形式と一致しません。',
    'different' => ':attribute と :other は異なる必要があります。',
    'digits' => ':attribute は :digits 桁である必要があります。',
    'digits_between' => ':attribute は :min から :max 桁の間である必要があります。',
    'dimensions' => ':attribute の画像サイズが無効です。',
    'distinct' => ':attribute フィールドに重複した値があります。',
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
        'numeric' => ':attribute は :max より大きくできません。',
        'file' => ':attribute は :max キロバイトより大きくできません。',
        'string' => ':attribute は :max 文字より大きくできません。',
        'array' => ':attribute の項目数は :max 個を超えられません。',
    ],
    'mimes' => ':attribute は次の種類のファイルである必要があります: :values。',
    'mimetypes' => ':attribute は次の種類のファイルである必要があります: :values。',
    'min' => [
        'numeric' => ':attribute は少なくとも :min である必要があります。',
        'file' => ':attribute は少なくとも :min キロバイトである必要があります。',
        'string' => ':attribute は少なくとも :min 文字である必要があります。',
        'array' => ':attribute には少なくとも :min 個の項目が必要です。',
    ],
    'not_in' => '選択された :attribute は無効です。',
    'numeric' => ':attribute は数値である必要があります。',
    'present' => ':attribute フィールドが存在している必要があります。',
    'regex' => ':attribute の形式が無効です。',
    'required' => ':attribute フィールドは必須です。',
    'required_if' => ':other が :value の場合、:attribute フィールドは必須です。',
    'required_unless' => ':other が :values に含まれていない限り、:attribute フィールドは必須です。',
    'required_with' => ':values が存在する場合、:attribute フィールドは必須です。',
    'required_with_all' => ':values が存在する場合、:attribute フィールドは必須です。',
    'required_without' => ':values が存在しない場合、:attribute フィールドは必須です。',
    'required_without_all' => ':values のいずれも存在しない場合、:attribute フィールドは必須です。',
    'same' => ':attribute と :other は一致する必要があります。',
    'size' => [
        'numeric' => ':attribute は :size である必要があります。',
        'file' => ':attribute は :size キロバイトである必要があります。',
        'string' => ':attribute は :size 文字である必要があります。',
        'array' => ':attribute には :size 個の項目が必要です。',
    ],
    'string' => ':attribute は文字列である必要があります。',
    'timezone' => ':attribute は有効なタイムゾーンである必要があります。',
    'unique' => ':attribute は既に使用されています。',
    'uploaded' => ':attribute のアップロードに失敗しました。',
    'url' => ':attribute の形式が無効です。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

    // Internal validation logic for Pterodactyl
    'internal' => [
        'variable_value' => ':env 変数',
        'invalid_password' => '指定されたパスワードはこのアカウントでは無効です。',
    ],
];
