<?php

namespace App;

/**
 * Class Continent
 * @package App
 *
 * @property int country_id
 * @property int continent_id
 * @property string name
 * @property int status
 * @property \DateTime added_date
 * @property \DateTime updated_date
 */
class Country extends BaseModel
{
    public function __construct()
    {
        parent::__construct(null, 'countries', 'country_id', 'int');
    }

    protected $fillable = [
        'name'
    ];

    public function Continent()
    {
        return $this->belongsTo(Continent::class);
    }

    public function Teams()
    {
        return $this->hasMany(Team::class);
    }
}