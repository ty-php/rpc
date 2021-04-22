<?php

namespace XinMo\RPC\Protocol;

use XinMo\RPC\RESTful;

class REST extends RESTful
{
    protected function execute()
    {
        if ($this->service == 'XinMo\Search') {
            
        }
        var_dump($this->service, $this->uri, $this->method, $this->params);
    }
}
