<?php

namespace frontend\modules\api\wechat;

use Yii;
/**
 * wechat module definition class
 */
class Module extends \frontend\modules\api\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\api\wechat\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        Yii::$app->user->enableSession = false;
        Yii::$app->user->loginUrl = null;
    }
}
