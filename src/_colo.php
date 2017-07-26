<?php

namespace PMVC\PlugIn\getenv;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\colo';

class colo 
{
    function __invoke($key)
    {
        $colo = $this->caller->get('CF-RAY');
        if (!empty($colo)) {
            $colo = \PMVC\value(explode('-', $colo), [1]);
        }
        return $colo;
    }
}
