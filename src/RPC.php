<?php

namespace TyPHP\RPC;

use TyPHP\RPC\Protocol\Local;
use TyPHP\RPC\Protocol\REST;

/**
 * rpc入口
 * @method static $this Recommend($siteId, $protocol = RPCConst::RPC_PROTOCOL_LOCAL)
 */
class RPC implements IRESTful
{
    private $service;
    private $siteId;
    private $uri;
    private $method;
    private $params;
    private $protocol;

    public function __construct($service, $siteId = null, $protocol = RPCConst::RPC_PROTOCOL_LOCAL)
    {
        $this->service  = $service;
        $this->siteId   = $siteId;
        $this->protocol = $protocol;
    }

    public static function server($service, $siteId, $protocol = RPCConst::RPC_PROTOCOL_LOCAL): RPC
    {
        return new self($service, $siteId, $protocol);
    }

    public function request($uri, $method = RPCConst::HTTP_METHOD_GET, $params = [])
    {
        $this->uri    = $uri;
        $this->method = $method;

        $this->params = is_array($params)?$params + ['siteId' => $this->siteId]:$params;
        if ($this->protocol == RPCConst::RPC_PROTOCOL_REST) {
            $protocol = (new REST($this->service));
        } else {
            $protocol = (new Local($this->service));
        }

        return $protocol->request($this->uri, $this->method, $this->params);
    }

    public function get($uri, $params = [])
    {
        return $this->request($uri, RPCConst::HTTP_METHOD_GET, $params);
    }

    public function post($uri, $params = [])
    {
        return $this->request($uri, RPCConst::HTTP_METHOD_POST, $params);
    }

    public function put($uri, $params = [])
    {
        return $this->request($uri, RPCConst::HTTP_METHOD_PUT, $params);
    }

    public function delete($uri, $params = [])
    {
        return $this->request($uri, RPCConst::HTTP_METHOD_DELETE, $params);
    }

    public static function __callStatic($name, $arguments)
    {
        return self::server($service = 'TyPHP\\' . $name, ...$arguments);
    }
}
