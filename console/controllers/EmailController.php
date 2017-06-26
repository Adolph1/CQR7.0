<?php

namespace console\controllers;

use backend\models\EmailLog;
use backend\models\Employee;
use backend\models\User;
use Yii;
use yii\console\Controller;


/**
 * BGEmailController implements the CRUD actions for BGEmail model.
 */
class EmailController extends Controller
{

    public function actionSendEmail()
    {
        $emails=EmailLog::find()->where(['status'=>0])->all();
        if($emails!=null){
            foreach ($emails as $email){
                $userID=User::getUserIDByEmail($email->to);
                $userdept=Employee::getDepartmentID($userID);
                $departusers=Employee::find()->where(['department_id'=>$userdept])->all();
                foreach ($departusers as $departuser) {
                    Yii::$app->mailer->compose()
                        ->setFrom($email->from)
                        ->setTo(User::getEmailID($departuser->id))
                        ->setSubject($email->subject)
                        ->setTextBody($email->message)
                        ->setHtmlBody($email->message)
                        ->send();
                }
                EmailLog::updateAll(['status'=>1],['id'=>$email->id]);
            }
        }


        return 0;
    }


}
