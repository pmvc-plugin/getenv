<?php
namespace PMVC\PlugIn\getenv;

use PMVC\PlugIn\get\GetInterface;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\getenv';

\PMVC\initPlugin(['get'=>null]);

class getenv extends \PMVC\PlugIn
    implements GetInterface
{
    public function get($k)
    {
        if (isset($this[$k])) {
            if (is_callable($this[$k])) {
                $isCache = false;
                $v = $this[$k]($isCache, $k, $this);
                if ($isCache) {
                    $this[$k] = $v;
                }
                return $v;
            } else {
                return $this[$k];
            }
        } else {
            return \PMVC\value($_SERVER,[$k]);
        }
    }

    public function has($k)
    {
        return isset($_SERVER[$k]) || isset($this[$k]);
    }
}
