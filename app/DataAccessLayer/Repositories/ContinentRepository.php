<?php

namespace App\DataAccessLayer\Repositories;


use App\CommonLib\AppSettings\Constants;
use App\CommonLib\AppSettings\enStatus;
use App\CommonLib\CustomUtils\PCollection;
use App\Continent;
use App\DataAccessLayer\Interfaces\IContinentRepository;
use Illuminate\Database\Eloquent\Builder;

class ContinentRepository implements IContinentRepository
{

    public function list(?Builder $builder, ?int $pageNumber, ?int $pageSize, ?string $sortBy, bool $isDesc = false): ?PCollection
    {
        try {

            $lst = $builder != null ? $builder->get() : Continent::all();
            $lstToReturn = new PCollection();
            $totalCount = count($lst);

            if ($sortBy != null) {
                $lst = $lst->sortBy($sortBy, SORT_REGULAR, $isDesc);
            }

            if ($pageNumber != null && $pageSize != null) {
                $lst = $lst->forPage($pageNumber, $pageSize);
                $lstToReturn->setPaging($pageNumber, $pageSize, $totalCount);
            }

            $lstToReturn->List = $lst;
            return $lstToReturn;
        }
        catch (\Exception $exception) {
            logger($exception->getTraceAsString());
            return null;
        }
    }

    public function get(int $itemId): ?Continent
    {
        try {
            $builder = Continent::query();
            $builder->where(Continent::$PRIMARY_KEY, '=', $itemId);

            $lst = $this->list($builder, 0, 1, null);

            return $lst != null ? $lst->List->first() : null;
        }
        catch (\Exception $exception) {
            logger($exception->getTraceAsString());
            return null;
        }
    }

    public function add(Continent $item): int
    {
        try {
            $item->status = enStatus::ACTIVE;
            $item->added_date = date(Constants::DATETIME_FORMAT);
            $item->updated_date = date(Constants::DATETIME_FORMAT);

            if ($item->save()) {
                return $item->continent_id;
            }
        }
        catch (\Exception $exception) {
            logger($exception->getTraceAsString());
        }
        return 0;
    }

    public function update(Continent $item): bool
    {
        try {
            $itemToUpdate = self::get($item->continent_id);

            if ($itemToUpdate != null) {
                $itemToUpdate->name = $item->name;

                $itemToUpdate->status = $item->status;
                $itemToUpdate->updated_date = date(Constants::DATETIME_FORMAT);

                return $itemToUpdate->save();
            }
        }
        catch (\Exception $exception) {
            logger($exception->getTraceAsString());
        }
        return false;
    }

    public function delete(int $itemId): bool
    {
        try {
            $itemToDelete = self::get($itemId);

            if ($itemToDelete != null) {

                $itemToDelete->status = enStatus::DELETED;
                $itemToDelete->updated_date = date(Constants::DATETIME_FORMAT);

                return $itemToDelete->save();
            }
        }
        catch (\Exception $exception) {
            logger($exception->getTraceAsString());
        }
        return false;
    }
}