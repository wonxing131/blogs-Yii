<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '桐汌博客';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>桐汌</b>博客</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">找回密码</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'nowPass', $fieldOptions1)
            ->label(false)
            ->passwordInput(['placeholder' => '新密码']) ?>
        <?= $form
            ->field($model, 'surePass', $fieldOptions1)
            ->label(false)
            ->passwordInput(['placeholder' => '确认密码']) ?>
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="token" value="<?= $token ?>">
        <div class="row">
            <!-- /.col -->
            <div class="col-xs-12">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary btn-block btn-flat']) ?>
            </div>
            <!-- /.col -->
        </div>

        <?php ActiveForm::end(); ?>



    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
