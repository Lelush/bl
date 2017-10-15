<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 7/6/15
 * Time: 2:54 PM
 */

namespace frontend\widgets;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;


/**
 *
 * @method EditablePanelField field($model, $field, $options = array())
 *
 * Class UiForm
 * @package frontend\widgets
 */
class EditablePanelForm extends ThemeForm
{

    public $fieldClass = 'frontend\widgets\EditablePanelField';

    public $panelOptions= [];
    public $panelTitle = '';
    public $showPanelEditButton = true;
    public $panelEditButton = '<div class="pull-right mr10"><span class="fa fa-pencil editable-toggle" aria-hidden="true"></span></div>';
    public $cancelButtonTitle = 'Отмена';
    public $cancelButtonOptions = [
        'class' => 'btn btn-default'
    ];
    public $okButtonTitle = 'Сохранить';
    public $okButtonOptions = [
        'class' => 'btn btn-primary'
    ];

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if($this->showPanelEditButton && ArrayHelper::keyExists('appendHeading', $this->panelOptions)){
            $this->panelOptions['appendHeading'] .= $this->panelEditButton;
        }elseif($this->showPanelEditButton){
            $this->panelOptions['appendHeading'] = $this->panelEditButton;
        }
        if(!ArrayHelper::keyExists('title', $this->panelOptions)){
            $this->panelOptions['title'] = $this->panelTitle;
        }
        Html::addCssClass($this->panelOptions['options'], ['editable-container']);

        PanelBlock::begin($this->panelOptions);

    }

    public function run()
    {

        Html::addCssClass($this->cancelButtonOptions, ['editable-toggle']);
        $this->showPanelEditButton && print '<div class="editable-box">
                <div class="editable-form">
                    <div class="form-group pull-right">'
                        .Html::button($this->cancelButtonTitle, $this->cancelButtonOptions)
                        .Html::submitButton($this->okButtonTitle, $this->okButtonOptions)
                        .
                    '</div>
                </div>
            </div>';
        PanelBlock::end();
        parent::run(); // TODO: Change the autogenerated stub
    }

}