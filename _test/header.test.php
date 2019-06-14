<?php


/**
 * Test the template
 *
 * @group template_bootie
 * @group templates
 */
class plugin_webcomponent_header_test extends DokuWikiTest
{




    public function test_base()
    {

        global $conf;
        // https://www.dokuwiki.org/config:jquerycdn
        $conf ['jquerycdn'] = 'cdnjs';

        // https://getbootstrap.com/docs/4.3/components/card/#using-custom-css
        $elements = syntax_plugin_webcomponent_button::getTags();
        $link_content = 'Go Somewhere';
        $doku_text = '<' . $elements[0] . '>' . '[[:namespace:page#section|' . $link_content . ']]' . '</' . $elements[0] . '>';
        $pageId = syntax_plugin_webcomponent_button::getTag().':header:test_base';
        saveWikiText($pageId, $doku_text, 'Header Test base');
        idx_addPage($pageId);

        $request = new TestRequest();
        $response = $request->get(array('id' => $pageId, '/doku.php'));
        $expected = '<a href="/doku.php?id=:namespace:page%23section" class="btn btn-primary">' . $link_content . '</a>';

        $generator = $response->queryHTML('meta[name="generator"]');
        $this->assertEquals($expected, $generator);


    }


}
