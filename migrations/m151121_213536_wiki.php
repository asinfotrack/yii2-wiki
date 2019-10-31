<?php

use yii\db\Migration;

/**
 * Migration to create the default wiki table
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class m151121_213536_wiki extends Migration
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
		]);
        $this->createIndex(
            'wiki_ind_id',
            '{{%wiki}}',
            'id',
            true
        );

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
