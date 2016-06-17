<?php
namespace PMVC\PlugIn\getenv;

use PMVC\PlugIn\get\GetInterface;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\getenv';

\PMVC\initPlugin(['get'=>null]);

class getenv extends \PMVC\PlugIn
    implements GetInterface
{
    public function get($s)
    {
        return \PMVC\value($_SERVER,[$s]);
    }

    public function has($s)
    {
        return isset($_SERVER[$s]);
    }
}
