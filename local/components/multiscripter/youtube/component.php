<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Web\HttpClient;

if ($arParams['AJAX'] == 'Y')
    CJSCore::Init(['jquery3']);

$isAjax = isset($_GET['YTCAJAX']);

$getParams = [
    'key='.$arParams['API_KEY'],
    'playlistId='.$arParams['PLAYLIST_ID'],
    'part=snippet',
    'maxResults='.$arParams['MAX_RESULTS']
];
if ($_GET['YTtoken'])
    $getParams[] = 'pageToken='.$_GET['YTtoken'];
$url = 'https://www.googleapis.com/youtube/v3/playlistItems?';
$url .= implode('&', $getParams);

// URL эндпоинта playlistItems с GET-параметрами является идентификатором кэша Bitrix.
// Для первого элемента создаётся 2 одинаковых кэша: 
// первый не включает pageToken в cachID, так как его нет при первом запросе эндпоинта.
if ($isAjax) {
    ob_end_clean();
    ob_start();
}
if ($this->StartResultCache(false, $url)) {
    $httpClient = new HttpClient();
    $listResponse = json_decode($httpClient->get($url));
    if ($listResponse->items) {
        $arResult['videoId'] = $listResponse->items[0]->snippet->resourceId->videoId;
        $resulution = $listResponse->items[0]->snippet->thumbnails->maxres;
        if ($resulution) {
            $resulution = [
                'height' => $resulution->height,
                'width' => $resulution->width
            ];
        } else {
            $getParams = [
                'id='.$arResult['videoId'],
                'key='.$arParams['API_KEY'],
                'part=snippet,player',
            ];
            $url = 'https://www.googleapis.com/youtube/v3/videos?';
            $url .= implode('&', $getParams);
            $videoResponse = json_decode($httpClient->get($url));
            $iframe = json_encode($videoResponse->items[0]->player->embedHtml);
            if (preg_match('/(?<=width\=\\\")\d*/', $iframe, $matches))
                $resulution['width'] = intval($matches[0]);
            if (preg_match('/(?<=height\=\\\")\d*/', $iframe, $matches))
                $resulution['height'] = intval($matches[0]);
        }
        
        $curUrl =$APPLICATION->GetCurPage();
        $arResult['prevCssClass'] = !$listResponse->prevPageToken ? ' disabled' : '';
        $arResult['prevHref'] = '';
        if ($listResponse->prevPageToken)
            $arResult['prevHref'] = $curUrl.'?YTtoken='.$listResponse->prevPageToken;
        
        $arResult['header-text'] = $listResponse->items[0]->snippet->title;
        
        $arResult['nextCssClass'] = !$listResponse->nextPageToken ? ' disabled' : '';
        $arResult['nextHref'] = '';
        if ($listResponse->nextPageToken)
            $arResult['nextHref'] = $curUrl.'?YTtoken='.$listResponse->nextPageToken;
        
        $arResult['padding-bottom'] = $resulution['height'] / ($resulution['width'] / 100);
    } else
        $arResult['header-text'] = GetMessage('NOT_FOUND');
    
    $arResult['cacheStartTime'] = date('Y-m-d H:i:s');

    $this->IncludeComponentTemplate();
    if ($isAjax)
        die(ob_get_clean());
}

if ($isAjax)
    die(ob_get_clean());