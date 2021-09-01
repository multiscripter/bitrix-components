<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$arComponentParameters = [
    'GROUPS' => [],
    'PARAMETERS' => [
        'API_KEY' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('API_KEY'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N'
        ],
        'PLAYLIST_ID' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('PLAYLIST_ID'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N'
        ],
        'MAX_RESULTS' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('MAX_RESULTS'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N',
            'DEFAULT' => 1
        ],
        'CACHE_TIME'  =>  [
            'DEFAULT' => 86400
        ],
        'AJAX' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('AJAX'),
            'TYPE' => 'CHECKBOX',
            'MULTIPLE' => 'N',
            'DEFAULT' => 'N'
        ]
    ],
];
