<?php

namespace App;

/**
 * Class Team
 * @package App
 *
 * @property int team_id
 * @property int country_id
 * @property string name
 * @property string short_code
 * @property bool is_national_team
 * @property int founded_year
 * @property int status
 * @property \DateTime added_date
 * @property \DateTime updated_date
 */
class Team extends BaseModel
{
    public function __construct()
    {
        parent::__construct(null, 'teams', 'team_id', 'int');
    }

    protected $fillable = [
        'name',
        'short_code',
        'is_national_team',
        'founded_year'
    ];

    public function Country()
    {
        return $this->belongsTo(Country::class);
    }
}