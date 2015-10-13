<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mpesa;

/**
 * MpesaSearch represents the model behind the search form about `app\models\Mpesa`.
 */
class MpesaSearch extends Mpesa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['origin', 'destination', 'customer_id', 'user', 'pass', 'routemethod_id', 'routemethod_name', 'business_number'], 'safe'],
        ];
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
        $query = Mpesa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'destination', $this->destination])
            ->andFilterWhere(['like', 'customer_id', $this->customer_id])
            ->andFilterWhere(['like', 'user', $this->user])
            ->andFilterWhere(['like', 'pass', $this->pass])
            ->andFilterWhere(['like', 'routemethod_id', $this->routemethod_id])
            ->andFilterWhere(['like', 'routemethod_name', $this->routemethod_name])
            ->andFilterWhere(['like', 'business_number', $this->business_number]);

        return $dataProvider;
    }
}
