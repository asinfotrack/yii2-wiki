<?php
namespace asinfotrack\yii2\wiki\models;

/**
 * This is the ActiveQuery class for [[\app\models\Wiki]].
 * @see \app\models\Wiki
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class WikiQuery extends \yii\db\ActiveQuery
{

	/**
	 * Named scope to filter articles with a link to another article
	 *
	 * @param $articleId
	 * @return $this
	 */
	public function withLinkToArticle($articleId)
	{
		$this->andFilterWhere(['like', 'content', '[%]('.$articleId.')', ['%'=>'%']]);
		return $this;
	}

}
