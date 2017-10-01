<?php

namespace common\models;

use common\enums\ImageType;
use common\helpers\HDates;
use common\helpers\HImage;
use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $link
 * @property string $scope
 * @property string $avatar
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CompanyLike[] $companyLikes
 * @property CompanySuggest[] $companySuggests
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'link','scope'], 'required'],
            [['name', 'link','scope','avatar'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'link' => Yii::t('app', 'Link'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyLikes()
    {
        return $this->hasMany(CompanyLike::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanySuggests()
    {
        return $this->hasMany(CompanySuggest::className(), ['company_id' => 'id']);
    }



    public function getLogoSrc()
    {
        return HImage::getSrc(ImageType::COMPANY, $this->getLogoUrl());
    }
    /**
     * получение урл до лого оффера
     */
    private function getLogoUrl()
    {
        return $this->avatar ? $this->avatar : Yii::$app->params['defaultAvatar'];
    }

    public function beforeSave($insert)
    {
        if($insert) {
            $this->created_at = HDates::long();
            $this->updated_at = HDates::long();
        } else {
            $this->updated_at = HDates::long();
        }
        return parent::beforeSave($insert);
    }
}
