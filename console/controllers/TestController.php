<?php
    
    namespace console\controllers;
    
    use common\components\Notification;
    use common\models\Book;
    
    class TestController extends \yii\console\Controller
    {
        public function actionSmsTest($id)
        {
            $book = Book::findOne(['id' => $id]);
            Notification::sendSMS($book, true);
        }
    }