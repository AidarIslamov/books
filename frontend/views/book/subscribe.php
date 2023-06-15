<?php
    
    use common\models\User;
    use common\models\Subscribtion;
    use yii\bootstrap5\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\web\View;
    
    /** @var View $this */
    /** @var User $authors */
    /** @var Subscribtion $model */

?>


<div class="body-content">
    <div class="row">
        <div class="col-12">
            
            <?php
                $form = ActiveForm::begin([
                    'id' => 'form-subscription',
                ]);
            ?>
            <?= $form->field($model, 'name')->label('Name')?>
            <?= $form->field($model, 'phone')->label('Phone')?>
            <?= $form->field($model, 'email')->label('Email')?>
            
            <?= $form->field($model, '_authors')->dropDownList(
                    ArrayHelper::map($authors, 'id', 'username'),
                    ['multiple' => true, 'value' => $model->_authors]
                ); ?>
            
            <?= Html::submitButton('Save', [
                'class' => 'btn btn-success',
                'name' => 'save',
                'form' => 'form-subscription',
            ]) ?>
            <?php
                ActiveForm::end();
            ?>
        
        </div>
    </div>

</div>
    
