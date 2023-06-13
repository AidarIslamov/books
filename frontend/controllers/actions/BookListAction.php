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
        
        public function applyFilter(ActiveQuery $query, $columns, $search)
        {
            return $query;
        }
    }