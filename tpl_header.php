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
            echo '<div class="container">Create a page with the id ('.$navBarPageName.') to create a page header. Example with the <a href="https://gerardnico.com/dokuwiki/webcomponent/navbar">navbar Web component</a></div>';
        }
        ?>


        <!-- About -->
        <!-- Margin Right auto (mr-auto) pushes the others components to the right -->
        <!--                <li class="nav-item mr-auto">-->
        <!--                    --><?php //tpl_link(wl('about'), hsc("About"), 'title="About" class="nav-link"'); ?>
        <!--                </li>-->


        <!--//-->
        <!--//-->
        <!--//                // TODO: https://www.dokuwiki.org/devel:menus-->
        <!--//                if ($INFO['ismanager']) {-->
        <!--//-->
        <!--//                    $data['items']['purge'] = '<li class="nav-item">' . tpl_link(wl($ID, ['purge' => true]), '<span>Purge this page</span>', 'class="action purge dropdown-item"', $return = true) . '</li>';-->
        <!--//                    $data['items']['purge_css'] = '<li class="nav-item">' . tpl_link("/lib/exe/css.php?purge=true", '<span>Purge Css</span>', 'class="action purge dropdown-item"', $return = true) . '</li>';-->
        <!--//                    $data['items']['purge_js'] = '<li class="nav-item">' . tpl_link("/lib/exe/js.php?purge=true", '<span>Purge Js</span>', 'class="action purge dropdown-item"', $return = true) . '</li>';-->
        <!--//                    $data['items']['export_xhtml'] = '<li class="nav-item">' . tpl_link(wl($ID, ['do' => "export_xhtml"]), '<span>Export Xhtml</span>', 'class="action purge dropdown-item"', $return = true) . '</li>';-->
        <!--//-->
        <!--//                    // the page tools can be amended through a custom plugin hook-->
        <!--//                    $evt = new Doku_Event('TEMPLATE_PAGETOOLS_DISPLAY', $data);-->
        <!--//                    if ($evt->advise_before()) {-->
        <!--//                        foreach ($evt->data['items'] as $k => $html) echo $html;-->
        <!--//                    }-->
        <!--//                    $evt->advise_after();-->
        <!--//                    unset($data);-->
        <!--//                    unset($evt);-->
        <!--//-->
        <!--//                }-->
        <!--//-->


<!--    </nav>-->
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

