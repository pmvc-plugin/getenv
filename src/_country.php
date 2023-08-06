<?php

namespace PMVC\PlugIn\getenv;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__ . '\country';

class country
{
    public $caller;
    function __invoke($key)
    {
        $country = $this->caller->get('HTTP_CF_IPCOUNTRY');
        if (!empty($country)) {
            $country = strtolower($country);
        }
        return $country;
    }
}
