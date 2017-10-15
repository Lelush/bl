<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 7/6/15
 * Time: 2:54 PM
 */

namespace frontend\widgets;


use yii\bootstrap\ActiveForm;

/**
 *
 * @method AdminField field($model, $field, $options = array())
 *
 * Class UiForm
 * @package frontend\widgets
 */
class AdminForm extends ActiveForm
{

    public $fieldClass = 'frontend\widgets\AdminField';
    public $errorCssClass = 'has-error state-error';
    public $successCssClass = 'has-success state-success';
    public $enableAjaxValidation = true;
    public $validateOnChange = false;
    public $validateOnBlur = false;

}