<?php
    
    namespace frontend\controllers;
    
    use frontend\controllers\actions\BookListAction;
    use yii\filters\AccessControl;
    use yii\web\Controller;
    
    class BookController extends Controller
    {
        public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['list'],
                    'rules' => [
                        [
                            'actions' => ['list'],
                            'allow' => true,
                            'roles' => ['?', '@'],
                        ],
                    ],
                ],
            ];
        }
        
        public function actions()
        {
            return [
                'error' => [
                    'class' => \yii\web\ErrorAction::class,
                ],
                'list' => BookListAction::class
            ];
        }
    }