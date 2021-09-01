<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$arr = explode('/', $APPLICATION->GetCurPage());
$arrSize = sizeof($arr);
if (!$arr[$arrSize - 1]) {
    array_pop($arr);
    $arrSize--;
}
$ref = '/';
if (sizeof($arr) > 1)
    $arr = array_slice($arr, 0, $arrSize - ($arr[$arrSize - 1] == 'index.php' ? 2 : 1));
    $ref = implode('/', $arr) . '/';
$arResult['BACK'] = $_SERVER['HTTP_REFERER'];
$arResult['UP'] = $ref;
$this->IncludeComponentTemplate();
