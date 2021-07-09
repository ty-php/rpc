<?php

namespace XinMo\RPC\CacheControl;

use think\Model;

/**
 * 多米诺骨牌起点
 */
class CacheControlModel extends Model
{
    public function __construct($data = [])
    {
        $this->observerClass = '\XinMo\RPC\CacheControl\\' . $this->name;

        parent::__construct($data);
    }
}
