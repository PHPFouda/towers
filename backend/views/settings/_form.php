<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

	<?php $form = ActiveForm::begin(); ?>

		<div class="box-body">
			<?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'setting_key')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'setting_value')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'is_editable')->checkbox(['checked' => true]) ?>
			<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
					</div>
		
		<div class="box-footer">
			<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>