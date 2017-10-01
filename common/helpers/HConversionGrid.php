<?php
/**
 * Created by PhpStorm.
 * User: greka
 * Date: 30.08.16
 * Time: 19:29
 */

namespace common\helpers;


use common\enums\ConversionState;
use common\enums\ConversionStatus;
use common\enums\OfferType;
use common\enums\Role;
use common\enums\TrashType;
use common\models\Conversion;
use common\models\TrashReason;
use frontend\models\ConversionFilter;
use Yii;
use yii\bootstrap\Html;
use yii\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class HConversionGrid
{

    public static function getIdColumn($role,$filter = null)
    {
        return [
            'attribute' => 'id',
            'format'=>'html',
            'value' => function (Conversion $model){
               return Html::a($model->id,$model->viewUrl);
            },
            'headerOptions' => [
                'class' => 'va-t',
            ],
        ];
    }

    public static function getOfferTypeColumn($role,$filter = null)
    {
        return [
            'attribute' => 'offer_type',
            'label'     => 'Система',
            'value'     => function ($model) {
                if($model->landing->offer){
                    return OfferType::getValue($model->landing->offer->type);
                }
                return null;
            },
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'offer_type',
            ],
            'filter'=>OfferType::getList(),
        ];
    }

    public static function getCreatedAtDateColumn($role,$filter = null)
    {
        return [
            'format' => 'raw',
            'attribute' => 'created_at',
            'label'=>'Дата',
            'value'=>function ($model){
                return HDates::short($model->created_at).' <br/>'.HDates::His($model->created_at);
            },
            'contentOptions' => [
                'class' =>'text-center'
            ],
            'headerOptions' => [
                'class' => 'va-t',
            ],
        ];
    }
    public static function getCreatedAtTimeColumn($role,$filter = null)
    {
        return [
            'attribute' => 'created_at',
            'label'=>'Время конверсии',
            'value'=>function ($model){
                return HDates::His($model->created_at);
            },
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'created_at',
            ],
        ];
    }

    public static function getOfferNameColumn($role,$filter = null)
    {
        return [
            'attribute' => 'offer_name',
            'label'     => 'Оффер',
            'format'    => 'html',
            'value'     => function ($model) use ($role, $filter) {
                if(!$model->landing->offer){
                    return false;
                }
                $link = '';
                if ($role == Role::ADMIN || $role == Role::MANAGER) {
                    $link = '&nbsp;'.Html::a(Html::tag('span','&nbsp;',['class' => 'glyphicon glyphicon-share']), $model->landing->offer->updateUrl);
                } else {
                    $link = '&nbsp;'.Html::a(Html::tag('span','&nbsp;',['class' => 'glyphicon glyphicon-share']), $model->landing->offer->viewUrl);
                }
                if ($filter) {
                    return Html::a($model->landing->offer->name, $filter->getFilterUrl(['offer_name' => $model->landing->offer->name])).$link;
                }
                else {
                    return $model->landing->offer->name;
                }
            },
            'headerOptions' => [
                'class' => 'va-t mw320',
            ],
            'contentOptions' => [
                'class' => 'mw320'
            ]
        ];
    }

    public static function getGoalNameColumn($role,$filter = null)
    {
        return [
            'attribute' => 'goal_name',
            'label'     => 'Цель',
            'value'     => function (ConversionFilter $model) {
                if($model->is_trash){
                    foreach ($model->trashReasons as $trashReason) {
                        if ($trashReason->code == TrashType::GOAL_INACTIVE) {
                            return ' N/A';
                        }
                    }
                }
                return $model->goal->name;
            },
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t mw240',
                'data-control-id' => 'goal_name',
            ],
            'contentOptions' => [
                'class' => 'mw240'
            ]
        ];
    }

    public static function getPartnerColumn($role,$filter = null)
    {
        return [
            'attribute' => 'partner',
            'label'     => 'Партнер',
            'format'    => 'html',
            'value'     => function ($model) use ($role, $filter) {
                if ($model->winClick && $model->winClick->partner && $model->winClick->partner->owner) {
                    $link = '';
                    if ($role == Role::ADMIN || $role == Role::MANAGER)
                    {
                        $link = '&nbsp;'.Html::a(Html::tag('span','&nbsp;',['class' => 'glyphicon glyphicon-share']), '/company/'.$model->winClick->partner->id);
                    }
                    if ($filter) {
                        return Html::a($model->winClick->partner->name, $filter->getFilterUrl(['partner' => $model->winClick->partner->name])).$link;
                    }
                    else {
                        return $model->winClick->partner->name;
                    }
                }

                return false;
            },
            'headerOptions' => [
                'class' => 'mw320 va-t',
            ],
            'contentOptions' => [
                'class' => 'mw320'
            ]
        ];
    }

    public static function getClickSubidColumn($role,$filter = null)
    {
        return [
             'attribute' => 'click_subid',
             'label'=>'Web-мастер',
            'format'    => 'html',
             'value'=>function($model) use ($role, $filter){
                 if($model->winClick){

                     if ($filter) {
                         return Html::a($model->winClick->subid, $filter->getFilterUrl(['click_subid' => $model->winClick->subid]));
                     }

                     return $model->winClick->subid;
                 }
             },
            'headerOptions' => [
                'class' => 'va-t mw100',
            ],
            'contentOptions' => [
                'class' => 'mw100'
            ]
        ];
    }
    public static function getClickIpColumn($role,$filter = null)
    {
        return [
             'attribute' => 'click_ip',
             'label'=>'IP',
             'value'=>function($model){
                 if($model->winClick){
                     return $model->winClick->ip;
                 }
             },
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'click_ip',
            ],
        ];
    }
    public static function getClickCityColumn($role,$filter = null)
    {
        return [
             'attribute' => 'click_sxgeo_city',
             'label'=> 'Город',
             'value'=> function($model){
                 if($model->winClick && $model->winClick->city){
                     return $model->winClick->city->name_ru;
                 }

                 return implode(', ', $model->getTrashCity());
             },
            'headerOptions' => [
                'class' => 'va-t mw100',
            ],
            'contentOptions' => [
                'class' => 'mw100'
            ]
        ];
    }
    public static function getStatusColumn($role,$filter = null)
    {
        return [
            'attribute' => 'status',
            'value'     => function ($model) {
                return ConversionStatus::getValue($model->status);
            },
            'filter'=>ConversionStatus::getList(),
            'headerOptions' => [
                'class' => 'mw240 va-t',
            ],
            'contentOptions' => [
                'class' => 'mw240'
            ]

        ];
    }
    public static function getStateColumn($role,$filter = null)
    {
        return [
            'format' => 'raw',
            'attribute' => 'state',
            'value'     => function ($model) {
                return Html::tag('span', $model->state, ['class' => 'label label-' . ConversionState::getColorClass($model->state)]);
            },
            'filter'=>ConversionState::getList(),
            'headerOptions' => [
                'class' => 'va-t',
            ],

        ];
    }
    public static function getCommentColumn($role,$filter = null) //TODO ЗАГЛУШКА
    {
        return [
            'format' => 'raw',
            'attribute' => 'comment',
            'label'     => 'Комментарий',
            'value'     => function (ConversionFilter $model) {
                if ($model->lastStatusHistory) {
                    $comment = '';
                    if($model->lastStatusHistory->comment && mb_strlen($model->lastStatusHistory->comment) > 10 && !Yii::$app->request->isPost){
                        $comment = Html::tag('span',mb_substr($model->lastStatusHistory->comment, 0, 10,"UTF-8").'...',['data'=>['toggle'=>'tooltip', 'placement'=>'top', 'title'=>$model->lastStatusHistory->comment]]);
                    } else {
                        $comment = Html::tag('span',$model->lastStatusHistory->comment);
                    }
                    return $comment;
                } else {
                    return '';
                }
            },
            'headerOptions' => [
                'class' => 'va-t',
            ],
        ];
    }
    public static function getFinalColumn($role,$filter = null)
    {
        return [
            'attribute' => 'final',
            'label'     => 'Финал',
            'value'     => function ($model) {
                return $model->isFinal ? 'Да' : 'Нет';
            },
            'headerOptions' => [
                'class' => 'va-t',
            ],
        ];
    }

    public static function getHistoryColumn($role,$filter = null) //TODO ЗАГЛУШКА
    {
        return [
            'attribute' => 'history',
            'label'     => 'История переходов',
            'format'    => 'raw',
            'value'     => function ($model) {
                return Html::button('История переходов',[
                    'class'=>'btn btn-primary',
                    'data'=>[
                        'target' => '#conversion',
                        'modal-ajax' => true,
                        'pjax' => 0,
                    ],
                    'value'=>\yii\helpers\Url::to([
                        '/conversions/ajax-history-modal',
                        'id' => $model->id,
                    ]),
                ]);
            },
            'headerOptions' => [
                'class' => 'va-t',
            ],
        ];
    }
    public static function getClickCreatedAtColumn($role,$filter = null)
    {
        return  [
            'attribute' => 'click_created_at',
            'label'     => 'Время <br/>клика',
            'encodeLabel'=>false,
            'format'    => 'html',
            'value'=>function ($model){
                return HDates::short($model->firstClick->created_at).' <br/>'.HDates::His($model->firstClick->created_at);
            },
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'click_created_at',
            ],
        ];
    }
    public static function getAdvertiserCompanyColumn($role,$filter = null)
    {
        return  [
            'attribute' => 'advertiser_company',
            'label'     => 'Рекламодатель',
            'format'    => 'html',
            'value'     => function ($model) {
                if ($model->advertiserCompany) {
                    if($model->advertiserCompany->owner){
                        return Html::a($model->advertiserCompany->name, $model->advertiserCompany->owner->viewUrl);
                    }
                }
                return false;
            },
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'advertiser_company',
            ],
        ];
    }
    public static function getTransactionIdColumn($role,$filter = null)
    {
        return  [
            'attribute' => 'transaction_id',
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'transaction_id',
            ],
        ];
    }
    public static function getLastStatusHistoryColumn($role,$filter = null)
    {
        return  [
            'attribute' => 'last_status_history',
            'label'     => 'Дата <br/>обновления <br/>статуса',
            'encodeLabel'=>false,
            'format'    => 'html',
            'value'     => function ($model) {
                if ($model->lastStatusHistory) {
                    return HDates::short($model->lastStatusHistory->created_at).' <br/>'.HDates::His($model->lastStatusHistory->created_at);
                }
                return null;
            },
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'last_status_history',
            ],
        ];
    }
    public static function getClickRefererColumn($role,$filter = null)
    {
        return  [
            'attribute' => 'click_referer',
            'label'     => 'Реффер',
            'value'     => 'winClick.referer',
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'click_referer',
            ],
        ];
    }
    
    // TODO  тут я не знаю как будет  для каждой конверсии свои поля наверное нужны...
    public static function getAdvancedECommerceAdvertiserOrderIdColumn($role,$filter = null)
    {
        return [
            'attribute' => 'ecommerce_advertiser_order_id',
            'label' => 'ID заказа',
            'value'     =>  'ecommerce.advertiser_order_id',
            'headerOptions' => [
                'class' => 'va-t',
            ],
        ];
    }
    public static function getAdvancedECommerceAmountColumn($role,$filter = null)
    {
        return [
            'attribute' => 'ecommerce_amount',
            'label'     => 'Сумма',
            'value'     => 'ecommerce.amount',
            'headerOptions' => [
                'class' => 'va-t',
            ],
        ];
    }
    public static function getAdvancedECommerceParamsColumn($role,$filter = null) //TODO :  пока кажем скопом. по ТЗ на каждый параметр Доп столбец
    {
        return [
            'label'     => 'Параметры',
            'value'     => 'ecommerce.params',
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'ecommerce_params',
            ],
        ];
    }
    public static function getClickSubid2Column($role,$filter = null)
    {
        return [
            'attribute' => 'click_subid2',
            'label'     => 'Subid2',
            'value'     => 'winClick.subid2',
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'click_subid2',
            ],
        ];
    }
    public static function getAntifraudScoreColumn($role,$filter = null)
    {
        return [
            'attribute' => 'antifraud_score',
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'antifraud_score',
            ],
        ];
    }
    public static function getButtonColumn($role,$filter = null)
    {
        return [
            'class'          => ActionColumn::className(),
            'template'       => '{final} {disconnect} {history}',
            'header'         => Html::a('<span class="fa fa-gear"></span> Управление', '#', [
                'class'       => 'grid-settings-button',
                'data-target' => '#grid-settings',
            ]),
            'headerOptions' => [
                'class' => 'va-t',
            ],
            'buttons'        => [
                'disconnect' => function ($url, $model) use ($role)  {
                    if ($model && $role==Role::ADMIN) {
                        return Html::a('<span class="fs16 mr5 text-danger glyphicon glyphicon-ban-circle"></span>', Url::to(), [
                            'title' => 'Заблокировать реферер',
                        ]);
                    }
                    return false;
                },
                'final'      => function ($url, $model) use($role) {
                    if (($role == Role::ADMIN || $role ==Role::MANAGER) && !$model->isFinal) {
                        return Html::a('<span class="fs16 mr5 text-success glyphicon glyphicon-ok"></span>', Url::to($url), [
                            'title' => 'финализировать',
                        ]);
                    } else {
                        return false;
                    }
                },
                'history'      => function ($url, $model) {
                    if ($model) {
                        return Html::a('<span class="fs16 mr5 text-primary glyphicon glyphicon-random"></span>',
                            Url::to([
                                '/conversions/ajax-history-modal',
                                'id' => $model->id,
                            ]),
                            [
                                'title' => 'История переходов',
                                'data'=>[
                                    'target' => '#conversion',
                                    'modal-ajax' => true,
                                    'pjax' => 0,
                                ]
                            ]
                        );
                    }
                    return false;
                },
            ],
            'contentOptions' => [
                'class' => 'centred',
            ],
        ];
    }
    public static function getCauseCutoffColumn($role,$filter = null){
        return [
            'attribute' => 'causeCutoff',
            'format'    => 'html',
            'label'     => 'Причина отсечки',
            'value'     => function ($model) {
                $result = [];
                /**@var TrashReason $trashReason */
                foreach ($model->trashReasons as $trashReason) {
                    $result[] = TrashType::getValue($trashReason->code);
                }
                return implode('<br>', $result);
            },
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'causeCutoff',
            ],
        ];
    }
    public static function getTypeCutoffColumn($role,$filter = null){ // TODO: заглушка Тип отсечки
        return [
            'attribute' => 'typeCutoff',
            'format'    => 'html',
            'label'     => 'Тип отсечки',
            'value'     => function ($model) {
                return implode(', ', array_values($model->getTrashReasonsList()));
            },
        ];
    }

    public static function getTrashButtonColumn($role,$filter = null){
        return [
            'class'          => ActionColumn::className(),
            'template'       => '{restore}',
            'header'         => Html::a('<span class="fa fa-gear"></span> Управление', '#', [
                'class'       => 'grid-settings-button',
                'data-target' => '#grid-settings',
            ]),
            'buttons'        => [
                'restore' => function ($url, $model) use ($role)  {
                    if($role == Role::ADMIN || $role == Role::MANAGER){
                        if(isset($model->trashReasons)){
                            if(ArrayHelper::isSubset(ArrayHelper::getColumn($model->trashReasons,'code'),TrashType::getCriticalType())){
                                return false;
                            }else{
                                return Html::a('<span class="fs16 mr5 glyphicon glyphicon-repeat"></span>', Url::to(), [
                                    'title' => 'Востановить',
                                ]);
                            }
                        }
                    }
                }
            ],
            'contentOptions' => [
                'class' => 'centred',
            ],
        ];
    }
    public static function getDurationConversionColumn($role, $filter = null){
        return [
            'attribute' => 'duration_conversion',
            'format'    => 'html',
            'label'     => 'Длительность <br/>конверсии',
            'encodeLabel'=>false,
            'value'     => function ($model) {
                $date = date_diff(
                    date_create($model->created_at),
                    date_create($model->firstClick->created_at)
                );
                return Yii::t(
                    'app',
                    '{n, plural, =0{} =1{# день} one{# день} few{# дня} many{# дней} other{# день}} ' . $date->format('%H:%I:%S') ,
                    ['n' => $date->d]
                ) ;
            },
            'headerOptions' => [
                'class' => 'grid-settings-def-hidden grid-settings-hide va-t',
                'data-control-id' => 'duration_conversion',
            ],
        ];
    }

    public static function getCheckboxColumn($role, $name = null, $filter = null)
    {
        return [
            'class' => 'yii\grid\CheckboxColumn',
            'name' => 'ConversionFilter[batch_conversion_ids]'
        ];
    }
}