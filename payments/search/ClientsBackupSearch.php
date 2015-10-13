<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClientsBackup;

/**
 * ClientsBackupSearch represents the model behind the search form about `app\models\ClientsBackup`.
 */
class ClientsBackupSearch extends ClientsBackup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['client_acc', 'names', 'username', 'attribute', 'value', 'Op', 'verified', 'status', 'bonus_days', 'lastpayment_date', 'timestamp', 'balances', 'email', 'phone'], 'safe'],
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
        $query = ClientsBackup::find();

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
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'client_acc', $this->client_acc])
            ->andFilterWhere(['like', 'names', $this->names])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'attribute', $this->attribute])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'Op', $this->Op])
            ->andFilterWhere(['like', 'verified', $this->verified])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'bonus_days', $this->bonus_days])
            ->andFilterWhere(['like', 'lastpayment_date', $this->lastpayment_date])
            ->andFilterWhere(['like', 'balances', $this->balances])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
