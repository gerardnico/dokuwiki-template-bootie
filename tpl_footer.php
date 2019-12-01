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
    $footerPageName = tpl_getConf('footer');
    if (page_findnearest($footerPageName)) {
        tpl_flush();
        tpl_include_page($footerPageName, 1, 1);
    }
    ?>


    <div class="row p-3 justify-content-center">
        <div class="col-16 text-center">
        <a href="https://gerardnico.com/dokuwiki/bootie" title="Designed by Nickeau">Bootie Template</a>
        designed by <a href="https://gerardnico.com/" title="Nickeau WebSite">Gerardnico</a> with the help of <a
            href="https://getbootstrap.com/" title="The Bootstrap">Bootstrap</a> and <a href="https://www.dokuwiki.org/template">DokuWiki</a>
        </div>
    </div>

</footer>


