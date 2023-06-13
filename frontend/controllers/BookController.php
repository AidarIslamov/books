<?php
    
    namespace frontend\controllers;
    
    use common\models\Author;
    use common\models\User;
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
                    'rules' => [
                        [
                            'actions' => ['list-data-table'],
                            'allow' => true,
                            'roles' => ['?', '@'],
                        ],
                        [
                            'actions' => ['index'],
                            'allow' => true,
                            'roles' => ['@'],
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
                'list-data-table' => BookListAction::class
            ];
        }
        
        public function actionIndex()
        {
            $authorsList = User::find()
                ->select(['user.id', 'user.username'])
                ->innerJoin(Author::tableName(), Author::tableName() . '.user_id = user.id')
                ->distinct()
                ->all()
            ;
            
            return $this->render('index', compact('authorsList'));
        }
    }