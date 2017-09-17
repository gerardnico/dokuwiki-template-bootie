<?php
/**
 * Template footer, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<!-- ********** FOOTER is a nav bar class********** -->
<footer id="dokuwiki__footer" class="footer pad">

    <?php
    tpl_includeFile('footer.html');
    ?>

    <div class="container">
        <div class="d-flex flex-row justify-content-between" >
            <div >
                <h3>Data (State)</h3>
                <ul>
                    <li><a href="/particulier/overzichten/index">Data Processing</a></li>
                    <li><a href="/particulier/betalen/index">Data Modeling</a></li>
                    <li><a href="/particulier/overzichten/verzendlijst/index">Data Quality</a></li>
                    <li><a href="/particulier/berichten/index">Data Structure</a></li>
                    <li><a href="/particulier/overzichten/ingeplande-opdrachten/index">Data Type</a></li>
                    <li><a href="/particulier/overzichten/geweigerde-opdrachten/index">Data Warehouse</a></li>
                    <li><a href="/particulier/overzichten/afschriften-en-jaaroverzichten/index">Data Vizualisation</a></li>
                    <li><a href="/particulier/overzichten/download/index">Data Partition</a></li>
                    <li><a href="/particulier/overzichten/verzoekenpagina/index">Data Persistence</a></li>
                </ul>
            </div>
            <div>
                <h3>Data Type</h3>
                <ul>
                    <li><a href="/particulier/overzichten/index">Number</a></li>
                    <li><a href="/particulier/overzichten/verzendlijst/index">Time</a></li>
                    <li><a href="/particulier/overzichten/verzendlijst/index">Text</a></li>
                    <li><a href="/particulier/betalen/index">Collection</a></li>
                    <li><a href="/particulier/betalen/index">Relation (Table)</a></li>
                    <li><a href="/particulier/berichten/index">Tree</a></li>
                    <li><a href="/particulier/berichten/index">Key/Value</a></li>
                    <li><a href="/particulier/berichten/index" title="Nodes and Edges">Graph</a></li>
                    <li><a href="/particulier/overzichten/ingeplande-opdrachten/index">Spatial</a></li>
                </ul>
            </div>
            <div >
                <h3>Code</h3>
                <ul>
                    <li><a href="/particulier/betalen/index">Compiler</a></li>
                    <li><a href="/particulier/betalen/index">Lexical Parser</a></li>
                    <li><a href="/particulier/overzichten/verzendlijst/index">Grammar</a></li>
                    <li><a href="/particulier/overzichten/index">Function</a></li>
                    <li><a href="/particulier/berichten/index">Testing</a></li>
                    <li><a href="/particulier/overzichten/verzendlijst/index">Shipping</a></li>
                    <li><a href="/particulier/berichten/index">Data Type</a></li>
                    <li><a href="/particulier/overzichten/ingeplande-opdrachten/index">Versioning</a></li>
                </ul>
            </div>
            <div >
                <h3>System</h3>
                <ul>
                    <li><a href="/particulier/overzichten/index">Operating System</a></li>
                    <li><a href="/particulier/betalen/index">Transactions and Properties</a></li>
                    <li><a href="/particulier/overzichten/index">Security</a></li>
                    <li><a href="/particulier/overzichten/index">File System</a></li>
                    <li><a href="/particulier/overzichten/index">Concurrency</a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php tpl_license(''); // license text ?>

    <div class="buttons">
        <?php
        tpl_license('button', true, false, false); // license button, no wrapper
        $target = ($conf['target']['extern']) ? 'target="' . $conf['target']['extern'] . '"' : '';
        ?>
        <a href="http://validator.w3.org/check/referer" title="Valid HTML5" <?php echo $target ?>><img
                src="<?php echo tpl_basedir(); ?>images/button-html5.png" width="80" height="15"
                alt="Valid HTML5"/></a>
        <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3"
           title="Valid CSS" <?php echo $target ?>><img
                src="<?php echo tpl_basedir(); ?>images/button-css.png" width="80" height="15"
                alt="Valid CSS"/></a>
        <a href="http://dokuwiki.org/" title="Driven by DokuWiki" <?php echo $target ?>><img
                src="<?php echo tpl_basedir(); ?>images/button-dw.png" width="80" height="15"
                alt="Driven by DokuWiki"/></a>
    </div>
    <div>
        <a href="http://gerardnico.com/wiki/dokuwiki/bootie" title="Designed by Nickeau">Bootie Template</a>
        designed by <a href="http://gerardnico.com/" title="Nickeau WebSite">Gerardnico</a> with the help of <a
            href="http://getbootstrap.com/" title="The Bootstrap">Bootstrap</a>.
    </div>

</footer><!-- /footer -->


