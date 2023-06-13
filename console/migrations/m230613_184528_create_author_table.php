<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m230613_184528_create_author_table extends Migration
{
    
    const TABLE_NAME = '{{%author}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('ID of user'),
            'book_id' => $this->integer()->notNull()->comment('ID of book')
        ]);
        
        $this->createIndex('IDX_author__user_id', self::TABLE_NAME, 'user_id');
        $this->createIndex('IDX_author__book_id', self::TABLE_NAME, 'book_id');
        
        $this->addForeignKey('FK_author__user_id', self::TABLE_NAME, 'user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('FK_author__book_id', self::TABLE_NAME, 'book_id', '{{%book}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
