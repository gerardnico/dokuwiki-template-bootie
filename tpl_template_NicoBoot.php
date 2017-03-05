<?php
/**
 * Custom Function for the template
 */

// must be run from within DokuWiki
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
    echo '<ol class="breadcrumb">'.PHP_EOL;

    foreach ($crumbs as $id => $name) {
        $i++;

        if ($i == $last) {
            print '<li class="active">';
        } else {
            print '<li>';
        }
        if ($i == 1) {
            // Try to get the template custom breadcrumb
            $breadCrumb = tpl_getLang('breadcrumb');
            if ($breadCrumb=='') {
                // If not present for the language, get the default one
                $breadCrumb = $lang['breadcrumb'];
            }
            echo $breadCrumb.': ';
        }
        tpl_link(wl($id), hsc($name), 'title="' . $id . '"');

        print '</li>'.PHP_EOL;

    }
    echo '</ol>'.PHP_EOL;
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
function tpl_youarehere_bootstrap($printPrefix = false) {

    global $conf;
    global $lang;

    // check if enabled
    if(!$conf['youarehere']) return;

    // print intermediate namespace links
    $htmlOutput = '<ol class="breadcrumb">'.PHP_EOL;

    // Print the home page
    $htmlOutput .= '<li>'.PHP_EOL;
    if ($printPrefix) {
        $htmlOutput .= $lang['youarehere'] . ' ';
    }
    $page = $conf['start'];
    $htmlOutput .= tpl_link(wl($page), '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', 'title="' . tpl_pagetitle($page,true) . '"', $return = true);
    $htmlOutput .= '</li>'.PHP_EOL;

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
    $htmlOutput .= '</li>'.PHP_EOL;
    // close the breadcrumb
    $htmlOutput .= '</ol>'.PHP_EOL;
    return $htmlOutput;

}


/*
 * Function return the page name from an id
 * @author Nicolas GERARD
 *
 * @param string $sep Separator between entries
 * @return bool
 */

function tpl_pageName($id){

    // page names
    $name = noNSorNS($id);
    if(useHeading('navigation')) {
        // get page title
        $title = p_get_first_heading($id, METADATA_RENDER_USING_SIMPLE_CACHE);
        if($title) {
            $name = $title;
        }
    }
    return $name;

}

function tpl_searchform_bootie($ajax = true, $autocomplete = true) {
    global $lang;
    global $ACT;
    global $QUERY;

    // don't print the search form if search action has been disabled
    if(!actionOK('search')) return false;

    print '<form action="'.wl().'" accept-charset="utf-8" class="search navbar-form" id="dw__search" method="get" role="search"><div class="no">';
    print '<input type="hidden" name="do" value="search" />';
    print '<label class="sr-only" for="search">Search Term</label>';
    print '<input type="text" ';
    if($ACT == 'search') print 'value="'.htmlspecialchars($QUERY).'" ';
    print 'placeholder="'.$lang['btn_search'].'..." ';
    if(!$autocomplete) print 'autocomplete="off" ';
    print 'id="qsearch__in" accesskey="f" name="id" class="edit form-control" title="[F]" />';
//    print '<button type="submit" title="'.$lang['btn_search'].'">'.$lang['btn_search'].'</button>';
    if($ajax) print '<div id="qsearch__out" class="ajax_qsearch JSpopup"></div>';
    print '</div></form>';
    return true;
}

