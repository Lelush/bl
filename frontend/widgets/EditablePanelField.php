<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 7/6/15
 * Time: 2:54 PM
 */

namespace frontend\widgets;


use yii\helpers\ArrayHelper;

class EditablePanelField extends ThemeField
{
    public $emptyValue = 'Не задано';
    public $canShowStatic = true;
    public $showInput = true;
    public function getWrapper($options = [], $template = '')
    {
        $tmp = clone $this;
        $staticOptions = ArrayHelper::remove($options, 'staticControlOptions', []);
        if(!ArrayHelper::keyExists('value', $staticOptions) && empty($this->model->{$this->attribute})){
            $staticOptions['value'] = $this->emptyValue;
        }
        if(!empty($this->model->{$this->attribute}) && is_array($this->model->{$this->attribute})){
            $staticOptions['value'] = join(', ', $this->model->{$this->attribute});
        }
        $template = $template?:$this->template;
        $content = '<div class="editable-box">
                    <div class="editable-static not_required">'
                        .($this->canShowStatic ? $tmp->staticControl($staticOptions):'')
                        .
                    '</div>'.($this->showInput ? '<div class="editable-form">
                        '.$template.'
                    </div>' : '').'</div>';
        unset($tmp);
        return $content;
    }

    public function dropDownList($items, $options = [], $wrapper = true)
    {
        $dropDownList = parent::dropDownList($items, $options);
        if($wrapper)
        $this->template = $this->getWrapper($options, $this->template);
        return $dropDownList;
    }

    public function textInput($options = [], $wrapper = true)
    {
        $input = parent::textInput($options);
        if($wrapper)
        $this->template = $this->getWrapper($options, $this->template);
        return $input;
    }

    public function switchBox($options = [], $wrapper = true)
    {
        $switchBox = parent::switchBox($options);
        if($wrapper)
        $this->template = $this->getWrapper($options, $this->template);
        return $switchBox;

    }

    public function switchRadio($options = [], $wrapper = true)
    {
        $switchRadio = parent::switchRadio($options);
        if($wrapper)
        $this->template = $this->getWrapper($options, $this->template);
        return $switchRadio;
    }

    public function radioList($items, $options = [], $wrapper = true)
    {
        $radioList = parent::radioList($items, $options);
        if($wrapper)
        $this->template = $this->getWrapper($options, $this->template);
        return $radioList;
    }

    public function checkboxList($items, $options = [], $wrapper = true)
    {
        $radioList = parent::checkboxList($items, $options);
        if($wrapper)
            $this->template = $this->getWrapper($options, $this->template);
        return $radioList;
    }

    public function checkbox($options = [], $enclosedByLabel = true, $wrapper = true)
    {
        $checkbox = parent::checkbox($options = [], $enclosedByLabel = true);
        if($wrapper)
        $this->template = $this->getWrapper($options, $this->template);
        return $checkbox;
    }

    public function widget($class, $config = [], $wrapper = true)
    {
        $widget = parent::widget($class, $config);
        if($wrapper)
        $this->template = $this->getWrapper();
        return $widget;
    }
}