<?php
declare(strict_types=1);

namespace XinMo\RPC\BO\Search;

/**
 * @property-read $is_vip_book
 */
class BookVipSearchBO extends BookSearchBO
{
    public function __construct(
        $section_id = null,
        array $class_ids = null,
        array $subclass_ids = null,
        $keyword,
        $free = null,
        $book_status = null,
        $words = null,
        $update = null,
        $order = null,
        $offset = null,
        $limit = null
    ) {
        parent::__construct(
            $section_id, $class_ids, $subclass_ids,
            $keyword,
            $free, $book_status, $words, $update, $order,
            $offset, $limit
        );
        $this->is_vip_book = 1;
    }
}
