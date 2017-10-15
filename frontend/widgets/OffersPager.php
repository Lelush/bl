<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 7/6/15
 * Time: 2:54 PM
 */

namespace frontend\widgets;


use yii\helpers\Html;
use yii\widgets\LinkPager;

class OffersPager extends LinkPager
{

    public $linkOptions = ['class' => 'goto-page'];
    public $maxButtonCount = 5;

}