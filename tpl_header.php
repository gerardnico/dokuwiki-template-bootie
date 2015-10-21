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

<nav class="navbar navbar-fixed-top navbar-inverse">

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
            // get logo either out of the template images folder or data/media folder
            $logoSize = array();
            $logo = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'images/logo.png'), false, $logoSize);

            // display logo and wiki title in a link to the home page
            tpl_link(
                wl(),
                '<img src="' . $logo . '" ' . $logoSize[3] . ' alt="" />',
                'class="navbar-brand" accesskey="h" title="[H]"'
            );

            tpl_link(
                wl(),
                'Gerardnico', // Title
                'class="navbar-brand"')
            ?>
        </div>

        <!-- The navbar -->
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-left">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
            <ul class="nav navbar-nav navbar-left">
                <li><a href="#">About</a></li>

                <!-- User tool -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        <?php echo $lang['user_tools']; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        tpl_action('admin', 1, 'li');
                        tpl_action('profile', 1, 'li');
                        tpl_action('register', 1, 'li');
                        tpl_action('login', 1, 'li');
                        ?>
                    </ul>
                </li>

                <!-- Page tool -->
                <li class="dropdown">
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

                <!-- Logged As -->
                <?php
                if (!empty($_SERVER['REMOTE_USER'])) {
                    echo '<li><a href="/doku.php?id=user:' . $_SERVER['REMOTE_USER'] . '" title="' . $lang['loggedinas'] . $_SERVER['REMOTE_USER'] . '">';
                    print $lang['loggedinas'] . ' ' . editorinfo($_SERVER['REMOTE_USER'], true);
                    echo '</a></li>';
                }
                ?>

            </ul>

        </div>
        <!-- ********** The CONTENT layout********** -->
        <?php
        if ($ACT == 'show') {
            if ($conf['breadcrumbs']) {
                tpl_breadcrumbs_bootstrap();
            }
        }
        ?>

    </div>

</nav>

<div class="container-tease">
    <!-- The tease -->
    <a href="" class="header-tease">My Tease</a>
</div>




