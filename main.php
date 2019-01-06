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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <!-- Bootstrap css customization -->
    <!-- This Css is not in the framework of Dokuwiki because bootstrap requires a more recent jquery version than Dokuwiki -->
    <!-- Therefore Bootstrap must be placed after the call of tpl_metaheaders-->
    <!-- Version: -->
    <!--    - Jquery: https://github.com/twbs/bootstrap/blob/v3.3.5/bower.json -->
    <!--    - Doku: https://www.dokuwiki.org/devel:jqueryfaq -->
    <link href="<?php echo tpl_getMediaFile(array("css/customBootstrap.css")); ?>" rel="stylesheet">


</head>
<body role="document" >
<!--[if lte IE 7 ]>
<div id="IE7"><![endif]-->
<!--[if IE 8 ]>
<div id="IE8"><![endif]-->


<?php
//Library of template function
require_once('tpl_template_NicoBoot.php');
// The header (navigation)
include('tpl_header.php')
?>
<!-- Some plugin (such as wrap) rely on the dokuwiki class for their css-->
<div class="container dokuwiki">

    <!-- TAGLINE -->
    <?php if ($conf['tagline']): ?>
        <p class="claim"><?php echo $conf['tagline']; ?></p>
    <?php endif ?>

    <!-- The global message array -->
    <?php html_msgarea() ?>

    <!-- A trigger to show content on the top part of the website -->
    <?php 
        $data="";// Mandatory
        trigger_event('TPL_TOP_OUTPUT',$data);
    ?>


    <div class="row">

        <!-- ********** The CONTENT layout ********** -->
        <!-- ********** One or two columns ********** -->
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
    <!-- /content -->

    <!-- SIDE BAR -->
    <?php if ($showSidebar and $ACT == 'show'): ?>
        <nav role="complementary" class="col-md-3" style="padding-top: 15px;">
            <!-- Below data-spy="affix" data-offset-top="230"-->
            <nav class="bs-docs-sidebar hidden-prints">
                <!--<h3 class="toggle">--><?php //echo $lang['sidebar'] ?><!--</h3>-->
                <?php tpl_flush() ?>
                <?php //tpl_includeFile('sidebarheader.html') ?>
                <?php tpl_include_page($conf['sidebar'], 1, 1) ?>
                <?php //tpl_includeFile('sidebarfooter.html') ?>
                <a class="back-to-top" href="#top"> Back to top </a>
            </nav>
            
            <!-- A trigger to show content on the top part of the website -->
            <?php 
                $data="";// Mandatory
                trigger_event('TPL_SIDEBAR_OUTPUT',$data);
            ?>

        </nav>
    <?php endif; ?>

</div>
<!-- /wrapper -->

<?php include('tpl_footer.php') ?>


<!-- /site -->

<div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
<div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
<!--[if ( lte IE 7 | IE 8 ) ]></div><![endif]-->

<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
</body>
</html>
