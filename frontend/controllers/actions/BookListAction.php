<?php
    
    namespace frontend\controllers\actions;
    
    use nullref\datatable\DataTableAction;
    use common\models\Book;
    use yii\db\ActiveQuery;
    use Yii;
    
    
    class BookListAction extends DataTableAction
    {
        public $requestMethod = DataTableAction::REQUEST_METHOD_POST;
        
        public function init()
        {
            $this->query = Book::find()
                ->joinWith('author');
            parent::init();
        }
        
        /**
         * @param ActiveQuery $query
         * @param array       $columns
         * @param array       $search
         *
         * @return ActiveQuery
         */
        public function applyFilter(ActiveQuery $query, $columns, $search)
        {
            foreach ($columns as $column) {
                if($column['searchable'] != 'false') {

                    if (!empty($column['search']) && !empty($column['search']['value']) ) {
                        if($column['data'] == 'author') {
                            $query->andWhere(['author.user_id' => $column['search']['value']]);
                        }
                        else {
                            $query->andWhere(['LIKE', $column['data'], $column['search']['value']]);
                        }
                    }
                }
            }
            
            if($this->getParam('only_my', false) == 'true' && $currentUser = Yii::$app->user) {
                $query->andWhere(['author.user_id' => $currentUser->id]);
            }
            return $query;
        }
    }