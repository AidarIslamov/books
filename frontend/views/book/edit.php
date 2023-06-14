<?php
    
    use common\models\Book;
    use common\models\User;
    use yii\bootstrap5\ActiveForm;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    
    /** @var Book $book */
    /** @var User[] $authors */
    
?>


<div class="body-content">
    <div class="row">
        <div class="col-12">
            <?php
                $form = ActiveForm::begin([
                    'id' => 'form-edit-book',
                ]);
                ?>
                <?= $form->field($book, 'file')->fileInput() ?>
                <?= $form->field($book, 'id')->hiddenInput()->label(false) ?>
                <?= $form->field($book, 'title')->textInput()->label('Title') ?>
                <?= $form->field($book, 'isbn')->textInput() ?>
                <?= $form->field($book, 'description')->textarea(['rows'=>2])->label('Description') ?>
                <?= $form->field($book, 'year')->textInput([
                    'type' => 'number',
                    'max'=> date('Y'),
                ]) ?>
            
                <?= $form->field($book, 'author')->dropDownList(
                    ArrayHelper::map($authors, 'id', 'username'),
                    ['multiple' => true, 'value' => user()->id]
                ) ?>
                
                <?= Html::submitButton('Save', [
                    'class' => 'btn btn-success',
                    'name' => 'save',
                    'form' => 'form-edit-book',
                ]) ?>
                <?= Html::resetButton('Delete book', [
                    'class' => 'btn btn-danger',
                    'name' => 'save-and-exit',
                    'form' => 'form-edit-book',
                ]) ?>
            
            <?php
                ActiveForm::end();
            ?>
        
        </div>
    </div>

</div>
