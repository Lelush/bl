<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\components;

use Yii;
use yii\bootstrap\BootstrapPluginAsset;
use yii\bootstrap\Html;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;

class CLeftNavBar extends Widget
{

    /**
     * @var array the HTML attributes for the widget container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "nav", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];


    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = false;
        if (empty($this->options['class'])) {
            Html::addCssClass($this->options, ['nano', 'nano-primary', 'affix', 'has-scrollbar']);
        } else {
            Html::addCssClass($this->options, ['widget' => 'nano']);
        }
        $this->options['id'] = 'sidebar_left';
        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'aside');
        echo Html::beginTag($tag, $options);

        echo Html::beginTag('div', ['class' => 'sidebar-left-content nano-content', 'tabindex'=>0]);

    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo Html::tag('div', Html::a('<span class="fa fa-sign-out"></span>', '#'),['class' => 'sidebar-toggle-mini']);
        echo Html::endTag('div');
        $tag = ArrayHelper::remove($this->options, 'tag', 'aside');
        echo Html::endTag($tag);
//        BootstrapPluginAsset::register($this->getView());
    }
}
