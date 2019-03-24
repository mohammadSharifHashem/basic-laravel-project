<?php

namespace App\DataAccessLayer\Repositories;


use App\CommonLib\AppSettings\Constants;
use App\CommonLib\AppSettings\enStatus;
use App\CommonLib\CustomUtils\PCollection;
use App\Country;
use App\DataAccessLayer\Interfaces\ICountryRepository;
use Illuminate\Database\Eloquent\Builder;

class CountryRepository implements ICountryRepository
{
    public function list(?Builder $builder, ?int $pageNumber, ?int $pageSize, ?string $sortBy, bool $isDesc = false): ?PCollection
    {
        try {
            $lst = $builder != null ? $builder->get() : Country::all();
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

    public function get(int $itemId): ?Country
    {
        try {
            $builder = Country::query();
            $builder->where(Country::$PRIMARY_KEY, '=', $itemId);

            $lst = self::list($builder, 0, 1, null);

            return $lst != null ? $lst->List->first() : null;
        }
        catch (\Exception $exception) {
            logger($exception->getTraceAsString());
            return null;
        }
    }

    public function add(Country $item): int
    {
        try {
            $item->status = enStatus::ACTIVE;
            $item->added_date = date(Constants::DATETIME_FORMAT);
            $item->updated_date = date(Constants::DATETIME_FORMAT);

            if ($item->save()) {
                return $item->country_id;
            }
        }
        catch (\Exception $exception) {
            logger($exception->getTraceAsString());
        }
        return 0;
    }

    public function update(Country $item): bool
    {
        try {
            $itemToUpdate = self::get($item->country_id);

            if ($itemToUpdate != null) {
                $itemToUpdate->continent_id = $item->continent_id;
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