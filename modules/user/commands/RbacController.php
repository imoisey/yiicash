<?php

namespace app\modules\user\commands;

use Yii;
use yii\helpers\Console;
use yii\console\Controller;
use app\components\RbacHelper;
use app\modules\user\models\User;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $assigments = [];
        foreach (User::find()->all() as $user) {
            $assigments[$user->id]['user'] = $user;
            foreach ($auth->getAssignments($user->id) as $a) {
                $assigments[$user->id]['roles'][] = $a->roleName;
            }
        }

        echo "Связка ролей с пользователями сохранена\n";
        $this->clear();

        RbacHelper::initRbac();

        // Назначаем все разрешения админу
        $admin = $auth->getRole(User::ROLE_ADMIN);
        foreach ($auth->getPermissions() as $perm) {
            $auth->addChild($admin, $perm);
        }

        // Присваем всем пользователям роль Сотрудник
        $employeer = $auth->getRole(User::ROLE_EMPLOYEER);
        foreach (User::find()->all() as $user) {
            if (is_null($auth->getAssignment($employeer->name, $user->id))) {
                $auth->assign($employeer, $user->id);
            }
        }

        $title = $this->ansiFormat("Результат инициализации RBAC", Console::BOLD);
        echo $title . "\n";

        $this->printPermissions();

        // Восстанавливаем роли пользователей
        foreach ($assigments as $userId => $obj) {
            $user = $obj['user'];
            if (isset($obj['roles']) && is_array($obj['roles'])) {
                foreach ($obj['roles'] as $roleName) {
                    // Если пользователю еще не назначена роль
                    if (is_null($auth->getAssignment($roleName, $userId))) {
                        // Получаем экземпляр роли
                        $role = $auth->getRole($roleName);
                        // Если роль найдена
                        if (!is_null($role)) {
                            $uname = $this->ansiFormat('#'.$user->id." - ".$user->getFullName(), Console::FG_PURPLE);
                            $rdesc = $this->ansiFormat($role->description, Console::FG_GREEN);
                            echo "Пользователю {$uname} была восстановлена роль {$rdesc}\n";
                            $auth->assign($role, $user->id);
                        }
                    }
                }
            }
        }
        echo "Связка ролей с пользователями восстановлена\n";
    }

    private function printPermissions()
    {
        $auth = Yii::$app->authManager;
        foreach ($auth->getRoles() as $role) {
            $rname = $this->ansiFormat($role->name, Console::BOLD);
            $rdesc = $this->ansiFormat($role->description, Console::FG_GREEN);
            if ($role->name == User::ROLE_ADMIN) {
                echo "Роль {$rdesc} ($rname) может все \n";
            } else {
                $perms = $auth->getPermissionsByRole($role->name);
                if (!empty($perms)) {
                    echo "Роли {$rdesc} {$rname} разрешено: \n";
                    foreach ($perms as $perm) {
                        $pname = $this->ansiFormat($perm->name, Console::BOLD);
                        $pdesc = $this->ansiFormat($perm->description, Console::FG_GREEN);
                        echo "\t * {$pdesc} - {$pname}\n";
                    }
                } else {
                    echo "Роли {$rdesc} ({$rname}} ничего не разрешено.\n";
                }
            }
        }
    }

    private function clear()
    {
        Yii::$app->authManager->removeAll();
        echo "Хранилище очищено\n";
    }
}
