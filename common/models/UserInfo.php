<?php

namespace common\models;

use common\enums\ImageType;
use common\helpers\HImage;
use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $avatar
 * @property string $about
 * @property integer $gender
 * @property string $scope
 *
 * @property string $fullName
 *
 * @property User $user
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender', 'scope'], 'required'],
            [['user_id','gender'], 'integer'],
            [['about'], 'string'],
            [['avatar', 'scope'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'avatar' => Yii::t('app', 'Avatar'),
            'about' => Yii::t('app', 'About'),
            'scope' => Yii::t('app', 'Scope'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getLogoSrc()
    {
        return HImage::getSrc(ImageType::USER, $this->getLogoUrl());
    }
    /**
     * получение урл до лого оффера
     */
    private function getLogoUrl()
    {
        return $this->avatar ? $this->avatar : Yii::$app->params['defaultAvatar'];
    }
}
