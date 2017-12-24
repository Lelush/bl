<?php

namespace frontend\models;

use common\components\MultipleModel;
use common\enums\Role;
use common\helpers\HDev;
use common\models\Company;
use common\models\CompanyInfo;
use common\models\UserInfo;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;
use yii\db\ActiveRecord;

/**
 * UserForm represents the model behind the search form about `common\models\User`.
 */
class UserForm extends User
{

    const PASSWORD_LENGTH = 8;
    /**
     * @var UserInfo
     */
    public $modelUserInfo;
    /**
     * @var Company
     */
    public $modelCompany;

    public $bd_day;
    public $bd_month;
    public $bd_year;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bd_day', 'bd_month','bd_year'],'required', 'on'=>'signup', 'message'=>'Укажите {attribute}'],
            [['birthday'],'validateBirthday', 'on'=>'signup'],
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['first_name', 'last_name'],'required'],
            [['id', 'status', 'parent'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'ref', 'role', 'last_visit', 'created_at', 'updated_at'], 'safe'],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой номер уже зарегистрирован.', 'on'=>'signup'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.', 'on'=>'signup'],


            ['password', 'required', 'on'=>'signup'],
            ['password', 'string', 'min' => 6, 'on'=>'signup'],
        ];
    }

    public function validateBirthday($attribute, $params, $validator)
    {
        $this->birthday = $this->bd_year.'-'.$this->bd_month.'-'.$this->bd_day;
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'parent' => $this->parent,
            'last_visit' => $this->last_visit,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'role', $this->role]);

        return $dataProvider;
    }

    public function attributeLabels()
    {
        return array_merge([
            'bd_day' => 'День',
            'bd_month' => 'Месяц',
            'bd_year' => 'Год',
        ],parent::attributeLabels());
    }

    public function loadModels()
    {
        $this->modelUserInfo = $this->userInfo ?: new UserInfo();
        $this->modelCompany = $this->company ?: new Company();
    }


    /**
     * @inheritdoc
     */
    public function load($data, $formName = null)
    {


        if (!parent::load($data, $formName)) {
            return false;
        }
        $this->modelUserInfo = MultipleModel::loadOne(UserInfo::classname(), $data);
        $this->modelCompany = MultipleModel::loadOne(Company::classname(), $data);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function validate($attributeNames = null, $clearErrors = true)
    {
        if($this->role == Role::USER) {
            return parent::validate() && (is_a($this->modelUserInfo,UserInfo::className()) && $this->modelUserInfo->validate());
        }
        if($this->role == Role::COMPANY) {
            return parent::validate() && (is_a($this->modelCompany,Company::className()) && $this->modelCompany->validate());
        }
        return parent::validate();
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->username = $this->email;
            if($this->password) {
                $this->newPassword = $this->password;
            } else {
                $this->newPassword = Yii::$app->security->generateRandomString(self::PASSWORD_LENGTH);
            }
            $this->setPassword($this->newPassword);
            $this->generateAuthKey();
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * после создания отправлять почту
     *
     * @param bool  $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if($this->role == Role::USER) {
            $this->saveModel($this->userInfo, $this->modelUserInfo);
        }
        if($this->role == Role::COMPANY) {
            $this->saveModel($this->company, $this->modelCompany);
        }
        if ($insert) {
            $this->refresh();
            Yii::$app->mailer->compose('mail_create_user', ['user' => $this])->setFrom(Yii::$app->params['adminEmail'])->setTo($this->email)->setSubject("Регистрация в системе")->send();
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @param $oldModel ActiveRecord
     * @param $newModel ActiveRecord
     */
    private function saveModel($oldModel, $newModel)
    {
        $newModel->user_id = $this->id;
        if ($oldModel) {
            $oldModel->attributes = $newModel->attributes;
            if (!$oldModel->save()) {
                HDev::logSaveError($oldModel);
            }
        } else {
            if (!$newModel->save()) {
                HDev::logSaveError($oldModel);
            }
        }
    }

}
