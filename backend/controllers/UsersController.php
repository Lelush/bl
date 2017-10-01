<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\UserForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param  $type
     * @return mixed
     */
    public function actionCreate($type)
    {
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validate($model),
                    ActiveForm::validate($model->modelCompany),
                    ActiveForm::validate($model->modelUserInfo)
                );
            }
            if ($model->save()) {
                $this->setFlash('success', ACTION_CREATE_SUCCESS);

                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                $this->setFlash('error', ACTION_VALIDATE_ERROR);
                $this->setFlash('error', var_export(ArrayHelper::merge($model->getErrors(),$model->modelUserInfo->getErrors()),true));
            }
        }

        $model->loadModels();
        return $this->render('create', [
            'model' => $model,
            'type' => $type,
        ]);

    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validate($model),
                    ActiveForm::validate($model->modelCompany),
                    ActiveForm::validate($model->modelUserInfo)
                );
            }
            if ($model->save()) {
                $this->setFlash('success', ACTION_CREATE_SUCCESS);

                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                $this->setFlash('error', ACTION_VALIDATE_ERROR);
                $this->setFlash('error', var_export(ArrayHelper::merge($model->getErrors(),$model->modelUserInfo->getErrors()),true));
            }
        }

        $model->loadModels();
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
