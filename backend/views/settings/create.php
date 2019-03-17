<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Settings */

$this->title = Yii::t('app', 'Create Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-create">

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
		</div>
		
		<?= $this->render('_form', [
			'model' => $model,
		]) ?>
	</div>

</div>
