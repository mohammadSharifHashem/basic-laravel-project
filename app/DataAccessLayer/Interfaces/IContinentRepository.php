<?php

namespace App\DataAccessLayer\Interfaces;


use App\CommonLib\CustomUtils\PCollection;
use App\Continent;
use Illuminate\Database\Eloquent\Builder;

interface IContinentRepository
{
    function list(?Builder $builder, ?int $pageNumber, ?int $pageSize, ?string $sortBy, bool $isDesc = false) : ?PCollection;

    function get(int $itemId) : ?Continent;

    function add(Continent $item) : int;

    function update(Continent $item) : bool;

    function delete(int $itemId) : bool;
}