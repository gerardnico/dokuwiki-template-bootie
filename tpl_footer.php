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

<!--    --><?php //tpl_license(''); // license text ?>
<!---->
<!--    <div class="buttons">-->
<!--        --><?php
//        tpl_license('button', true, false, false); // license button, no wrapper
//        $target = ($conf['target']['extern']) ? 'target="' . $conf['target']['extern'] . '"' : '';
//        ?>
<!--        <a href="http://validator.w3.org/check/referer" title="Valid HTML5" --><?php //echo $target ?><!--><img-->
<!--                src="--><?php //echo tpl_basedir(); ?><!--images/button-html5.png" width="80" height="15"-->
<!--                alt="Valid HTML5"/></a>-->
<!--        <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3"-->
<!--           title="Valid CSS" --><?php //echo $target ?><!--><img-->
<!--                src="--><?php //echo tpl_basedir(); ?><!--images/button-css.png" width="80" height="15"-->
<!--                alt="Valid CSS"/></a>-->
<!--        <a href="http://dokuwiki.org/" title="Driven by DokuWiki" --><?php //echo $target ?><!--><img-->
<!--                src="--><?php //echo tpl_basedir(); ?><!--images/button-dw.png" width="80" height="15"-->
<!--                alt="Driven by DokuWiki"/></a>-->
<!--    </div>-->

    <div class="row justify-content-center">
        <div class="col-16">
        <a href="https://gerardnico.com/dokuwiki/bootie" title="Designed by Nickeau">Bootie Template</a>
        designed by <a href="https://gerardnico.com/" title="Nickeau WebSite">Gerardnico</a> with the help of <a
            href="https://getbootstrap.com/" title="The Bootstrap">Bootstrap</a> and <a href="https://www.dokuwiki.org/template">DokuWiki</a>
        </div>
    </div>

</footer>


