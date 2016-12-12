<?php

namespace frontend\modules\api\v1\controllers;

use yii\rest\Controller;
/**
 * Default controller for the `v1` module
 */
class IndexController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $ar = array (
            'data' =>
                array (
                    0 =>
                        array (
                            'id' => '86',
                            'username' => 'm春梅',
                            'nickname' => '赵',
                            'sex' => '2',
                            'age' => '19',
                            'headimgurl' => 'http://7xjgpp.com1.z0.glb.clouddn.com/5.jpg-80?e=1481512214&token=0ZV4UgdVowHcWDn5tJNHSziqcc6TvSmUetmyvHYE:EuHeCVbWgVULWkCnheMUS8XJ9Ek=',
                            'last_time' => '1434676431',
                            'location_x' => '-40.562321',
                            'location_y' => '-5.690525',
                        ),
                    1 =>
                        array (
                            'id' => '52',
                            'username' => 'a丹丹',
                            'nickname' => '姚',
                            'sex' => '2',
                            'age' => '32',
                            'headimgurl' => 'http://7xjgpp.com1.z0.glb.clouddn.com/7.jpg-80?e=1481512214&token=0ZV4UgdVowHcWDn5tJNHSziqcc6TvSmUetmyvHYE:jK38cRj7p_TGBl-hNGY-N6NyGjg=',
                            'last_time' => '1434619807',
                            'location_x' => '56.885273',
                            'location_y' => '-24.584060',
                        ),
                    2 =>
                        array (
                            'id' => '164',
                            'username' => '宋96',
                            'nickname' => '姜',
                            'sex' => '2',
                            'age' => '35',
                            'headimgurl' => 'http://7xjgpp.com1.z0.glb.clouddn.com/2.jpg-80?e=1481512214&token=0ZV4UgdVowHcWDn5tJNHSziqcc6TvSmUetmyvHYE:AhRWnEG01wi5iMlVmP868S1HTJQ=',
                            'last_time' => '1434600473',
                            'location_x' => '72.865114',
                            'location_y' => '-4.656934',
                        ),
                    3 =>
                        array (
                            'id' => '178',
                            'username' => '范.秀梅',
                            'nickname' => '叶',
                            'sex' => '2',
                            'age' => '26',
                            'headimgurl' => 'http://7xjgpp.com1.z0.glb.clouddn.com/7.jpg-80?e=1481512214&token=0ZV4UgdVowHcWDn5tJNHSziqcc6TvSmUetmyvHYE:jK38cRj7p_TGBl-hNGY-N6NyGjg=',
                            'last_time' => '1434594752',
                            'location_x' => '80.157230',
                            'location_y' => '-45.565293',
                        ),
                    4 =>
                        array (
                            'id' => '68',
                            'username' => '郭.想',
                            'nickname' => '金',
                            'sex' => '2',
                            'age' => '34',
                            'headimgurl' => 'http://7xjgpp.com1.z0.glb.clouddn.com/5.jpg-80?e=1481512214&token=0ZV4UgdVowHcWDn5tJNHSziqcc6TvSmUetmyvHYE:EuHeCVbWgVULWkCnheMUS8XJ9Ek=',
                            'last_time' => '1434545578',
                            'location_x' => '-136.014873',
                            'location_y' => '29.759255',
                        ),
                ),
            'pagination' =>
                array (
                    'self' => '/m/online/user-list.html?page=2',
                    'first' => '/m/online/user-list.html?page=1',
                    'prev' => '/m/online/user-list.html?page=1',
                    'next' => '/m/online/user-list.html?page=3',
                    'last' => '/m/online/user-list.html?page=8',
                ),
        );
        return $ar;
    }
}
