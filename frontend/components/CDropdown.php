<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\components;

use yii\base\InvalidConfigException;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

/**
 * Dropdown renders a Bootstrap dropdown menu component.
 *
 * For example,
 *
 * ```php
 * <div class="dropdown">
 *     <a href="#" data-toggle="dropdown" class="dropdown-toggle">Label <b class="caret"></b></a>
 *     <?php
 *         echo Dropdown::widget([
 *             'items' => [
 *                 ['label' => 'DropdownA', 'url' => '/'],
 *                 ['label' => 'DropdownB', 'url' => '#'],
 *             ],
 *         ]);
 *     ?>
 * </div>
 * ```
 * @see http://getbootstrap.com/javascript/#dropdowns
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @since 2.0
 */
class CDropdown extends Dropdown
{
    public $dropDownCaret;
    /**
     * Renders menu items.
     * @param array $items the menu items to be rendered
     * @param array $options the container HTML attributes
     * @return string the rendering result.
     * @throws InvalidConfigException if the label option is not specified in one of the items.
     */
    protected function renderItems($items, $options = [])
    {
        $lines = [];
        foreach ($items as $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            if (is_string($item)) {
                $lines[] = $item;
                continue;
            }
            if (!array_key_exists('label', $item)) {
                throw new InvalidConfigException("The 'label' option is required.");
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $icon = isset($item['icon']) ? $item['icon'] : false;
            if($icon){
                $iconOptions = isset($icon['options']) ? $icon['options'] : [];
                if(isset($icon['name'])){
                    $name = $icon['name'];
                    Html::addCssClass($iconOptions, [$name, 'pr5']);
                }
                $iconHtml = Html::tag(isset($icon['tag']) ? $icon['tag'] : 'span', null, $iconOptions);
                $label = $iconHtml . $label;
            }
            $itemOptions = ArrayHelper::getValue($item, 'options', []);
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            $linkOptions['tabindex'] = '-1';
            if(isset($itemOptions['class']) && !strpos($itemOptions['class'], 'dropdown-footer')){

            }else{
                Html::addCssClass($itemOptions, 'list-group-item');
                Html::addCssClass($linkOptions, ['animated', 'animated-short', 'fadeInUp']);

            }
            $url = array_key_exists('url', $item) ? $item['url'] : null;
            if (empty($item['items'])) {
                if ($url === null) {
                    $url = '#';
                }
                $content = Html::a($label, $url, $linkOptions);

            } else {
                $submenuOptions = !empty($this->submenuOptions) && $this->submenuOptions != false  ?$this->submenuOptions: $this->options;
                if (isset($item['submenuOptions'])) {
                    $submenuOptions = array_merge($submenuOptions, $item['submenuOptions']);
                }
                Html::addCssClass($linkOptions, ['widget' => 'accordion-toggle']);
                if ($this->dropDownCaret !== '') {
                    $label .= ' ' . $this->dropDownCaret;
                }
                $content = Html::a($label, $url === null ? '#' : $url, $linkOptions)
                    . $this->renderItems($item['items'], $submenuOptions);
            }

            $lines[] = Html::tag('li', $content, $itemOptions);
        }
        Html::addCssClass($options, ['list-group', 'dropdown-persist']);
        return Html::tag('ul', implode("\n", $lines), $options);
    }
}
