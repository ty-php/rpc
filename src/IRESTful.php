<?php

namespace XinMo\RPC;

interface IRESTful
{
    public function request($uri, $method, $params);
}
