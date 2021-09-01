<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$arComponentParameters = [
    'GROUPS' => [],
    'PARAMETERS' => [
        'AUTH' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('AUTH'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N'
        ],
        'CLIENT_ID' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('CLIENT_ID'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N'
        ],
        'CHANNEL_LOGIN' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('CHANNEL_LOGIN'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N'
        ],
        'CACHE_TIME'  =>  [
            'DEFAULT' => 86400
        ],
        'HEADER' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('HEADER'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N'
        ],
        'FULL_SCREEN' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('ALLOW_FULL_SCREEN'),
            'TYPE' => 'CHECKBOX',
            'MULTIPLE' => 'N',
            'DEFAULT' => 'Y'
        ]
    ],
];
