<?php
declare(strict_types=1);

namespace XinMo\RPC\BO\Search;

/**
 * @property-read $section_id
 * @property-read $class_ids
 * @property-read $subclass_ids
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
        array $class_ids = null,
        array $subclass_ids = null,

        $keyword,

        $free = null,
        $book_status = null,
        $words = null,
        $update = null,
        $order = null,

        $offset = null,
        $limit = null,
    ) {
        $this->section_id   = $section_id;
        $this->class_ids    = $class_ids;
        $this->subclass_ids = $subclass_ids;
        $this->keyword      = $keyword;
        $this->free         = $free;
        $this->book_status  = $book_status;
        $this->words        = $words;
        $this->update       = $update;
        $this->order        = $order;
        $this->offset       = $offset ? $offset : 0;
        $this->limit        = $limit ? $limit : 10;

        //如果搜索的是免费的，那么默认一些搜索条件  15天内的，按字数desc
        if ($this->free && $this->free == 1) {
            if ($this->section_id == 2) {
                $this->words = 5;//大于30万字
            } else {
                $this->update = 3;//15日内更新
            }
            $this->order = 7;
        }
    }
}
