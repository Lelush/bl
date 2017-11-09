<?php
/**
 * Created by PhpStorm.
 * User: Sefirot
 * Date: 06.11.2017
 * Time: 20:13
 */

use yii\helpers\Url;
?>

<div class="col-md-12 col-lg-12 col-xs-12">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12 choose-headline">
              <span>
                Выбери кто ты
              </span>
        </div>
        <div class="col-md-12 col-xs-12 col-lg-12 choose-blocks choose-blocks_page">
            <div class="col-md-offset-1 col-lg-offset-1 col-md-3 col-lg-3 col-xs-12 choose-block">
                <div class="image-wrapper">
                    <img class="main" src="<?=Yii::getAlias('@static')?>/img/users.png"/>
                </div>
                <div class="text-wrapper">
                  <span class="text-wrapper__heading">
                    Пользователь
                  </span>
                    <span class="text-wrapper__text">
                    Создай свой образ и открой его особые возможности
                  </span>
                    <span class="text-wrapper__text">
                    Начни экономить, зарабатывать и становиться популярным
                  </span>
                    <span class="text-wrapper__text">
                    Выбери свой Lifestyle
                  </span>
                    <a href="<?=Url::to(['/site/users'])?>" class="choose-button">
                        Выбрать
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-lg-3 col-xs-12 choose-block">
                <div class="image-wrapper">
                    <img class="unic-img main" src="<?=Yii::getAlias('@static')?>/img/unic.png"/>
                </div>
                <div class="text-wrapper">
                  <span class="text-wrapper__heading">
                    Уникальный пользователь
                  </span>
                    <span class="text-wrapper__text">
                    Откройте доступ к уникальным пользователям
                  </span>
                    <input class="choose-input" type="text" placeholder="Введите код">
                    <button disabled class="choose-button">
                        Выбрать
                    </button>
                </div>
            </div>

            <div class="col-md-3 col-lg-3 col-xs-12 choose-block">
                <div class="image-wrapper">
                    <img class="main" src="<?=Yii::getAlias('@static')?>/img/company.png"/>
                </div>
                <div class="text-wrapper">
                  <span class="text-wrapper__heading">
                    Коммерческий пользователь
                  </span>
                    <span class="text-wrapper__text">
                    Откройте новые возможности развития, создания имиджа,
                    популярности или взаимодействия с людьми, которые вам дороги
                  </span>
                    <a href="<?=Url::to(['/site/company'])?>" class="choose-button">
                        Выбрать
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
