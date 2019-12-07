<?php

use yii\db\Migration;
use app\modules\user\models\User;

/**
 * Class m191206_202207_add_roleid_in_users
 */
class m191206_202207_add_roleid_in_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(User::tableName(), 'role', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(User::tableName(), 'role');
    }
    
}
