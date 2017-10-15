<?php

/** @var $this View */
/** @var $listOptions [] */
/** @var AjaxListWidget $widget */

use frontend\widgets\AjaxListWidget;
use frontend\widgets\CGrid;
use frontend\widgets\PjaxAlert;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

$widget = $this->context;

$notFound = !empty($widget->gridOptions['emptyText']) ? $widget->gridOptions['emptyText'] : 'Ничего не найдено';

$getHashUrl = Url::to(['/deposits/']);
$this->registerJs(<<<JS
    var buffForm;
    function applyFilter(){
        var form = $(this).parents('form');
        var pjax = form.attr('data-pjax-target');
        var url = window.location.origin + window.location.pathname;
        var delimiter = '';
        if(url.match(/(&|\?)[^&\?]+$/)){
            delimiter = '&';
        }else if(url.match(/(&|\?)$/)){
            delimiter = '';
        }else{
            delimiter = '?';
        }
        url+=delimiter+form.serialize();
        $.pjax.reload({
            container:pjax,
            url:url
        });
        return false;
    }

    var inputChangeTimeout;
    function timeoutApplyFilter(){
        var self = this;
        clearTimeout(inputChangeTimeout);
        inputChangeTimeout = setTimeout(function(){
            $.proxy(applyFilter,self)();
        },300);
    }

    $('.apply-pjax').click(function(){
        var form = $(this).parents('form');
        form.find('button').addClass('disabled');
        buffForm = form;
        $.proxy(applyFilter,this)();
    });

    $.fn.clearForm = function() {
      return this.each(function() {
        var type = this.type, tag = this.tagName.toLowerCase();
        if (tag == 'form')
          return $(':input',this).clearForm();
        if (type == 'text' || type == 'password' || tag == 'textarea'){
            this.value = typeof this.attributes['data-default'] != 'undefined' ? this.attributes['data-default'].value :'';
        }
        else if (type == 'checkbox' || type == 'radio')
          this.checked = false;
        else if (tag == 'select')
          this.selectedIndex = 0;
      });
    };

    $('.clear-pjax').click(function(){
        var form = $(this).parents('form');
        form.clearForm();
        form.find('button').addClass('disabled');
        buffForm = form;
        $.proxy(applyFilter,this)();
    });

    $('.change-pjax-delay').change(function(){
        $.proxy(timeoutApplyFilter,this)();
    });

    $('.change-pjax').change(function(){
        $.proxy(applyFilter,this)();
    });

    $('[data-pjax-target]').find('input,textarea').on('keyup',function(e){
        if(e.keyCode == 13){ //enter
            $.proxy(applyFilter,this)();
        }
    });


    //$('.offer-filter').find(':checkbox, :radio, select').on('change',function(){
    //    $.proxy(applyFilter, this)();
    //});
    function initConfirm(parent){
        $(parent).find('.confirmation').confirmation({
            singleton: true,
            placement: 'left',
            btnOkLabel: 'Да',
            btnCancelLabel: 'Нет',
        });
    }
    $(document).on("pjax:click", "a:not(.goto-page):not(table th a):not([data-pjax=0])", false);
    $(document).on('pjax:beforeSend', function() {
        $('#pjax-filtered-deposit-list-trobbler').css('display', 'block');
    });
    $(document).on('pjax:complete', function() {
        initModal($('body'));
        initConfirm($('body'));
        initGridSettings($('[data-pjax-container]'));
        $('.layer').click();
        if(buffForm){
            $(buffForm).find('button').removeClass('disabled');
        }
        chartUpdate();
    });
    $.pjax.defaults = $.pjax.defaults || {};
    $.pjax.defaults.timeout = 2000;

    $(document).on('click', '.grid-settings-button', function(){
        var button = $(this);
        var container = button.parents('[data-pjax-container]');
        var target = container.find(button.attr('data-target'));
        var layer = $('<div>').addClass('layer');
        var head = container.find('.fix-header');
        if(!head.length){
            head = container.find('.table thead');
        }
        console.log(head);
        layer.click(function(){
            target.toggle();
            layer.remove();
        });
        $(window).on('scroll.reinitHeader',function(){
            var cot = container.offset().top;
            var hot = head.offset().top;
            console.log(cot,hot);
            var top = hot-cot +head.height(); 
            target.css({top:top+'px'});
        }).trigger('scroll');
        target.toggle();
        target.after(layer);
        return false;
    });
    function initModal(parent){
        $(parent).find(".btn-more-offers").on('click',function() {
            var btn = $(this);
            var ul = btn.parents('ul').clone();
            ul.find('.btn-more-offers').remove();
            ul.find('.hide').removeClass('hide');
            $(".modal-body", $('#more_offers')).html(ul);
        });
    }

    window.offerTable = window.offerTable || [];
    function initGridSettings(containers){
        $.each(containers, function(i,container){
            var container = $(container);
            var items = container.find('.table').not('.fix-header').find('.grid-settings-hide');
            var checkboxList = container.find('.grid-settings-checkbox-list');
            var offerGridSettingsName = 'offerGridSettings_'+location.host+'_'+window.location.pathname;
            var settingsStr;

            window.offerGridSettings = window.offerGridSettings || {};
            if(container.find('.grid-view table').length){
                var table = container.find('.grid-view table').not('.dis-data-table');
                if(window.offerTable[table.attr('data-table-index')]){
                    window.offerTable[table.attr('data-table-index')].destroy();
                }
                var index;
                var offerDataTable = table.DataTable({
                    "oLanguage": {
                        "sEmptyTable":  "{$notFound}"
                    },
                    "autoWidth": false,
                    "paging":   false,
                    "ordering": false,
                    "info":     false,
                    "bFilter":   false,
                    "sDom": 't',
                    'classes': {
                        'sWrapper' : "dataTables_wrapper form-inline dt-bootstrap table-responsive",
                    }
                });
                window.offerTable[i]=offerDataTable;
                offerGridSettingsName = offerGridSettingsName+'_'+i;
                table.attr('data-table-index',i);
                settingsStr = localStorage.getItem(offerGridSettingsName);

                $.each(items, function(){
                    var box = container.find('.grid-settings-checkbox-box').first().clone();
                    var checkbox = box.find('.grid-settings-checkbox');
                    var th = $(this);
                    var name = th.text();
                    var index = th.attr('data-control-id');
                    checkbox.removeClass('all');
                    box.find('i').text(name);
                    checkbox.val(index);
                    offerGridSettings[i] = offerGridSettings[i] || {};
                    offerGridSettings[i][index] = th.is('.grid-settings-def-hidden') ? false : true;
                    checkboxList.append(box);
                });
                if(typeof settingsStr != 'undefined' && settingsStr != 'null'){
                    $.extend(window.offerGridSettings[i], JSON.parse(settingsStr), true);
                }
                $.each(offerGridSettings[i], function(key, val){
                    var column = window.offerTable[i].column('[data-control-id="'+key+'"]');
                    column.visible( val );
                    var checkbox = checkboxList.find('[value="'+key+'"]');
                    if(val) {
                        checkbox.prop('checked', true);
                    } else {
                        checkbox.prop('checked', false);
                    }
                    checkboxListSetAll(checkboxList);
                });
                localStorage.setItem(offerGridSettingsName, JSON.stringify(offerGridSettings[i] || {}));
            }
            $('#filter_1').find('button').removeClass('disabled');
            setTimeout(function(){
                $(document).trigger('reinitHeader', table);
            },0);
        });
    }
    function checkboxListSetAll(checkboxList){
        var sel;
        var all = checkboxList.find('.all');
        checkboxList.find(':checkbox').not('.all').each(function(){
            var item = $(this);
            if(typeof sel == 'undefined' || sel !== false) {
                sel = item.is(':checked');
            }
        });
        if(sel) {
            all.prop('checked', true);
        } else {
            all.prop('checked', false);
        }
    }
    initModal($('body'));
    initConfirm($('body'));
    initGridSettings($('[data-pjax-container]'));
    function toggleCheckbox(checkbox, prop){
        var container = checkbox.parents('[data-pjax-container]');
        var list = checkbox.parents('.grid-settings-checkbox-list');
        var table = container.find('.grid-view table').not('.dis-data-table');
        var index = table.attr('data-table-index');
        var column = window.offerTable[index].column('[data-control-id="'+checkbox.val()+'"]');
        var sett  = {};
        if(typeof prop != 'undefined'){
            column.visible( prop );
            sett[checkbox.val()] = prop;
        } else {
            column.visible( ! column.visible() );
            sett[checkbox.val()] = column.visible();
        }

        $.extend(offerGridSettings[index] || {}, sett, true);
        checkboxListSetAll(list);
        $(document).trigger('reinitHeader',table);
    }

    $(document).on('click', '.grid-settings-checkbox',function(){
        var checkbox = $(this);
        var container = checkbox.parents('[data-pjax-container]');
        var list = checkbox.parents('.grid-settings-checkbox-list');
        var table = container.find('.grid-view table').not('.dis-data-table');
        var index = table.attr('data-table-index');
        var box = checkbox.parents('.grid-settings-checkbox-box');
        var offerGridSettingsName = 'offerGridSettings_'+location.host+'_'+window.location.pathname+'_'+index;
        if(checkbox.is('.all')){
            if(checkbox.is(':checked')) {
                list.find('.grid-settings-checkbox').not('.all').prop('checked', false).each(function(){
                    var checkbox = $(this);
                    toggleCheckbox(checkbox, false);
                    checkbox.click();
                });
            } else {
                list.find('.grid-settings-checkbox').not('.all').prop('checked', true).each(function(){
                    var checkbox = $(this);
                    toggleCheckbox(checkbox, true);
                    checkbox.click();
                });
            }
        } else {
            toggleCheckbox(checkbox);
        }
        localStorage.setItem(offerGridSettingsName, JSON.stringify(offerGridSettings[index] || {}));
    })

    function chartUpdate(){
        $('[data-chart-target]').each(function(){
            var that = $(this);
            var target = $(that.attr('data-chart-target'));
            var data = JSON.parse(that.attr('data-chart'));
            var categories = JSON.parse(that.attr('data-categories'));
            var chart = target.highcharts();
            $.each(chart.series, function(key, item){
                //item.update(data[key]);
                var dataChartObject = data[key].data;
                item.setData(dataChartObject);
            });
            if (typeof categories !== 'undefined' && categories.length > 0) {
                chart.xAxis[0].update({'categories': categories}, true);
            }
        });
    }
JS
, View::POS_READY, 'pjax_script'
);

/** @var AjaxListWidget $widget */

$pjaxOptions = $widget->pjaxOptions;
if(!isset($pjaxOptions['clientOptions'])){
    $pjaxOptions['clientOptions'] = ['method'=>'post'];
}
if(!ArrayHelper::keyExists('timeout',$pjaxOptions)){
    $pjaxOptions['timeout'] = 4000;
}
?>
<?=Modal::widget(['options' => ['id' => "more_offers", 'class'=>'mt50'], 'header' => "Цели"])?>
<? Pjax::begin($pjaxOptions); ?>
<?= $widget->beforeHtml;?>
<div id="grid-settings" class="col-md-2 mb50">
    <div class="panel panel-primary heading-border">
        <div class="panel-body bg-light admin-form">
            <div class="option-group field section  grid-settings-checkbox-list">
                <label class="block mt15 option option-primary grid-settings-checkbox-box">
                    <input class="grid-settings-checkbox all" type="checkbox" value="all">
                    <span class="checkbox"></span>
                    <i>
                        Все столбцы
                    </i>
                </label>
            </div>
        </div>
    </div>
</div>
<?
if($widget->gridOptions){
    $options = $widget->gridOptions;
} else{
    $options = [
        'id' => 'offer-list',
        'dataProvider' => $widget->filter->search(),
        'pageSizer' => [
            'availableSizes' => [25=>'25',50 => '50',100 => '100'],
            'options' => [
                'class' => 'pagination pull-right'
            ],
            'afterHtml' => '<div class="pull-right mr10 mt25"><p>Показать на странице: </p></div>'
        ],
        'columns' => $widget->columns,
        'headerRowOptions' => [
            'class' => 'va-t'
        ],
        'rowOptions' => $widget->rowOptions
    ];
}
?>
<?= $widget->afterHtml;?>
<?= PjaxAlert::widget() ?>
<?=CGrid::widget($options);?>
<? Pjax::end(); ?>