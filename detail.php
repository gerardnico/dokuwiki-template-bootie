<?php
/**
 * DokuWiki Image Detail Page
 *
 * @author   Andreas Gohr <andi@splitbrain.org>
 * @author   Anika Henke <anika@selfthinker.org>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
header('X-UA-Compatible: IE=edge,chrome=1');

?><!DOCTYPE html>
<html lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="utf-8"/>
    <title>
        <?php echo hsc(tpl_img_getTag('IPTC.Headline', $IMG)) ?>
        [<?php echo strip_tags($conf['title']) ?>]
    </title>
    <script>(function (H) {
            H.className = H.className.replace(/\bno-js\b/, 'js')
        })(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>

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

<body>
<!--[if lte IE 7 ]>
<div id="IE7"><![endif]--><!--[if IE 8 ]>
<div id="IE8"><![endif]-->
<div id="dokuwiki__site">
    <div id="dokuwiki__top" class="site <?php echo tpl_classes(); ?>">

        <?php include_once('tpl_template_NicoBoot.php'); ?>
        <?php include('tpl_header.php') ?>
        <!-- Bootstrap Container -->
        <div class="container">
		
			<?php 
                $data="";// Mandatory for the below function
                trigger_event('TPL_TOP_OUTPUT',$data);
            ?>
            
            <!-- Must contain One row -->
            <div class="row">
             
				<div role="main" class="col-md-12">
                    <!-- ********** CONTENT ********** -->
                    
                        

<!--                            What is this ? Double with the h1 below -->
<!--                            --><?php //if (!$ERROR): ?>
<!--                                <div class="pageId">-->
<!--                                    <span>IPTC.Headline: --><?php //echo hsc(tpl_img_getTag('IPTC.Headline', $IMG)); ?><!--</span></div>-->
<!--                            --><?php //endif; ?>

                            
					<?php tpl_flush() ?>
					<?php tpl_includeFile('pageheader.html') ?>
					<!-- detail start -->
					<?php
					if ($ERROR):
						echo '<h1>' . $ERROR . '</h1>';
					else: ?>
						<?php if ($REV) echo p_locale_xhtml('showrev'); ?>
						<h1><?php echo nl2br(hsc(tpl_img_getTag('simple.title'))); ?></h1>

						<p>
						<?php tpl_img(900, 700); /* parameters: maximum width, maximum height (and more) */ ?>
						</p>

						<div class="img_detail">
							<?php tpl_img_meta(); ?>
						</div>
						<?php //Comment in for Debug// dbg(tpl_img_getTag('Simple.Raw'));?>
					<?php endif; ?>
                            
					<!-- detail stop -->
					<?php tpl_includeFile('pagefooter.html') ?>
					<?php tpl_flush() ?>

					<?php /* doesn't make sense like this; @todo: maybe add tpl_imginfo()? <div class="docInfo"><?php tpl_pageinfo(); ?></div> */ ?>
                
				</div>
            </div>
        </div>
        <?php include('tpl_footer.php') ?>
    </div>
</div><!-- /site -->

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
