<?php

namespace app\components\grid;

use Closure;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\DataColumn;

class LinkColumn extends DataColumn
{
    /** @var callable */
    public $url;

    /** @var bool */
    public $targetBlank = false;

    /** @var string */
    public $controller;

    /**
     * @inheritDoc
     */
    public $format = 'raw';

    protected function renderDataCellContent($model, $key, $index)
    {
        $value = $this->getDataCellValue($model, $key, $index);
        $text = $this->grid->formatter->format($value, $this->format);
        $url = $this->createUrl($model, $key, $index);
        $options = $this->targetBlank ? ['target' => '_blank'] : [];

        return $value === null ? $this->grid->emptyCell : Html::a($text, $url, $options);
    }

    public function createUrl($model, $key, $index)
    {
        if ($this->url instanceof Closure) {
            return call_user_func($this->url, $model, $key, $index);
        } else {
            $params = is_array($key) ? $key : ['id' => (string) $key];
            $params[0] = $this->controller ? $this->controller . '/view' : 'view';
            return Url::toRoute($params);
        }
    }
}
