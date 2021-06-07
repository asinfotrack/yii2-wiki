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
        $this->execute('
            CREATE TABLE `wiki` (
              `id` char(255) CHARACTER SET latin1 NOT NULL,
              `title` varchar(255) NOT NULL,
              `content` text,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8

        ');
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
