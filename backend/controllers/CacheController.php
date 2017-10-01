<?php
namespace backend\controllers;

use common\enums\Role;
use backend\components\Controller;
use Yii;
use yii\filters\AccessControl;


class CacheController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [Role::ADMIN, Role::MANAGER],
                    ],
                ],
            ],
        ];
    }

    public function actionFlush()
    {
        // clear the cache of all loaded tables\
        Yii::$app->db->schema->refresh();
        echo "Schema cache flushed";
    }
}
