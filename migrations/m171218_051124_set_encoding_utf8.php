<?php

use yii\db\Migration;

class m171218_051124_set_encoding_utf8 extends Migration
{
    public function safeUp()
    {
        $this->execute('
          ALTER TABLE `wiki`   
            CHANGE `title` `title` VARCHAR(255) CHARSET utf8 NOT NULL,
            CHANGE `content` `content` TEXT CHARSET utf8 NULL, 
            CHARSET=utf8, COLLATE=utf8_general_ci;
        ');
    }

    public function safeDown()
    {
        echo "m171218_051124_set_encoding_utf8 cannot be reverted.\n";

        return false;
    }

}
