<?php

namespace PMVC\PlugIn\getenv;

use PMVC\PlugIn\get\GetInterface;
use PMVC\PlugIn;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__ . '\getenv';

\PMVC\initPlugin(['get' => null], true);

/**
 * @parameters bool isDev
 */
class getenv extends PlugIn implements GetInterface
{
    public function init()
    {
        $this['SITE'] = function (&$isCache) {
            $isCache = true;
            $site = $this->getDefault(
                'SITE',
                basename(\PMVC\callPlugin('controller', 'getAppsParent'))
            );
            return $site;
        };

        $this['UTM'] = function (&$isCache, $key) {
            $isCache = true;
            return $this->utm($key);
        };

        $this['CDN'] = function (&$isCache, $key) {
            $isCache = true;
            return $this->cdn($key);
        };

        $this['COUNTRY'] = function (&$isCache, $key) {
            $isCache = true;
            return $this->country($key);
        };

        $this['HOST_ARRAY'] = function (&$isCache, $key) {
            $isCache = true;
            $host = $this->get('HTTP_HOST');
            return explode('.', $host);
        };

        $this['UNIQUE_ID'] = function (&$isCache, $key) {
            $isCache = true;
            $unique = $this->getDefault('UNIQUE_ID');
            if (empty($unique)) {
                $unique = $this->getDefault('HTTP_X_UNIQUE_ID');
            }
            return $unique;
        };
    }

    public function get($k)
    {
        $reqKey = '--' . $k;
        $request = $this->request();
        if ($this['isDev'] && isset($request[$reqKey])) {
            return $_REQUEST[$reqKey];
        } elseif (isset($this[$k])) {
            if (!is_callable($this[$k])) {
                return $this[$k];
            }
            $isCache = false;
            $v = $this[$k]($isCache, $k, $this);
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

    public function request()
    {
        $creq = \PMVC\callPlugin('controller', 'getRequest');
        return $creq ? $creq : $_REQUEST;
    }
}
