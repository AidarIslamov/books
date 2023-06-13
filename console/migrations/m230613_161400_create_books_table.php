<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m230613_161400_create_books_table extends Migration
{
    
    const TABLE_NAME = '{{%books}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID'),
            'title' => $this->string(50)->notNull()->comment('Tittle of book'),
            'isbn' => $this->string(17)->notNull()->comment('ISBN'),
            'year' => $this->integer(4)->notNull()->comment('Issue year'),
            'image_name' => $this->string(50)->defaultValue(null)->comment('Name of image'),
            'description' => $this->string(256)->defaultValue(null)->comment('Description of book'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
        
        $this->createIndex('IDX_books__title', self::TABLE_NAME, 'title');
        $this->createIndex('IDX_books__isbn', self::TABLE_NAME, 'isbn');
        $this->createIndex('IDX_books__year', self::TABLE_NAME, 'year');
        $this->createIndex('IDX_books__created_at', self::TABLE_NAME, 'created_at');
        $this->createIndex('IDX_books__updated_at', self::TABLE_NAME, 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
