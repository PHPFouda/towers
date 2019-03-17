<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Menus */

$name = ($model->menusTranslations)?$model->menusTranslations->name:$model->name;
$this->title = $name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute' => 'name','value' => $name],
            //'parent',
            [
                'attribute' => 'parent',
                'value' => function ($model) {
                    //return $model->getPrerequisitesCourses($model->id);
                    $return = null;
                    if($model->parent){
                        if($model->parent->menusTranslations)
                            $return = $model->parent->menusTranslations->name;
                    }
                    return $return;
                },
                //'header'=>yii::t('app','prerequisite_sign')
            ],
            'route',
            'order',
            'data',
            'active:boolean',
            'is_backend:boolean',
            'created',
        ],
    ]) ?>

</div>
