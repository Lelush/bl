<?php

namespace common\models;

use common\enums\ImageType;
use common\helpers\HImage;
use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "user_info".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $avatar
 * @property string $about
 * @property integer $gender
 * @property string $scope
 * @property string $prof
 * @property string $interests
 * @property string $state
 * @property string $vk
 * @property string $tw
 * @property string $fb
 * @property string $inst
 *
 * @property string $avatarSrc
 * @property string $fullName
 * @property string $interestsJson
 * @property array  $interestsArray
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
            [[/*'gender',*/
                'scope'], 'required'],
            [['user_id', 'gender', 'scope'], 'integer'],
            [['about'], 'string'],
            [['avatar', 'prof', 'interests', 'state', 'vk', 'fb', 'inst', 'tw'], 'string', 'max' => 255],
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

    public function getAvatarSrc()
    {
        return HImage::getSrc(ImageType::USER, $this->getAvatarUrl());
    }

    /**
     * получение урл до лого оффера
     */
    private function getAvatarUrl()
    {
        return $this->avatar ? $this->avatar : Yii::$app->params['defaultAvatar'];
    }

    public function getInterestsArray()
    {
        return $this->interests ? explode(',', $this->interests) : [];
    }


    public function getInterestsJson()
    {
        return Json::encode($this->getInterestsArray());
    }
}
