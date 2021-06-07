<?php


use asinfotrack\yii2\wiki\accessRights\WikiEditUserRole;
use yii\db\Migration;




class m191031_100102_AddRolesWikiEdit extends Migration {

    public $roles = [
        WikiEditUserRole::NAME,
    ];

    public function up() {

        $auth = Yii::$app->authManager;

        /**
         *  create roles
         */
        foreach ($this->roles as $roleName) {
            $role = $auth->createRole($roleName);
            $auth->add($role);
        }
    }

    public function down() {
        $auth = Yii::$app->authManager;

        foreach ($this->roles as $roleName => $actions) {
            $role = $auth->createRole($roleName);
            $auth->remove($role);
        }
    }

}
