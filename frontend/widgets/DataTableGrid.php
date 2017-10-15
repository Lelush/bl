<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 7/6/15
 * Time: 2:54 PM
 */

namespace frontend\widgets;


use yii\grid\Column;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

class DataTableGrid extends GridView
{
    public $options = ['class' => 'grid-view table-responsive'];
    public $tableOptions = ['class' => 'table table-bordered'];
    public $rows = [];
    /**
     * Renders the table body.
     * @return string the rendering result.
     */

    public function init()
    {

        $this->initRows(); // before self::initColumn()
        parent::init();
    }

    public function initRows()
    {
        foreach ($this->rows as $ir => $row) {
            if(empty($row['columns'])){
                continue;
            }
            foreach($row['columns'] as $ic =>$column){

                $this->columns[] = $column;
            }
        }
    }

    /**
     * Renders the table header.
     * @return string the rendering result.
     */
    public function renderTableHeader()
    {


        $content = '';
        if(count($this->rows)){
            $offset = 0;
            $rows = $this->rows;
            foreach($rows as $ir => $row){

                if(!isset($row['columns']) || isset($row['columns']) && empty($row['columns'])) {
                    continue;
                }
                $rowOptions = ArrayHelper::getValue($row, 'options', []);
                $content .= Html::beginTag('tr', $rowOptions);
                $count = count($row['columns']);
                $columns = array_slice($this->columns,$offset, $count);
                foreach($columns as $column){
                    /* @var $column Column */
                    $content .= $column->renderHeaderCell();
                }
                $offset = $count;
                $content .= Html::endTag('tr') . "\n";
            }
        } else {
            $cells = [];
            foreach ($this->columns as $column) {
                /* @var $column Column */
                $cells[] = $column->renderHeaderCell();
            }
            $content = Html::tag('tr', implode('', $cells), $this->headerRowOptions);
        }


        if ($this->filterPosition === self::FILTER_POS_HEADER) {
            $content = $this->renderFilters() . $content;
        } elseif ($this->filterPosition === self::FILTER_POS_BODY) {
            $content .= $this->renderFilters();
        }

        return "<thead>\n" . $content . "\n</thead>";
    }

    /**
     * @param $column DataColumn
     * @return mixed
     */
    public function renderHeaderCell($column)
    {
        $column->headerOptions['data-control-id'] = $column;
        return $column->renderHeaderCell();
    }

    public function renderTableBody()
    {
        $models = array_values($this->dataProvider->getModels());
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        foreach ($models as $index => $model) {
            $key = $keys[$index];
            if ($this->beforeRow !== null) {
                $row = call_user_func($this->beforeRow, $model, $key, $index, $this);
                if (!empty($row)) {
                    $rows[] = $row;
                }
            }

            $rows[] = $this->renderTableRow($model, $key, $index);

            if ($this->afterRow !== null) {
                $row = call_user_func($this->afterRow, $model, $key, $index, $this);
                if (!empty($row)) {
                    $rows[] = $row;
                }
            }
        }

        return "<tbody>\n" . implode("\n", $rows) . "\n</tbody>";
    }

    /**
     * Renders a table row with the given data model and key.
     * @param mixed $model the data model to be rendered
     * @param mixed $key the key associated with the data model
     * @param integer $index the zero-based index of the data model among the model array returned by [[dataProvider]].
     * @return string the rendering result
     */
    public function renderTableRow($model, $key, $index)
    {
        $cells = [];
        if(count($this->rows)){
            $offset = 0;
            $offsetNext = 0;
            $rows = $this->rows;
            for($ir=0,$rCount=count($rows);$ir<$rCount;$ir++){
                $row = $rows[$ir];
                if(!isset($row['columns']) || isset($row['columns']) && empty($row['columns'])) {
                    continue;
                }
                $count = count($row['columns']);
                $columns = array_slice($this->columns,$offset, $count);
                foreach($columns as $i => $column){
                    /* @var $column Column */
                    $hide = false;
                    if(ArrayHelper::keyExists('hidden',$column->contentOptions) && ArrayHelper::getValue($column->contentOptions, 'hidden')) {
                        $hide = true;
                    }
                    if( ArrayHelper::keyExists('colspan',$column->headerOptions) ) {
                        $countNext = $column->headerOptions['colspan'];
                        $columnsNext = array_slice($this->columns, $count+$offsetNext, $countNext);
                        foreach($columnsNext as $icn => $columnNext){
                            /* @var $columnNext Column */
                            $cells[] = $columnNext->renderDataCell($model, $key, $index);
                            unset($rows[$ir+1]['columns'][$icn]);
                        }
                        $offset += $countNext;
                        $offsetNext +=$countNext;
                    }
                    if(!$hide){
                        $cells[] = $column->renderDataCell($model, $key, $index);
                    }
                }
                $offset += $count;
            }
        } else {
            /* @var $column Column */
            foreach ($this->columns as $column) {
                $cells[] = $column->renderDataCell($model, $key, $index);
            }
        }
        if ($this->rowOptions instanceof \Closure) {
            $options = call_user_func($this->rowOptions, $model, $key, $index, $this);
        } else {
            $options = $this->rowOptions;
        }
        $options['data-key'] = is_array($key) ? json_encode($key) : (string) $key;
        $result = Html::tag('tr', implode('', $cells), $options);
        if(isset($model->details) && !empty($model->details)){
            foreach ($model->details as $i => $detail){

                $result .= $this->renderTableRow($detail, $key.'-'.$i, $index);
            }
        }
        return $result;
    }
}