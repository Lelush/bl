<?php

namespace common\helpers;


use common\enums\Antifraud;
use common\enums\Currency;
use common\enums\Role;
use common\enums\StatisticDateGroups;
use common\enums\TrashType;
use common\models\Company;
use frontend\models\ConversionFilter;
use frontend\models\NewStatisticFilter;
use frontend\models\StatisticFilter;
use frontend\models\StatisticModel;
use Yii;
use yii\helpers\Html;

class HStatisticGrid
{
    const DATE = 'date';
    CONST HOUR = 'hour';
    CONST PARTNER = 'partner';
    CONST ADVERTISER = 'advertiser';
    CONST OFFER = 'offer';
    CONST GOAL = 'goal';
    CONST WEBMASTER = 'webmaster';
    CONST LANDING = 'landing';
    CONST COUNTRY = 'country';
    CONST CITY = 'city';
    CONST CLICK = 'click';
    CONST TRANSACTION = 'transaction';
    CONST TRASH_REASON = 'trash_reason';
    CONST FRAUD = 'antifraud_reason';
    CONST AVARAGE_SCORE_FRAUD = 'avarage_score_fraud';
    CONST AVARAGE_SCORE = 'avarage_score';
    CONST SOURCE = 'utm_source';

    const CONVERSION_FRAUD = 'conversion_fraud';
    const CONVERSION_WITHOUT_FRAUD = 'conversion_without_fraud';
    CONST CONVERSION = 'conversion';
    CONST TRASH = 'trash';
    CONST NOT_TRASH = 'not_trash';
    CONST APPROVED = 'approved';
    CONST REJECTED = 'rejected';
    CONST PENDING = 'pending';
    CONST WIDHOUT_PARTNER = 'without_partner';
    CONST AMOUNT = 'amount';
    //оборот
    CONST APPROVED_ADVERTISER_PAYMENT = 'approved_advertiser_payment';
    CONST PENDING_ADVERTISER_PAYMENT = 'pending_advertiser_payment';
    CONST REJECTED_ADVERTISER_PAYMENT = 'rejected_advertiser_payment';
    //выплаты
    CONST APPROVED_PARTNER_PAYMENT = 'approved_partner_payment';
    CONST PENDING_PARTNER_PAYMENT = 'pending_partner_payment';
    CONST REJECTED_PARTNER_PAYMENT = 'rejected_partner_payment';

    CONST APPROVED_PROFIT = 'approved_profit';
    CONST PENDING_PROFIT = 'pending_profit';
    CONST REJECTED_PROFIT = 'rejected_profit';

    CONST ADVERTISER_PAYMENT_TOTAL = 'advertiser_payment_total';
    CONST PARTNER_PAYMENT_TOTAL = 'partner_payment_total';

    CONST CR = 'cr';
    CONST AR = 'ar';
    CONST PR = 'pr';
    CONST RR = 'rr';
    CONST TR = 'tr';
    CONST FR = 'fr';

    public static function getColumn($type, $role, $filter)
    {
        $scenario = $filter->getScenario();
        $isAdmin = Yii::$app->user->can(Role::ADMIN);

        switch ($type) {
            case self::APPROVED_PROFIT:
            case self::PENDING_PROFIT:
            case self::REJECTED_PROFIT:
                $prefix = str_replace('_profit','', $type); //approved, peding, rejected
                return [
                    'attribute' => $type,
                    'format' => 'html',
                    'value' => function (StatisticModel $model) use ($role, $type, $prefix) {
                        switch ($role)
                        {
                            case Role::ADMIN:
                            case Role::MANAGER:
                                /**
                                 * @TODO валюта выводиться хардкодом
                                 */
                                return Html::tag('span',HNumbers::format($model->{$type}, 2, '.', ' ').' <span class="'.Currency::getValue(Currency::RUB, Currency::getFaList()).'"></span>');
                            case Role::ADVERTISER:
                            case Role::BROKER:
                                /**
                                 * @TODO валюта выводиться хардкодом
                                 */
                                return Html::tag('span',HNumbers::format($model->{$prefix.'_advertiser_payment'}, 2, '.', ' ').' <span class="'.Currency::getValue(Currency::RUB, Currency::getFaList()).'"></span>');
                            case Role::PARTNER:
                                /**
                                 * @TODO валюта выводиться хардкодом
                                 */
                                return Html::tag('span',HNumbers::format($model->{$prefix.'_partner_payment'}, 2, '.', ' ').' <span class="'.Currency::getValue(Currency::RUB, Currency::getFaList()).'"></span>');
                        }
                        return null;
                    },
                    'contentOptions' => function($model, $key, $index, $column){
                        $options = [];
                        if(isset($model->hide) && $model->hide){
                            Html::addCssClass($options,['bg-light darker']);
                        }
                        return $options;
                    },
                    'headerOptions' => [
                        'class' => 'va-t',
                    ]

                ];
            case self::CONVERSION:
            case self::APPROVED:
            case self::PENDING:
            case self::REJECTED:
            case self::TRASH:
            case self::CR:
            case self::AR:
            case self::AVARAGE_SCORE_FRAUD:
            case self::AVARAGE_SCORE:
                return [
                    'attribute' => $type,
                    'format' => 'html',
                    'contentOptions' => function($model, $key, $index, $column){
                        $options = [];
                        if(isset($model->hide) && $model->hide){
                            Html::addCssClass($options,['bg-light darker']);
                        }
                        return $options;
                    },
                    'value' => function (StatisticModel $model) use ($role, $type,$scenario) {
                        if(!is_null($model->{$type}) && ($type == self::CR || $type == self::AR) ){
                            return Html::tag('span',$model->{$type}.' %');
                        }
                        return Html::tag('span',$model->{$type}?:'---');
                    },
                    'headerOptions' => [
                        'class' => 'va-t',
                    ]

                ];
            case self::AMOUNT:
            case self::WIDHOUT_PARTNER:
            case self::ADVERTISER_PAYMENT_TOTAL:
            case self::PARTNER_PAYMENT_TOTAL:
            case self::PR:
            case self::RR:
                $headerOptions = [
                    'class' => 'va-t grid-settings-def-hidden grid-settings-hide',
                    'data-control-id' => $type,
                ];
                $label = null;
                if($type == self::AMOUNT){
                    $label = 'Сумма <br/> заказа';
                }
                if($type == self::ADVERTISER_PAYMENT_TOTAL){
                    $label = 'Всего <br/> оборот';
                }
                if($type == self::PARTNER_PAYMENT_TOTAL){
                    $label = 'Всего <br/> выплат';
                }
                if($type == self::WIDHOUT_PARTNER){
                    $label = 'Без <br/> канала';
                }
                return [
                    'attribute' => $type,
                    'format' => 'html',
                    'label'=>$label,
                    'encodeLabel'=>false,
                    'contentOptions' => function($model, $key, $index, $column){
                        $options = [];
                        if(isset($model->hide) && $model->hide){
                            Html::addCssClass($options,['bg-light darker']);
                        }
                        return $options;
                    },
                    'value' => function (StatisticModel $model) use ($role, $type,$scenario) {
                        if(!is_null($model->{$type}) && ($type == self::PR || $type == self::RR) ){
                            return Html::tag('span',$model->{$type}.' %');
                        }
                        if($type == self::AMOUNT || $type == self::ADVERTISER_PAYMENT_TOTAL || $type == self::PARTNER_PAYMENT_TOTAL ){
                            /**
                             * @TODO валюта выводиться хардкодом
                             */
                            return Html::tag('span',HNumbers::format($model->{$type}, 2, '.', ' ').' <span class="'.Currency::getValue(Currency::RUB, Currency::getFaList()).'"></span>');
                        }
                        return Html::tag('span',$model->{$type}?:'---');
                    },
                    'headerOptions' => $headerOptions

                ];
            case self::OFFER:
                $headerOptions = [
                    'class' => 'va-t',
                ];
                if(
                    $scenario == StatisticFilter::SCENARIO_ADVERTISERS ||
                    $scenario == StatisticFilter::SCENARIO_PARTNERS ||
                    $scenario == StatisticFilter::SCENARIO_CONVERSIONS ||
                    $scenario == StatisticFilter::SCENARIO_REGIONS
                ){
                    Html::addCssClass($headerOptions, ['hide', 'not-export']);
                }
                return [
                    'attribute' => $type,
                    'format' => 'html',
                    'contentOptions' => function($model, $key, $index, $column) use ($scenario, $type){
                        $options = [];
                        if(
                            $scenario == StatisticFilter::SCENARIO_ADVERTISERS ||
                            $scenario == StatisticFilter::SCENARIO_PARTNERS ||
                            $scenario == StatisticFilter::SCENARIO_CONVERSIONS ||
                            $scenario == StatisticFilter::SCENARIO_REGIONS
                        ){
                            if(isset($model->type) && $model->type != $type){
                                Html::addCssClass($options,['hide']);
                            }
                        } else {
                            if(isset($model->hide) && $model->hide){
                                Html::addCssClass($options,['hide']);
                            }
                            if(isset($model->type) && $model->type != $type){
                                Html::addCssClass($options,['hide']);
                            }
                        }
                        return $options;
                    },
                    'value' => function (StatisticModel $model) use ($role, $type,$scenario, $filter) {

                        $to = 'offers';
                        if ($scenario == StatisticFilter::SCENARIO_CONVERSIONS) {
                            $to = 'partners';
                        }

                        $filter_url = $filter->getFilterUrl($to, $model, $type);

                        if(
                            $scenario == StatisticFilter::SCENARIO_ADVERTISERS ||
                            $scenario == StatisticFilter::SCENARIO_PARTNERS ||
                            $scenario == StatisticFilter::SCENARIO_CONVERSIONS ||
                            $scenario == StatisticFilter::SCENARIO_REGIONS
                        ) {
                            return Html::tag(
                                'span','&#9492; '.$filter_url,
                                [
                                    'class'=>'pl10 pt10 pb10',
                                    'title'=>'Оффер',
                                    'data-toggle'=>'tooltip'
                                ]
                            );
                        } else {
                            if(isset($model->details) && !empty($model->details)){
                                return
                                    Html::tag(
                                        'span', '&nbsp;', ['class'=>'marker-minus'])
                                    .Html::tag(
                                        'span',$filter_url,['class'=>'btn-link asd']);
                            }
                        }
                        return Html::tag('span',$filter_url);
                    },
                    'headerOptions' => $headerOptions

                ];
            case self::PARTNER:
            case self::DATE:
            case self::ADVERTISER:
            case self::COUNTRY:
                $headerOptions = [
                    'class' => 'va-t',
                ];
                if ($scenario == NewStatisticFilter::SCENARIO_SOURCES && !$isAdmin) {
                    Html::addCssClass($headerOptions, ['hide']);
                }
                return [
                    'attribute' => $type,
                    'format' => 'html',
                    'contentOptions' => function($model, $key, $index, $column) use ($type, $scenario, $isAdmin){
                        $options = [];
                        if(isset($model->hide) && $model->hide){
                            Html::addCssClass($options,['hide']);
                        }
                        if ($scenario != NewStatisticFilter::SCENARIO_SOURCES) {
                            if (isset($model->type) && $model->type != $type) {
                                Html::addCssClass($options, ['hide']);
                            }
                        }
                        elseif ($scenario == NewStatisticFilter::SCENARIO_SOURCES && !$isAdmin) {
                            Html::addCssClass($options, ['hide']);
                        }
                        return $options;
                    },
                    'value' => function (StatisticModel $model) use ($role, $type, $scenario, $filter, $isAdmin) {

                        $filter_url = $filter->getFilterUrl($type.'s', $model, $type);

                        if(isset($model->details) && !empty($model->details)){
                            if ($scenario == NewStatisticFilter::SCENARIO_CONVERSIONS) {
                                $title = $model->{$type};
                                $title = StatisticDateGroups::getCellTitle($title, $filter->created_group);
                                return
                                    Html::tag(
                                        'span', '&nbsp;', ['class'=>'marker-plus'])
                                    .Html::tag(
                                        'span',$title,['class'=>'btn-link']);
                            } else {
                                return
                                    Html::tag(
                                        'span', '&nbsp;', ['class'=>'marker-minus'])
                                    .Html::tag(
                                        'span',$filter_url,['class'=>'btn-link asd']);
                            }
                        }

                        if ($scenario == NewStatisticFilter::SCENARIO_SOURCES && $isAdmin) {
                            $partner_id = $type.'_id';
                            if ($model->utm_source && $model->utm_source != 'Без значения') {
                                return Company::getLink(
                                    $model->{$partner_id},
                                    $model->utm_source
                                        ? Html::a('Задать',
                                        [
                                            '/offers/set-partner',
                                            'offer_id' => $filter->offer_id,
                                            'utm_source' => $model->utm_source
                                        ],
                                        [
                                            'title' => "Настройка партнера для Utm Source '{$model->utm_source}'",
                                            'class' => 'btn btn-xs btn-alert view-system set-partner-link'
                                        ])
                                        : '&mdash;'
                                );
                            }

                            return '&mdash;';
                        }

                        return Html::tag('span',$model->{$type});
                    },
                    'headerOptions' => $headerOptions

                ];
            case self::SOURCE:
                $headerOptions = [
                    'class' => 'va-t',
                ];
                return [
                    'attribute' => $type,
                    'format' => 'html',
                    'value' => function (StatisticModel $model) use ($role, $type, $scenario, $filter) {
                        $value = $model->{$type};
                        return Html::tag('span', $value);
                    },
                    'headerOptions' => $headerOptions
                ];
            case self::GOAL:
            case self::WEBMASTER:
            case self::HOUR:
            case self::LANDING:
            case self::CITY:
                $headerOptions = [
                    'class' => 'va-t hide not-export',
                ];
                return [
                    'attribute' => $type,
                    'format' => 'html',
                    'contentOptions' => function($model, $key, $index, $column) use($type){
                        $options = [];
                        if((isset($model->hide) && $model->hide) || (isset($model->type) && $model->type != $type)){
                            Html::addCssClass($options,['hide']);
                        }
                            Html::addCssClass($options,['br-t-n pn pl'.($model->level*10),'bg-light darker ']);
                        return $options;
                    },
                    'value' => function (StatisticModel $model) use ($role, $type, $filter) {
                        $value = $model->{$type};
                        if($type == self::HOUR){
                            $value .= ':00';
                        }
                        $options = [
                            'class'=>'pl10 pt10 pb10'
                        ];
                        switch ($type)
                        {
                            case self::GOAL:
                                $options = array_merge($options, ['title'=>'Цель', 'data-toggle'=>'tooltip']);
                                break;
                            case self::WEBMASTER:
                                $conversionFilter = new ConversionFilter();
                                $conversionFilter->loadExternalFilter($filter);
                                $value = Html::a($value, $conversionFilter->getFilterUrl(['click_subid' => $model->{$type}]));

                                $options = array_merge($options, ['title'=>'ID вебмастера', 'data-toggle'=>'tooltip']);
                                break;
                            case self::HOUR:
                                $options = array_merge($options, ['title'=>'Час', 'data-toggle'=>'tooltip']);
                                break;
                            case self::LANDING:
                                $options = array_merge($options, ['title'=>'Сайт', 'data-toggle'=>'tooltip']);
                                break;
                            case self::CITY:
                                $options = array_merge($options, ['title'=>'Город', 'data-toggle'=>'tooltip']);
                                break;

                        }
                        $value = '&#9492; '.$value;
                        return Html::tag('span',$value,$options);
                    },
                    'headerOptions' => $headerOptions

                ];
            case self::FRAUD:
                $headerOptions = [
                    'class' => 'va-t hide not-export',
                ];
                return [
                    'attribute' => $type,
                    'format' => 'html',
                    'contentOptions' => function($model, $key, $index, $column) use($type){
                        $options = [];
                        if((isset($model->hide) && !$model->hide) || (isset($model->type) && $model->type != $type)){
                            Html::addCssClass($options,['hide']);
                        }
                        Html::addCssClass($options,['br-t-n pn pl'.($model->level*10),'bg-light darker ']);
                        return $options;
                    },
                    'value' => function (StatisticModel $model) use ($role, $type) {
                        $value = Antifraud::getValue($model->{$type});
                        $options = [
                            'class'=>'br-n br-l br-dashed-l bw2 br-primary pl10 pt10 pb10'
                        ];
                        return Html::tag('span',$value,$options);
                    },
                    'headerOptions' => $headerOptions

                ];
        case self::TRASH_REASON:
                $headerOptions = [
                    'class' => 'va-t hide not-export',
                ];
                return [
                    'attribute' => $type,
                    'format' => 'html',
                    'contentOptions' => function($model, $key, $index, $column){
                        $options = [];
                        if(isset($model->hide) && !$model->hide){
                            Html::addCssClass($options,['hide']);
                        }
                        Html::addCssClass($options,['br-t-n pn pl10','bg-light darker']);
                        return $options;
                    },
                    'value' => function (StatisticModel $model) use ($role, $type) {
                        return Html::tag('span', TrashType::getName($model->{$type}),['class'=>'br-n br-l br-dashed-l bw2 br-primary pl10 pt10 pb10']);
                    },
                    'headerOptions' => $headerOptions

                ];
            default:
                $headerOptions = [
                    'class' => 'va-t',
                ];
                return [
                    'attribute' => $type,
                    'format' => 'html',
                    'contentOptions' => function($model, $key, $index, $column){
                        $options = [];
                        if(isset($model->hide) && $model->hide){
                            Html::addCssClass($options,['bg-light darker']);
                        }
                        return $options;
                    },
                    'value' => function (StatisticModel $model) use ($role, $type,$scenario) {
                        if(!is_null($model->{$type}) && ($type == self::TR || $type == self::FR) ){
                            return Html::tag('span',$model->{$type}.' %');
                        }
                        if (is_numeric($model->{$type}))
                        {
                            return Html::tag('span',HNumbers::format($model->{$type}, 0, '.', ' '));
                        }
                        return Html::tag('span',$model->{$type}?:'---');
                    },
                    'headerOptions' => $headerOptions

                ];
        }
    }
}