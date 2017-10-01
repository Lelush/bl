<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\components;

use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;

class CNav extends Nav
{

    /**
     * Initializes the widget.
     */
    public function init()
    {
        if ($this->dropDownCaret === null) {
            $this->dropDownCaret = Html::tag('span', '', ['class' => 'caret']);
        }
        parent::init();
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        Html::addCssClass($this->options, ['widget' => 'nav']);
    }

    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        if(isset($item['label'])){
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        }else{
            $label = '';
        }

        $icon = isset($item['icon']) ? $item['icon'] : false;
        if($icon){
            $iconOptions = isset($icon['options']) ? $icon['options'] : [];
            if(isset($icon['name'])){
                $name = $icon['name'];
                Html::addCssClass($iconOptions, $name);
            }
            $iconHtml = Html::tag(isset($icon['tag']) ? $icon['tag'] : 'span', null, $iconOptions);
            $label = $iconHtml . $label;
        }

        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        if(isset($item['badge'])){
            $badge = $item['badge'];
            if (!isset($badge['count'])) {
                throw new InvalidConfigException("The 'count' option badge is required.");
            }
            $badgeOptions = isset($badge['options']) ? $badge['options'] : [];
            Html::addCssClass($badgeOptions, 'badge');
            if(isset($badge['type'])){
                Html::addCssClass($badgeOptions, 'badge-'.$badge['type']);
            }
            $label .= ' '.Html::tag('span', $badge['count'], $badgeOptions);
        }

        if ($items !== null) {
            $linkOptions['data-toggle'] = 'dropdown';
            Html::addCssClass($options, ['widget' => 'dropdown']);
            Html::addCssClass($linkOptions, ['widget' => 'dropdown-toggle']);
            if ($this->dropDownCaret !== '') {
                $label .= ' ' . $this->dropDownCaret;
            }
            if (is_array($items)) {
                if ($this->activateItems) {
                    $items = $this->isChildActive($items, $active);
                }
                $items = $this->renderDropdown($items, $item);
            }
        }

        if ($this->activateItems && $active) {
            Html::addCssClass($options, 'active');
        }

        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }

    /**
     * Renders the given items as a dropdown.
     * This method is called to create sub-menus.
     * @param array $items the given items. Please refer to [[Dropdown::items]] for the array structure.
     * @param array $parentItem the parent item information. Please refer to [[items]] for the structure of this array.
     * @return string the rendering result.
     * @since 2.0.1
     */
    protected function renderDropdown($items, $parentItem)
    {
        return CDropdown::widget([
            'options' => ArrayHelper::getValue($parentItem, 'dropDownOptions', []),
            'items' => $items,
            'encodeLabels' => $this->encodeLabels,
            'clientOptions' => false,
            'view' => $this->getView(),
            'dropDownCaret' => $this->dropDownCaret,
        ]);
    }
}
