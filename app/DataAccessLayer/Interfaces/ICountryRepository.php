<?php

namespace App\DataAccessLayer\Interfaces;

use App\CommonLib\CustomUtils\PCollection;
use App\Country;
use Illuminate\Database\Eloquent\Builder;

interface ICountryRepository
{
    function list(?Builder $builder, ?int $pageNumber, ?int $pageSize, ?string $sortBy, bool $isDesc = false) : ?PCollection;

    function get(int $itemId) : ?Country;

    function add(Country $item) : int;

    function update(Country $item) : bool;

    function delete(int $itemId) : bool;
}