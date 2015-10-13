<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Payments;

/**
 * PaymentsSearch represents the model behind the search form about `app\models\Payments`.
 */
class PaymentsSearch extends Payments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id'], 'integer'],
            [['mpesa_id', 'original', 'destination', 'test', 'mpesa_code', 'mpesa_acc', 'mpesa_msidn', 'mpesa_amount', 'mpesa_sender', 'timestamp'], 'safe'],
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
        $query = Payments::find();

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
            'customer_id' => $this->customer_id,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'mpesa_id', $this->mpesa_id])
            ->andFilterWhere(['like', 'original', $this->original])
            ->andFilterWhere(['like', 'destination', $this->destination])
            ->andFilterWhere(['like', 'test', $this->test])
            ->andFilterWhere(['like', 'mpesa_code', $this->mpesa_code])
            ->andFilterWhere(['like', 'mpesa_acc', $this->mpesa_acc])
            ->andFilterWhere(['like', 'mpesa_msidn', $this->mpesa_msidn])
            ->andFilterWhere(['like', 'mpesa_amount', $this->mpesa_amount])
            ->andFilterWhere(['like', 'mpesa_sender', $this->mpesa_sender]);

        return $dataProvider;
    }
}
