<?php
declare(strict_types=1);

namespace XinMo\RPC\BO\Search;

/**
 * @property-read $section_id
 *
 * @property-read $keyword

 * @property-read $order
 *
 * @property-read $offset
 * @property-read $limit
 */
class BookFieldSearchBO
{
    public function __construct(
        $section_id = null,

        $keyword,

        $order = null,

        $offset = null,
        $limit = null
    ) {
        $this->section_id   = $section_id;
        $this->keyword      = openccT2S($keyword);
        $this->order        = $order;
        $this->offset       = $offset ? $offset : 0;
        $this->limit        = $limit ? $limit : 10;

    }
}
