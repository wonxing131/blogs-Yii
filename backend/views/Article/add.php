<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '添加文章';

$fieldOptions1 = [
    'options' => ['class' => 'form-group'],
    'inputTemplate' => "<div class='form-group'>{input}</div>"
];
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">文章内容</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php $form =  ActiveForm::begin() ?>
                    <div class="box-body">
                        <?= $form
                            ->field($model,'admin_name',$fieldOptions1)
                            ->textInput(['placeholder'=>$model->getAttributeLabel('admin_name')]); ?>
                        <?= $form
                            ->field($model,'admin_email',$fieldOptions1)
                            ->textInput(['placeholder'=>$model->getAttributeLabel('admin_email')]); ?>
                        <?= $form
                            ->field($model,'admin_mobile',$fieldOptions1)
                            ->textInput(['placeholder'=>$model->getAttributeLabel('admin_mobile')])?>
                        <?= $form
                            ->field($model,'admin_pass',$fieldOptions1)
                            ->passwordInput(['placeholder'=>$model->getAttributeLabel('admin_pass')]); ?>
                        <?= $form
                            ->field($model,'surePass',$fieldOptions1)
                            ->passwordInput(['placeholder'=>$model->getAttributeLabel('surePass')]) ?>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <?= Html::submitButton('创建',['class'=>'btn btn-primary']) ?>
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

