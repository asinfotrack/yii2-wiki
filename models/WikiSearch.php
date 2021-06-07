<?php
namespace asinfotrack\yii2\wiki\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use asinfotrack\yii2\wiki\Module;

/**
 * WikiSearch represents the model behind the search form about `app\models\Wiki`.
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class WikiSearch extends Wiki
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'title', 'content'], 'safe'],
			//[['created', 'created_by', 'updated', 'updated_by'], 'integer'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		//bypass scenarios() implementation in the parent class
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
		$modelClass = Module::getInstance()->modelClass;
		$query = $modelClass::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);
		if (!$this->validate()) {
			return $dataProvider;
		}

		$query
			->andFilterWhere(['like', 'id', $this->id])
			->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'content', $this->content]);

		return $dataProvider;
	}
}
