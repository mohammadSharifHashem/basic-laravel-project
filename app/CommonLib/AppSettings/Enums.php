<?php

namespace App\CommonLib\AppSettings;


use MyCLabs\Enum\Enum;

/**
 * Class enStatus (Status for database records)
 * @package TheGeekLink\TGLBase\appSettings
 */
class enStatus extends Enum
{
    const DELETED = 0;
    const ACTIVE = 1;
    const INACTIVE = 2;
    const PENDING = 3;
}