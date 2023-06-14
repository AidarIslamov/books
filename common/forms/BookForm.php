<?php
    
    
    namespace common\forms;
    
    
    use common\models\Author;
    use yii\base\Model;
    
    class BookForm extends Model
    {
        private $_book;
        
        
        /**
         * @var integer
         */
        public $id;
        
        /**
         * @var string
         */
        public $title;
        
        /**
         * @var $isbn
         */
        public $isbn;
        
        /**
         * @var int
         */
        public $year;
        
        /**
         * @var string|null
         */
        public $image_name;
        
        /**
         * @var string|null
         */
        public $description;
        
        /**
         * @var array
         */
        public $author;
        
        public $file;
        
        
        public function rules()
        {
            return [
                [['title', 'isbn', 'year'], 'required'],
                [['year'], 'integer'],
                [['title', 'image_name'], 'string', 'max' => 50],
                [['isbn'], 'string', 'max' => 17],
                [['description'], 'string', 'max' => 256],
                [['file'], 'file', 'skipOnEmpty' => false],
                ['author', 'each', 'rule' => ['integer']]
            ];
        }
    }