<?php

namespace frontend\controllers;

use Yii;
use common\models\Orders;
use common\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
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
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
		$modelOrderDetail = new \common\models\OrderDetail();

		if ($modelOrderDetail->load(Yii::$app->request->post())) {
			//echo "<pre>";print_r(Yii::$app->request->post());echo"</pre>";die;

			
			$subTotal = 0;
			if(isset(Yii::$app->request->post()['OrderDetail']['item_id']) && isset(Yii::$app->request->post()['OrderDetail']['quantity'])){
				
				$items = Yii::$app->request->post()['OrderDetail']['item_id'];
				$quantities = Yii::$app->request->post()['OrderDetail']['quantity'];
				if(count($quantities) != count($items))
					$modelOrderDetail->addError('quantity',"يجب ملأ غانة الصنف والكمية");
				$mergeArray = array_combine($items, $quantities);
				
				if($mergeArray){
					foreach ($mergeArray as $item => $quantity) {
						$itemRow = \common\models\Items::findOne($item);
						if($itemRow)
							$subTotal += $itemRow->price;
					}
				}
				
			}else{
				$modelOrderDetail->addError('quantity',"يجب ملأ غانة الصنف والكمية");
			}
			$model->user_id = Yii::$app->user->identity->id;
			$model->order_status = 1;
			$model->tax = 0;
			$model->shipping = 0;
			$model->subtotal = $subTotal;
			$model->total = $subTotal;
			$model->paid = 0;
			$model->due = $subTotal;
			$model->additional_fees = 0;
			$model->created = date("Y-m-d H:i:s",time());
			if($model->validate(null, false)){
				
				$transaction = \Yii::$app->db->beginTransaction();
				try{
					if(!$model->save())
						throw new \yii\base\UserException("حدث خطأ عند حفظ الطلب");
					
						if($mergeArray){
							foreach ($mergeArray as $item => $quantity) {
								$itemRow = \common\models\Items::findOne($item);
								if($itemRow){
									$orderDetail = new \common\models\OrderDetail();
									$orderDetail->order_id = $model->id;
									$orderDetail->item_id = $itemRow->id;
									$orderDetail->quantity = $quantity;
									$orderDetail->price = $itemRow->price;
									$orderDetail->purchPrice = $itemRow->purchPrice;
									$orderDetail->profitPercent = $itemRow->profitPercent;
									$orderDetail->tax = $itemRow->tax;
									if(!$orderDetail->save())
										throw new \yii\base\UserException("حدث خطأ عند حفظ بيانات الطلب".print_r($orderDetail->Errors, 1));
									$itemRow = \common\models\Items::findOne($item);
									if($itemRow){
										$itemRow->quantity -= $quantity;
										if(!$itemRow->save())
											throw new \yii\base\UserException("حدث خطأ عند تعديل كمية الصنف".print_r($orderDetail->Errors, 1));
									}
									
								}
							}
						}
					
					$transaction->commit();
					Yii::$app->session->setFlash('success', yii::t('app','تم الحفظ بنجاح!'));
					
					return $this->redirect(['view', 'id' => $model->id]);
				} catch (\Exception $e) {
					$transaction->rollBack();
					Yii::$app->session->setFlash('error', $e->getMessage());
					//throw $e;
				}
			}else{
				//echo "<pre>xccxc";print_r($modelOrderDetail->Errors);echo"</pre>";
				//echo "<pre>";print_r($model->Errors);echo"</pre>";die;
			}
		}

		return $this->render('create', [
            'model' => $model,
            'modelOrderDetail' => $modelOrderDetail
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
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
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
