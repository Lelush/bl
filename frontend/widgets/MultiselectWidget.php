<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 7/6/15
 * Time: 2:54 PM
 */

namespace frontend\widgets;


use yii\base\InvalidConfigException;
use yii\bootstrap\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class MultiselectWidget extends InputWidget
{
    /**
     * @var array data for generating the list options (value=>display)
     */
    public $data = [];
    /**
     * @var array the options for the Bootstrap Multiselect JS plugin.
     * Please refer to the Bootstrap Multiselect plugin Web page for possible options.
     * @see http://davidstutz.github.io/bootstrap-multiselect/#options
     */
    public $clientOptions = [];
    /**
     * Initializes the widget.
     */
    public function init()
    {
        if (empty($this->data)) {
            throw new  InvalidConfigException('"Multiselect::$data" attribute cannot be blank or an empty array.');
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->clientOptions['buttonContainer'] = '<div class="pos-r"></div>';
        $this->clientOptions['buttonClass'] = 'form-control text-left';

        if (isset($this->options['prompt'])) {
            $this->clientOptions['nonSelectedText'] = $this->options['prompt'];
            unset($this->options['prompt']);
        }
//        Html::addCssClass(, );
        if ($this->hasModel()) {
            echo Html::activeDropDownList($this->model, $this->attribute, $this->data, $this->options);
        } else {
            echo Html::dropDownList($this->name, $this->value, $this->data, $this->options);
        }
        $this->registerPlugin();
    }
    /**
     * Registers MultiSelect Bootstrap plugin and the related events
     */
    protected function registerPlugin()
    {
        $view = $this->getView();
//        MultiSelectAsset::register($view);
        $id = $this->options['id'];
        $options = $this->clientOptions !== false && !empty($this->clientOptions)
            ? Json::encode($this->clientOptions)
            : '';
        $js = "jQuery('#$id').multiselect($options);";
        $view->registerJs($js);
    }

}