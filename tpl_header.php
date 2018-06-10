<?php
/**
 * Template header, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<!-- ********** HEADER ********** -->
<?php tpl_includeFile('header.html') ?>

<?php //echo $lang['skip_to_content']; ?>


<!--navbar-expand-lg gives the breakpoint -->
<nav id="navBar" class="navbar navbar-expand-md navbar-light bg-light fixed-top">

    <!-- Must be in the navbar -->
    <div class="container">


        <!-- Never collpase -->
        <div class="navbar-nav">

            <li class="nav-item">
                <?php
                // TODO: Replace with icon font
                // https://css-tricks.com/examples/IconFont/
                //            // get logo either out of the template images folder or data/media folder
                //            $logoSize = array();
                //            $logo = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'images/logo.png'), false, $logoSize);
                //            // display logo and wiki title in a link to the home page
                //            tpl_link(
                //                wl(),
                //                '<img src="' . $logo . '" ' . $logoSize[3] . ' alt="" />',
                //                'class="navbar-brand" accesskey="h" title="[H]"'
                //            );

                tpl_link(
                    wl(),
                    $conf['title'], // Title
                    'id="navBarBrand" class="navbar-brand"')
                ?>
            </li>

        </div>

        <!-- Needed for responsive design on mobile -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- The navbar -->
        <div id="navbar" class="collapse navbar-collapse">

            <ul id="navBarCollapse" class="nav navbar-nav">

                <!-- Search Form -->
                <?php tpl_searchform_bootie() ?>


                <!-- About -->
                <!-- Margin Right auto (mr-auto) pushes the others components to the right -->
                <li class="nav-item mr-auto">
                    <?php tpl_link(wl('about'), hsc("About"), 'title="About" class="nav-link"'); ?>
                </li>


                <!-- User tool -->
                <!-- Logged As -->
                <?php
                if (!empty($_SERVER['REMOTE_USER'])) { ?>

                    <li class="nav-item dropdown">

                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbarDropdownUserTool"
                           role="button" aria-haspopup="true" aria-expanded="false"
                           title="<?php $lang['loggedinas'] . $_SERVER['REMOTE_USER'] ?>">
                            <?php print 'User ' . ucfirst(editorinfo($_SERVER['REMOTE_USER'], true)); ?>
                        </a>


                        <div class="dropdown-menu" aria-labelledby="navbarDropdownUserTool">
                            <?php
                            tpl_actionlink_bootie('admin', "dropdown-item");
                            tpl_actionlink_bootie('profile', "dropdown-item");
                            tpl_actionlink_bootie('login', "dropdown-item");
                            ?>
                        </div>


                    </li>
                    <?php
                } else {

                    tpl_actionlink_bootie('login', "dropdown-item", '<li class="nav-item">', '</li>');
                    tpl_actionlink_bootie('register', "dropdown-item", '<li class="nav-item">', '</li>');

                }


                // <!-- Page tool -->
                echo '<li class="nav-item dropdown">';

                echo '<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbarDropdownPageTool" role="button" aria-haspopup="true" aria-expanded="false" title="' . $lang['loggedinas'] . $_SERVER['REMOTE_USER'] . '">';
                echo $lang['page_tools'];
                echo '</a>';

                echo '<ul id="navBarPageTool" class="dropdown-menu"  aria-labelledby="navbarDropdownPageTool">';

                $data = array(
                    'view' => 'main',
                    'items' => array(
                        'edit' => tpl_actionlink_bootie('edit', "dropdown-item", '<li class="nav-item">', '</li>', '', 1),
                        'revert' => tpl_actionlink_bootie('revert', "dropdown-item", '<li class="nav-item">', '</li>', '', 1),
                        'revisions' => tpl_actionlink_bootie('revisions', "dropdown-item", '<li class="nav-item">', '</li>', '', 1),
                        'backlink' => tpl_actionlink_bootie('backlink', "dropdown-item", '<li class="nav-item">', '</li>', '', 1),
                        'subscribe' => tpl_actionlink_bootie('subscribe', "dropdown-item", '<li class="nav-item">', '</li>', '', 1),
//                        'top' => tpl_actionlink_bootie('top', "dropdown-item", '<li class="nav-item">', '</li>', '', 1), Already at the top
                        'index' => tpl_actionlink_bootie('index', "dropdown-item", '<li class="nav-item">', '</li>', '', 1),
                    )
                );


                // TODO: Possible to add action ?
                if ($INFO['ismanager']) {
                    $data['items']['purge'] = '<li class="nav-item">' . tpl_link(wl($ID, ['purge' => true]), '<span>Purge this page</span>', 'class="action purge dropdown-item"', $return = true) . '</li>';
                    $data['items']['purge_css'] = '<li class="nav-item">' . tpl_link("/lib/exe/css.php?purge=true", '<span>Purge Css</span>', 'class="action purge dropdown-item"', $return = true) . '</li>';
                    $data['items']['purge_js'] = '<li class="nav-item">' . tpl_link("/lib/exe/js.php?purge=true", '<span>Purge Js</span>', 'class="action purge dropdown-item"', $return = true) . '</li>';
					$data['items']['export_xhtml'] = '<li class="nav-item">' . tpl_link(wl($ID, ['do' => "export_xhtml"]), '<span>Export Xhtml</span>', 'class="action purge dropdown-item"', $return = true) . '</li>';
                }


                // the page tools can be amended through a custom plugin hook
                $evt = new Doku_Event('TEMPLATE_PAGETOOLS_DISPLAY', $data);
                if ($evt->advise_before()) {
                    foreach ($evt->data['items'] as $k => $html) echo $html;
                }
                $evt->advise_after();
                unset($data);
                unset($evt);

                echo '</ul>';
                echo '</li>';

                ?>


            </ul>


        </div>


    </div>

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


<!-- A tease -->
<!--<div class="container-tease">-->
<!--    <a href="" class="header-tease">My Tease</a>-->
<!--</div>-->




