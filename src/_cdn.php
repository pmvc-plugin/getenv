<?php

namespace PMVC\PlugIn\getenv;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\cdn';

class cdn 
{
    public $caller;
    function __invoke($key)
    {
        $cdn = $this->caller->get('HTTP_CF_RAY');
        if (!empty($cdn)) {
            $cdn = \PMVC\value(explode('-', $cdn), [1]);
        }
        return $cdn;
    }
}
