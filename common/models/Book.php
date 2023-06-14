<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "book".
 *
 * @property int $id ID
 * @property string $title Tittle of book
 * @property string $isbn ISBN
 * @property int $year Issue year
 * @property string|null $image_name Name of image
 * @property string|null $description Description of book
 * @property int $created_at
 * @property int $updated_at
 *
 *
 * @property User[] $author
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%book}}';
    }
    
    public function behaviors()
    {
        return [
            [
                'class'      => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => [
                        'created_at',
                        'updated_at',
                    ],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value'      => new Expression('NOW()'),
            ],
        ];
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
     * @return \common\models\ActiveQuery\BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\ActiveQuery\BookQuery(get_called_class());
    }
    
    public function getAuthor()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->viaTable(Author::tableName(), ['book_id' => 'id']);
    }
}
