<?php
namespace PMVC\PlugIn\getenv;

use PMVC\PlugIn\get\GetInterface;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\getenv';

\PMVC\initPlugin(['get'=>null]);

/**
 * @parameters bool isDev
 */
class getenv extends \PMVC\PlugIn
    implements GetInterface
{
    public function init()
    {
        $this['SITE'] = function()
        {
            return basename(\PMVC\getAppsParent());
        };
    }

    public function get($k)
    {
        $reqKey = '--'.$k;
        if ($this['isDev'] &&
            isset($_REQUEST[$reqKey])
           ) {
            return $_REQUEST[$reqKey];
        } elseif (isset($this[$k])) {
            if (!is_callable($this[$k])) {

                return $this[$k];
            }
            $isCache = false;
            $v = $this[$k](
                $isCache,
                $k,
                $this
            );
            if ($isCache) {
                $this[$k] = $v;
            }

            return $v;
        } else {
            return $this->getDefault($k);
        }
    }

    public function getDefault($k)
    {
        return \PMVC\get($_SERVER,$k);
    }

    public function has($k)
    {
        return isset($_SERVER[$k]) || isset($this[$k]);
    }
}
