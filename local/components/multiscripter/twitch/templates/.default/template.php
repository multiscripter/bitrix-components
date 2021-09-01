<div class="comp-twitch js-<?=$arResult['uniqueCLass']?>" data-cache="<?=$arResult['cacheStartTime']?>">
    <h2 class="section-header"><?=$arResult['header']?></h2>
    <style>
        .comp-twitch iframe {
            display: block;
            width: 100%;
        }
    </style>
    <iframe src="<?=$arResult['iframeSrc']?>"<?=$arResult['allowfullscreen']?>></iframe>
    <script type="text/javascript" data-skip-moving="true">
        let box = document.querySelector('.js-<?=$arResult['uniqueCLass']?>');
        let height = Math.ceil(box.offsetWidth / 16 * 9);
        box.querySelector('iframe').style.height = height + 'px';
    </script>
</div>