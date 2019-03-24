<?php

namespace App\CommonLib\CustomUtils;

use Illuminate\Database\Eloquent\Collection;

class PCollection
{
    public $List;
    public $Paging;

    public function __construct()
    {
        $this->List = new Collection();
        $this->Paging = new Paging();
    }

    public function setPaging(int $pageNumber, int $pageSize, int $totalCount) {
        $this->Paging = new Paging();
        $this->Paging->setPageNumber($pageNumber);
        $this->Paging->setPageSize($pageSize);
        $this->Paging->setTotalCount($totalCount);
    }
}