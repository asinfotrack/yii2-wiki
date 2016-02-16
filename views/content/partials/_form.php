<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model asinfotrack\yii2\wiki\models\Wiki */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['enableClientValidation'=>false]); ?>

	<?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'content')->textarea(['rows'=>20]) ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

<?php ActiveForm::end(); ?>
