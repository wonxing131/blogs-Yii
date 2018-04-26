<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '修改密码';

$fieldOptions1 = [
    'options' => ['class' => 'form-group'],
    'inputTemplate' => "<div class='form-group'>{input}</div>"
];
$model->admin_pass = '';
$model->nowPass = '';
$model->surePass = '';
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">个人信息</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php $form =  ActiveForm::begin() ?>
                    <div class="box-body">
                        <?= $form
                            ->field($model,'admin_pass',$fieldOptions1)
                            ->passwordInput(['placeholder'=>'原密码']); ?>
                        <?= $form
                            ->field($model,'nowPass',$fieldOptions1)
                            ->passwordInput(['placeholder'=>'新密码']); ?>
                        <?= $form
                            ->field($model,'surePass',$fieldOptions1)
                            ->passwordInput(['placeholder'=>'确认新密码'])?>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <?= Html::submitButton('修改',['class'=>'btn btn-primary']) ?>
                        <?= Html::resetButton('重置',['class'=>'btn btn-danger']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

