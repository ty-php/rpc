<?php

namespace TyPHP\RPC;

interface IRPCService
{
    public function index($params);

    public function insert($params);

    public function view($params);

    public function update($params);

    public function drop($params);

    public function delete($params);
}
