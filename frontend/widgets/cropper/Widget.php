<?php

namespace frontend\widgets\cropper;

use frontend\widgets\cropper\assets\CropperAsset;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use Yii;

class Widget extends InputWidget
{
    public $uploadParameter = 'file';
    public $width = 200;
    public $height = 200;
    public $label = '';
    public $uploadUrl;
    public $noPhotoImage = '';
    public $maxSize = 2097152;
    public $thumbnailWidth = 300;
    public $thumbnailHeight = 300;
    public $cropAreaWidth = 300;
    public $cropAreaHeight = 300;
    public $extensions = 'jpeg, jpg, png, gif';
    public $onCompleteJcrop;
    public $pluginOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::registerTranslations();

        if ($this->uploadUrl === null) {
            throw new InvalidConfigException(Yii::t('cropper', 'MISSING_ATTRIBUTE', ['attribute' => 'uploadUrl']));
        } else {
            $this->uploadUrl = rtrim(Yii::getAlias($this->uploadUrl), '/') . '/';
        }

        if ($this->label == '') {
            $this->label = Yii::t('cropper', 'DEFAULT_LABEL');
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerClientAssets();

        return $this->render('widget', [
            'model' => $this->model,
            'widget' => $this
        ]);
    }

    /**
     * Register widget asset.
     */
    public function registerClientAssets()
    {
        $view = $this->getView();
        $assets = CropperAsset::register($view);

        if ($this->noPhotoImage == '') {
            $this->noPhotoImage = $assets->baseUrl . '/img/nophoto.png';
        }

        $settings = array_merge([
            'url' => $this->uploadUrl,
            'name' => $this->uploadParameter,
            'maxSize' => $this->maxSize / 1024,
            'allowedExtensions' => explode(', ', $this->extensions),
            'size_error_text' => Yii::t('cropper', 'TOO_BIG_ERROR', ['size' => $this->maxSize / (1024 * 1024)]),
            'ext_error_text' => Yii::t('cropper', 'EXTENSION_ERROR', ['formats' => $this->extensions]),
            'accept' => 'image/*'
        ], $this->pluginOptions);

        if ($this->onCompleteJcrop)
            $settings['onCompleteJcrop'] = $this->onCompleteJcrop;

        $view->registerJs(
            'jQuery("#' . $this->options['id'] . '").parents(".cropper-widget").find(".new-photo-area").cropper(' . Json::encode($settings) . ', ' . $this->width . ', ' . $this->height . ', this);',
            $view::POS_READY
        );
        $view->registerJs(
            'jQuery("#' . $this->options['id'] . '").parents(".cropper-widget").find(".edit-upload").on(\'click\',function(){
                var block = jQuery("#' . $this->options['id'] . '").parents(".cropper-widget").first();
                var span = $(this).find("span");
                var self = $(this);
                console.log(block,block.find(\'.cropper-update-area\') )
                if(self.is(\'.active\')) {
                    block.find(\'.cropper-update-area\').hide();
                    span.text(span.attr("data-on-text"));
                    self.removeClass("active");
                } else {
                    block.find(\'.cropper-update-area\').show();
                    span.text(span.attr("data-off-text"));
                    self.addClass("active");
                }
            });',
            $view::POS_READY
        );
    }

    /**
     * Register widget translations.
     */
    public static function registerTranslations()
    {
        if (!isset(Yii::$app->i18n->translations['cropper']) && !isset(Yii::$app->i18n->translations['cropper/*'])) {
            Yii::$app->i18n->translations['cropper'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@frontend/widgets/cropper/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    'cropper' => 'cropper.php'
                ]
            ];
        }
    }
}
