<?php
    
    namespace frontend\controllers\actions;
    
    use nullref\datatable\DataTableAction;
    use common\models\Book;
    use yii\db\ActiveQuery;
    
    
    class BookListAction extends DataTableAction
    {
        public $requestMethod = DataTableAction::REQUEST_METHOD_POST;
        
        public function init()
        {
            $this->query = Book::find();
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
                            $query->joinWith('author')
                            ->andWhere(['author.user_id' => $column['search']['value']]);
                        }
                        else {
                            $query->andWhere(['LIKE', $column['data'], $column['search']['value']]);
                        }
                    }
                }
            }
            return $query;
        }
    }