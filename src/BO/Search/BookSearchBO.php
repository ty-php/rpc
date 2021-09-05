<?php
declare(strict_types=1);

namespace XinMo\RPC\BO\Search;

/**
 * 书籍搜索参数对象
 * @property-read $section_id
 * @property-read $class_ids
 * @property-read $subclass_id
 *
 * @property-read $keyword
 *
 * @property-read $free
 * @property-read $book_status
 * @property-read $words
 * @property-read $update
 * @property-read $order
 *
 * @property-read $offset
 * @property-read $limit
 */
class BookSearchBO
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
        $limit = null
    ) {
        $this->section_id   = $section_id;
        $this->class_id    = $class_id;
        $this->subclass_id = $subclass_id;
        $this->keyword      = $keyword?openccT2S($keyword):$keyword;//////qwl
        $this->free         = $free;
        $this->book_status  = $book_status;
        $this->words        = $words;
        $this->update       = $update;
        $this->order        = $order;
        $this->offset       = $offset ? $offset : 0;
        $this->limit        = $limit ? $limit : 10;

        if ($this->free == 1) {
            $this->words = 6;//大于1万字
            $this->order = 7;
        }
    }
}
