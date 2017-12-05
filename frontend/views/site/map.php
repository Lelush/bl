<?php
/**
 * Created by PhpStorm.
 * User: Sefirot
 */

?>

<div class="col-md-12 col-lg-12 col-xs-12 mapPage">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12 map-filter">
            <form class="filter-form">
                <select class="map-filter__item">
                    <option value="0">
                        Категория
                    </option>
                    <option>
                        Питание
                    </option>
                    <option>
                        Шопинг
                    </option>
                    <option>
                        Услуги
                    </option>
                    <option>
                        Развлечения
                    </option>
                </select>
                <div class="map-filter__item day-night">
                  <span id="day">
                    День
                  </span>
                    <span id="night">
                    Ночь
                  </span>
                </div>
                <div class="icons">
                  <span class="map-filter__item">
                    <img src="http://bl.2dsd.ru/1/assets/img/users/filter_1.svg"/>
                  </span>
                    <span class="map-filter__item">
                    <img src="http://bl.2dsd.ru/1/assets/img/users/filter_2.svg"/>
                  </span>
                    <span class="map-filter__item">
                    <img src="http://bl.2dsd.ru/1/assets/img/users/filter_3.svg"/>
                  </span>
                    <span class="map-filter__item">
                    <img src="http://bl.2dsd.ru/1/assets/img/users/filter_4.svg"/>
                  </span>
                    <span class="map-filter__item">
                    <img src="http://bl.2dsd.ru/1/assets/img/users/filter_5.svg"/>
                  </span>
                </div>
                <div class="map-filter__item search">
                    <input type="search" class="filter-search" placeholder="Я ищу...">
                    <button type="submit" class="filter-search__button"></button>
                </div>
            </form>
            <button id="add-company" class="map-filter__item add">
                <img class="closed" src="http://bl.2dsd.ru/1/assets/img/users/add-icon.svg"/>
                <img class="opened" src="http://bl.2dsd.ru/1/assets/img/users/close-icon.png"/>
                <span class="closed">
                  Добавить
                </span>
                <span class="opened">
                  Закрыть
                </span>
            </button>

            <button id="showAll-close" class="map-filter__item add sA-close pull-right">
                <span>
                  Свернуть
                </span>
            </button>
            <!--<button id="add-close" class="map-filter__item add-close">
              <img src="http://bl.2dsd.ru/1/assets/img/users/close-icon.png"/>
              Закрыть
            </button>-->
        </div>
        <div id="addCompany-wrapper" class="col-md-6 col-lg-6 col-xs-12 map-addCompany">
              <span class="map-addCompany__heading">
                Добавить компанию на карту
              </span>
            <span class="map-addCompany__text">
                Расскажите нам максимально подробно о предлагаемой компании и, возможно,
                она появится на карте BL.
              </span>
            <form id="addCompany-form">
                <div class="addCompany__field col-md-6 col-lg-6 col-xs-12">
                    <label for="company-name">
                        Название
                    </label>
                    <input id="company-name" type="text" placeholder="">
                </div>
                <div class="addCompany__field col-md-6 col-lg-6 col-xs-12">
                    <label for="company-name">
                        Сфера услуг
                    </label>
                    <input id="company-service" type="text" placeholder="">
                </div>
                <button class="addCompany-submit pull-right" type="submit">
                    Предложить компанию
                </button>
            </form>
        </div>

        <div class="col-md-12 col-lg-12 col-xs-12 map-companyBox">
            <div class="map-companyBox_headline">
                Популярные
            </div>
            <div class="col-md-2 col-lg-2 col-xs-12 map-companyBox__item">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 item-avatar">
                        <img class="center-block" src="http://bl.2dsd.ru/1/assets/img/users/company-avatar.png"/>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-heading">
                    <span>
                      Название компании
                    </span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-actions">
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-like.svg"/>
                            <span>
                        1560
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-share.svg"/>
                            <span>
                        520
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-relate.svg"/>
                            <span>
                        315
                      </span>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xs-5 item-rating">
                        <img src="http://bl.2dsd.ru/1/assets/img/users/rating-star.svg"/>
                        <span>
                      1560
                    </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 map-companyBox__item">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 item-avatar">
                        <img class="center-block" src="http://bl.2dsd.ru/1/assets/img/users/company-avatar.png"/>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-heading">
                    <span>
                      Название компании
                    </span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-actions">
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-like.svg"/>
                            <span>
                        1560
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-share.svg"/>
                            <span>
                        520
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-relate.svg"/>
                            <span>
                        315
                      </span>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xs-5 item-rating">
                        <img src="http://bl.2dsd.ru/1/assets/img/users/rating-star.svg"/>
                        <span>
                      1560
                    </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 map-companyBox__item">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 item-avatar">
                        <img class="center-block" src="http://bl.2dsd.ru/1/assets/img/users/company-avatar.png"/>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-heading">
                    <span>
                      Название компании
                    </span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-actions">
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-like.svg"/>
                            <span>
                        1560
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-share.svg"/>
                            <span>
                        520
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-relate.svg"/>
                            <span>
                        315
                      </span>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xs-5 item-rating">
                        <img src="http://bl.2dsd.ru/1/assets/img/users/rating-star.svg"/>
                        <span>
                      1560
                    </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 map-companyBox__item">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 item-avatar">
                        <img class="center-block" src="http://bl.2dsd.ru/1/assets/img/users/company-avatar.png"/>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-heading">
                    <span>
                      Название компании
                    </span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-actions">
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-like.svg"/>
                            <span>
                        1560
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-share.svg"/>
                            <span>
                        520
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-relate.svg"/>
                            <span>
                        315
                      </span>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xs-5 item-rating">
                        <img src="http://bl.2dsd.ru/1/assets/img/users/rating-star.svg"/>
                        <span>
                      1560
                    </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 map-companyBox__item">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 item-avatar">
                        <img class="center-block" src="http://bl.2dsd.ru/1/assets/img/users/company-avatar.png"/>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-heading">
                    <span>
                      Название компании
                    </span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-actions">
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-like.svg"/>
                            <span>
                        1560
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-share.svg"/>
                            <span>
                        520
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-relate.svg"/>
                            <span>
                        315
                      </span>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xs-5 item-rating">
                        <img src="http://bl.2dsd.ru/1/assets/img/users/rating-star.svg"/>
                        <span>
                      1560
                    </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 map-companyBox__item blured">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 item-avatar">
                        <img class="center-block" src="http://bl.2dsd.ru/1/assets/img/users/show-more.png"/>
                    </div>
                    <div id="cb-showAll" class="col-md-12 col-lg-12 col-xs-12 item-heading">
                    <span>
                      Показать все
                    </span>
                    </div>
                </div>
            </div>

            <hr class="showAll"/>

            <div class="map-companyBox_headline showAll">
                Новые
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 map-companyBox__item showAll">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 item-avatar">
                        <img class="center-block" src="http://bl.2dsd.ru/1/assets/img/users/company-avatar.png"/>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-heading">
                    <span>
                      Название компании
                    </span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-actions">
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-like.svg"/>
                            <span>
                        1560
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-share.svg"/>
                            <span>
                        520
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-relate.svg"/>
                            <span>
                        315
                      </span>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xs-5 item-rating">
                        <img src="http://bl.2dsd.ru/1/assets/img/users/rating-star.svg"/>
                        <span>
                      1560
                    </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 map-companyBox__item showAll">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 item-avatar">
                        <img class="center-block" src="http://bl.2dsd.ru/1/assets/img/users/company-avatar.png"/>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-heading">
                    <span>
                      Название компании
                    </span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-actions">
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-like.svg"/>
                            <span>
                        1560
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-share.svg"/>
                            <span>
                        520
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-relate.svg"/>
                            <span>
                        315
                      </span>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xs-5 item-rating">
                        <img src="http://bl.2dsd.ru/1/assets/img/users/rating-star.svg"/>
                        <span>
                      1560
                    </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 map-companyBox__item showAll">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 item-avatar">
                        <img class="center-block" src="http://bl.2dsd.ru/1/assets/img/users/company-avatar.png"/>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-heading">
                    <span>
                      Название компании
                    </span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-actions">
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-like.svg"/>
                            <span>
                        1560
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-share.svg"/>
                            <span>
                        520
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-relate.svg"/>
                            <span>
                        315
                      </span>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xs-5 item-rating">
                        <img src="http://bl.2dsd.ru/1/assets/img/users/rating-star.svg"/>
                        <span>
                      1560
                    </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 map-companyBox__item showAll">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 item-avatar">
                        <img class="center-block" src="http://bl.2dsd.ru/1/assets/img/users/company-avatar.png"/>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-heading">
                    <span>
                      Название компании
                    </span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-actions">
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-like.svg"/>
                            <span>
                        1560
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-share.svg"/>
                            <span>
                        520
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-relate.svg"/>
                            <span>
                        315
                      </span>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xs-5 item-rating">
                        <img src="http://bl.2dsd.ru/1/assets/img/users/rating-star.svg"/>
                        <span>
                      1560
                    </span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 map-companyBox__item showAll">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 item-avatar">
                        <img class="center-block" src="http://bl.2dsd.ru/1/assets/img/users/company-avatar.png"/>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-heading">
                    <span>
                      Название компании
                    </span>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12 item-actions">
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-like.svg"/>
                            <span>
                        1560
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-share.svg"/>
                            <span>
                        520
                      </span>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 item-actions_action">
                            <img src="http://bl.2dsd.ru/1/assets/img/users/action-relate.svg"/>
                            <span>
                        315
                      </span>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 col-xs-5 item-rating">
                        <img src="http://bl.2dsd.ru/1/assets/img/users/rating-star.svg"/>
                        <span>
                      1560
                    </span>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
