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
            $rawKeys = ['source', 'medium', 'campaign'];
            $isEmpty = false;
            $arr = [];
            foreach ($rawKeys as $rawK) {
                $kVal = \PMVC\get($_REQUEST, 'utm_'.$rawK);
                $kVal = str_replace('_', '', $kVal);
                if (empty($kVal)) {
                    $isEmpty = true;
                    break;
                }
                $arr[] = $kVal; 
            }
            $pCookie = \PMVC\plug('cookie');
            if (!$isEmpty) {
                $utm = join('_', $arr);
                $pCookie->set($key, $utm, ['lifetime'=>86400*365]);
                return $utm;
            }
            $utm = $pCookie->get($key);
            if (!empty($utm)) {
                return $utm;
            } else {
                return null;
            }
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
