<?php

namespace PMVC\PlugIn\getenv;

use PMVC\PlugIn\get\GetInterface;
use PMVC\PlugIn;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\getenv';

\PMVC\initPlugin(['get'=>null]);

/**
 * @parameters bool isDev
 */
class getenv
    extends PlugIn
    implements GetInterface
{
    public function init()
    {
        $this['SITE'] = function(&$isCache)
        {
            $isCache = true;
            return basename(\PMVC\getAppsParent());
        };

        $this['UTM'] = function(&$isCache, $key)
        {
            $isCache = true;
            return $this->utm($key);
        };

        $this['COLO'] = function(&$isCache, $key)
        {
            $isCache = true;
            return $this->colo($key);
        };

        $this['COUNTRY'] = function(&$isCache, $key)
        {
            $isCache = true;
            return $this->country($key);
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

    public function getDefault($k, $default = null)
    {
        return \PMVC\get($_SERVER, $k, $default);
    }

    public function has($k)
    {
        return isset($_SERVER[$k]) || isset($this[$k]);
    }
}
