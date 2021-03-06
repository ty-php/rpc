<?php

namespace TyPHP\RPC\Protocol;

use TyPHP\RPC\RESTful;

/**
 * RESTFUL http 调用类
 */
class REST extends RESTful
{
    protected function execute()
    {
        if ($this->service == 'TyPHP\Search') {
            switch (\TyPHP\Config\Env::getName()) {
                case "dev":
                    $url = 'http://search.local.com/' . trim($this->uri, '/');
                    break;
                case "test":
                    $url = 'http://search.damowang.com/' . trim($this->uri, '/');
                    break;
                default:
                    $url = 'http://search.weiyanqing.com/' . trim($this->uri, '/');
            }
        }
        $client   = new \GuzzleHttp\Client();
        $response = $client->request($this->method, $url, ['form_params' => $this->params]);

        return $response->getBody()->getContents();
    }
}
