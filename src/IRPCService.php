<?php

namespace XinMo\RPC;

interface IRPCService
{
    public function index(array $params);

    public function insert(array $params);

    public function view($id);

    public function update($id);

    public function drop();

    public function delete($id);
}
