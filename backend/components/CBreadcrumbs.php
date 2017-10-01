<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\components;

use Yii;
use yii\bootstrap\Html;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

class CBreadcrumbs extends Widget
{

    public $links;
    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        $this->options['id'] ='topbar';
        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'header');
        echo Html::beginTag($tag, $options);
        echo Html::beginTag('div', ['class'=>'topbar-left']);
        echo Breadcrumbs::widget([
            'encodeLabels' => false,
            'tag' => 'ol',
            'links' => $this->links ?: [],
            'options' => [
                'class' => 'breadcrumb',
            ],
            'itemTemplate' => "<li class=\"crumb-link\">{link}</li>\n",
            'activeItemTemplate' => "<li class=\"crumb-active\">{link}</li>\n",
        ]);
        echo Html::endTag('div');
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo Html::beginTag('div', ['class'=>'topbar-right']);
        echo Html::beginTag('div', ['class'=>'ml15', 'id'=> 'toggle_sidemenu_r']);
        /**
         * @TODO Была просьба скрыть пока кнопку для правого доп. контента
         */
//        echo Html::a('<i class="fa fa-sign-in fs22 text-primary"></i>', '#');
        echo Html::endTag('div');
        echo Html::endTag('div');

        $tag = ArrayHelper::remove($this->options, 'tag', 'header');
        echo Html::endTag($tag);

    }
}
