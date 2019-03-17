<?php

namespace backend\controllers;

use Yii;
use common\models\Menus;
use common\models\MenusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenusController implements the CRUD actions for Menus model.
 */
class MenusController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Menus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Menus();

        if ($model->load(Yii::$app->request->post())) {
            //echo "<pre>";print_r(Yii::$app->request->post());echo"</pre>";die;

            $model->created = date("Y-m-d H:i:s",time());
            $languages = \common\models\Languages::find()->where(['active'=>1])->all();
            if(isset(Yii::$app->request->post()['MenusTranslations'])){
                $model->name = Yii::$app->request->post()['MenusTranslations']['name']['en'];
            }else{
                $model->addError("name","Menu Name can't be blank!");
            }

            if($model->validate(null, false)){
                $transaction = \Yii::$app->db->beginTransaction();
                try{
                    if(!$model->save())
                        throw new \yii\base\UserException("An eroror occour while saving college!");
                    if(isset(Yii::$app->request->post()['MenusTranslations'])){
                        foreach ($languages as $language) {
                            $collegeTranslations = new \common\models\MenusTranslations();
                            $collegeTranslations->menu_id = $model->id;
                            $collegeTranslations->language_alias = $language->alias;
                            $collegeTranslations->name = Yii::$app->request->post()['MenusTranslations']['name'][$language->alias];
                            if(!$collegeTranslations->save())
                                throw new \yii\base\UserException("An eroror occours while saving menu transaltion!");
                        }
                    }
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Menu has been added successfully');
                    return $this->redirect(['view', 'id' => $model->id]);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                   //throw $e;
                    Yii::$app->session->setFlash('error', $e);
                }
                
            }else{
                //echo "<pre>";print_r($model->Errors);die;
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Menus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $languages = \common\models\Languages::find()->where(['active'=>1])->all();
            if(isset(Yii::$app->request->post()['MenusTranslations'])){
                $model->name = Yii::$app->request->post()['MenusTranslations']['name']['en'];
            }else{
                $model->addError("name","Menu Name can't be blank!");
            }

            if($model->validate()){
                $transaction = \Yii::$app->db->beginTransaction();
                try{
                    if(!$model->save())
                        throw new \yii\base\UserException("An eroror occour while saving college!");
                    if(isset(Yii::$app->request->post()['MenusTranslations'])){
                        foreach ($languages as $language) {
                            $menuTranslations = \common\models\MenusTranslations::findOne([
                                'menu_id' => $model->id,
                                'language_alias' => $language->alias,
                            ]);
                            if(!$menuTranslations){
                                $menuTranslations = new \common\models\MenusTranslations();
                                $menuTranslations->menu_id = $model->id;
                                $menuTranslations->language_alias = $language->alias;
                            }
                            $menuTranslations->name = Yii::$app->request->post()['MenusTranslations']['name'][$language->alias];
                            if(!$menuTranslations->save())
                                throw new \yii\base\UserException("An eroror occours while saving menu transaltions!");
                        }
                    }
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Menu has been updated successfully');
                    return $this->redirect(['view', 'id' => $model->id]);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    //throw $e;
                    Yii::$app->session->setFlash('error', $e);
                }
            }else{
                //echo "<pre>";print_r($model->Errors);die;
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Menus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFrontOrBackMenus($is_backend, $selected_parent = null) {
        $Menus = \common\models\Menus::find()
                ->joinWith('menusTranslations')
                ->where(['active'=>1,'is_backend'=>$is_backend])
                ->all();
        $output = '';
        $output .= '<div class="form-group field-menus-parent has-success">
                <label class="control-label" for="menus-parent">Parent</label>';
        $output .= '<select name="Menus[parent]" id="menu-parent" class="form-control">';
        $output .= '<option value="">Select a menu ...</option>';
        if(count($Menus)>0){
            foreach($Menus as $Menu){
                $selected = ($selected_parent == $Menu->id)?'selected="selected"':'';
                $output .= "<option value='".$Menu->id."' $selected>";
                $output .= $Menu->menusTranslations->name;
                $output .= "</option>";
            }
        }
         $output .='</select>';
         $output .='<div class="help-block"></div>';
         $output .='</div>';
        echo $output;
    }
}
