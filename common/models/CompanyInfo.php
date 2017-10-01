<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_info".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $avatar
 * @property string $about
 * @property string $link
 * @property string $scope
 * @property string $name
 *
 * @property User $user
 */
class CompanyInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['about'], 'string'],
            [['avatar', 'link', 'scope', 'name'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
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
            'link' => Yii::t('app', 'Link'),
            'scope' => Yii::t('app', 'Scope'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
