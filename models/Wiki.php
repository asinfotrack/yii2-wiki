<?php
namespace asinfotrack\yii2\wiki\models;

use Yii;
use asinfotrack\yii2\wiki\Module;

/**
 * This is the model class for table "wiki".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 *
 * @property bool $isOrphan
 * @property string $contentProcessed
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class Wiki extends \yii\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'wiki';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['content'], 'default'],

			[['id', 'title'], 'required'],

			[['id'], 'match', 'pattern'=>Module::getInstance()->articleIdRegex, 'message'=>Module::getInstance()->invalidArticleIdMessage],
			[['content'], 'string'],
			[['id', 'title'], 'string', 'max'=>255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'Identifier'),
			'title' => Yii::t('app', 'Title'),
			'content' => Yii::t('app', 'Content'),
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function find()
	{
		$queryClass = Module::getInstance()->queryClass;
		return new $queryClass(get_called_class());
	}

	public function getIsOrphan()
	{
		return !static::find()->withLinkToArticle($this->id)->exists();
	}

	public function getContentProcessed()
	{
		return Module::getInstance()->processContent($this->content);
	}

}
