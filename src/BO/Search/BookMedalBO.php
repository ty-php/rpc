<?php
declare(strict_types=1);

namespace XinMo\RPC\BO\Search;

/**
 * 获取勋章书籍参数对象
 * @property-read $medal
 * @property-read $offset
 * @property-read $limit
 */
class BookMedalBO
{
    public function __construct(
        $medal,
        $offset = null,
        $limit = null
    ) {
        $this->medal  = $medal;
        $this->offset = $offset ? $offset : 0;
        $this->limit  = $limit ? $limit : 10;
    }
}
