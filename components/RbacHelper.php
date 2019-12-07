<?php

namespace app\components;

use Yii;
use yii\base\Component;
use app\modules\user\models\User;
use yii\helpers\VarDumper;

class RbacHelper extends Component
{
    public static function getPermissions()
    {
        return [
            'user/users/create' => [
                'description' => 'Пользователи / Создание',
                'allow' => [],
            ],

            'user/users/update' => [
                'description' => 'Пользователи / Редактирование',
                'allow' => [],
            ],

            'user/users/view' => [
                'description' => 'Пользователи / Просмотр',
                'allow' => [],
            ],

            'user/users/delete' => [
                'description' => 'Пользователи / Удаление',
                'allow' => [],
            ],

            'user/users/index' => [
                'description' => 'Пользователи / Список',
                'allow' => [],
            ],

            'main/events/create' => [
                'description' => 'События / Создание',
                'allow' => [User::ROLE_EMPLOYEER],
            ],

            'main/events/index' => [
                'description' => 'События / Список',
                'allow' => [User::ROLE_EMPLOYEER],
            ],

            'main/reports/index' => [
                'description' => 'Отчет / Просмотр',
                'allow' => [User::ROLE_EMPLOYEER],
            ],

            'user/profile/index' => [
                'description' => 'Профиль / Просмотр',
                'allow' => [User::ROLE_EMPLOYEER],
            ],

            'user/profile/update' => [
                'description' => 'Профиль / Редактирование',
                'allow' => [User::ROLE_EMPLOYEER],
            ],

            'user/profile/password-change' => [
                'description' => 'Профиль / Смена пароля',
                'allow' => [User::ROLE_EMPLOYEER]
            ],

            'user/default/logout' => [
                'description' => 'Выйти',
                'allow' => [User::ROLE_EMPLOYEER]
            ]
        ];
    }

    public static function initRbac()
    {
        $auth = Yii::$app->authManager;

        $roles = [];
        // инициализация ролей
        foreach (User::getRolesArray() as $roleId => $name) {
            $role = $auth->createRole($roleId);
            $role->description = $name;
            $roles[$roleId] = $role;
            $auth->add($role);
        }

        // инициализация разрешения
        foreach (self::getPermissions() as $id => $options) {
            $perm = $auth->createPermission($id);

            if (isset($options['description'])) {
                $perm->description = $options['description'];
            }

            if (isset($options['rule'])) {
                $className = $options['rule'];
                /** @var Rule $rule */
                $rule = new $className;
                $auth->add($rule);
                $perm->ruleName = $rule->name;
            }
            $auth->add($perm);

            if (isset($options['allow']) && is_array($options['allow'])) {
                foreach ($options['allow'] as $roleName) {
                    $role = isset($roles[$roleName]) ? $roles[$roleName] : $auth->getRole($roleName);
                    $auth->addChild($role, $perm);
                }
            }
            unset($perm);
        }
    }

    public static function Route2rbac($route)
    {
        if (is_array($route) && isset($route[0])) {
            $route = $route[0];
        }

        $parts = explode('/', $route);
        if (count($parts) > 0) {
            $route = '';
            $end_parts_index = count($parts) - 1;
            for ($i = 0; $i <= $end_parts_index; $i++) {
                if (!empty($parts[$i])) {
                    if ($i < $end_parts_index) {
                        $route .= $parts[$i].'/';
                    } else {
                        $route .= $parts[$i];
                    }
                }
            }
        }
        return $route;
    }


    public static function can($permissionName, $param = [])
    {
        $auth = Yii::$app->authManager;
        $perm = $auth->getPermission($permissionName);

        if (is_null($perm)) {
            Yii::warning('Для маршрута '.$permissionName.' не определено разрешение в хранилище RBAC', 'users');
            return false;
        }

        if (Yii::$app->user->isGuest) {
            return false;
        }

        return Yii::$app->user->can($permissionName, $param);
    }
}
