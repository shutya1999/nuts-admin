<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Clients;

/**
 * ClientSearch represents the model behind the search form of `app\models\Clients`.
 */
class ClientSearch extends Clients
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'password', 'auth_key', 'name', 'surname', 'patronymic', 'phone', 'delivery_type', 'city', 'department_np', 'street', 'index_ukr', 'house_number', 'apartment_number', 'secret_key'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Clients::find();

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
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'delivery_type', $this->delivery_type])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'department_np', $this->department_np])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'index_ukr', $this->index_ukr])
            ->andFilterWhere(['like', 'house_number', $this->house_number])
            ->andFilterWhere(['like', 'apartment_number', $this->apartment_number])
            ->andFilterWhere(['like', 'secret_key', $this->secret_key]);

        return $dataProvider;
    }
}
