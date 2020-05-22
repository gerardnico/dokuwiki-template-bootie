<?php
/**
 * Template header, included in the files main.php and detail.php
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $conf;

?>

<nav class="fixed-top navbar-light bg-light">

    <!--    navbar-expand-lg gives:-->
    <!--       * the breakpoint at the md breakpoint-->
    <!--       * and make the content flex (no new line then)  -->
    <!--    <nav id="navBar" class="navbar navbar-expand-md">-->


    <?php
    $navBarPageName = tpl_getConf('header');
    if (page_findnearest($navBarPageName)) {
        tpl_flush();
        tpl_include_page($navBarPageName, 1, 1);
    } else {
        echo '<div class="container">Create a page with the id (' . $navBarPageName . ') to create a page header. Example with the <a href="https://gerardnico.com/dokuwiki/webcomponent/navbar">navbar Web component</a></div>';
    }
    ?>


    <!-- Start a new line  -->
    <div class="container">
        <!-- ********** Breadcrumbs ********** -->
        <?php

        if ($conf['breadcrumbs']) {
            tpl_breadcrumbs_bootstrap();
        }

        ?>
    </div>
</nav>

