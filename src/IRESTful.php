<?php

namespace TyPHP\RPC;

interface IRESTful
{
    public function request($uri, $method, $params);
}
