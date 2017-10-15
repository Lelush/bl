<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\bootstrap\Html;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

class PanelBlock extends Widget
{
    const PANEL_TYPE_ALERT = 'panel-alert';
    const PANEL_TYPE_SYSTEM = 'panel-system';
    const PANEL_TYPE_DANGER = 'panel-danger';
    const PANEL_TYPE_WARNING = 'panel-warning';
    const PANEL_TYPE_INFO = 'panel-info';
    const PANEL_TYPE_SUCCESS = 'panel-success';
    const PANEL_TYPE_PRIMARY = 'panel-primary';
    const PANEL_TYPE_DARK = 'panel-dark';
    const PANEL_TYPE_DEFAULT = 'panel-default';

    public $controls = [];
    public $title;
    public $type;
    public $collapse = false;
    public $appendHeading = '';
    public $prepandHeading = '';
    public $prepandTitle = '';
    public $collapseIn = true;
    public $content = '';
    public $footerContent = '';
    public $footerOptions = [];
    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        $titleOptions = ['class' => 'pull-left'];
        $headOptions = ArrayHelper::getValue($this->options, 'headOptions');
        unset($this->options['headOptions']);
        $bodyOptions = ArrayHelper::getValue($this->options, 'bodyOptions');
        unset($this->options['bodyOptions']);
        $linkOptions = ArrayHelper::getValue($this->options, 'linkOptions');
        unset($this->options['linkOptions']);
        $this->footerOptions = ArrayHelper::getValue($this->options, 'footerOptions')?:$this->footerOptions;
        unset($this->options['footerOptions']);
        $options = $this->options;

        if(array_search('color', $this->controls) === false) {
            $options['data-panel-color'] = 'true';
        }
        if(array_search('title', $this->controls) === false) {
            $options['data-panel-title'] = 'true';
        }
        if(array_search('collapse', $this->controls) === false) {
            $options['data-panel-collapse'] = 'true';
        }
        if(array_search('fullscreen', $this->controls) === false) {
            $options['data-panel-fullscreen'] = 'true';
        }
        if(array_search('remove', $this->controls) === false) {
            $options['data-panel-remove'] = 'true';
        }


        Html::addCssClass($options,['widget'=>'panel', 'panel-group']);
        Html::addCssClass($headOptions,['widget'=>'panel-heading']);
        Html::addCssClass($bodyOptions,['widget'=>'panel-body panel-collapse collapse', $this->collapseIn ? 'in' : 'out']);
        Html::addCssClass($linkOptions, ['pull-left', 'accordion-toggle', 'accordion-icon', 'link-unstyled', 'lh40']);
        if(!$this->collapseIn){
            Html::addCssClass($linkOptions,['collapsed']);
        }
        $linkOptions['data-toggle'] ='collapse';
        $linkOptions['data-parent'] ='#'.$this->getId();
        $linkOptions['aria-expanded'] ='false';
        if($this->type){
            Html::addCssClass($options,[$this->type]);
        }
        if( !isset($bodyOptions['id']) ){
            $bodyOptions['id'] = static::$autoIdPrefix.(static::$counter++);
        }
        if(!isset($bodyOptions['aria-expanded'])){
            $bodyOptions['aria-expanded'] = 'true';
        }

        echo Html::beginTag('div', $options);
        if(!empty($this->title) || !empty($this->prepandTitle) || !empty($this->prepandHeading) || !empty($this->prepandTitle) || !empty($this->appendHeading)) {
        echo Html::beginTag('div', $headOptions);
        echo $this->prepandHeading;
        if($this->collapse){
            echo Html::a('','#'.$bodyOptions['id'],$linkOptions);
            if(empty($this->prepandTitle)){
                Html::addCssClass($titleOptions, ['ml30']);
            }else{
                Html::addCssClass($titleOptions, ['ml10']);
            }
        }
        echo $this->prepandTitle;
        echo Html::beginTag('div',$titleOptions);
        echo Html::tag('span', $this->title,['class'=>'panel-title h4']);
        echo Html::endTag('div');
        echo $this->appendHeading;
        echo Html::endTag('div');
        }
        echo Html::beginTag('div', $bodyOptions);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo $this->content;
        echo Html::endTag('div');
        if($this->footerContent){
            Html::addCssClass($this->footerOptions, ['panel-footer']);
            echo Html::beginTag('div', $this->footerOptions);
            echo $this->footerContent;
            echo Html::endTag('div');
        }
        echo Html::endTag('div');
    }
}
