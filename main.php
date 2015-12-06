<?php
/**
 * DokuWiki Default Template 2015
 *
 * @link     http://gerardnico.com/wiki/dokuwiki/template
 * @author   Nicolas GERARD
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
header('X-UA-Compatible: IE=edge,chrome=1');

$hasSidebar = page_findnearest($conf['sidebar']);
$showSidebar = $hasSidebar && ($ACT == 'show');
?><!DOCTYPE html>
<!--<html lang="--><?php //echo $conf['lang'] ?><!--" dir="--><?php //echo $lang['direction'] ?><!--" class="no-js">-->
<html lang="<?php echo $conf['lang'] ?>" class="no-js">
<head>
    <meta charset="utf-8"/>

    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function (H) {
            H.className = H.className.replace(/\bno-js\b/, 'js')
        })(document.documentElement)</script>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>

    <!-- Dokuwiki -->
    <!-- Must be place before bootstrap links because of difference in Jquery version-->
    <?php tpl_metaheaders() ?>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Bootstrap css customization -->
    <!-- This Css is not in the framework of Dokuwiki because bootstrap requires a more recent jquery version than Dokuwiki -->
    <!-- Therefore Bootstrap must be placed after the call of tpl_metaheaders-->
    <!-- Version: -->
    <!--    - Jquery: https://github.com/twbs/bootstrap/blob/v3.3.5/bower.json -->
    <!--    - Doku: https://www.dokuwiki.org/devel:jqueryfaq -->
    <link href="<?php echo tpl_getMediaFile(array("css/customBootstrap.css")); ?>" rel="stylesheet">


</head>
<body role="document">
<!--[if lte IE 7 ]>
<div id="IE7"><![endif]-->
<!--[if IE 8 ]>
<div id="IE8"><![endif]-->


<?php
//Library of template function
include('tpl_template_NicoBoot.php');
// The header (navigation)
include('tpl_header.php')
?>
<div class="container">


    <!-- TAGLINE -->
    <?php if ($conf['tagline']): ?>
        <p class="claim"><?php echo $conf['tagline']; ?></p>
    <?php endif ?>

    <!-- The global message array -->
    <?php html_msgarea() ?>


    <div class="row">

        <!-- ********** The CONTENT layout ********** -->
        <!-- ********** One or two coloumns ********** -->
        <?php if ($ACT == 'show' and $showSidebar and page_findnearest($conf['sidebar'])) {
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

        <!-- Some plugin (such as wrap) rely on the dokuwiki div tag for their css-->
        <div class="dokuwiki">

            <!-- The content: Show, Edit, .... -->
            <?php tpl_flush() ?>
            <?php tpl_includeFile('pageheader.html') ?>
            <!-- wikipage start $prependTOC=false -->

            <!-- Add a p around the content to enable the reader view in Mozilla -->
            <!-- https://github.com/mozilla/readability -->
            <!-- But Firefox close the P because they must contain only inline element ???-->
            <?php tpl_content($prependTOC = false) ?>

            <!-- wikipage stop -->
            <?php tpl_includeFile('pagefooter.html') ?>

            <?php tpl_pageinfo() ?>
            <?php tpl_flush() ?>


        </div>

    </div>
    <!-- /content -->

    <!-- SIDE BAR -->
    <?php if ($showSidebar and $ACT == 'show'): ?>
        <nav role="complementary" class="col-md-3">
            <!-- Below data-spy="affix" data-offset-top="230"-->
            <nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm">
                <!--<h3 class="toggle">--><?php //echo $lang['sidebar'] ?><!--</h3>-->
                <?php tpl_flush() ?>
                <?php //tpl_includeFile('sidebarheader.html') ?>
                <?php tpl_include_page($conf['sidebar'], 1, 1) ?>
                <?php //tpl_includeFile('sidebarfooter.html') ?>
                <a class="back-to-top" href="#top"> Back to top </a>
            </nav>

        </nav>
    <?php endif; ?>

</div>
<!-- /wrapper -->

<?php include('tpl_footer.php') ?>


<!-- /site -->

<div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
<div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
<!--[if ( lte IE 7 | IE 8 ) ]></div><![endif]-->
</body>
</html>
