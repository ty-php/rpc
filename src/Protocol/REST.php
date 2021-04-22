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
        $response = $client->request($this->method, $url, $this->params);

        //var_dump($response->getStatusCode(),$response->getBody()->getContents());exit;
        return $response->getBody()->getContents();
    }
}
