<?php

namespace XinMo\RPC;

/**
 * Interface IRPCService
 * rpc服务实现此接口
 */
interface IRPCService
{
    public function index($params);

    public function insert($params);

    public function view();

    public function update($params);

    public function drop();

    public function delete();
}
