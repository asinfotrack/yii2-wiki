<?php
namespace asinfotrack\yii2\wiki\accessRights;


use CompanyRights\components\UserRoleInterface;
use yii2d3\d3persons\accessRights\SystemAdminUserRole;
use Yii;

class WikiEditUserRole implements UserRoleInterface
{

    const NAME = 'WikiEdit';
    /**
     * @inheritdoc
     */
    public function getType(): string
    {
        return self::TYPE_REGULAR;
    }

    /**
     * @inheritdoc
     */
    public function getLabel(): string
    {
        return Yii::t('app', 'Wiki Edit');
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @inheritdoc
     */
    public function getAssigments(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function canAssign(): bool
    {
        return Yii::$app->user->can(SystemAdminUserRole::NAME);
    }
    
    /**
     * @inheritdoc
     */    
    public function canView(): bool
    {

        return Yii::$app->user->can(SystemAdminUserRole::NAME);
    }

    /**
     * @inheritdoc
     */
    public function canRevoke(): bool
    {
        return Yii::$app->user->can(SystemAdminUserRole::NAME);
    }            
    

            
}