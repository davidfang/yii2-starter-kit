<?php

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class RbacAuthAssignmentFixture extends ActiveFixture
{
    public $tableName = 'rbac_auth_assignment';
    public $depends = [
        'tests\unit\fixtures\UserFixture'
    ];
}
