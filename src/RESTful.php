<?php

namespace XinMo\RPC;

abstract class RESTful implements IRESTful
{
    protected $service;
    protected $uri;
    protected $method;
    protected $params;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function request($uri, $method, $params)
    {
        $this->uri    = $uri;
        $this->method = $method;
        $this->params = $params;
        $this->execute();
    }

    abstract protected function execute();
}
