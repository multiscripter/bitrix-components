<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Web\HttpClient;

function getChannelInfo($arParams) {
    if (!$arParams['AUTH'] || !$arParams['CLIENT_ID'])
        return false;
    $httpClient = new HttpClient();
    $httpClient->setHeader('Authorization','Bearer '.$arParams['AUTH']); 
    $httpClient->setHeader('Client-Id', $arParams['CLIENT_ID']); 
    $url = 'https://api.twitch.tv/helix/search/channels?query=';
    $url .= $arParams['CHANNEL_LOGIN'];
    $response = json_decode($httpClient->get($url));
    return property_exists($response, 'error') ? false : $response->data[0];
}

if ($this->StartResultCache(false)) {
    $arResult['uniqueCLass'] = uniqid();
    $data = getChannelInfo($arParams);
    $arResult['header'] = $data ? $data->title : GetMessage('DEFAULT_TITLE');
    if ($arParams['HEADER'])
        $arResult['header'] = $arParams['HEADER'];
    $parent = SITE_SERVER_NAME;
    if (!$parent)
        $parent = $_SERVER['HTTP_HOST'];
    if (!$parent)
        $parent = $_SERVER['SERVER_NAME'];
    $src = 'https://player.twitch.tv/?channel='.$arParams['CHANNEL_LOGIN'];
    $src .= '&parent='.$parent;
    $arResult['iframeSrc'] = $src;
    $arResult['allowfullscreen'] = $arParams['FULL_SCREEN'] == 'Y' 
        ? ' allowfullscreen="true"' : '';
        
    $arResult['cacheStartTime'] = date('Y-m-d H:i:s');
    $this->IncludeComponentTemplate();
}