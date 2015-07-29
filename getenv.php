<?php
namespace PMVC\PlugIn\getenv;
use PMVC\PlugIn\get;
// \PMVC\l(__DIR__.'/xxx.php');

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\getenv';

\PMVC\initPlugin(array('get'=>null));

class getenv extends \PMVC\PlugIn
    implements get\GetInterface
{
    public function get($s)
    {
        return \getenv($s);
    }

    public function has($s)
    {
        return !empty(\getenv($s));
    }
}
