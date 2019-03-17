<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ItemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'barcode') ?>

    <?php // echo $form->field($model, 'imageUrl') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'sale_count') ?>

    <?php // echo $form->field($model, 'profitPercent') ?>

    <?php // echo $form->field($model, 'purchPrice') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'freeShipping') ?>

    <?php // echo $form->field($model, 'max_amount_in_order') ?>

    <?php // echo $form->field($model, 'isFeatured') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'inStock') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'price_old') ?>

    <?php // echo $form->field($model, 'tax') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
