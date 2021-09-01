<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Page\Asset;
if ($arParams['AJAX'] == 'Y')
    Asset::getInstance()->addJs($this->GetFolder() . '/ajax.js');

if (isset($arResult['videoId'])) {
?><div class="comp-youtube js-comp-youtube" data-cache="<?=$arResult['cacheStartTime']?>"><?
if (isset($arResult['debug'])) { ?><pre><?=$arResult['debug']?></pre><? } ?>
<h2 class="section-header">
    <a class="btn btn-sm btn-primary js-comp-youtube-btn<?=$arResult['prevCssClass']?>" 
    href="<?=$arResult['prevHref']?>"><?=GetMessage('PREV')?></a>
    <span class="section-header-text"><?=$arResult['header-text']?></span>
    <a class="btn btn-sm btn-primary js-comp-youtube-btn<?=$arResult['nextCssClass']?>" 
    href="<?=$arResult['nextHref']?>"><?=GetMessage('NEXT')?></a>
</h2>
<div class="video-box">
    <div class="video" style="padding-bottom: <?=$arResult['padding-bottom']?>%">
        <iframe src="https://www.youtube.com/embed/<?=$arResult['videoId']?>"></iframe>
    </div>
</div><?
} else { ?>
<h2 class="section-header">
    <span class="section-header-text"><?=$arResult['header-text']?></span>
</h2><?
} ?>
</div>