<?php

namespace common\helpers;


use common\enums\CompanyPricingType;
use common\enums\OfferPartnerStatus;
use common\enums\OfferStatus;
use common\enums\OfferType;
use common\enums\Role;
use common\models\Category;
use common\models\Company;
use common\models\Goal;
use common\models\Offer;
use common\models\OfferBrokerSetting;
use yii\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class HOfferGrid
{
    public static function getIdColumn($role, $statisticData)
    {
        return [
            'attribute'      => 'id',
            'format'         => 'html',
            'contentOptions' => [
                'class' => 'id',
            ],
            'headerOptions' => [
                'class' => 'va-t'
            ]
        ];
    }

    public static function getLogoColumn($role, $statisticData)
    {
        return [
            'attribute'      => 'logo',
            'format'         => 'raw',
            'contentOptions' => [
                'class' => 'centred',
            ],
            'headerOptions' => [
                'class' => 'grid-settings-hide va-t',
                'data-control-id' => 'logo',
            ],
            'value'          => function (Offer $model) {
                return Html::img($model->getLogoSrc()); //TODO: загвоздка почему то не отображается картинка.
            },
            'filter'         => false,
            'enableSorting'=>false,
        ];
    }

    public static function getOfferColumn($role, $statisticData)
    {
        if ($role == Role::ADMIN || $role == Role::MANAGER) {
            $val = function (Offer $model) {
                return Html::a($model->name, $model->getUpdateUrl());
            };
        }else{
            $val = function (Offer $model) {
                return Html::a($model->name, $model->getViewUrl());
            };
        }
        return [
            'attribute' => 'name',
            'format'    => 'html',
            'value'     => $val,
            'contentOptions' => [
              'class' => 'mw320'
            ],
            'headerOptions' => [
                'class' => 'va-t mw320'
            ],
        ];
    }

    public static function getCategoriesColumn($role, $statisticData)
    {
        return [
            'attribute'     => 'category',
            'value'         => function (Offer $model) {
                return $model->getCategoriesStr();
            },
            'contentOptions' => [
                'class' => 'mw320'
            ],
            'headerOptions' => [
                'class' => 'grid-settings-hide va-t',
                'data-control-id' => 'category',
            ],
            'filter'        => Category::getList(),
        ];
    }

    public static function getCreatedAtColumn($role, $statisticData)
    {
        return [
            'attribute'      => 'created_at',
            'label' => 'Дата <br> создания',
            'encodeLabel' => false,
            'contentOptions' => [
                'class' => 'centred',
            ],
            'headerOptions'  => [
                'class' => 'grid-settings-hide va-t',
                'data-control-id' => 'created_at',
            ],
            'format' => ['date', 'php:Y-m-d'],
            'filter'         => false,
        ];
    }

    public static function getGoalsColumn($role, $statisticData)
    {
        if($role == Role::ADMIN || $role == Role::MANAGER){
            $value = function (Offer $model) {
                $val = '<ul class="list-unstyled">';
                /**
                 * @var $goal Goal
                 */
                $i = 0;
                $countGoals = count($model->goals);
                foreach ($model->goals as $goal) {
                    $text = [];
                    if($model->type == OfferType::KUPILEAD){
                        $text[] = $goal->getTextCostBroker();
                    }else{
                        $text[] = $goal->getTextCostAdvertiser('<span class="fa fa-usd"></span> рекламодателя');
                    }
                    $text[] = $goal->getTextCostPartner('<span class="fa fa-usd"></span> партнера');

                    $val.= HOfferGrid::renderLi($text, $goal,$i)  ;
                    $i++;
                }
                $val.= HOfferGrid::renderModalA($countGoals) . '</ul>';
                return $val;
            };
        }
        
        if($role == Role::ADVERTISER){
            $value = function (Offer $model) {
                $val = '<ul class="list-unstyled">';
                /**
                 * @var $goal Goal
                 */
                $i = 0;
                $countGoals = count($model->goals);
                foreach ($model->goals as $goal) {
                    $text = [];
                    $text[] = $goal->getTextCostAdvertiser('Ставка');
                    $val.= HOfferGrid::renderLi($text, $goal,$i)  ;
                    $i++;
                }
                $val.= HOfferGrid::renderModalA($countGoals) .'</ul>';
                return $val;
            };
        }

        if($role == Role::PARTNER){
            $value = function (Offer $model) {
                $val = '<ul class="list-unstyled">';
                /**
                 * @var $goal Goal
                 */
                $i = 0;
                $countGoals = count($model->goals);
                foreach ($model->goals as $goal) {
                    $text = [];
                    $text[] = $goal->getTextCostPartner('Ставка');
                    $val.= HOfferGrid::renderLi($text, $goal,$i)  ;
                    $i++;
                }
                $val.= HOfferGrid::renderModalA($countGoals) .'</ul>';
                return $val;
            };
        }

        if($role == Role::BROKER){
            $value = function (Offer $model) {
                $val = '<ul class="list-unstyled">';
                /**
                 * @var $goal Goal
                 */
                $i = 0;
                $goals = Goal::getListByOfferID($model->id, true);
                $countGoals = count($goals);
                foreach ($goals as $goal) {
                    $text = [];
                    $text[] = $goal->getTextCostBroker('Ставка');
                    $val.= HOfferGrid::renderLi($text, $goal,$i)  ;
                    $i++;
                }
                $val.= HOfferGrid::renderModalA($countGoals) . '</ul>';
                return $val;
            };
        }
        return [
            'header' => 'Цель',
            'format' => 'raw',
            'value'  => $value ,
            'filter' => false,
            'headerOptions' => [
                'class' => 'grid-settings-hide va-t mw200',
                'data-control-id' => 'goal_name',
            ],
            'contentOptions' => [
                'class' => 'mw200'
            ],
        ];
    }

    public static function renderModalA($countGoals){
        return  $countGoals > 1 ?Html::a('Все цели', '#',['class'=>'btn-more-offers', 'data-toggle' => 'modal', 'data-target' => '#more_offers']):'';
    }

    public static function renderLi(array $text, Goal $goal, $iteration,$htmlOptions =[]){
        if($iteration > 1){
            $htmlOptions['class'] = 'hide';
        }
        return Html::tag('li', '<strong>' . $goal->name . '</strong>' . ' <br/>' . implode('<br/>', $text), $htmlOptions);

    }

    public static function getStatusColumn($role, $statisticData)
    {
        if ($role == Role::ADMIN || $role == Role::MANAGER ) {
            $value = function (Offer $model) {
                $status = OfferStatus::APPROVED;
                if (!$model->active) {
                    $status = OfferStatus::DISABLED;
                } else {
                    $status = OfferStatus::PENDING;
                    // получаем все заказы на данный оффер,
                    $brokerSetting = null;
                    foreach ($model->orders as $order) {
                        $company = Company::getById($order->company_id, true);
                        if($company->pricing_type == CompanyPricingType::POSTPAYMENT){
                            $status = OfferStatus::APPROVED;
                            break;
                        }
                        // из заказов получаем компании по этому офферу
                        // сравниваем хватает ли нам баланса для получения конверсии хотябы по 1 цели оффера
                        if($model->type == OfferType::KUPILEAD){
                            /**@var OfferBrokerSetting $brokerSetting */
                                $brokerSetting = $model->getOfferBrokerSetting()->where(['company_id' => $company->id])->one();
                            if(!$brokerSetting){
                                $status = OfferStatus::PENDING;
                            }else{
                                if($order->balance >= $brokerSetting->cpa){
                                    $status = OfferStatus::APPROVED;
                                    break(1);
                                }
                            }
                        }else{
                            $balance = $company->balance;
                            foreach ($model->goals as $goal) {
                                if ($balance >= $goal->advertiser_fix) {
                                    $status = OfferStatus::APPROVED;
                                    break(2);
                                }
                            }
                        }
                    }
                }
                $name = OfferStatus::getName($status);
                if($status == OfferStatus::PENDING){
                    $name = str_replace(' ','<br>',$name);
                }
                $cssClass = OfferStatus::getCssClass($status);
                return Html::tag('span', $name, ['class' => 'label label-' . $cssClass]);
            };
        }
        // РД имеет только таргет Оффер order в таком случае 1.
        if ($role == Role::ADVERTISER) {
            $value = function (Offer $model) {
                $status = OfferStatus::APPROVED;
                $orders = $model->orders;
                $order = array_shift($orders);
                $company = Company::getByID($order->company_id, true);
                if (!$model->active) {
                    $status = OfferStatus::DISABLED;
                } elseif($company->pricing_type == CompanyPricingType::POSTPAYMENT){
                    $status = OfferStatus::APPROVED;
                } else {
                    $status = OfferStatus::PENDING;
                    // из заказов получаем компании по этому офферу
                    $balance = $company->balance;
                    foreach ($model->goals as $goal) {
                        if ($balance >= $goal->advertiser_fix) {
                            $status = OfferStatus::APPROVED;
                            break(1);
                        }
                    }
                }
                $name = OfferStatus::getName($status);
                if($status == OfferStatus::PENDING){
                    $name = str_replace(' ','<br>',$name);
                }
                $cssClass = OfferStatus::getCssClass($status);
                return Html::tag('span', $name, ['class' => 'label label-' . $cssClass]);
            };
        }
        if ($role == Role::BROKER) {
            $value = function (Offer $model) {
                $status = OfferStatus::APPROVED;
                $orders = $model->orders;
                $order = array_shift($orders);
                $company = Company::getByID($order->company_id, true);
                if (!$model->orders) { // если компания подключена к офферу у нее есть заказ.( статус заказа учтен в запросе)
                    $status = OfferStatus::DISABLED;
                } else { // проверяем на наличие денег.
                    if (!$model->offerBrokerSetting) {
                        $status = OfferStatus::DISABLED;
                    } elseif($company->pricing_type == CompanyPricingType::POSTPAYMENT){
                        $status = OfferStatus::APPROVED;
                    } elseif ($order->balance <= $model->offerBrokerSetting->cpa) { //  у брокера может быть только 1 заказ
                        $status = OfferStatus::PENDING;
                    }
                }
                $name = OfferStatus::getName($status);
                if($status == OfferStatus::PENDING){
                    $name = str_replace(' ','<br>',$name);
                }
                $cssClass = OfferStatus::getCssClass($status);
                return Html::tag('span', $name, ['class' => 'label label-' . $cssClass]);
            };
        }
        // Пратнер
        if ($role == Role::PARTNER) {
            $value = function (Offer $model) {
               $offerPartner =  array_values($model->offerPartners);
                $orders = $model->orders;
                $order = array_shift($orders);
                $company = Company::getByID($order->company_id, true);
                if (!$offerPartner) { // не подключен
                    $status = OfferStatus::DISABLED;
                }elseif($offerPartner[0]->status == OfferStatus::DISABLED){
                    $status = OfferStatus::DISABLED;
                }elseif($offerPartner[0]->status == OfferStatus::PENDING){
                    $status = OfferPartnerStatus::PENDING;
                } elseif($company->pricing_type == CompanyPricingType::POSTPAYMENT){
                    $status = OfferStatus::APPROVED;
                }else {
                    $status = OfferStatus::DISABLED;
                    // из заказов получаем компании по этому офферу и проверяем есть ли у кого-нибудь из них деньги на конверсию.
                    $balance = $company->balance;
                    foreach ($model->goals as $goal) {
                        if ($balance >= $goal->advertiser_fix) {
                            $status = OfferStatus::APPROVED;
                            break(1);
                        }
                    }
                }
                $name = OfferPartnerStatus::getName($status);
                if($status == OfferStatus::PENDING){
                    $name = str_replace(' ','<br>',$name);
                }
                $cssClass = OfferStatus::getCssClass($status);
                return Html::tag('span', $name, ['class' => 'label label-' . $cssClass]);
            };
        }
        return [
            'format'         => 'raw',
            'header'         => 'Статус',
            'value'          => $value,
            'contentOptions' => [
                'class' => 'text-center',
            ],
            'filter'         => false,
            'headerOptions'  => [
                'class' => 'va-t',
            ],
        ];
    }

    public static function getConversionsColumn($role, $statisticData)
    {
        return [
            'header' => 'Конверсии',
            'format' => 'raw',
            'value'  => function (Offer $model) use ($statisticData) {
                $text = '<ul class="list-unstyled">';
                $text.='<li>Всего: '.ArrayHelper::getValue($statisticData,[$model->id, HStatisticGrid::CONVERSION], 0);
                $text.='<li>Принято: '.ArrayHelper::getValue($statisticData,[$model->id, HStatisticGrid::APPROVED], 0);
                $text.='<li>В ожидании: '.ArrayHelper::getValue($statisticData,[$model->id, HStatisticGrid::PENDING], 0);
                $text.='<li>Отклонено: '.ArrayHelper::getValue($statisticData,[$model->id, HStatisticGrid::REJECTED], 0);
                $text.='</ul>';
                return $text;
            },
            'filter' => false,
            'headerOptions' => [
                'class' => 'grid-settings-hide va-t',
                'data-control-id' => 'conversions',
            ],
        ];
    }

    public static function getStatisticsColumn($role, $statisticData)
    {
        return [
            'header' => 'Статистика',
            'format' => 'raw',
            'value'  => function (Offer $model) use ($statisticData) {
                $approved = ArrayHelper::getValue($statisticData,[$model->id, HStatisticGrid::APPROVED]);
                $total = ArrayHelper::getValue($statisticData,[$model->id, HStatisticGrid::CONVERSION]);
                $click = ArrayHelper::getValue($statisticData,[$model->id, HStatisticGrid::CLICK]);
                $text = '<ul class="list-unstyled">';
                $text.='<li>AR: '.($total ? round($approved / $total * 100, 1).'%' : '-').'</li>';
                $text.='<li>CR: '.($click ? round($total / $click * 100, 1).'%' : '-').'</li>';
                $text.='</ul>';
                return $text;
            },
            'filter' => false,
            'headerOptions' => [
                'class' => 'grid-settings-hide va-t',
                'data-control-id' => 'stats',
            ],
        ];
    }

    public static function getSystemsColumn($role, $statisticData)
    {
        return [
            'attribute'     => 'type',
            'value'         => function (Offer $model) {
                return OfferType::getName($model->type);
            },
            'headerOptions' => [
                'class' => 'grid-settings-hide va-t',
                'data-control-id' => 'type',
            ],
            'filter'        => OfferType::getList(),
        ];
    }

    public static function getControlColumn($role, $statisticData)
    {
        if($role == Role::ADMIN){
            $template = '{update} {disconnect} {delete}';
        }elseif($role == Role::MANAGER){
            $template = '{update} {disconnect}';
        }else{
            $template = '{view}';
        }
        return [
            'header'         => Html::a('<span class="fa fa-gear"></span> Управление', '#', [
                'class'       => 'grid-settings-button',
                'data-target' => '#grid-settings',
            ]),
            'class'          => ActionColumn::className(),
            'template'       => $template,
            'contentOptions' => [
                'class' => 'text-center fs15',
            ],
            'buttons' => [
                'delete' => function($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => \Yii::t('yii', 'Delete'),
                        'aria-label' => \Yii::t('yii', 'Delete'),
                        'data-pjax' => '0',
                        'class' => 'confirmation'
                    ]);
                },
                'disconnect' => function ($url, $model) {
                    $offerPartner =  array_values($model->offerPartners);
                    if (!empty($offerPartner) && !empty($offerPartner[0]))
                    {
                        if($offerPartner[0]->status == \common\enums\OfferPartnerStatus::APPROVED){
                            if (\Yii::$app->user->can(Role::ADMIN)){
                                //$params = \Yii::$app->request->get();
                                $url = ['/offers/disconnect','id' => $model->id,'user_id'=>\Yii::$app->user->id];
                            }else{
                                $url = ['/offers/disconnect','id' => $model->id];
                            }
                            return Html::a('<span class="glyphicon glyphicon-off"></span>', $url, [
                                'title' =>  'Выключить',
                            ]);
                        }
                    }
                    return false;
                },
                'update' => function($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/offers/update','id' => $model->id], [
                        'title' =>  'Редактировать',
                    ]);
                }
            ],
            'headerOptions' => [
                'class' => 'va-t'
            ],
        ];
    }
}