<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 7/6/15
 * Time: 2:54 PM
 */

namespace frontend\widgets;


use frontend\models\OfferFilter;
use Yii;
use yii\base\Widget;

class AjaxListWidget extends Widget
{
    /** @var  OfferFilter */
    public $filter;
    public $columns;
    public $rowOptions;
    public $gridOptions;
    public $pjaxOptions;
    public $beforeHtml = '';
    public $afterHtml = '';

    public function run()
    {
        return $this->render('pjaxList');
    }

}