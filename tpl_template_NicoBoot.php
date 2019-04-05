<?php
/**
 * Custom Function for the template
 */

// must be run from within DokuWiki
const BOOTIE = 'bootie';
if (!defined('DOKU_INC')) die();


/**
 * Print the breadcrumbs trace with Bootstrap class
 *
 * @author Nicolas GERARD
 *
 * @param string $sep Separator between entries
 * @return bool
 */
function tpl_breadcrumbs_bootstrap($sep = '�')
{

    global $conf;
    global $lang;

    //check if enabled
    if (!$conf['breadcrumbs']) return false;

    $crumbs = array_reverse(breadcrumbs()); //setup crumb trace


    $last = count($crumbs);
    $i = 0;
    echo '<ol class="breadcrumb justify-content-start m-0 p-0 pb-1">' . PHP_EOL;

    // Try to get the template custom breadcrumb
    $breadCrumb = tpl_getLang('breadcrumb');
    if ($breadCrumb == '') {
        // If not present for the language, get the default one
        $breadCrumb = $lang['breadcrumb'];
    }
    echo '<span id="breadCrumbTitle">' . $breadCrumb . ':   </span>';

    foreach ($crumbs as $id => $name) {
        $i++;

        if ($i == $last) {
            print '<li class="breadcrumb-item active">';
        } else {
            print '<li class="breadcrumb-item">';
        }
        tpl_link(wl($id), hsc($name), 'title="' . $id . '" style="width: 100%;"');

        print '</li>' . PHP_EOL;

    }
    echo '</ol>' . PHP_EOL;
    return true;
}


/**
 * Hierarchical breadcrumbs
 *
 * This will return the Hierarchical breadcrumbs.
 *
 * Config:
 *    - $conf['youarehere'] must be true
 *    - add $lang['youarehere'] if $printPrefix is true
 *
 * @param bool $printPrefix print or not the $lang['youarehere']
 * @return string
 */
function tpl_youarehere_bootstrap($printPrefix = false)
{

    global $conf;
    global $lang;

    // check if enabled
    if (!$conf['youarehere']) return;

    // print intermediate namespace links
    $htmlOutput = '<ol class="breadcrumb">' . PHP_EOL;

    // Print the home page
    $htmlOutput .= '<li>' . PHP_EOL;
    if ($printPrefix) {
        $htmlOutput .= $lang['youarehere'] . ' ';
    }
    $page = $conf['start'];
    $htmlOutput .= tpl_link(wl($page), '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', 'title="' . tpl_pagetitle($page, true) . '"', $return = true);
    $htmlOutput .= '</li>' . PHP_EOL;

    // Print the parts if there is more than one
    global $ID;
    $idParts = explode(':', $ID);
    if (count($idParts) > 1) {

        // Print the parts without the last one ($count -1)
        $page = "";
        for ($i = 0; $i < count($idParts) - 1; $i++) {

            $page .= $idParts[$i] . ':';

            // Skip home page of the namespace
            // if ($page == $conf['start']) continue;

            // The last part is the active one
//            if ($i == $count) {
//                $htmlOutput .= '<li class="active">';
//            } else {
//                $htmlOutput .= '<li>';
//            }

            $htmlOutput .= '<li>';
            // html_wikilink because the page has the form pagename: and not pagename:pagename
            $htmlOutput .= html_wikilink($page);
            $htmlOutput .= '</li>' . PHP_EOL;

        }
    }

    // Skipping Wiki Global Root Home Page
//    resolve_pageid('', $page, $exists);
//    if(isset($page) && $page == $idPart.$idParts[$i]) {
//        echo '</ol>'.PHP_EOL;
//        return true;
//    }
//    // skipping for namespace index
//    $page = $idPart.$idParts[$i];
//    if($page == $conf['start']) {
//        echo '</ol>'.PHP_EOL;
//        return true;
//    }

    // print current page
//    print '<li>';
//    tpl_link(wl($page), tpl_pagetitle($page,true), 'title="' . $page . '"');
    $htmlOutput .= '</li>' . PHP_EOL;
    // close the breadcrumb
    $htmlOutput .= '</ol>' . PHP_EOL;
    return $htmlOutput;

}


/*
 * Function return the page name from an id
 * @author Nicolas GERARD
 *
 * @param string $sep Separator between entries
 * @return bool
 */

function tpl_pageName($id)
{

    // page names
    $name = noNSorNS($id);
    if (useHeading('navigation')) {
        // get page title
        $title = p_get_first_heading($id, METADATA_RENDER_USING_SIMPLE_CACHE);
        if ($title) {
            $name = $title;
        }
    }
    return $name;

}

function tpl_searchform_bootie($ajax = true, $autocomplete = true)
{
    global $lang;
    global $ACT;
    global $QUERY;

    // don't print the search form if search action has been disabled
    if (!actionOK('search')) return false;

    print '<form id="navBarSearch" action="' . wl() . '" accept-charset="utf-8" class="search form-inline my-lg-0" id="dw__search" method="get" role="search">';
    print '<input type="hidden" name="do" value="search" />';
    print '<label class="sr-only" for="search">Search Term</label>';
    print '<input type="text" ';
    if ($ACT == 'search') print 'value="' . htmlspecialchars($QUERY) . '" ';
    print 'placeholder="' . $lang['btn_search'] . '..." ';
    if (!$autocomplete) print 'autocomplete="off" ';
    print 'id="qsearch__in" accesskey="f" name="id" class="edit form-control" title="[F]" />';
//    print '<button type="submit" title="'.$lang['btn_search'].'">'.$lang['btn_search'].'</button>';
    if ($ajax) print '<div id="qsearch__out" class="ajax_qsearch JSpopup"></div>';
    print '</form>';
    return true;
}

/**
 * This is a fork of tpl_actionlink where I have added the class parameters
 *
 * Like the action buttons but links
 *
 * @author Adrian Lang <mail@adrianlang.de>
 * @see    tpl_get_action
 *
 * @param string $type action command
 * @param string $pre prefix of link
 * @param string $suf suffix of link
 * @param string $inner innerHML of link
 * @param bool $return if true it returns html, otherwise prints
 * @param string $class the class to be added
 * @return bool|string html or false if no data, true if printed
 */
function tpl_actionlink_bootie($type, $class = '', $pre = '', $suf = '', $inner = '', $return = false)
{
    global $lang;
    $data = tpl_get_action($type);
    if ($data === false) {
        return false;
    } elseif (!is_array($data)) {
        $out = sprintf($data, 'link');
    } else {
        /**
         * @var string $accesskey
         * @var string $id
         * @var string $method
         * @var bool $nofollow
         * @var array $params
         * @var string $replacement
         */
        extract($data);
        if (strpos($id, '#') === 0) {
            $linktarget = $id;
        } else {
            $linktarget = wl($id, $params);
        }
        $caption = $lang['btn_' . $type];
        if (strpos($caption, '%s')) {
            $caption = sprintf($caption, $replacement);
        }
        $akey = $addTitle = '';
        if ($accesskey) {
            $akey = 'accesskey="' . $accesskey . '" ';
            $addTitle = ' [' . strtoupper($accesskey) . ']';
        }
        $rel = $nofollow ? 'rel="nofollow" ' : '';
        $out = $pre . tpl_link(
                $linktarget, (($inner) ? $inner : $caption),
                'class="nav-link action ' . $type . ' ' . $class . '" ' .
                $akey . $rel .
                'title="' . hsc($caption) . $addTitle . '"', true
            ) . $suf;
    }
    if ($return) return $out;
    echo $out;
    return true;
}


/**
 * @return array
 * Return the headers needed by this template
 * */
function tpl_get_default_headers()
{

    $useCdn = tpl_getConf('cdn');
    $script = array();
    if (!$useCdn) {

        $localBaseJs = DOKU_BASE . 'lib/tpl/bootie/js/';

        // Other mode, we pick the Javascript of Dokuwiki
        // jquery must not be slim because the post is needed for qsearch
        $script['jquery'] = array(
            'src' => $localBaseJs . 'jquery-3.3.1.min.js',
            'integrity' => "sha256-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT",
            'crossorigin' => "anonymous",
            'defer' => "true"
        );


        $script['popper'] = array(
            'src' => $localBaseJs . 'popper-1.14.7.min.js',
            'integrity' => "sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1",
            'crossorigin' => "anonymous",
            'defer' => "true"

        );
        $script['bootstrap'] = array(
            'src' => $localBaseJs . 'bootstrap-4.3.1.min.js',
            'integrity' => "sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM",
            'crossorigin' => "anonymous",
            'defer' => "true"

        );


    } else {

        // use a cdn
        // jquery must not be slim because the post is needed for qsearch
        $script['jquery'] = array(
            'src' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
            'integrity' => "sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=",
            'crossorigin' => "anonymous",
            'defer' => "true"
        );
        $script['popper'] = array(
            'src' => 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
            'integrity' => "sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1",
            'crossorigin' => "anonymous",
            'defer' => "true"
        );
        $script['bootstrap'] = array(
            'src' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
            'integrity' => "sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM",
            'crossorigin' => "anonymous",
            'defer' => "true"
        );

    }


    if (!$useCdn) {
        $baseCss = DOKU_BASE . 'lib/tpl/bootie/css/';
        $css['bootstrap'] = array(
            'href' => $baseCss . 'bootstrap-4.3.1.min.css',
            'integrity' => "sha384-ZYfZnVukOuh/gRpU9uN+T9XwwRFJ9Y+0Ylk3zKvI184omb/HoOtQ0F8Iol7Nix7q",
            'crossorigin' => "anonymous",
            'rel' => "stylesheet",

        );

    } else {
        $css['bootstrap'] = array(
            'href' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
            'integrity' => "sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T",
            'crossorigin' => "anonymous",
            'rel' => "stylesheet",
        );
    };

    return array(
        'script' => $script,
        'link' => $css
    );


}

/**
 * @param Doku_Event $event
 * @param $param
 * Function that handle the META HEADER event
 *   * It will add the Bootstrap Js and CSS
 *   * Make all script and resources defer
 */
function tpl_bootie_meta_header(Doku_Event &$event, $param)
{

    global $DOKU_TPL_BOOTIE_PRELOAD_CSS;
    $DOKU_TPL_BOOTIE_PRELOAD_CSS = array();

    $newHeaderTypes = array();
    $bootstrapHeaders = tpl_get_default_headers();
    $eventHeaderTypes = $event->data;
    foreach ($eventHeaderTypes as $headerType => $headerData) {
        switch ($headerType) {
            case "meta":
                // generator, color, robots, keywords
                // nothing to do pick them all
                $newHeaderTypes[$headerType] = $headerData;
                break;
            case "link":
                // index, rss, manifest, search, alternate, stylesheet
                // delete edit
                $newLinkData = $bootstrapHeaders[$headerType]; // Css of Bootstrap will be unchanged
                foreach ($headerData as $linkData) {
                    switch ($linkData['rel']) {
                        case 'edit':
                            break;
                        case 'stylesheet':

                            // Take the stylesheet to load them at the end
                            $DOKU_TPL_BOOTIE_PRELOAD_CSS[] = $linkData;

                            // Change the loading mechanism to preload
                            $linkData['rel'] = 'preload';
                            $linkData['as'] = 'style';
                            $newLinkData[] = $linkData;

                            break;
                        default:
                            $newLinkData[] = $linkData;
                            break;
                    }
                }
                $newHeaderTypes[$headerType] = $newLinkData;
                break;

            case "script":

                $newScriptData = array();
                foreach ($headerData as $scriptData) {
                    $scriptData['defer'] = "true";
                    $pos = strpos($scriptData['src'], 'jquery');
                    if ($pos === false) {
                        $newScriptData[] = $scriptData;
                    } else {
                        // This is the Jquery script
                        if (empty($_SERVER['REMOTE_USER'])) {
                            // https://www.dokuwiki.org/config:jquerycdn
                            // We take the Jquery of Bootstrap
                            $newScriptData = array_merge($newScriptData, $bootstrapHeaders[$headerType]);
                        } else {
                            // We take the Jquery of doku and we add Bootstrap
                            $newScriptData[] = $scriptData; // js
                            $newScriptData[] = $bootstrapHeaders[$headerType]['popper'];
                            $newScriptData[] = $bootstrapHeaders[$headerType]['bootstrap'];
                        }
                    }
                }

                $newHeaderTypes[$headerType] = $newScriptData;
                break;

        }
    }
    $event->data = $newHeaderTypes;


}

