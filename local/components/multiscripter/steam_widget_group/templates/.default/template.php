<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="steam-group-main" data-cache="<?=$arResult['cacheStartTime']?>">
    <ul class="steam-group-header">
        <li class="steam-group-header-item steam-group-logo-box">
            <img class="steam-group-logo" src="<?=$arResult['logoSrc'][0]?>">
        </li>
        <li class="steam-group-header-item steam-group-header-data">
            <span class="steam-group-header-data-item steam-group-label">
            <?=GetMessage('group')?> STEAM
            </span>
            <span class="steam-group-header-data-item steam-group-name">
                <?=$arResult['name'][0]?>
                <span class="steam-group-abbr"><?=$arResult['abbr'][0]?></span>
            </span>
            <ul class="steam-group-counts steam-group-header-counts">
                <li class="steam-group-numbers steam-group-count-members">
                    <a class="steam-group-count-ref" href="<?
                        echo $arResult['membersRef'][0]?>" target="_blank">
                        <span class="steam-group-number steam-group-number-num"><?
                            echo $arResult['members'][0];
                        ?></span>
                        <span class="steam-group-number steam-group-number-label"><?
                            echo GetMessage('members')?>
                        </span>
                    </a>
                </li>
                <li class="steam-group-numbers steam-group-count-ingame">
                    <span class="steam-group-number steam-group-number-num"><?
                        echo $arResult['ingame'][0];
                    ?></span>
                    <span class="steam-group-number steam-group-number-label"><?
                        echo GetMessage('ingame')?></span>
                </li>
                <li class="steam-group-numbers steam-group-count-online">
                    <span class="steam-group-number steam-group-number-num"><?
                    echo $arResult['online'][0];
                    ?></span>
                    <span class="steam-group-number steam-group-number-label"><?
                        echo GetMessage('online')?></span>
                </li>
            </ul>
            <ul class="steam-group-stats steam-group-header-stats">
                <li class="steam-group-stat">
                    <span class="steam-group-stat-label"><?
                        echo GetMessage('created')?></span>
                    <span class="steam-group-stat-data"><?
                        echo $arResult['stat'][0]?></span>
                </li>
                <li class="steam-group-stat">
                    <span class="steam-group-stat-label"><?
                        echo GetMessage('country')?></span>
                    <span class="steam-group-stat-data"><?
                        echo $arResult['stat'][1];
                    ?><img class="steam-group-stat-flag" 
                        src="<?=$arResult['flagSrc'][0]?>">
                    </span>
                </li>
            </ul>
        </li>
        <li class="steam-group-header-item steam-group-go2btn">
            <a 
                class="btn-go2" href="<?=$arParams['URL']?>" 
                target="_blank">
                <span><?=GetMessage('go_to_steam')?></span>
            </a>
        </li>
    </ul>
    <ul class="steam-group-body">
        <li class="steam-group-summary">
            <div class="steam-group-block-box">
                <span class="steam-group-block-header">
                    О <?=$arResult['name'][0]?>
                </span>
                <div class="steam-group-summary-body"><?
                    echo $arResult['summary'][0]?>
                </div><?
                if ($arResult['linkHrefs']) { ?>
                <ul class="steam-group-refs"><?
                    for ($a = 0; $a < count($arResult['linkHrefs']); $a++) { ?>
                    <li class="steam-group-ref-box">
                        <a class="steam-group-ext-ref" href="<?
                            echo $arResult['linkHrefs'][$a]
                        ?>" target="_blank"><?=$arResult['linkTexts'][$a]?></a>
                    </li><?
                    } ?>
                </ul><?
                } ?>
            </div><?
            if ($arResult['rss']) { ?>
            <div class="steam-group-block-box">
                <span class="steam-group-block-header"><?
                    echo GetMessage('recent_announcements')
                ?></span>
                <div class="steam-group-rss-list"><?
                    for ($a = 0; $a < $arResult['rssQty']; $a++) {
                        if ($a < $arResult['rssQty'] - 1) { ?>
                        <input 
                            id="steam-group-rss-<?=$a?>" 
                            class="steam-group-rss-chbox" 
                            type="checkbox"><?
                        } ?>
                    <div class="steam-group-rss-item">
                        <a class="steam-group-rss-item-ref" href="<?
                        echo $arResult['rss'][$a]['guid'];
                        ?>" target="_blank"><?
                        echo $arResult['rss'][$a]['title'];
                        ?></a>
                        <div class="steam-group-rss-item-data">
                            <?=$arResult['rss'][$a]['date']?>&nbsp;|&nbsp;<?
                            echo $arResult['rss'][$a]['author'];?>
                        </div>
                        <p class="steam-group-rss-item-text"><?
                        echo $arResult['rss'][$a]['description'];
                        ?></p><?
                        if ($a < $arResult['rssQty'] - 1) { ?>
                        <label 
                            class="steam-group-rss-label" 
                            for="steam-group-rss-<?=$a?>"><?
                                echo GetMessage('show_more')
                        ?></label><?
                        } ?>
                    </div><?
                    }
                ?></div>
            </div>
        </li><?
        } ?>
        <li class="steam-group-data">
            <ul class="steam-group-data-list">
                <li class="steam-group-data-item">
                    <ul class="steam-group-counts steam-group-body-count">
                        <li class="steam-group-number steam-group-count-members">
                            <a class="steam-group-count-ref" href="<?
                                echo $arResult['membersRef'][0]?>" target="_blank">
                                <span class="steam-group-number-num"><?
                                    echo $arResult['members'][0];
                                ?></span>
                                <span class="steam-group-number-label"><?
                                    echo GetMessage('members')?></span>
                            </a>
                        </li>
                        <li class="steam-group-number steam-group-count-ingame">
                            <span class="steam-group-number-num"><?
                                echo $arResult['ingame'][0];
                            ?></span>
                            <span class="steam-group-number-label"><?
                                echo GetMessage('ingame')?></span>
                        </li>
                        <li class="steam-group-number steam-group-count-online">
                            <span class="steam-group-number-num"><?
                                echo $arResult['online'][0];
                            ?></span>
                            <span class="steam-group-number-label"><?
                                echo GetMessage('online')?></span>
                        </li>
                    </ul>
                </li>
                <li class="steam-group-data-item">
                    <ul class="steam-group-stats">
                        <li class="steam-group-stat">
                            <span class="steam-group-stat-label"><?
                                echo GetMessage('created')?></span>
                            <span class="steam-group-stat-data"><?
                                echo $arResult['stat'][0]?></span>
                        </li>
                        <li class="steam-group-stat">
                            <span class="steam-group-stat-label"><?
                                echo GetMessage('country')?></span>
                            <span class="steam-group-stat-data"><?
                                echo $arResult['stat'][1];
                            ?><img class="steam-group-stat-flag" 
                                src="<?=$arResult['flagSrc'][0]?>">
                            </span>
                        </li>
                    </ul>
                </li><?
                if ($arResult['linkHrefs']) { ?>
                <li class="steam-group-data-item">
                    <ul class="steam-group-refs"><?
                        for ($a = 0; $a < count($arResult['linkHrefs']); $a++) { ?>
                        <li class="steam-group-ref-box">
                            <a class="steam-group-ext-ref" href="<?
                                echo $arResult['linkHrefs'][$a]
                            ?>" target="_blank"><?=$arResult['linkTexts'][$a]?></a>
                        </li><?
                        } ?>
                    </ul>
                </li><?
                } ?>
            </ul><?
            if ($arResult['relGamesNames']) { ?>
            <ul class="steam-group-data-list rel-game-data">
                <li class="steam-group-data-item rel-game-label-box">
                    <span class="rel-game-label"><?
                    echo GetMessage('rel_games')?></span>
                </li>
                <li class="steam-group-data-item rel-game">
                    <span class="rel-game-box">
                        <a 
                            class="rel-game-pic-ref" 
                            href="<?=$arResult['relGamesHrefs'][0]?>" 
                            target="_blank">
                            <img 
                                class="rel-game-pic" 
                                src="<?=$arResult['relGamesIconSrcs'][0]?>" 
                                title="<?=$arResult['relGamesNames'][0]?>" 
                                alt="<?=$arResult['relGamesNames'][0]?>">
                        </a>
                        <a 
                            class="rel-game-name-ref" 
                            href="<?=$arResult['relGamesHrefs'][0]?>" 
                            target="_blank"><?
                                echo $arResult['relGamesNames'][0]
                            ?></a>
                    </span>
                </li>
            </ul><?
            } ?>
        </li>
    </ul>
</div>