<?php

namespace App;

use App\CommonLib\AppSettings\Constants;
use App\CommonLib\AppSettings\enStatus;
use App\CommonLib\Scopes\ExcludeDeletedRowsScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BaseModel extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ExcludeDeletedRowsScope());
    }

    public static function activeQuery() : Builder
    {
        return self::query()->where(Constants::STATUS_COLUMN, '=', enStatus::ACTIVE);
    }

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'added_date';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updated_date';

    /**
     * The name of the "primary key".
     *
     * @var string
     */
    static $PRIMARY_KEY = 'id';

    /**
     * @param string $connection
     * @param string $table
     * @param string $primaryKey
     * @param string $keyType
     * @param bool $incrementing
     * @param bool $timestamps
     * @param array $attributes
     */
    public function __construct($connection, $table, $primaryKey, $keyType, $incrementing = true, $timestamps = false, array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection != null) {
            $this->connection = $connection;
        }

        if ($table != null) {
            $this->table = $table;
        }

        if ($primaryKey != null) {
            $this->primaryKey = self::$PRIMARY_KEY = $primaryKey;
        }

        if ($keyType != null) {
            $this->keyType = $keyType;
        }

        $this->incrementing = $incrementing;

        $this->timestamps = $timestamps;
    }
}