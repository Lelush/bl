<?php


namespace frontend\widgets;

use common\widgets\Alert;

class PjaxAlert extends Alert
{
    public $alertTypes = [
        'pjax-error'   => 'alert-danger',
        'pjax-danger'  => 'alert-danger',
        'pjax-success' => 'alert-success',
        'pjax-info'    => 'alert-info',
        'pjax-warning' => 'alert-warning'
    ];
}
