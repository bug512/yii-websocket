<?php

namespace common\components\enums;

use common\components\classes\StatusResponse\SuccessStatus;
use common\components\classes\StatusResponse\ErrorStatus;

/**
 * Class StatusResponseEnum
 */
abstract class StatusResponseEnum
{
    const SUCCESS = SuccessStatus::class;
    const ERROR = ErrorStatus::class;
}