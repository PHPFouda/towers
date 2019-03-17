<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */

$name = $model->title;
$this->title = Yii::t('app', 'Update Settings') .': '. $name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="settings-update">

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
		</div>
		
		<?= $this->render('_form', [
			'model' => $model,
		]) ?>
	</div>

</div>
