<?php
use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model asinfotrack\yii2\wiki\models\Wiki */

$this->title = Html::encode($model->title);
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="wiki-content">
	<?= $model->contentProcessed ?>
</div>

<?= Button::widget([
	'tagName'=>'a',
	'label'=>Yii::t('app', 'Update'),
	'options'=>[
		'class'=>'btn-primary',
		'href'=>Url::to(['update', 'id'=>$model->id]),
	],
]) ?>
