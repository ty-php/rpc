<?php

namespace XinMo\RPC\Protocol;

use XinMo\RPC\RESTful;

class REST extends RESTful
{
    protected function execute()
    {
        if ($this->service == 'XinMo\Search') {
            switch (\XinMo\Config\Env::getName()) {
                case "dev":
                    $url = 'http://search.local.com/' . trim($this->uri, '/');
                    break;
                case "test":
                    $url = 'http://search.damowang.com/' . trim($this->uri, '/');/////qwl
                default:
                    /////qwl
                    break;
            }
        }
        $client   = new \GuzzleHttp\Client();
        $response = $client->request($this->method, $url, ['form_params' => $this->params]);

        return $response->getBody()->getContents();
    }
}
