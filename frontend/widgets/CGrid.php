<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 7/6/15
 * Time: 2:54 PM
 */

namespace frontend\widgets;


use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

class CGrid extends DataTableGrid
{
    public $options = ['class' => 'grid-view'];
    public $pager = [
        'class' => 'frontend\widgets\OffersPager',
    ];

    /**
     * @var array the configuration for the page sizer widget. By default, [[LinkPageSizer]] will be
     * used to render the page sizer. You can use a different widget class by configuring the "class" element.
     */
    public $pageSizer = [];
    /**
     * @var string the layout that determines how different sections of the list view should be organized.
     * The following tokens will be replaced with the corresponding section contents:
     *
     * - `{summary}`: the summary section. See [[renderSummary()]].
     * - `{errors}`: the filter model error summary. See [[renderErrors()]].
     * - `{items}`: the list items. See [[renderItems()]].
     * - `{sorter}`: the sorter. See [[renderSorter()]].
     * - `{pager}`: the pager. See [[renderPager()]].
     * - `{pagesizer}`: the page sizer. See [[renderPagesizer()]].
     */
    public $layout = "{summary}\n{fixheader}\n{items}\n{fixscroll}\n{pager}\n{pagesizer}";
    public $summary = "Показаны записи <b>{begin, number}-{end, number}</b> из <b>{totalCount, number}</b>";
    
    /**
     * @inheritdoc
     */
    public function renderSection($name)
    {
        switch ($name) {
            case "{fixscroll}":
                return $this->renderFixScroll();
            case "{fixheader}":
                return $this->renderFixHeader();
            case "{pagesizer}":
                return $this->renderPagesizer();
            default:
                return parent::renderSection($name);
        }
    }

    public function renderFixScroll(){
        $wrapperOptions = [];
        Html::addCssClass($wrapperOptions,['table-responsive','fix-scroll-wrapper']);

        $options = [];
        Html::addCssClass($options,['fix-scroll']);

        $view = $this->getView();
        $view->registerJs(<<<JS
            var reinitScroll = function(t){
                var table = $(t);
                var grdView = table.parents('.grid-view').first();
                var fixHeader = grdView.find('.fix-header')
                var wrapper = table.parents('.table-responsive').first();
                var fixScroll = grdView.find('.fix-scroll');
                var wrapperFixScroll = fixScroll.parents('.fix-scroll-wrapper').first();
                
                var w = table.outerWidth();
                fixScroll.css({width:w+'px'});
                
                var h = grdView.outerHeight() -wrapper.outerHeight() -  wrapperFixScroll.height() +4 + (grdView.offset().top - wrapper.offset().top) ; //4px for scroll
                wrapperFixScroll.css({bottom:h+'px'}).attr('default-position',h);
                
                var scroll = grdView.find(".table-responsive");
            
                scroll.scroll(function(){
                    scroll.scrollLeft($(this).scrollLeft());
                });
                
                if(wrapperFixScroll.width() >= w){
                    wrapperFixScroll.hide();
                } else {
                    wrapperFixScroll.show();
                }
                
                var ww = $(window).height();
                var fh = $('#main footer').outerHeight();
                $(window).on('scroll.reinitScroll',function(){
                    var wrot = wrapper.offset().top;
                    var wrh = wrapper.height();
                    var scw = $(window).scrollTop();
                    var wrpt = wrot - scw + wrh;
                    var wrptf = ww-fh-wrpt;
                    
                    var tot = table.offset().top;
                    var scwb = $(window).scrollTop() + $(window).height();
                    var wrfp = scwb - fh - wrapperFixScroll.height();
                    var wrfd = wrfp - (tot+fixHeader.height());
                    
                    var bot;
                    
                    if(wrfd < 0){
                        bot = wrh - fixHeader.height() - wrapperFixScroll.height() + parseFloat(wrapperFixScroll.attr('default-position')) +2;
                        wrapperFixScroll.css({bottom:bot+'px'})
                    } else if(wrptf < 0){
                        bot = Math.abs(wrptf) + parseFloat(wrapperFixScroll.attr('default-position')) +2;
                        wrapperFixScroll.css({bottom:bot+'px'})
                    }else{
                        wrapperFixScroll.css({bottom:wrapperFixScroll.attr('default-position')+'px'})
                    }
                }).trigger('scroll');
            }
            var rsTimer;
            var rsOldTable;
            $(document).on('reinitHeader.reinitScroll',function(e, t){
                if($(rsOldTable).data('table-index')==$(t).data('table-index')){
                    clearTimeout(rsTimer);
                }
                rsTimer = setTimeout(function(){
                    reinitScroll(t);
                },10);
                rsOldTable = t;
            });
JS
        );

        return Html::tag('div',Html::tag('div', null, $options),$wrapperOptions);
    }

    public function renderFixHeader(){
        $wrapperOptions = [];
        Html::addCssClass($wrapperOptions,['table-responsive','table-responsive-hide-scroll']);
        $content = $this->renderTableHeader();
        $options = $this->tableOptions;
        Html::addCssClass($options,['dis-data-table','fix-header','dataTable']);
        $view = $this->getView();
        $view->registerJs(<<<JS
        var reinitHeader = function(t){
            var table = $(t);
            var container = table.parents('.grid-view').first();
            var targetTable = container.find('.fix-header');
            targetTable.find('thead').html(table.find('thead').html());
            table.find('th').each(function(i,item){
                var th = $(item);
                var w = th.width();
                targetTable.find('th:eq('+i+')').css({width:w,minWidth:w});
            });
            
            var scroll = container.find(".table-responsive");
            
            scroll.scroll(function(){
                scroll.scrollLeft($(this).scrollLeft());
            });
            
            var headerHeight = $('#main > header').outerHeight();
            var targetWrapper = targetTable.parents('.table-responsive').first();
            var dift = container.offset().top - table.offset().top;
            var top;
            
            if(dift<0  ){
                top = Math.abs(dift);
                targetWrapper.css({top:top}).attr('default-position',top);
            }
            
            
            $(window).on('scroll.reinitHeader',function(){
                var tot = table.offset().top;
                var th = table.height();
                var scw = $(window).scrollTop();
                var tpt = tot - scw - headerHeight;
                var tob =  th  - headerHeight;
                var tpb = tot + tob - scw -targetTable.height();
                
                if (tpb < 0) {
                    top = Math.abs(tob)+parseFloat(targetWrapper.attr('default-position'));
                    targetWrapper.css({top:top+'px'});
                } else if (tpt < 0){
                    top = Math.abs(tpt)+parseFloat(targetWrapper.attr('default-position'));
                    targetWrapper.css({top:top+'px'});
                } else {
                    targetWrapper.css({top:targetWrapper.attr('default-position')+'px'});
                }
            }).trigger('scroll');
        }
        var rhTimer;
        var rhOldTable = null;
        $(document).on('reinitHeader.reinitHeader',function(e, t){
            if($(rhOldTable).data('table-index')==$(t).data('table-index')){
                clearTimeout(rhTimer);
            }
            rhTimer = setTimeout(function(){
                reinitHeader(t);
            },10);
            rhOldTable = t;
        });
JS
);
        return Html::tag('div',Html::tag('table', $content, $options),$wrapperOptions);
    }

    /**
     * Renders the page sizer.
     * @return string the rendering result
     */
    public function renderPagesizer()
    {
        $pagination = $this->dataProvider->getPagination();
        if ($pagination === false || $this->dataProvider->getCount() <= 0 || $this->pageSizer === false) {
            return '';
        }
        /* @var $class LinkPageSizer */
        $pageSizer = $this->pageSizer;
        $class = ArrayHelper::remove($pageSizer, 'class', LinkPageSizer::className());
        $pageSizer['pagination'] = $pagination;
        $pageSizer['view'] = $this->getView();
        return $class::widget($pageSizer);
    }
}