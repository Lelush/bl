<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 7/6/15
 * Time: 2:54 PM
 */

namespace frontend\widgets;


use yii\bootstrap\ActiveField;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class AdminField extends ActiveField
{

    public $options = ['class' => 'section'];

    public $labelOptions = ['encode' => false, 'class' => 'field-label text-muted fs18 mb10'];

    public $template = "{label}\n<label for=\"username\" class=\"field prepend-icon\">{input}\n{hint}\n</label>{error}";

    public $inputOptions = ['class' => 'gui-input'];

    public $errorOptions = ['class' => 'error help-block'];

    public $iconOptions = ['class'=> 'field-icon'];

    public function render($content=null)
    {
        if($content==null){
            if (!isset($this->parts['{icon}'])) {
                $this->icon();
            }
        }
        return parent::render($content);
    }

    public function icon($options = [])
    {
        if ($options === false) {
            $this->parts['{icon}'] = '';
            return $this;
        }
        $options = array_merge($this->iconOptions, $options);
        $name = ArrayHelper::getValue($options,'name', 'fa fa-pencil-square-o');
        $this->parts['{icon}'] = Html::label('<i class="'.$name.'"></i>', $this->attribute, $options);

        return $this;
    }
    public function passwordInput($options = [])
    {
        $this->template = "{label}\n<label for=\"username\" class=\"field prepend-icon\">{input}\n{hint}\n{icon}</label>{error}";
        Html::addCssClass($this->labelOptions, ['widget'=>'field-label text-muted fs18 mb10']);
        return parent::passwordInput($options);
    }

    public function textInput($options = [])
    {
        $this->template = "{label}\n<label for=\"username\" class=\"field prepend-icon\">{input}\n{hint}\n{icon}</label>{error}";
        return parent::textInput($options);
    }

    public function switchBoxRight($options = [], $enclosedByLabel = true)
    {
        $checkboxOptions = ArrayHelper::getValue($options, 'checkboxOptions');
        $switchOptions = ArrayHelper::getValue($options, 'switchOptions');
        $this->labelOptions = [
            'label' => $this->model->getAttributeLabel($this->attribute),
        ];
        Html::addCssClass($switchOptions, ['widget'=>'switch']);
        $this->template = Html::tag('label','{input}'.Html::label('',$this->attribute,['data-on'=>'Да','data-off'=>'Нет']).'<span>{label}</span>{hint}{error}',$switchOptions);
        $checkboxOptions['id'] = $this->attribute;
        return parent::checkbox($checkboxOptions, false);
    }

    public function switchRadio($options = [])
    {
        $radioOptions = ArrayHelper::getValue($options, 'radioOptions');
        $switchOptions = ArrayHelper::getValue($options, 'switchOptions');
        $this->labelOptions = [
            'label' => $this->model->getAttributeLabel($this->attribute),
        ];
        Html::addCssClass($switchOptions, ['widget'=>'switch switch-round']);
        $this->template = Html::tag('label','{input}'.Html::label('',$this->attribute,['data-on'=>'Вкл','data-off'=>'Выкл']).'<span>{label}</span>{hint}{error}',$switchOptions);
        $radioOptions['id'] = $this->attribute;
        return parent::radio($radioOptions, false);
    }

    public function radioList($items, $options = [])
    {
        $this->adjustLabelFor($options);
        $type = ArrayHelper::getValue($options, 'type');
        $disabled = ArrayHelper::getValue($options, 'disabled');
        $options['item'] = function($index, $label, $name, $checked, $value) use($type, $disabled) {
            $check = $checked ? ' checked="checked"' : '';
            $disable = !empty($disabled) && array_search($value, $disabled) !== false ? 'disabled' : '';
            return "<label class=\"option $type $index\"><input type=\"radio\" name=\"$name\" value=\"$value\" $check $disable> <span class=\"radio\"></span> $label</label>";
        };
        $this->parts['{input}'] = Html::activeRadioList($this->model, $this->attribute, $items, $options);
        $this->parts['{icon}'] = '';
        return $this;
    }

    public function dropDownList($items, $options = [])
    {
        $this->parts['{icon}'] = '';
        $this->template = "{label}\n<label for=\"username\" class=\"field select\">{input}\n{hint}\n<i class=\"arrow\"></i></label>{error}";
        return parent::dropDownList($items, $options);
    }

    public function checkboxList($items, $options = [])
    {
        $this->parts['{icon}'] = '';
        $type = ArrayHelper::getValue($options, 'type');
        $options['item'] = function($index, $label, $name, $checked, $value) use($type){
            $check = $checked ? ' checked="checked"' : '';
            return "<label class=\"option $type\"><input type=\"checkbox\" name=\"$name\" value=\"$value\" $check> <span class=\"checkbox\"></span> $label</label>";
        };
        $this->parts['{input}'] = Html::activeCheckboxList($this->model, $this->attribute, $items, $options);
        $this->parts['{icon}'] = '';
        return $this;
    }

    public function checkbox($options = [], $enclosedByLabel = true)
    {
        $type = ArrayHelper::getValue($options, 'type');
        $options['template'] = "<label class=\"option $type\">{input}<span class=\"checkbox\">\n{hint}\n</span><span class=\"text\">{labelTitle}</span></label>";
        return parent::checkbox($options);
    }
}