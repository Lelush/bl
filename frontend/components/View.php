<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 4/21/15
 * Time: 4:02 PM
 */

namespace frontend\components;


use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class View extends \yii\web\View
{
    public $showTitle = true;

    public function renderAlert($text, $type = 'default', $class = '')
    {
        if ($text) {
            echo Html::tag('div', $text, ['class' => "alert alert-$type $class"]);
        }
    }

    public function renderHelp($text, $title = null)
    {
        if ($title) {
            $text = "<h4>$title</h4>\n".$text;
        }
        $text = '<i class="fa fa-info pr10"></i>'."\n".$text;
        $this->renderAlert($text, 'info', 'alert-micro alert-border-left');
    }

    public function registerGlobals($params)
    {
        $json = json_encode($params);
        $this->registerJs(<<<JS
            if(typeof YII == "undefined"){
                var YII = {};
            }
            (function(){
                "use strict";
                var data = $json;
                for(var x in data) {
                    if(data.hasOwnProperty(x)){
                        YII[x] = data[x];
                    }
                }
            })();

JS
            , View::POS_HEAD);
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return Yii::$app->user->getIdentity(false);
    }

    public function renderBlock($block)
    {
        return ArrayHelper::getValue($this->blocks, $block);
    }
}