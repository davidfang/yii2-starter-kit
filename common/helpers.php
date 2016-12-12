<?php
/**
 * Yii2 Shortcuts
 * @author Eugene Terentev <eugene@terentev.net>
 * -----
 * This file is just an example and a place where you can add your own shortcuts,
 * it doesn't pretend to be a full list of available possibilities
 * -----
 */

/**
 * @return int|string
 */
function getMyId()
{
    return Yii::$app->user->getId();
}

/**
 * @param string $view
 * @param array $params
 * @return string
 */
function render($view, $params = [])
{
    return Yii::$app->controller->render($view, $params);
}

/**
 * @param $url
 * @param int $statusCode
 * @return \yii\web\Response
 */
function redirect($url, $statusCode = 302)
{
    return Yii::$app->controller->redirect($url, $statusCode);
}

/**
 * @param $form \yii\widgets\ActiveForm
 * @param $model
 * @param $attribute
 * @param array $inputOptions
 * @param array $fieldOptions
 * @return string
 */
function activeTextinput($form, $model, $attribute, $inputOptions = [], $fieldOptions = [])
{
    return $form->field($model, $attribute, $fieldOptions)->textInput($inputOptions);
}

/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function env($key, $default = false) {

    $value = getenv($key);

    if ($value === false) {
        return $default;
    }

    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;

        case 'false':
        case '(false)':
            return false;
    }

    return $value;
}

/*********七牛操作**************/
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;

/**
 * Class StaticResource 根据 hash map 修改静态资源地址
 */
class StaticResource
{

    /**
     * 信息配置
     * @var array
     */
    public static $_config = array(
        "debug" => false, //true-开发环境，false-生产环境
        "path" => array( //资源路径
            "develop" => "/statics-src/",
            "product" => "/statics/"
        ),
        "domain" => array( //网站环境
            "local" => "/liao.local.com/"
            //"local"=>  "/m.sikerdi/"
        )
    );

    /**
     * hash map 数据
     * @var
     */
    private static $_map;

    /**
     * 静态资源地址
     * @var
     */
    public static $_address;

    /**
     * 初始化函数
     */
    public static function init()
    {

        //读取hash.json文件内容
        self::$_map = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/hash.json'), true);


        $host = $_SERVER['HTTP_HOST'];
        //if((isset($_GET['debug']) && $_GET['debug']=='qd') || preg_match(self::$_config['domain']['local'],$host) || preg_match(self::$_config['domain']['it'],$host)){ //加debug=qd调试环境
        if ((isset($_GET['debug']) && $_GET['debug'] == 'qd') || preg_match(self::$_config['domain']['local'], $host)) { //加debug=qd调试环境
            self::$_config['debug'] = true;
            self::$_address = self::$_config['path']['develop'];
        } else {
            self::$_config['debug'] = false;
            self::$_address = self::$_config['path']['product'];
        }

    }

    /**
     * 创建前端资源url
     * @param $url
     * @return string
     */
    public static function createUrl($url)
    {

        if (self::$_config['debug']) {
            $hashUrl = self::$_address . $url;
        } else {
            $reg = "/[^\/]+\..+$/";
            preg_match($reg, $url, $fileName);

            $hashFileName = self::$_map[$url] . "." . $fileName[0];
            $hashUrl = preg_replace($reg, $hashFileName, $url);

            $hashUrl = self::$_address . $hashUrl;
        }

        return $hashUrl;
    }
}

StaticResource::init();

function createUrl($url)
{
    return StaticResource::createUrl($url);
}

/**以下为网站全局使用的函数方法**/
/**
 * 获得七牛下载地址
 * @param string $k  七牛关键字
 * @param string $format 七牛图片处理设置参数（需要在七牛后台设置相应的处理方法缩写）,默认的链接符为 -
 * @return string 返回地址
 */
function qiniuDownloadUrl($k = 'FvatF_M83LV3ND3EgJHZF_Ifmnxv',$format=50)
{
    $accessKey = Yii::$app->params['qiniu']['accessKey'];
    $secretKey = Yii::$app->params['qiniu']['secretKey'];
    //$bucket = Yii::$app->params['qiniu']['bucket'];
    $auth = new Auth($accessKey, $secretKey);;
    //$callbackUrl = Yii::$app->params['qiniu']['host'] . $k .'?imageView2/0/w/80/h/80';
    $callbackUrl = Yii::$app->params['qiniu']['host'] . $k .'-'.$format;
    $downurl = $auth->privateDownloadUrl($callbackUrl);
    return $downurl;
}

/**
 * 生成七牛文件上传token
 * @param null $user_id 用户ID
 * @param  $type 类别
 * @return string
 */
function qiniuUploadToken($user_id=null,$type='')
{
    $type_array = ['basic_user', 'activity'];
    $type = in_array($type,$type_array)?$type:$type_array[0];
    $type_id = $type==$type_array[0]?$user_id:null;
    $accessKey = Yii::$app->params['qiniu']['accessKey'];
    $secretKey = Yii::$app->params['qiniu']['secretKey'];
    $bucket = Yii::$app->params['qiniu']['bucket'];
    $auth = new Auth($accessKey, $secretKey);

    $policy = [
        "callbackUrl" => Yii::$app->params['qiniu']['callbackUrl'],
        "callbackBody" => "name=$(fname)&img_size=$(fsize)&hash=$(etag)&user_id=$user_id&type=$type&type_id=$type_id"
    ];
    $token = $auth->uploadToken($bucket, null, 3600, $policy);
    return  $token;
}