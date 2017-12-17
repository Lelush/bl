<?php

namespace frontend\models;

use common\components\MultipleModel;
use common\enums\Role;
use common\enums\UserCategory;
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
class FriendsForm extends User
{

    public $discounter;
    public $popular;
    public $luxury;
    public $rich;
    public $tourist;
    public $name;

    public $friends;
    public $people;

    public function rules()
    {
        return [
            [['discounter', 'popular', 'luxury', 'rich', 'tourist', 'name', 'friends', 'people'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param User $model
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($model, $params)
    {
        $query = $model->getFriendUsers();

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

        $query->joinWith('userInfo userInfo', false);

        if($this->name) {
            list($fName, $sName) = explode(' ', $this->name);
            $query->andFilterWhere([
                'or',
                [
                    'and',
                    ['ilike', 'first_name', $fName],
                    ['ilike', 'last_name', $sName],
                ],
                [
                    'and',
                    ['ilike', 'last_name', $fName],
                    ['ilike', 'first_name', $sName],
                ],

            ]);
        }

        $params = ['or'];

        if($this->tourist) {
            $params[]=['userInfo.scope'=>UserCategory::TOURIST];
        }
        if($this->rich) {
            $params[]=['userInfo.scope'=>UserCategory::RICH];
        }
        if($this->luxury) {
            $params[]=['userInfo.scope'=>UserCategory::LUXURY];
        }
        if($this->popular) {
            $params[]=['userInfo.scope'=>UserCategory::POPULAR];
        }
        if($this->discounter) {
            $params[]=['userInfo.scope'=>UserCategory::DISCOUNTER];
        }

        if(count($params) > 1) {
            $query->andWhere($params);
        }

        return $dataProvider;
    }

}
