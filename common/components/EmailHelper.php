<?php 
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

 /**
 * Class EmailHelper
 * Author Eng Mohammed Fouda.
 */

class EmailHelper extends Component {
	public function init(){}
	
	function SendEmail($templateAlias, $to, $param = array(), $send = false, $bcc = array(), $cc = array(), $attachments = array()) {
		$autoConvertImagesToInlineAttachments = true;
		
		$template = \common\models\EmailTemplate::findOne(['alias' => $templateAlias]);
		
		if (!$template || $template->active == 0) {
			return false;
		}
		//Email Layout
		/*$body = $template->emailLayout->layout;
		
		$body = str_replace('{homePage}', \yii\helpers\Url::to('/'), $body);
		$body = str_replace('{myAccount}', \yii\helpers\Url::to('/account'), $body);
		$body = str_replace('{facebook}', 'https://www.facebook.com/', $body);
		$body = str_replace('{linkedIn}', 'https://www.linkedin.com/', $body);
		$body = str_replace('{upgrade}', \yii\helpers\Url::to('/checkout'), $body);
		
		$body = str_replace("{content}", $template->body, $body);*/
		
		$body = $template->body;
		
		if(isset($param['subject']) && $param['subject'])
			$subject = $param['subject'];
		else
			$subject = $template->subject;
		
		$from = $template->sender_email;
		
		$param['{base_url}'] = Yii::$app->homeUrl;//Yii::app()->getBaseUrl(true);
		foreach ($param as $key => $value) {
			$body = str_replace($key, $value, $body);
			$subject = str_replace($key, $value, $subject);
		}
		$body = str_replace('{signin}', \yii\helpers\Url::to('/user/login'), $body);
		$body = str_replace('{myAccount}', \yii\helpers\Url::to('/account'), $body);
		$body = str_replace('{liveChat}', \yii\helpers\Url::to('/').'#chat', $body);
		$body = str_replace('{addUser}', \yii\helpers\Url::to('/account/users'), $body);
		$body = str_replace('{accountSettingLink}', \yii\helpers\Url::to('/account/settings'), $body);
		$body = str_replace('{purchaseLink}', \yii\helpers\Url::to('/purchase'), $body);
		$body = str_replace('{terms}', \yii\helpers\Url::to('/terms-and-conditions'), $body);
		$body = str_replace('{forget}', \yii\helpers\Url::to('/user/recovery'), $body);
		$body = str_replace('{upgrade}', \yii\helpers\Url::to('/checkout'), $body);

		$re = "/<tr[^>]*>\\s*<td[^>]*>[^>]*<\\/td>\\s*<td[^>]*>[\\s0]*<\\/td>\\s*<\\/tr>/s";
		$body = preg_replace($re, "", $body);

		//render layout
		$htmlMail = Yii::$app->controller->renderPartial('@common/mail/layouts/html', ['content' => $body]);

		//$to = '';
		return Yii::$app->mailer->compose(
                //['html' => '@common/mail/layouts/html','text' => '@common/mail/layouts/text'],
                //['content' => $body]
            )
			->setTo($to)
			->setFrom([$from => $template->sender_name])
			->setSubject($subject)
			//->setTextBody($body)
			->setHtmlBody($htmlMail)
			->send();
	}
}