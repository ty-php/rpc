<?php

namespace XinMo\RPC;

use XinMo\RPC\Protocol\Local;
use XinMo\RPC\Protocol\REST;

class RPC implements IRESTful
{
    private $service;
    private $uri;
    private $method;
    private $params;
    private $protocol;

    public function __construct(
        $service,
        $protocol = RPCConst::RPC_PROTOCOL_LOCAL
    ) {
        $this->service  = $service;
        $this->protocol = $protocol;
    }

    public function request(
        $uri,
        $method = RPCConst::HTTP_METHOD_GET,
        $params = []
    ) {
        $this->uri    = $uri;
        $this->method = $method;
        $this->params = $params;
        if ($this->protocol == RPCConst::RPC_PROTOCOL_REST) {
            $protocol = (new REST($this->service));
        } else {
            $protocol = (new Local($this->service));
        }

        return $protocol->request($this->uri, $this->method, $this->params);
    }
}
