<?php

namespace XinMo\RPC\Protocol;

use XinMo\RPC\RESTful;

class REST extends RESTful
{
    protected function execute()
    {
        if ($this->service == 'XinMo\Search') {
            $url = 'http://search.local.com/' . trim($this->uri, '/');
        }
        $client   = new \GuzzleHttp\Client();
        $response = $client->request($this->method, $url, ['form_params' => $this->params]);

        return $response->getBody()->getContents();
    }
}
