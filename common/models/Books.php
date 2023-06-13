<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id ID
 * @property string $title Tittle of book
 * @property string $isbn ISBN
 * @property int $year Issue year
 * @property string|null $image_name Name of image
 * @property string|null $description Description of book
 * @property int $created_at
 * @property int $updated_at
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'isbn', 'year', 'created_at', 'updated_at'], 'required'],
            [['year', 'created_at', 'updated_at'], 'integer'],
            [['title', 'image_name'], 'string', 'max' => 50],
            [['isbn'], 'string', 'max' => 17],
            [['description'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Tittle of book',
            'isbn' => 'ISBN',
            'year' => 'Issue year',
            'image_name' => 'Name of image',
            'description' => 'Description of book',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\ActiveQuery\BooksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\ActiveQuery\BooksQuery(get_called_class());
    }
}
