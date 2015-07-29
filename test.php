<?php
PMVC\Load::plug();
PMVC\addPlugInFolder('../');
class GetEnvTest extends PHPUnit_Framework_TestCase
{
    private $_plug='getenv';
    function testPlugin()
    {
        ob_start();
        $plug = $this->_plug;
        print_r(PMVC\plug($plug));
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertContains($plug,$output);
    }

    function testGet()
    {
        $get = PMVC\plug('get');
        $get['order'] = array(
            'getenv'
        );
        $key = 'TTT';
        $value = 'lll';
        putenv("$key=$value");
        $this->assertEquals($value,$get->get($key));
    }

}
