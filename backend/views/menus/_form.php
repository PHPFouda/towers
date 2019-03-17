<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Menus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <?php $languages = \common\models\Languages::find()->where(['active'=>1])->all();
        foreach ($languages as  $language) {
            $langNameVal = "";
            foreach ($model->menusTranslationsAll as  $menusTranslation) {
                if ($language->alias!= $menusTranslation->language_alias) continue;
                $langNameVal =$menusTranslation->name;
                break;
            }
            
            $MenusTranslations = new \common\models\MenusTranslations;
            $className = \yii\helpers\StringHelper::basename(get_class($MenusTranslations));
            if(isset($_POST[$className]['name'][$language->alias]))
                $langNameVal=$_POST[$className]['name'][$language->alias];
            
            echo '<div class="col-sm-6">';
            echo $form->field($MenusTranslations, 'name['.$language->alias.']')->textInput(['maxlength' => true,'value'=>$langNameVal])->label(yii::t('app','Name in '.$language->title));
            echo'</div>';
        }?>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <?php   //= $form->field($model, 'is_backend')->checkbox(['checked' => true]) ;
            $selected_parent = ($model->parent)?'+"&selected_parent='.$model->parent.'"':'';
                echo $form->field($model, 'is_backend')->dropDownList(['0'=>'No',1=>'Yes'], [
                        'prompt'=>'Select...',
                        'onchange'=>'$.post( "'.Yii::$app->urlManager->createUrl('menus/front-or-back-menus?is_backend=').'"+$(this).val()'.$selected_parent.', function( data ) {
                            $( "#menus-parent-select" ).html( data );
                    });','value'=>$model->is_backend]);
            ?>
        </div>
        <div class="col-sm-10">
            <div id="menus-parent-select"></div>
            <?php 
                /*
                echo $form->field($model, 'parent')->widget(kartik\select2\Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Menus::find()->joinWith('menusTranslations')->where(['active'=>1])->all(),'id','menusTranslations.name'),
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select a menu ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);*/
            ?>
        </div>
    </div>

    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox(['checked' => true]) ?> 
 

    <?php //= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php echo $this->registerJs('
    $(document).ready(function() {
    $("input[type=radio][name=is_backend]").change(function() {
        if (this.value == "0") {
            
        }else if (this.value == "1") {
            
        }
    });
});
');?>