<?php
namespace common\components\classes\StatusResponse;

use common\components\interfaces\IStatusResponse;
/**
 * Class ErrorStatus
 */
class ErrorStatus implements IStatusResponse
{
    const STATUS = 'error';

    /**
     * @return mixed|string
     */
    public function getStatus()
    {
        return self::STATUS;
    }
}