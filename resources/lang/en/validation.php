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

    'accepted' => ':attributeを承認する必要があります。',
    'active_url' => ':attributeは有効なURLではありません。',
    'after' => ':attributeは:dateより後の日付である必要があります。',
    'after_or_equal' => ':attributeは:date以降の日付である必要があります。',
    'alpha' => ':attributeは文字のみを含む必要があります。',
    'alpha_dash' => ':attributeは文字、数字、およびダッシュのみを含む必要があります。',
    'alpha_num' => ':attributeは文字と数字のみを含む必要があります。',
    'array' => ':attributeは配列である必要があります。',
    'before' => ':attributeは:dateより前の日付である必要があります。',
    'before_or_equal' => ':attributeは:date以前の日付である必要があります。',
    'between' => [
        'numeric' => ':attributeは:minから:maxの間である必要があります。',
        'file' => ':attributeは:minから:maxキロバイトの間である必要があります。',
        'string' => ':attributeは:minから:max文字の間である必要があります。',
        'array' => ':attributeは:minから:max個の項目を含む必要があります。',
    ],
    'boolean' => ':attributeフィールドはtrueまたはfalseである必要があります。',
    'confirmed' => ':attributeの確認が一致しません。',
    'date' => ':attributeは有効な日付ではありません。',
    'date_format' => ':attributeは:format形式と一致しません。',
    'different' => ':attributeと:otherは異なる必要があります。',
    'digits' => ':attributeは:digits桁である必要があります。',
    'digits_between' => ':attributeは:minから:max桁の間である必要があります。',
    'dimensions' => ':attributeの画像サイズが無効です。',
    'distinct' => ':attributeフィールドには重複した値があります。',
    'email' => ':attributeは有効なメールアドレスである必要があります。',
    'exists' => '選択された:attributeは無効です。',
    'file' => ':attributeはファイルである必要があります。',
    'filled' => ':attributeフィールドは必須です。',
    'image' => ':attributeは画像である必要があります。',
    'in' => '選択された:attributeは無効です。',
    'in_array' => ':attributeフィールドは:otherに存在しません。',
    'integer' => ':attributeは整数である必要があります。',
    'ip' => ':attributeは有効なIPアドレスである必要があります。',
    'json' => ':attributeは有効なJSON文字列である必要があります。',
    'max' => [
        'numeric' => ':attributeは:maxより大きくすることはできません。',
        'file' => ':attributeは:maxキロバイトより大きくすることはできません。',
        'string' => ':attributeは:max文字より大きくすることはできません。',
        'array' => ':attributeは:max個より多くの項目を持つことはできません。',
    ],
    'mimes' => ':attributeは:valuesタイプのファイルである必要があります。',
    'mimetypes' => ':attributeは:valuesタイプのファイルである必要があります。',
    'min' => [
        'numeric' => ':attributeは少なくとも:minである必要があります。',
        'file' => ':attributeは少なくとも:minキロバイトである必要があります。',
        'string' => ':attributeは少なくとも:min文字である必要があります。',
        'array' => ':attributeは少なくとも:min個の項目を持つ必要があります。',
    ],
    'not_in' => '選択された:attributeは無効です。',
    'numeric' => ':attributeは数値である必要があります。',
    'present' => ':attributeフィールドは存在する必要があります。',
    'regex' => ':attributeの形式が無効です。',
    'required' => ':attributeフィールドは必須です。',
    'required_if' => ':otherが:valueの場合、:attributeフィールドは必須です。',
    'required_unless' => ':otherが:valuesにない限り、:attributeフィールドは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_with_all' => ':valuesがすべて存在する場合、:attributeフィールドは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeフィールドは必須です。',
    'required_without_all' => ':valuesがどれも存在しない場合、:attributeフィールドは必須です。',
    'same' => ':attributeと:otherは一致する必要があります。',
    'size' => [
        'numeric' => ':attributeは:sizeである必要があります。',
        'file' => ':attributeは:sizeキロバイトである必要があります。',
        'string' => ':attributeは:size文字である必要があります。',
        'array' => ':attributeは:size個の項目を含む必要があります。',
    ],
    'string' => ':attributeは文字列である必要があります。',
    'timezone' => ':attributeは有効なタイムゾーンである必要があります。',
    'unique' => ':attributeはすでに使用されています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'url' => ':attributeの形式が無効です。',

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
        'invalid_password' => '提供されたパスワードはこのアカウントでは無効です。',
    ],
];
