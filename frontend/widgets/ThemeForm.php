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
 * @method ThemeField field($model, $field, $options = array())
 *
 * Class UiForm
 * @package frontend\widgets
 */
class ThemeForm extends ActiveForm
{

    public $fieldClass = 'frontend\widgets\ThemeField';
    public $errorCssClass = 'has-error state-error';
    public $successCssClass = 'has-success state-success';
    public $enableAjaxValidation = true;
    public $validateOnChange = false;
    public $validateOnBlur = true;

}