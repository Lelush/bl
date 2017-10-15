<?php

namespace common\components;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class MultipleModel extends \yii\base\Model
{
    /**
     * @param string $modelClass
     * @param array $data
     * @param string $scenario
     * @return Model[]
     */
    public static function loadMultiple($modelClass, $data, $scenario = self::SCENARIO_DEFAULT)
    {
        /** @var Model $tmpModel */
        $tmpModel = new $modelClass;
        $tmpModel->formName();
        $models = [];
        foreach (ArrayHelper::getValue($data, $tmpModel->formName(), []) as $modelData) {
            $model = clone $tmpModel;
            $model->setScenario($scenario);
            $model->attributes = $modelData;
            $models[] = $model;
        }

        return $models;
    }

    /**
     * @param array $modelClass
     * @param array $data
     * @param string $scenario
     * @return bool
     */
    public static function loadNestedMultiple($modelClass, $data, $scenario = self::SCENARIO_DEFAULT)
    {
        /** @var Model $tmpModel */
        $tmpModel = new $modelClass;
        $tmpModel->formName();
        $models = [];

        foreach (ArrayHelper::getValue($data, $tmpModel->formName(), []) as $i => $nestedData) {

            foreach($nestedData as $modelData) {
                $model = clone $tmpModel;
                $model->setScenario($scenario);
                $model->attributes = $modelData;
                $models[$i][] = $model;
            }
        }


        return $models;
    }

    public static function loadOne($modelClass, $data, $scenario = self::SCENARIO_DEFAULT)
    {
        /** @var Model $model */
        $model = new $modelClass;
        $model->setScenario($scenario);
//        HDev::flash($data);
        $model->load($data);

        return $model;
    }

    public static function validateNestedForm($allModels, $attributes = null)
    {
        $result = [];
        foreach ($allModels as $i => $models) {
            /* @var $model Model */
            foreach ($models as $j => $model) {
                $model->validate($attributes);
                foreach ($model->getErrors() as $attribute => $errors) {
                    $result[Html::getInputId($model, "[$i][$j]" . $attribute)] = $errors;
                }
            }
        }

        return $result;
    }

    public static function validateNested($allModels, $attributes = null)
    {
        return !self::validateNestedForm($allModels, $attributes);
    }


}
