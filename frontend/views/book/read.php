<?php
    
    use yii\helpers\Url;
    use yii\web\View;
    use common\models\Book;
    use common\models\User;
    
    /**
     * @var Book $book
     */
    
    ?>


<div class="body-content">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="/images/<?=$book->image_name ?>" alt="Card image cap">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Title:</b> <?=$book->title?></li>
                    <li class="list-group-item"><b>Year:</b> <?=$book->year?></li>
                    <li class="list-group-item"><b>ISBN:</b> <?=$book->isbn?></li>
                    <li class="list-group-item"><b>Author:</b>
                        <?php
                            /**
                             * @var User $user
                             */
                            foreach ($book->author as $user):
                        ?>
                            <?=$user->username ?>
                        <?php endforeach; ?>
                    </li>
                </ul>
                <div class="card-body">
                    <p class="card-text"><?=$book->description?></p>
                </div>
            </div>
        </div>
    </div>
</div>

