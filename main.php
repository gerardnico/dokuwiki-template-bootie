<?php
/**
 * Gerardnico Template since 2015
 *
 * @link     http://gerardnico.com/dokuwiki/template
 * @author   Nicolas GERARD
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

//Library of template function
require_once('tpl_template_NicoBoot.php');

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
header('X-UA-Compatible: IE=edge,chrome=1');

global $ID;
global $lang;
global $ACT;
global $conf;

$hasSidebar = page_findnearest($conf['sidebar']);
$showSidebar = $hasSidebar && ($ACT == 'show');

global $EVENT_HANDLER;
$EVENT_HANDLER->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', null, 'tpl_bootie_meta_header');

// There is no header in the Home page
if ($ID == "start") {
    $pageTitle = "Home";
} else {
    $pageTitle = tpl_pagetitle($ID, true);
}
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>" lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>">
<head>

    <?php tpl_metaheaders() ?>

    <meta charset="utf-8"/>

    <title><?php echo $pageTitle ?> [<?php echo strip_tags($conf['title']) ?>]</title>

    <meta name="viewport" content="width=device-width,initial-scale=1"/>

    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>


</head>
<body role="document">


<?php
// The header (used also in detail.php)
include('tpl_header.php')
?>
<!--
  * tpl_classes will add the dokuwiki class. See https://www.dokuwiki.org/devel:templates#dokuwiki_class
  * dokuwiki__top ID is needed for the "Back to top" utility
  * used also by some plugins
-->

<div class="container <?php echo tpl_classes() ?>" id="dokuwiki__top">

    <!-- TAGLINE -->
    <?php if ($conf['tagline']): ?>
        <p class="claim"><?php echo $conf['tagline']; ?></p>
    <?php endif ?>

    <!-- The global message array -->
    <?php html_msgarea() ?>

    <!-- A trigger to show content on the top part of the website -->
    <?php
    $data = "";// Mandatory
    trigger_event('TPL_PAGE_TOP_OUTPUT', $data);
    ?>


    <div class="row">

        <!-- ********** The CONTENT layout ********** -->
        <!-- ********** One or two columns ********** -->
        <?php if ($showSidebar) {
            echo '<div role="main" class="col-md-9">';
        } else {
            echo '<div role="main" class="col-md-12">';
        }
        ?>


        <!-- BREADCRUMBS -->
        <?php
        if ($conf['youarehere']) {
            tpl_youarehere_bootstrap();
        }
        ?>


        <!-- The content: Show, Edit, .... -->
        <?php tpl_flush() ?>


        <!-- Add a p around the content to enable the reader view in Mozilla -->
        <!-- https://github.com/mozilla/readability -->
        <!-- But Firefox close the P because they must contain only inline element ???-->
        <?php tpl_content($prependTOC = false) ?>

        <?php tpl_pageinfo() ?>
        <?php tpl_flush() ?>


    </div>
    <!-- /content -->

    <!-- SIDE BAR -->
    <?php if ($showSidebar): ?>
        <nav role="complementary" class="col-md-3" style="padding-top: 15px;">
            <!-- Below data-spy="affix" data-offset-top="230"-->
            <nav class="bs-docs-sidebar hidden-prints">

                <?php tpl_flush() ?>

                <?php tpl_include_page($conf['sidebar'], 1, 1) ?>

                <a class="back-to-top" href="#dokuwiki__top"> Back to top </a>

            </nav>

            <!-- A trigger to show content on the sidebar part of the website -->
            <?php
            $data = "";// Mandatory
            trigger_event('TPL_SIDEBAR_BOTTOM_OUTPUT', $data);
            ?>

        </nav>
    <?php endif; ?>

</div>
<!-- /wrapper -->

<!-- Footer (used also in details.php -->
<?php include('tpl_footer.php') ?>


<!-- Indexer -->
<div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>


<!-- A trigger to add resources at the end -->
<?php
$data = "";// Mandatory
trigger_event('TPL_DOCUMENT_CLOSING', $data);
tpl_flush();
?>

<!-- The stylesheet -->
<?php
global $DOKU_TPL_BOOTIE_PRELOAD_CSS;

foreach ($DOKU_TPL_BOOTIE_PRELOAD_CSS as $link){
    ptln('<link rel="stylesheet" href="'.$link['href'].'">');
}
?>
</html>
