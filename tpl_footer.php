<?php
/**
 * Template footer, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<!-- ********** FOOTER is a nav bar class********** -->
<footer id="dokuwiki__footer" class="container bg-light">


    <?php
    $domain  =
    $footerPageName = tpl_getConf('footer');
    if (page_findnearest($footerPageName)) {
        tpl_flush();
        tpl_include_page($footerPageName, 1, 1);
    } else {
        echo '<div class="container p-3" style="text-align: center">Welcome to the <a href="'.$domain.'/bootie">Bootie template</a>. To get started, create a page with the id '.html_wikilink(':'.$footerPageName).' to create a footer.</div>';
    }

    echo '<div class="row p-3 justify-content-center">';
    echo '    <div class="col-16 text-center">';
    echo '  Powered by the <a href="https://combostrap.com/bootie" title="Bootstrap Template">Bootie Template</a>';
    echo '    </div>';
    echo '</div>';
    ?>

</footer>


