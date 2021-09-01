<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$arComponentParameters = [
    'GROUPS' => [],
    'PARAMETERS' => [
        'URL' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('URL'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N'
        ],
        'RSS_QTY' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('RSS_QTY'),
            'TYPE' => 'STRING',
            'MULTIPLE' => 'N',
            'DEFAULT' => 10
        ],
        'CACHE_TIME'  =>  [
            'DEFAULT' => 3600
        ],
    ],
];
