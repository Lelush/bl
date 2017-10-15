<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\components;

use common\helpers\HImage;
use Yii;
use yii\bootstrap\Html;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;

class CNavBar extends Widget
{
    const TYPE_PRIMARY = 'primary';
    const TYPE_INFO = 'info';
    const TYPE_WARNING = 'warning';
    const TYPE_DANGER = 'danger';
    const TYPE_ALERT = 'alert';
    const TYPE_SYSTEM = 'system';
    const TYPE_SUCCESS = 'success';
    const TYPE_DARK = 'dark';


    /**
     * @var array the HTML attributes for the widget container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "nav", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];
    /**
     * @var string|boolean the text of the brand or false if it's not used. Note that this is not HTML-encoded.
     * @see http://getbootstrap.com/components/#navbar
     */
    public $brandLabel = false;
    /**
     * @var array|string|boolean $url the URL for the brand's hyperlink tag. This parameter will be processed by [[Url::to()]]
     * and will be used for the "href" attribute of the brand link. Default value is false that means
     * [[\yii\web\Application::homeUrl]] will be used.
     */
    public $brandUrl = false;
    /**
     * @var array the HTML attributes of the brand link.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $brandOptions = [];
    public $brandingOptions = [];

    public $type;


    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = false;
        if (empty($this->options['class'])) {
            Html::addCssClass($this->options, ['navbar', 'navbar-default']);
        } else {
            Html::addCssClass($this->options, ['widget' => 'navbar']);
        }

        if(!$this->brandUrl) {
            $this->brandUrl = Yii::$app->homeUrl;
        }


        if (empty($this->options['role'])) {
            $this->options['role'] = 'navigation';
        }
        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'header');
        if($this->type){
            Html::addCssClass($options,['bg-'.$this->type]);
            Html::addCssClass($this->brandingOptions,['bg-'.$this->type]);
        }
        echo Html::beginTag($tag, $options);
        Html::addCssClass($this->brandingOptions, ['navbar-branding', 'dark']);
        echo Html::beginTag('div', $this->brandingOptions);
        Html::addCssClass($this->brandOptions, ['navbar-brand']);
        echo Html::a(Html::img(HImage::getSrc('img','/img/logo.png')).Html::tag('span',$this->brandLabel, ['class'=>'logo-text hidden-xs hidden-sm']), $this->brandUrl, $this->brandOptions);
        echo Html::tag('span',null,['id'=>'toggle_sidemenu_l','class'=>'hidden-md hidden-lg ad ad-lines']);
        echo Html::endTag('div');

    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $tag = ArrayHelper::remove($this->options, 'tag', 'header');
        echo Html::endTag($tag);
//        BootstrapPluginAsset::register($this->getView());
    }
}
