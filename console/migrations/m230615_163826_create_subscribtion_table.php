<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscribtion}}`.
 */
class m230615_163826_create_subscribtion_table extends Migration
{
    const TABLE_NAME = '{{%subscribtion}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('User name'),
            'phone' => $this->string(12)->notNull()->comment('User phone'),
            'email' => $this->string()->defaultValue(null)->comment('Email of user'),
            'author_id' => $this->integer()->notNull()->comment('ID of author'),
            'created_at' => $this->timestamp()->defaultValue(null)->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP')
        ]);
        
        $this->createIndex('IDX_subscribtion__name', self::TABLE_NAME, 'name');
        $this->createIndex('IDX_subscribtion__phone', self::TABLE_NAME, 'phone');
        $this->createIndex('IDX_subscribtion__email', self::TABLE_NAME, 'email');
        $this->createIndex('IDX_subscribtion__author_id', self::TABLE_NAME, 'author_id');
        
        $this->addForeignKey('FK_subscribtion__author_id', self::TABLE_NAME, 'author_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
