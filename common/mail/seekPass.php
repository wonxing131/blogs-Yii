<p>尊敬的管理员：您好!</p>

<p>您的找回密码链接如下:</p>

<?php Yii::$app->urlManager->baseUrl = $baseUrl; ?>
<?php Yii::$app->urlManager->scriptUrl = $baseUrl; ?>
<?php $url = Yii::$app ->urlManager->createAbsoluteUrl(['admin/reset-pass','email'=>$email,'token'=>$token]); ?>
<p>点击链接进行找回密码操作：<a href="<?= $url ?>" ><?= $url ?></a></p>

<p>该链接5分钟内有效，请勿传递给别人</p>

<p>本邮件为系统自动发送，请勿回复!</p>