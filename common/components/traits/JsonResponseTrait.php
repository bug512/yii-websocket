<?php

namespace common\components\traits;

use common\components\enums\StatusResponseEnum;
use common\components\interfaces\IStatusResponse;

/**
 * Trait JsonResponseTrait
 * @package common\components\traits
 */
trait JsonResponseTrait
{
    /**
     * @var IStatusResponse $instance
     */
    private $instance;

    /**
     * @param $type
     */
    private function setStatus($type)
    {
        try {
            $this->instance = new $type();

            if (!($this->instance instanceof IStatusResponse)) {
                throw new \RuntimeException(Yii::t(null, 'The object does not match the interface.'));
            }
        } catch (\Throwable $error) {
            \Yii::log($error->getMessage());
        }
    }

    /**
     * @param $response
     * @param string $status
     */
    public function jsonResponse($response, $status = null)
    {
        if (!$status) {
            echo json_encode($response);
            \Yii::app()->end();
        }

        $this->setStatus($status);

        if ($this->instance) {
            echo json_encode(
                [
                    'status' => $this->instance->getStatus(),
                    'message' => $response
                ]
            );
            \Yii::app()->end();
        }
    }
}