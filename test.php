<?php
PMVC\Load::plug();
PMVC\addPlugInFolders(['../']);
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
        $get = PMVC\plug('get', [
            'order'=>[
                'getenv'
            ]
        ]);
        $key = 'TTT';
        $value = 'lll';
        $_SERVER[$key] = $value; 
        $this->assertEquals($value,$get->get($key));
    }

    function testCustomEnv()
    {
        $fakeKey = 'abc';
        $fakeValue = '123';
        $p = PMVC\plug($this->_plug, [
            $fakeKey=> $fakeValue
        ]);
        $this->assertEquals($fakeValue,$p->get($fakeKey));
    }

    function testCustomEnvWithFunction()
    {
        $fakeKey = 'abc';
        $fakeValue = '123';
        $p = PMVC\plug($this->_plug, [
            $fakeKey=> function() use ($fakeValue){
                return $fakeValue;
            }
        ]);
        $this->assertEquals($fakeValue,$p->get($fakeKey));
    }
}
