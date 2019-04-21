<?php

namespace Base\Utils\Pagination;

abstract class AbstractPagination
{
    protected const DEFAULT_LIMIT = 10;

    protected const DEFAULT_PAGE = 1;

    protected $limit = self::DEFAULT_LIMIT;

    protected $page = self::DEFAULT_PAGE;

    protected function getLimit(): int
    {
        return $this->limit;
    }

    abstract protected function setLimit(int $limit);

    protected function getPage(): int
    {
        return $this->page;
    }

    abstract protected function setPage(int $page): void;
}
