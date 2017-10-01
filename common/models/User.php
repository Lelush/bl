<?php
namespace common\models;

use common\enums\Role;
use common\enums\UserStatus;
use common\helpers\HDates;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\bootstrap\Html;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property integer $status
 * @property string $ref
 * @property integer $parent
 * @property string $role
 * @property string $last_visit
 * @property string $created_at
 * @property string $updated_at
 * @property string $fullName
 *
 * @property Company $company
 * @property UserInfo $userInfo
 *
 * @property User            owner
 *  *
 * @method void touch($param)
 */
class User extends ActiveRecord implements IdentityInterface
{

    public $newPassword;
    public $rowSpan;
    public $hide;

    const SCENARIO_ADMIN_INSERT = 'scenario_admin_insert';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    function __toString()
    {
        return "#{$this->id} \"{$this->fullName}\"";
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()')
            ]

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_key', 'role'], 'required'],
            [['email', 'password_hash'], 'required'],
            [['email'], 'email'],
            [['email','phone'], 'unique'],
            [['phone'],'string'],
            [['role'], 'in', 'range' => Role::getValues()],
            [['newPassword'], 'required', 'on' => self::SCENARIO_ADMIN_INSERT],
            ['status', 'default', 'value' => UserStatus::ACTIVE],
            ['status', 'in', 'range' => UserStatus::getValues()],
            [['newPassword'], 'string', 'length' => [6, 25], 'message' => 'Пароль слишком простой, минимум 6 символов'],
            [['first_name', 'last_name'], 'string'],
            [['status'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'password' => 'Пароль',
            'newPassword' => 'Новый пароль',
            'status' => 'Статус',
            'role' => 'Роль',
            'email' => 'Почта',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'last_visit' => 'Последний вход',
            'last_name' => 'Фамилия',
            'first_name' => 'Имя',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInfo()
    {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => UserStatus::ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getAdminUrl()
    {
        return Url::to(['/users/view', 'id' => $this->id]);
    }


    public function getAdminLink()
    {
        return Html::a($this->username, $this->getAdminUrl());
    }

    /**
     * возвращает урл для просмотра пользователя.
     * @return string
     */
    public function getViewUrl()
    {
        return Url::to(['users/view', 'id' => $this->id]);
    }
    /**
     * Устанавливае статус пользователя на противоположный
     */
    public function toggleStatus(){
        $this->status = $this->status == UserStatus::DELETED ? UserStatus::ACTIVE : UserStatus::DELETED;
    }

    public function beforeSave($insert)
    {
        $this->username = $this->email;
        if($insert) {
            $this->created_at = HDates::long();
            $this->ref = \Yii::$app->getSecurity()->generateRandomString(24);
            $this->updated_at = HDates::long();
        } else {
            $this->updated_at = HDates::long();
        }
        return parent::beforeSave($insert);
    }

    /**
     * возвращет урл для переключения статуса
     * @return string
     */
    public function getToggleUrl()
    {
        return Url::to(['/users/toggle-status','id' => $this->id,]);
    }


    public function getDaysAfterRegistration(){
        if(is_array($this->created_at)){
            return false;
        }
        $from = strtotime($this->created_at);
        $to = time();
        return round(abs($to - $from)/60/60/24, 2);
    }





    /**
     * возвращает ФИО Юзера
     */
    public function getFullName()
    {
        $parts = [$this->last_name, $this->first_name];
        $parts = array_filter($parts, function ($value) { return !empty($value); });
        return implode(' ', $parts );
        //return trim($this->last_name . (empty($this->first_name) ? ' ' : ' ' . $this->first_name . ' ') . $this->middle_name);
    }

}
