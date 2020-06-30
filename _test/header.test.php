<?php


/**
 * A simple test to test the template
 *
 * @group template_bootie
 * @group templates
 */
class template_bootie_header_test extends DokuWikiTest
{



    public function test_base()
    {

        global $conf;
        // https://www.dokuwiki.org/config:jquerycdn
        $conf ['jquerycdn'] = 'cdnjs';

        $pageId = syntax_plugin_webcomponent_button::getTag().':header:test_base';
        saveWikiText($pageId, "Content", 'Header Test base');
        idx_addPage($pageId);

        $request = new TestRequest();
        $response = $request->get(array('id' => $pageId, '/doku.php'));
        $expected = 'DokuWiki';

        $generator = $response->queryHTML('meta[name="generator"]')->attr("content");
        $this->assertEquals($expected, $generator);


    }


}
