<?php

/**
 * Migration to create the default wiki table
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class m151121_213536_wiki extends \yii\db\Migration
{

	/**
	 * @inheritdoc
	 */
	public function up()
	{
		$this->createTable('{{%wiki}}', [
			'id'=>'CHAR(255) NOT NULL',
			'title'=>$this->string()->notNull(),
			'content'=>$this->text(),
			'PRIMARY KEY (id)',
		]);

		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function down()
	{
		$this->dropTable('{{%wiki}}');

		return true;
	}

}
