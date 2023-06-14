<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

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
    
    public $_file;
    
    public $_author;
    
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
                'value'      => new Expression('UNIX_TIMESTAMP()'),
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
            ['_author', 'each', 'rule' => ['integer']]
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
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->viaTable(Author::tableName(), ['book_id' => 'id']);
    }
    
    /**
     * @param $insert
     * @param $changedAttributes
     *
     * @return void
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if($this->_author) {
            $currentAuthorList = ArrayHelper::getColumn($this->author, 'id');
            
            // add new author
            foreach (array_diff($this->_author, $currentAuthorList) as $userId) {
                $this->addAuthor($userId);
                $currentAuthorList[]=$userId;
            }
            
            // delete author
            foreach (array_diff($currentAuthorList, $this->_author) as $userId) {
                $this->removeAuthor($userId);
            }
        }
    }
    
    
    /**
     * Check user is author of book
     *
     * @param $userId
     *
     * @return bool
     */
    public function isAuthor($userId = null) {
        if($userId) {
            return in_array($userId, ArrayHelper::getColumn($this->author, 'id'));
        }
        return in_array(user()->id, ArrayHelper::getColumn($this->author, 'id'));
    }
    
    /**
     * @param $userId
     *
     * @return bool
     */
    private function addAuthor($userId)
    {
        $author = new Author();
        $author->setAttributes([
            'book_id' => $this->id,
            'user_id' => $userId
        ]);
        return $author->save();
    }
    
    /**
     * @param $userId
     *
     * @return false|int
     */
    private function removeAuthor($userId)
    {
        $author = Author::findOne(['book_id' => $this->id, 'user_id' => $userId]);
        return $author->delete();
    }
    
    
}
