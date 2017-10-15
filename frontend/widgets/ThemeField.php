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

class ThemeField extends ActiveField
{

    public $options = ['class' => 'form-group'];

    public $labelOptions = ['encode' => false, 'class' => 'field-label mb10'];

    public $template = "{label}\n{icon}\n{input}\n{hint}\n{error}";

    public $inputOptions = ['class' => 'gui-input'];

    public $errorOptions = ['class' => 'error help-block'];

    public $iconOptions = ['class'=> 'append-icon right'];

    public $originConfig;

    /**
     * @inheritdoc
     */
    public function __construct($config = [])
    {
        $this->originConfig = $config;
        parent::__construct($config);
    }

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
        if (!empty($options)) {
            $options = array_merge($this->iconOptions, $options);
            $name = ArrayHelper::getValue($options,'name', 'fa fa-pencil-square-o');
            $this->parts['{icon}'] = Html::tag('span', '<i class="'.$name.'"></i>',$options);
            return $this;
        }
        $this->parts['{icon}'] = '';
        return $this;
    }

    public function textPre($options = [])
    {
        $this->template = "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}";
        $this->adjustLabelFor($options);
        $value = ArrayHelper::getValue($options,'value','N/A');
        unset($options['value']);
        $this->parts['{input}'] = Html::tag('pre', $value, $options);
        return $this;
    }

    public function textInput($options = [])
    {
        $this->template = "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}";

        if(!ArrayHelper::keyExists('placeholder',$options)){
            $options['placeholder'] = $this->model->getAttributeLabel(Html::getAttributeName($this->attribute));
        }
        return parent::textInput($options);
    }

    public function append($content)
    {
        if(strpos($this->template, 'input-group') !== false){
            $this->template = str_replace('{input}',"{input}\n<span class=\"input-group-addon\">$content</span>\n",$this->template);//"{label}\n{beginWrapper}\n\n{error}\n{endWrapper}\n{hint}";
        } else {
            $this->template = str_replace('{input}',"<div class=\"input-group\">\n{input}\n<span class=\"input-group-addon\">$content</span>\n</div>\n",$this->template);//"{label}\n{beginWrapper}\n<div class=\"input-group\">\n{error}\n{endWrapper}\n{hint}";
        }
        return $this;
    }
    public function appendButton($content)
    {
        if(strpos($this->template, 'input-group') !== false){
            $this->template = str_replace('{input}', "{input}\n<span class=\"input-group-btn\">$content</span>\n", $this->template);//"{label}\n{beginWrapper}\n<div class=\"input-group\">\n{error}\n{endWrapper}\n{hint}";
        } else {
            $this->template = str_replace('{input}', "<div class=\"input-group\">\n{input}\n<span class=\"input-group-btn\">$content</span>\n</div>\n", $this->template);//"{label}\n{beginWrapper}\n<div class=\"input-group\">\n{error}\n{endWrapper}\n{hint}";
        }
        return $this;
    }

    public function prepend($content)
    {
        $this->template = "{label}\n{beginWrapper}\n<div class=\"input-group\">\n<span class=\"input-group-addon\">$content</span>\n{input}\n</div>\n{error}\n{endWrapper}\n{hint}";
        return $this;
    }

    public function switchBox($options = [])
    {

        if(array_search('id',$options) === false){
            $options['id'] = $this->getInputId();
        }
        $this->labelOptions = ArrayHelper::merge($this->labelOptions, [
            'label' => $this->model->getAttributeLabel(Html::getAttributeName($this->attribute)),
        ]);
        Html::addCssClass($this->wrapperOptions, ['widget'=> 'switch', 'pull-left']);
        Html::addCssClass($this->labelOptions, ['ml15']);
        $this->template = Html::tag('div','{input}'.Html::label('',$options['id']).'{hint}{error}',$this->wrapperOptions)."{label}<div class=\"clearfix\"></div>";
        return parent::checkbox($options, false);

    }

    public function planeControl($options = [])
    {
        if(array_search('id',$options) === false){
            $options['id'] = $this->getInputId();
        }
        $label = $this->model->getAttributeLabel(Html::getAttributeName($this->attribute));
        $content = $label.':&nbsp;'.$this->model->{Html::getAttributeName($this->attribute)};
        Html::addCssClass($options, ['widget' => 'mr15']);
        return Html::tag('span', $content, $options);
    }

    public function switchRadio($options = [])
    {
        if(array_search('id',$options) === false){
            $options['id'] = $this->getInputId();
        }
        $this->labelOptions = [
            'label' => $this->model->getAttributeLabel(Html::getAttributeName($this->attribute)),
        ];
        Html::addCssClass($this->wrapperOptions, ['widget'=> 'switch switch-lg']);
        $this->template = Html::tag('div','{input}'.Html::label('',$options['id'],array_merge(['data-on'=>'Вкл','data-off'=>'Выкл'], $this->labelOptions)).'{hint}{error}',$this->wrapperOptions);
        return parent::radio($options, false);
    }

    public function radioList($items, $options = [])
    {
        $this->adjustLabelFor($options);
        $type = ArrayHelper::getValue($options, 'type');
        $disabled = ArrayHelper::getValue($options, 'disabled');
        $options['item'] = function($index, $label, $name, $checked, $value) use($type, $disabled) {
            if(!empty($disabled) && array_search($value, $disabled) !== false){
                Html::addCssClass($this->labelOptions, ['text-muted']);
                $this->inputOptions['disabled'] = true;
                Html::addCssClass($this->wrapperOptions,['radio-disabled']);
            }
            if($type){
                Html::addCssClass($this->wrapperOptions,[$type]);
            }
            $this->inputOptions;
            $id = $this->getInputId();
            $this->inputOptions['id'] = $id.'-'.$index;
            $label = Html::label($label, $id.'-'.$index, $this->labelOptions);
            $this->inputOptions = array_merge($this->inputOptions, ['value' => $value]);
            $input = Html::radio($name, $checked, $this->inputOptions);
            Html::addCssClass($this->wrapperOptions,['widget'=>'radio-custom']);
            return Html::tag('div', $input.$label,$this->wrapperOptions);
        };
        $this->parts['{input}'] = Html::activeRadioList($this->model, $this->attribute, $items, $options).'<div class="clearfix"></div>';
        $this->parts['{icon}'] = '';
        return $this;
    }

    public function checkboxList($items, $options = [])
    {
        $this->parts['{icon}'] = '';
        $type = ArrayHelper::getValue($options, 'type');
        $disabled = ArrayHelper::getValue($options, 'disabled');
        $options['item'] = function($index, $label, $name, $checked, $value) use($type, $disabled){
            if(!empty($disabled) && array_search($value, $disabled) !== false){
                Html::addCssClass($this->labelOptions, ['text-muted']);
                $this->inputOptions['disabled'] = true;
                Html::addCssClass($this->wrapperOptions,['checkbox-disabled']);
            }
            if($type){
                Html::addCssClass($this->wrapperOptions,[$type]);
            }
            $this->inputOptions;
            $id = $this->getInputId();
            $this->inputOptions['id'] = $id.'-'.$index;
            $label = Html::label($label, $id.'-'.$index, $this->labelOptions);
            $this->inputOptions = array_merge($this->inputOptions, ['value' => $value]);
            $input = Html::checkbox($name, $checked, $this->inputOptions);
            Html::addCssClass($this->wrapperOptions,['widget'=>'checkbox-custom']);
            return Html::tag('div', $input.$label,$this->wrapperOptions);
        };
        $this->parts['{input}'] = Html::activeCheckboxList($this->model, $this->attribute, $items, $options);
        $this->parts['{icon}'] = '';

        return $this;
    }

    protected function getTaskListInput(&$activeField, $model, $attribute, $items, $options = [])
    {
        $type = ArrayHelper::getValue($options, 'type');
        $name = isset($options['name']) ? $options['name'] : Html::getInputName($model, $attribute);
        $selection = Html::getAttributeValue($model, $attribute);
        if (!array_key_exists('unselect', $options)) {
            $options['unselect'] = '';
        }
        if (!array_key_exists('id', $options)) {
            $options['id'] = Html::getInputId($model, $attribute);
        }


        if (substr($name, -2) !== '[]' && count($items) > 1) {
            $name .= '[]';
        }

        $formatter = ArrayHelper::remove($options, 'item');
//            $itemOptions = ArrayHelper::remove($options, 'itemOptions', []);
//            $encode = ArrayHelper::remove($options, 'encode', true);
        $separator = ArrayHelper::remove($options, 'separator', "\n");
        $tag = ArrayHelper::remove($options, 'tag', 'ul');

        $lines = [];
        $index = 0;
        foreach ($items as $value => $label) {
            $checked = $selection !== null &&
                (!ArrayHelper::isTraversable($selection) && !strcmp($value, $selection)
                    || ArrayHelper::isTraversable($selection) && ArrayHelper::isIn($value, $selection));
            if ($formatter !== null) {
                $lines[] = call_user_func($formatter, $index, $label, $name, $checked, $value);
            } else {
                $liOptions = [];
                Html::addCssClass($liOptions,['task-item']);

                $handleOptions = [];
                Html::addCssClass($handleOptions,['task-handle']);

                $descOptions = [];
                Html::addCssClass($descOptions,['task-desc']);

                if($type){
                    Html::addCssClass($liOptions,[$type]);
                }
                $id = Html::getInputId($model, $attribute);
                $activeField->inputOptions['id'] = $id.'-'.$index;
                $helper = Html::label('', $activeField->inputOptions['id'], $activeField->labelOptions);
                $activeField->inputOptions = array_merge($activeField->inputOptions, ['value' => $value]);
                $input = Html::checkbox($name, $checked, $activeField->inputOptions);
                Html::addCssClass($activeField->wrapperOptions,['widget'=>'checkbox-custom']);
                $handle = Html::tag('div',Html::tag('div', $input.$helper,$activeField->wrapperOptions),$handleOptions);
                $desc = Html::tag('div',$label,$descOptions);
                $li = Html::tag('li',$handle.$desc,$liOptions);

                $lines[] = $li;
            }
            $index++;
        }

        if (isset($options['unselect'])) {
            // add a hidden field so that if the list box has no option being selected, it still submits a value
            $name2 = substr($name, -2) === '[]' ? substr($name, 0, -2) : $name;
            $hidden = Html::hiddenInput($name2, $options['unselect']);
            unset($options['unselect']);
        } else {
            $hidden = '';
        }

        $visibleContent = implode($separator, $lines);

        if ($tag === false) {
            return $hidden . $visibleContent;
        }
        Html::addCssClass($options,['widget'=>'task-list']);
        return $hidden . Html::tag($tag, $visibleContent, $options);
    }

    public function taskList($items, $options = [])
    {
        $this->template = "{label}\n{input}";
        $this->parts['{icon}'] = '';
        Html::addCssClass($this->options, ['mn']);

        $this->parts['{input}'] = $this->getTaskListInput($this, $this->model, $this->attribute, $items, $options);
        $this->parts['{icon}'] = '';

        return $this;
    }

    public function checkbox($options = [], $enclosedByLabel = true)
    {
        $options = array_merge($this->inputOptions, $options);
        $type = ArrayHelper::getValue($options, 'type');
        Html::addCssClass($this->wrapperOptions, ['widget'=>'checkbox-custom', $type]);
        if(ArrayHelper::keyExists('disabled', $options) && $options['disabled'] == true ){
            Html::addCssClass($this->wrapperOptions,['checkbox-disabled', 'fill']);
        }
        $this->horizontalCheckboxTemplate = "{beginWrapper}\n{input}\n{beginLabel}\n{labelTitle}\n{endLabel}\n{error}\n{endWrapper}\n{hint}";
        $this->checkboxTemplate = "{beginWrapper}\n{input}\n{beginLabel}\n{labelTitle}\n{endLabel}\n{error}\n{endWrapper}\n{hint}";
        return parent::checkbox($options);
    }

    public function inlineTemplate()
    {
        $config['form'] = $this->form;
        $config['form']->layout = 'inline';
        $config = $this->createLayoutConfig($config);
        \Yii::configure($this, $config);
        return $this;
    }
    public function horizontalTemplate($options = [])
    {
        $config['form'] = clone $this->form;
        $config['form']->layout = 'horizontal';
        $config = ArrayHelper::merge($config, $options);
        $config = $this->createLayoutConfig($config);
        \Yii::configure($this, $config);
        Html::addCssClass($this->labelOptions, ['mt10']);
        return $this;
    }

    public function staticControl($options = [])
    {
        Html::removeCssClass($this->labelOptions,['mt10']);
        $this->template ="{label}\n{icon}\n{input}\n{hint}";
        return parent::staticControl($options);
    }
}