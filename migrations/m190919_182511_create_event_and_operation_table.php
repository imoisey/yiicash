<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_and_operation}}`.
 */
class m190919_182511_create_event_and_operation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'total' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-event-author_id', '{{%event}}', 'author_id');
        $this->addForeignKey(
            'fk-event-author_id', 
            '{{%event}}', 
            'author_id', 
            '{{%user}}', 
            'id', 
            'CASCADE', 
            'CASCADE'
        );

        $this->createTable('{{%operation}}', [
            'event_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'type' => 'ENUM("+","-")',
            'amount' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-operation-event_id-user_id', 
            '{{%operation}}',
            ['event_id', 'user_id']
        );

        $this->addForeignKey(
            'fk-operation-event_id', 
            '{{%operation}}', 
            'event_id', 
            '{{%event}}', 
            'id', 
            'CASCADE', 
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-operation-user_id', 
            '{{%operation}}', 
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
        $this->dropForeignKey('fk-event-author_id', '{{%event}}');
        $this->dropForeignKey('fk-operation-event_id', '{{%operation}}');
        $this->dropForeignKey('fk-operation-user_id', '{{%operation}}');

        $this->dropIndex('idx-event-author_id', '{{%event}}');
        $this->dropIndex('idx-operation-event_id-user_id', '{{%operation}}');
        
        $this->dropTable('{{%event}}');
        $this->dropTable('{{%operation}}');
    }
}
