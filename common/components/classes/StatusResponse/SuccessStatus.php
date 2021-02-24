<?php

namespace common\components\classes\StatusResponse;

use common\components\interfaces\IStatusResponse;

/**
 * Class SuccessStatus
 */
class SuccessStatus implements IStatusResponse
{
    const STATUS = 'success';

    /**
     * @return mixed|string
     */
    public function getStatus()
    {
        return self::STATUS;
    }
}