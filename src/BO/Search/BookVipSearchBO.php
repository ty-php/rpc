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
        array $class_id = null,
        array $subclass_id = null,
        $keyword,
        $free = null,
        $book_status = null,
        $words = null,
        $update = null,
        $order = null,
        $offset = null,
        $limit = null,

        $is_vip_book = null
    ) {
        parent::__construct(
            $section_id, $class_id, $subclass_id,
            $keyword,
            $free, $book_status, $words, $update, $order,
            $offset, $limit
        );
        $this->is_vip_book = $is_vip_book;
    }
}
