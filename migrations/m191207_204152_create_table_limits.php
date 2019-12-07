<?php

use yii\db\Migration;

/**
 * Class m191207_204152_create_table_limits
 */
class m191207_204152_create_table_limits extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%limits}}', [
            'user_id' => $this->integer()->unique(),
            'award' => $this->integer()->notNull(),
            'penalty' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-limits-user_id', '{{%limits}}', 'user_id');
        $this->addForeignKey(
            'fk-limits-user_id',
            '{{%limits}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-limits-user_id', '{{%limits}}');
        $this->dropIndex('idx-limits-user_id', '{{%limits}}');
        $this->dropTable('{{%limits}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191207_204152_create_table_limits cannot be reverted.\n";

        return false;
    }
    */
}
