<?php
/**
 * Gerardnico Template since 2015
 *
 * @link     http://gerardnico.com/dokuwiki/template
 * @author   Nicolas GERARD
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
header('X-UA-Compatible: IE=edge,chrome=1');

$hasSidebar = page_findnearest($conf['sidebar']);
$showSidebar = $hasSidebar && ($ACT == 'show');

global $ID;

// There is no header in the Home page
if ($ID == "start") {
    $pageTitle = "Home";
} else {
    $pageTitle = tpl_pagetitle($ret = true);
}
?>

<!DOCTYPE html>
<!--<html lang="--><?php //echo $conf['lang'] ?><!--" dir="--><?php //echo $lang['direction'] ?><!--" class="no-js">-->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>" lang="<?php echo $conf['lang'] ?>"
      dir="<?php echo $lang['direction'] ?>">
<head>

    <?php tpl_metaheaders() ?>

    <meta charset="utf-8"/>

    <title><?php echo $pageTitle ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>


    <!-- Bootstrap -->
    <!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    <link href="<?php echo tpl_getMediaFile(array("css/bootstrap-4.3.1.min.css")); ?>" rel="stylesheet">

    <!-- Bootstrap css customization -->
    <!-- This Css is not in the framework of Dokuwiki because bootstrap requires a more recent jquery version than Dokuwiki -->
    <!-- Therefore Bootstrap must be placed after the call of tpl_metaheaders-->
    <!-- Version: -->
    <!--    - Jquery: https://github.com/twbs/bootstrap/blob/v3.3.5/bower.json -->
    <!--    - Doku: https://www.dokuwiki.org/devel:jqueryfaq -->
    <link href="<?php echo tpl_getMediaFile(array("css/customBootstrap.css")); ?>" rel="stylesheet">


</head>
<body role="document">


<?php
//Library of template function
require_once('tpl_template_NicoBoot.php');

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


<!-- /site -->

<div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
<div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
<!--[if ( lte IE 7 | IE 8 ) ]></div><![endif]-->

<!-- TODO: D:\dokuwiki\lib\plugins\bootswrapper\action.php -->
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<!--<script src="-->
<?php //echo tpl_getMediaFile(array("js/jquery-3.3.1.slim.min.js")); ?><!--" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="<?php echo tpl_getMediaFile(array("js/popper-1.14.7.min.js")); ?>"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="<?php echo tpl_getMediaFile(array("js/bootstrap-4.3.1.min.js")); ?>"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</html>
