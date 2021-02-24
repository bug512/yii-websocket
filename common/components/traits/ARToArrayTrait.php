<?php

namespace common\components\traits;

/**
 * Trait ToArrayTrait
 * @package common\components\traits
 */
trait ARToArrayTrait
{
    /**
     * @param $models
     * @return array
     */
    public function toArrayFromAR($models)
    {
        return array_map(fn($model) => $model->attributes, $models);
    }
}