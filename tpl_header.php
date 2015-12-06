<?php
/**
 * Template header, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<!-- ********** HEADER ********** -->
<?php tpl_includeFile('header.html') ?>

<!--    --><?php //echo $lang['skip_to_content']; ?><!--</a></li>-->

<nav class="navbar navbar-default navbar-fixed-top">

    <!-- Container = 70%, container-fluid = 100% -->
    <div class="container">


        <!-- Needed for responsive design on mobile -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- The brand -->
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
                'Gerardnico', // Title
                'class="navbar-brand"')
            ?>
        </div>

        <!-- The navbar -->
        <div id="navbar" class="navbar-collapse collapse">


            <ul class="nav navbar-nav navbar-left">

                <!-- Search Form -->
                <li>
                    <?php  tpl_searchform_bootie() ?>
                </li>

                <!-- About -->
                <li><?php tpl_link(wl('about'), hsc("About"), 'title="About"'); ?></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">

                <!-- User tool -->
                <!-- Logged As -->
                <?php
                if (!empty($_SERVER['REMOTE_USER'])) {

                    echo '<li class="dropdown">';
                    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="' . $lang['loggedinas'] . $_SERVER['REMOTE_USER'] . '">';
                    print 'User '.ucfirst(editorinfo($_SERVER['REMOTE_USER'], true));
                    print '<span class="caret"></span>';
                    echo '</a>';

                    echo '<ul class="dropdown-menu">';
                    tpl_action('admin', 1, 'li');
                    tpl_action('profile', 1, 'li');
                    tpl_action('login', 1, 'li');
                    echo '</ul>';

                    echo '</li>';

                } else {

                    tpl_action('login', $link = true, $wrapper = 'li');
                    tpl_action('register', 1, 'li');

                }
                ?>


                <!-- Page tool -->
                <li class="dropdown navbar-right"
                ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="false">
                    <?php echo $lang['page_tools']; ?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php
                    $data = array(
                        'view' => 'main',
                        'items' => array(
                            'edit' => tpl_action('edit', 1, 'li', 1, '<span>', '</span>'),
                            'revert' => tpl_action('revert', 1, 'li', 1, '<span>', '</span>'),
                            'revisions' => tpl_action('revisions', 1, 'li', 1, '<span>', '</span>'),
                            'backlink' => tpl_action('backlink', 1, 'li', 1, '<span>', '</span>'),
                            'subscribe' => tpl_action('subscribe', 1, 'li', 1, '<span>', '</span>'),
                            'top' => tpl_action('top', 1, 'li', 1, '<span>', '</span>')
                        )
                    );


                    // TODO: Possible to add action ?
                    if($INFO['ismanager']) {
                        $data['items']['purge'] = '<li>' . tpl_link(wl($ID, ['purge' => true]), '<span>Purge this page</span>', 'class="action purge"', $return = true) . '</li>';
                        $data['items']['purge_css'] = '<li>' . tpl_link("/lib/exe/css.php?purge=true", '<span>Purge Css</span>', 'class="action purge"', $return = true) . '</li>';
                        $data['items']['purge_js'] = '<li>' . tpl_link("/lib/exe/js.php?purge=true", '<span>Purge Js</span>', 'class="action purge"', $return = true) . '</li>';
                    }


                    // the page tools can be amended through a custom plugin hook
                    $evt = new Doku_Event('TEMPLATE_PAGETOOLS_DISPLAY', $data);
                    if ($evt->advise_before()) {
                        foreach ($evt->data['items'] as $k => $html) echo $html;
                    }
                    $evt->advise_after();
                    unset($data);
                    unset($evt);
                    ?>
                </ul>
                </li>


            </ul>


        </div>
        <!-- ********** The CONTENT layout********** -->
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




