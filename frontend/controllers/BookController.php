<?php
    
    namespace frontend\controllers;
    
    use common\models\Author;
    use common\models\Book;
    use common\models\User;
    use frontend\controllers\actions\BookListAction;
    use yii\filters\AccessControl;
    use yii\web\Controller;
    use yii\web\ForbiddenHttpException;
    use yii\web\NotFoundHttpException;
    use Yii;
    use yii\web\UploadedFile;
    
    class BookController extends Controller
    {
        public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['list-data-table', 'read'],
                            'allow' => true,
                            'roles' => ['?', '@'],
                        ],
                        [
                            'actions' => ['index', 'edit', 'create'],
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
        
        
        /**
         * Books list (for authenticated users only)
         *
         * @return string
         */
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
        
        public function actionRead($id)
        {
            if (!$book = Book::findOne(['id' => $id])) {
                throw new NotFoundHttpException('Book not found');
            }
            
            return $this->render('read', compact('book'));
        }
        
        
        /**
         * Edit book (for book owner)
         *
         * @param $id
         *
         * @return array|string|\yii\web\Response
         * @throws ForbiddenHttpException
         * @throws NotFoundHttpException
         * @throws \Throwable
         * @throws \yii\db\StaleObjectException
         */
        public function actionEdit($id)
        {
            if (!$book = Book::find()
                ->innerJoinWith('author')
                ->where([Book::tableName() . '.id' => $id])
                ->one()) {
                throw new NotFoundHttpException('Book not found');
            }
            
            if(!$book->isAuthor()) {
                throw new ForbiddenHttpException('Book not your');
            }
            
            if(Yii::$app->request->isDelete) {
                return $this->asJson(['success' => $book->delete()]);
            }
            
            if(Yii::$app->request->isPost && $book->load(Yii::$app->request->post())) {
                if(!$book->save()) {
                    return $book->errors;
                }
                $book->refresh();
                
                if(!$book->isAuthor()) {
                    throw new ForbiddenHttpException('Book not your');
                }
            }
            
            // $file = UploadedFile::getInstanceByName("file");
            
            $this->view->title = 'Edit book';
            $authors = User::find()->all();
            
            return $this->render('edit', compact('book', 'authors'));
        }
        
        
        /**
         * Create book
         *
         * @return string|\yii\web\Response
         */
        public function actionCreate()
        {
            $book = new Book();
            if(Yii::$app->request->isPost && $book->load(Yii::$app->request->post())) {
                if($book->_file = UploadedFile::getInstance($book, '_file')) {
                    if ($url = $book->upload()) {
                        $book->image_name = $url;
                    }
                }
                
                if($book->save()) {
                    return $this->redirect(\yii\helpers\Url::toRoute(['/book']));
                }
                
            }
            
            $this->view->title = 'Create book';
            $authors = User::find()->all();
            
            return $this->render('create', compact('book', 'authors'));
        }
        
    }