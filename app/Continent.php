<?php

namespace App;

/**
 * Class Continent
 * @package App
 *
 * @property int continent_id
 * @property string name
 * @property int status
 * @property \DateTime added_date
 * @property \DateTime updated_date
 */
class Continent extends BaseModel
{
    public function __construct()
    {
        parent::__construct(null, 'continents', 'continent_id', 'int');
    }

    protected $fillable = [
      'name'
    ];

    public function Countries()
    {
        return $this->hasMany(Country::class);
    }
}