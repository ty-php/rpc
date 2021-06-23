<?php

namespace XinMo\RPC;

interface IRPCService
{
    public function index($params);

    public function insert($params);

    public function view();

    public function update($params);

    public function drop();

    public function delete();
}
