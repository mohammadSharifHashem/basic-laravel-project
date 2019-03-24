<?php

namespace App\CommonLib\CustomUtils;


class Paging
{

    public function __construct() { }

    private $PageNumber;
    private $PageSize;
    private $TotalCount;

    /**
     * @return int
     */
    public function getPageNumber(): int
    {
        return $this->PageNumber;
    }

    /**
     * @param int $PageNumber
     */
    public function setPageNumber(int $PageNumber): void
    {
        $this->PageNumber = $PageNumber;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->PageSize;
    }

    /**
     * @param int $PageSize
     */
    public function setPageSize(int $PageSize): void
    {
        $this->PageSize = $PageSize;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->TotalCount;
    }

    /**
     * @param int $TotalCount
     */
    public function setTotalCount(int $TotalCount): void
    {
        $this->TotalCount = $TotalCount;
    }
}