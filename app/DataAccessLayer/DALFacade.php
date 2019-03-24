<?php

namespace App\DataAccessLayer;

use App\DataAccessLayer\Interfaces\IContinentRepository;
use App\DataAccessLayer\Interfaces\ICountryRepository;
use App\DataAccessLayer\Repositories\ContinentRepository;
use App\DataAccessLayer\Repositories\CountryRepository;

class DALFacade
{
    public static function ContinentRepository() : IContinentRepository
    {
        return new ContinentRepository();
    }

    public static function CountryRepository() : ICountryRepository
    {
        return new CountryRepository();
    }

}