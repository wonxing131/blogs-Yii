<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '添加文章';
\backend\assets\AppAsset::addCss($this,'@web/vendor/select2/dist/css/select2.min.css');
\backend\assets\AppAsset::addScript($this,'@web/vendor/select2/dist/js/select2.full.min.js');
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
                            ->field($model,'name',$fieldOptions1)
                            ->textInput(['placeholder'=>$model->getAttributeLabel('name')]); ?>
                        <?= $form
                            ->field($model,'class',$fieldOptions1)
                            ->dropDownList(Yii::$app->params['colorClass'],['class'=>'form-control select2','style'=>'width:100%','prompt'=>'选择颜色']) ?>
                        <?= $form
                            ->field($model,'is_del',$fieldOptions1)
                            ->radioList(['2'=>'显示','3'=>'隐藏'])?>

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

<script>
<?php $this->beginBlock('script'); ?>
    $(function () {
        $('.select2').select2();
    });

<?php $this->endBlock('script'); ?>
<?php $this->registerJs($this->blocks['script'],\yii\web\View::POS_END) ?>
</script>