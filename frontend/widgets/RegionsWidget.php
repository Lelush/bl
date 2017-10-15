<?php
/**
 * @link      https://github.com/wbraganca/yii2-fancytree-widget
 * @copyright Copyright (c) 2014 Wanderson Bragança
 * @license   https://github.com/wbraganca/yii2-fancytree-widget/blob/master/LICENSE
 */

namespace frontend\widgets;

use wbraganca\fancytree\FancytreeWidget as FancytreeWidgetBase;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

class RegionsWidget extends FancytreeWidgetBase
{
    protected $defaultOptions = [
        'icon' => false,
        'source' => [
            'debugDelay' => 1000
        ],
        'selectMode' => 3,
        'extensions' => ["edit", "glyph", "filter"],
        'checkbox' => true,
        'toggleEffect' => [
            'effect' => 'drop',
            'options' => [
                'direction' => 'left'
            ],
            'duration' => 400
        ],
        'filter' =>[
            'autoApply' => true,
            'counter' => true,
            'fuzzy' => false,
            'hideExpandedCounter' => true,
            'highlight' => true,
            'mode' => 'dimm',
        ],
//        'wide' => [
//            'iconWidth' => '1em',
//            'iconSpacing' => '0.5em',
//            'levelOfs' => '1.5em'
//        ],
        'glyph' => [
            'map' => [
                'doc'=> "glyphicon glyphicon-file",
                'docOpen'=> "glyphicon glyphicon-file",
                'checkbox'=> "glyphicon glyphicon-unchecked",
                'checkboxSelected'=> "glyphicon glyphicon-check",
                'checkboxUnknown'=> "glyphicon glyphicon-share",
                'dragHelper'=> "glyphicon glyphicon-play",
                'dropMarker'=> "glyphicon glyphicon-arrow-right",
                'error'=> "glyphicon glyphicon-warning-sign",
                'expanderClosed'=> "glyphicon glyphicon-menu-right",
                'expanderLazy'=> "glyphicon glyphicon-menu-right",  // glyphicon-plus-sign
                'expanderOpen'=> "glyphicon glyphicon-menu-down",  // glyphicon-collapse-down
                'folder'=> "glyphicon glyphicon-folder-close",
                'folderOpen'=> "glyphicon glyphicon-folder-open",
                'loading'=> "glyphicon glyphicon-refresh glyphicon-spin"
            ]
        ],
        'strings' => [
            'loading' => "Загрузка&#8230;",
            'loadError' => 'Ошибка загрузки!',
            'moreData' => "Далее&#8230;",
			'noData' => "Нет данных."
        ]
    ];

    public $url;
    public $title;
    public $inputName; // default ft_{id}[]
    public $searchOptions;
    public $searchName = 'fancyTree';
    public $buttonResetOptions = [];
    public $buttonResetId = 'fancyTreeReset';
    public $buttonSearchOptions = [];
    public $buttonSearchId = 'fancyTreeSearch';
    public $htmlOptions = [];
    public $searchUrl='';

    public function init()
    {
        Html::addCssClass($this->searchOptions, ['class'=>'form-control']);
        Html::addCssClass($this->buttonResetOptions, ['class'=>'btn btn-default']);
        if(!ArrayHelper::keyExists('id',$this->buttonResetOptions)){
            $this->buttonResetOptions['id'] = $this->buttonResetId;
        }
        if(!ArrayHelper::keyExists('id',$this->buttonSearchOptions)){
            $this->buttonSearchOptions['id'] = $this->buttonSearchId;
        }
        Html::addCssClass($this->buttonSearchOptions, ['btn', 'btn-default']);
        Html::tag('span', (!empty($this->title) ? $this->title : 'Регионы'));
        echo
        '<div class="row">
            <div class="form-group field-offerviewform-name col-md-7 row">
                '.($this->title !== false ? Html::tag('span', (!empty($this->title) ? $this->title : 'Регионы'), ['class'=>'field-label mb10 mt10 col-sm-12']) : '').'
                <div class="col-sm-12">
                    <div class="input-group">
                        '.Html::textInput($this->searchName, null, $this->searchOptions).'
                        <span class="input-group-btn">'.Html::button('<span class="glyphicon glyphicon-remove"></span>', $this->buttonResetOptions).'</span>
                        <span class="input-group-btn">'.Html::button('Поиск', $this->buttonSearchOptions).'</span>
                    </div>
                </div>

            </div>
        </div>';
        parent::init();
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $this->defaultOptions['icon'] = new JsExpression('function(event, data){
//            if( data.node.isFolder() ) {
//            return "glyphicon glyphicon-book";
//            }
        }');
        $this->defaultOptions['renderNode'] = new JsExpression('function(event, data){
            if(typeof data.node.children != "undefined"){
                $.each(data.node.children, function(i,item){
                    if(!item.selected){
                        item.selected = data.node.selected;
                    }
                    if(typeof item.children != "undefined"){
                        $.each(item.children, function(j,subItem){
                            if(!subItem.selected){
                                subItem.selected = item.selected;
                            }
                        });
                    }
                })
            }
        }');
        $this->defaultOptions['loadChildren'] = new JsExpression('function(event, data){
            if(data.node.selected){
                data.node.fixSelection3AfterClick();
            }
        }');

        if($this->url){
            $this->defaultOptions['source']['url'] = $this->url;
            $this->defaultOptions['lazyLoad'] = new JsExpression('function(event, request) {
                var node = request.node;
                // Issue an ajax request to load child nodes
                var data = {id: node.data.id};
                if(typeof node.data.lazytype != \'undefined\'){
                    data.type = node.data.lazytype;
                }
                if(typeof node.data.flag != \'undefined\'){
                    data.all = node.data.flag;
                }
                data.selected = node.selected ? 1 : 0;
                request.result = {
                url: "'.$this->url.'",
                data: data
                }
            }');
        }

        $view = $this->getView();
        FancytreeAsset::register($view);
        $id = 'fancyree_' . $this->id;
        if (isset($this->options['id'])) {
            $id = $this->options['id'];
            unset($this->options['id']);
        } else {
            if(!ArrayHelper::keyExists('id', $this->htmlOptions)){
                $this->htmlOptions['id'] = $id;
            }
           echo Html::tag('div', '', $this->htmlOptions);
        }
        $this->options = ArrayHelper::merge($this->defaultOptions, $this->options);
        $options = Json::encode($this->options);
        $view->registerJs('
        var treeBlock = $("#'.$id.'");
        treeBlock.fancytree( ' .$options .');
        var tree = treeBlock.fancytree("getTree");
        var searchInput = $("input[name='.$this->searchName.']");
        var buttonReset = $("#'.$this->buttonResetId.'");
        var buttonSearch = $("#'.$this->buttonSearchId.'");
        var timerMap = {};

        buttonReset.click(function(e){
          searchInput.val("");
          tree.clearFilter();
          $(this).attr("disabled", true);
          buttonSearch.attr("disabled", true);
        }).attr("disabled", true);

        buttonSearch.click(function (event) {
            search(searchInput.val());
        }).attr("disabled", true);

        function filter() {
            var n,
            opts = {
              autoExpand: true,
            },
            match = searchInput.val();
            n = tree.filterNodes(match, opts);
            console.log("filter");
        }

        function search(query) {
            query = $.trim(query);
            // Store the source options for optional paging
            $.when(
                _callWebservice("'.$this->searchUrl.'",{query:query})
            ).done(function(data){
                tree.reload(data);
                filter();
            });
        }

        _callWebservice = function (cmd, data) {
            return $.ajax({
                url: cmd,
                data: $.extend({
                }, data),
                cache: true,
                dataType: "json"
            });
        }

        function _delay(tag, ms, callback) {
            /*jshint -W040:true */
            var that = this;

            tag = "" + (tag || "default");
            if (timerMap[tag] != null) {
                clearTimeout(timerMap[tag]);
                delete timerMap[tag];
                // console.log("Cancel timer \'" + tag + "\'");
            }
            if (ms == null || callback == null) {
                return;
            }
            // console.log("Start timer \'" + tag + "\'");
            timerMap[tag] = setTimeout(function () {
                // console.log("Execute timer \'" + tag + "\'");
                callback.call(that);
            }, +ms);
        }

        searchInput.keyup(function (e) {
            var query = $.trim($(this).val()),
                lastQuery = $(this).data("lastQuery");

            if (e && e.which === $.ui.keyCode.ESCAPE || query === "") {
                buttonReset.click();
                return;
            }
            if (e && e.which === $.ui.keyCode.ENTER && query.length >= 3) {
                buttonSearch.click();
                return;
            }
            if (query === lastQuery || query.length < 3) {
                console.log("Ignored query \'" + query + "\'");
                return;
            }
            $(this).data("lastQuery", query);
            _delay("search", 400, function () {
                buttonSearch.click();
            });
            buttonReset.attr("disabled", query.length === 0);
            buttonSearch.attr("disabled", query.length < 2);
        });

        $("#'.$id.'").parents("form").on("beforeSubmit",function(){
            tree.generateFormElements('.($this->inputName?'"'.$this->inputName.'"':'null').', false, {stopOnParents: true})
        });
        ');
        $view->registerJs('');
    }
}
