<?php

namespace PMVC\PlugIn\getenv;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\country';

class country 
{
    function __invoke($key)
    {
        $country = $this->caller->get('CF-IPCountry');
        if (!empty($country)) {
            $country = strtolower($country);
        }
        return $country;
    }
}
