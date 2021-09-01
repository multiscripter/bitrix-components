<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Web\HttpClient;

if ($this->StartResultCache(false)) {
    $httpClient = new HttpClient();
    $dom = new DOMDocument;

    // Page.
    $response = $httpClient->get($arParams['URL']);
    $dom->loadHTML($response);
    $xpath = new DOMXPath($dom);

    class XPathParser {
        private $arResult;
        private $xpath;
        
        public function __construct($dom, &$arResult) {
            $this->arResult = &$arResult;
            $this->xpath = new DOMXPath($dom);
        }
        
        public function addValues($xpathExp, $key, $type='text', $attr=false) {
            $nodes = $this->xpath->query($xpathExp);
            $this->arResult[$key] = [];
            if ($nodes) {
                foreach ($nodes as $node) {
                    if ($type == 'text')
                        $this->arResult[$key][] = $node->textContent;
                    else if ($type == 'attr')
                        $this->arResult[$key][] = $node->getAttribute($attr);
                    else if ($type == 'html')
                        $this->arResult[$key][] = $node->ownerDocument->saveXML($node);
                }
            }
        }
    }

    $parser = new XPathParser($dom, $arResult);

    // Members quantity.
    $parser->addValues("//*[contains(@class, 'responsive_membercounts')]//*[contains(@class, 'members')]//*[contains(@class, 'count')]", 'members');

    $parser->addValues("//*[@class='membercount members']/a", 'membersRef', 'attr', 'href');

    // Ingame quantity.
    $parser->addValues("//*[contains(@class, 'responsive_membercounts')]//*[contains(@class, 'ingame')]//*[contains(@class, 'count')]", 'ingame');

    // Online quantity.
    $parser->addValues("//*[contains(@class, 'responsive_membercounts')]//*[contains(@class, 'online')]//*[contains(@class, 'count')]", 'online');

    // Group logo.
    $parser->addValues("//*[@class='grouppage_logo']/img", 'logoSrc', 'attr', 'src');

    // Group name.
    $parser->addValues("//*[@class='grouppage_header_name']/text()", 'name');

    // Group abbr.
    $parser->addValues("//*[@class='grouppage_header_abbrev']", 'abbr');

    // Creation date and country.
    $parser->addValues("//*[contains(@class, 'rightcol')]//*[@class='groupstat']//*[@class='data']", 'stat');
    $date = date_parse_from_format('d F, Y', $arResult['stat'][0]);
    if (!$date['year'])
        $date['year'] = date('Y');
    $arResult['stat'][0] = $date['day'].'-'.$date['month'].'-'.$date['year'];

    // Country flag.
    $parser->addValues(
        "//*[contains(@class, 'rightcol')]//*[@class='groupstat']//*[@class='data']//img",
        'flagSrc', 'attr', 'src'
    );

    // Group summary.
    $parser->addValues("//*[@class='formatted_group_summary']", 'summary', 'html');

    // Group link hrefs.
    $parser->addValues(
        "//*[@class='rightbox']//*[@class='weblink']/a",
        'linkHrefs', 'attr', 'href'
    );

    // Group link texts.
    $parser->addValues("//*[@class='rightbox']//*[@class='weblink']/a", 'linkTexts');

    // Names of related games.
    $parser->addValues("//*[@class='hoverunderline']", 'relGamesNames');
    if ($arResult['relGamesNames']) {
        // Hrefs of related games.
        $parser->addValues(
            "//*[@class='hoverunderline']", 'relGamesHrefs', 'attr', 'href'
        );
        // Icon`s srcs of related games.
        $parser->addValues(
            "//*[@class='group_associated_game_icon']//img", 
            'relGamesIconSrcs', 'attr', 'src'
        );
    }

    // RSS.
    $arResult['rss'] = [];
    $response = $httpClient->get($arParams['URL'].'/rss');
    $dom->loadHTML($response);
    $elems = $dom->getElementsByTagName('item');
    $arResult['rssQty'] = min($arParams['RSS_QTY'], count($elems));
    for ($a = 0; $a < $arResult['rssQty']; $a++) {
        $dateArr = date_parse_from_format(
            " D, d M Y H:i:s +u",
            $elems[$a]->getElementsByTagName('pubdate')[0]->nodeValue
        );
        $date = new DateTime(
            $dateArr['year'].'-'
            .$dateArr['month'].'-'
            .$dateArr['day'].' '
            .$dateArr['hour'].':'
            .$dateArr['minute'].':'
            .$dateArr['second']
        );
        $item = [
            'date' => $date->format('Y-m-d H:i:s'),
            'guid' => $elems[$a]->getElementsByTagName('guid')[0]->nodeValue,
            'title' => $elems[$a]->getElementsByTagName('title')[0]->nodeValue,
            'author' => $elems[$a]->getElementsByTagName('author')[0]->nodeValue,
            'description' => $elems[$a]->getElementsByTagName('description')[0]->nodeValue
        ];
        $arResult['rss'][] = $item;
    }
    
    $arResult['cacheStartTime'] = date('Y-m-d H:i:s');
    $this->IncludeComponentTemplate();
}