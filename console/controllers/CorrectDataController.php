<?php

namespace console\controllers;


use frontend\modules\api\v1\resources\ActivityRecord;
use frontend\modules\api\v1\resources\Message;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * 修正数据
 * @author Eugene Terentev <eugene@terentev.net>
 */
class CorrectDataController extends Controller
{

    /**
     * 修改消息中不匹配的
     */
    public function actionMessage()
    {
        $messageModel = new Message();
        $i = 1;
        do {
            $message = Message::findOne($i);
            if (rand(1, 10) % 2 == 1) {
                $message->to_user_id = $message->activity->user_id;
                echo "$i 修改 to_user_id {$message->to_user_id}为 {$message->activity->user_id}";
            } else {
                $message->from_user_id = $message->activity->user_id;
                echo "$i 修改 from_user_id {$message->from_user_id}为 {$message->activity->user_id}";
            }
            if ($message->save()) {
                echo '修改成功';
            } else {
                echo '修改失败';
            }
            $i++;
        } while ($i < 501);
    }

    public function actionActivityRecord()
    {
        $array = [-1, 0, 1, 2];
        $i = 1;
        do {$key = array_rand($array);
            $message = Message::findOne($i);
            $activityRecord = new ActivityRecord();
            $activityRecord->id = $i;
            $activityRecord->activity_id = $message->activity_id;
            $activityRecord->allow = $array[$key];
            $activityRecord->user_id = (rand(1, 10) % 2 == 1) ? $message->to_user_id : $message->from_user_id;
            $activityRecord->own_user_id = $message->activity->user_id;
            $activityRecord->created_at = time();
            $activityRecord->updated_at = time();

            if ($activityRecord->save()) {
                echo '1 修改成功';
            } else {
                echo '0 修改失败';
                //var_dump($activityRecord->getErrors());exit;
            }
            $i++;
        } while ($i < 501);
    }


}
