<?php

namespace PMVC\PlugIn\getenv;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\utm';

class utm
{
    function __invoke($key)
    {
        $rawKeys = ['source', 'medium', 'campaign'];
        $isEmpty = false;
        $arr = [];
        $request = $this->caller->request();
        foreach ($rawKeys as $rawK) {
            $kVal = \PMVC\get($request, 'utm_'.$rawK);
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
    }
}
