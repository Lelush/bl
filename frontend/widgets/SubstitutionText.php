<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 7/6/15
 * Time: 2:54 PM
 */

namespace frontend\widgets;


use yii\widgets\InputWidget;

class SubstitutionText extends InputWidget
{
    /**
     * @var array data for generating the list options (value=>display)
     */
    public $data = [];
    /**
     * @var array the options for the Bootstrap Multiselect JS plugin.
     * Please refer to the Bootstrap Multiselect plugin Web page for possible options.
     * @see http://davidstutz.github.io/bootstrap-multiselect/#options
     */
    public $clientOptions = [];
    /**
     * Initializes the widget.
     */

    public $fields;

    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $content = '';
        $fields = [];

        foreach ($this->fields as $field)
        {
            $fields[] = $field;
            $content .= '<span data-field="'.$field.'" class="user-params label label-rounded label-default '.$this->getID().'-'.$field.'">{'.$field.'}</span>';
        }

        echo '<div class="'.$this->getID().'" data-fields="'.implode(',',$fields).'">'.$content.'</div>';


        $this->registerPlugin();
    }
    /**
     * Registers MultiSelect Bootstrap plugin and the related events
     */
    protected function registerPlugin()
    {
        $view = $this->getView();

        //$timeOutID = md5($this->getID());

        $view->registerJs(<<<JS
$(document).ready(function(){

    // Функция подствечивает подстановочные теги, которые использованы в поле Postback партнера
    var timeOut{$this->getID()} = setTimeout(function(){
        var fields = $('.{$this->getID()}').data('fields').split(',');
        var value = $('#{$this->options['id']}').val();

        fields.forEach(function(item, i, fields) {
            if (value.indexOf('{'+item+'}') > -1) {
                $('.{$this->getID()}-'+item).addClass('label-info').removeClass('label-default');
            }
        });
    },500);


    $('#{$this->options['id']}').on('input', function(){
        var fields = $('.{$this->getID()}').data('fields').split(',');
        var value = $('#{$this->options['id']}').val();

        fields.forEach(function(item, i, fields) {
            if (value.indexOf('{'+item+'}') == -1) {
                $('.{$this->getID()}-'+item).removeClass('label-info').addClass('label-default');
            }
            else
            {
                $('.{$this->getID()}-'+item).addClass('label-info').removeClass('label-default');
            }
        });
    });

    $('.{$this->getID()} span').on('click', function() {
        var textField = $('#{$this->options['id']}');
        var value = textField.val();
        var field = $(this).data('field');
        var separator = '?';

        if (value.indexOf('?') > -1)
        {
            separator = '&';
        }

        var string = separator + field + '={' + field + '}';

        if (value.indexOf(string) > -1)
        {
            value = value.replace(string, '');
            value = value.replace('{'+field+'}', '');
            $(this).removeClass('label-info').addClass('label-default');
        }
        else
        {
            value = value + string;
            $(this).addClass('label-info').removeClass('label-default');
        }

        textField.val(value);

    });
});
JS
);
    }

}