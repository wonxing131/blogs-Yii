<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '个人信息';

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
                    <h3 class="box-title">个人信息</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php $form =  ActiveForm::begin() ?>
                    <div class="box-body">
                        <?= $form
                            ->field($model,'admin_name',$fieldOptions1)
                            ->textInput(['value'=>Yii::$app->user->identity->admin_name,'disabled'=>'disabled']); ?>
                        <?= $form
                            ->field($model,'admin_email',$fieldOptions1)
                            ->textInput(['placeholder'=>$model->getAttributeLabel('admin_email'),'value'=>Yii::$app->user->identity->admin_email]); ?>
                        <?= $form
                            ->field($model,'admin_mobile',$fieldOptions1)
                            ->textInput(['placeholder'=>$model->getAttributeLabel('admin_mobile'),'value'=>Yii::$app->user->identity->admin_mobile])?>
                        <?= $form
                            ->field($model,'admin_real',$fieldOptions1)
                            ->textInput(['placeholder'=>$model->getAttributeLabel('admin_real'),'value'=>Yii::$app->user->identity->admin_real])?>
                        <?= $form
                            ->field($model,'admin_qq',$fieldOptions1)
                            ->textInput(['placeholder'=>$model->getAttributeLabel('admin_qq'),'value'=>Yii::$app->user->identity->admin_qq])?>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <?= Html::submitButton('修改',['class'=>'btn btn-primary']) ?>
                        <?= Html::resetButton('重置',['class'=>'btn btn-danger']) ?>
                        <?= Html::a('刷新','javascript:window.location.reload();',['class'=>'btn btn-default']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

