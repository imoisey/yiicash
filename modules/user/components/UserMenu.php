<?php

namespace app\modules\user\components;

use app\components\RbacHelper;
use yii\bootstrap\Nav;
use yii\helpers\VarDumper;

class UserMenu extends Nav
{
    public function init()
    {
        parent::init();
        $this->applyPermissions($this->items);
    }

    protected function applyPermissions(&$items)
    {
        $allVisible = false;

        foreach ($items as &$item) {
            if (isset($item['visible']) && $item['visible'] === false) {
                return false;
            }

            if (isset($item['url']) && !in_array($item['url'], ['', '#'])) {
                $item['visible'] = RbacHelper::can(RbacHelper::Route2rbac($item['url']));
            }

            if (isset($item['items'])) {
                if (!$this->applyPermissions($item['items'])) {
                    $item['visible'] = false;
                }
            }

            if (isset($item['label']) && (!isset($item['visible']) || $item['visible'] === true)) {
                $allVisible = true;
            }
        }

        return $allVisible;
    }
}
