<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '添加文章';
\backend\assets\AppAsset::addCss($this,'@web/vendor/select2/dist/css/select2.min.css');
\backend\assets\AppAsset::addCss($this,'@web/vendor/ueditor/themes/default/css/umeditor.css');
\backend\assets\AppAsset::addScript($this,'@web/vendor/select2/dist/js/select2.full.min.js');
\backend\assets\AppAsset::addScript($this,'@web/vendor/ueditor/umeditor.config.js');
\backend\assets\AppAsset::addScript($this,'@web/vendor/ueditor/umeditor.min.js');
\backend\assets\AppAsset::addScript($this,'@web/vendor/ueditor/lang/zh-cn/zh-cn.js');
$fieldOptions1 = [
    'options' => ['class' => 'form-group'],
    'inputTemplate' => "<div class='form-group'>{input}</div>"
];
$fieldOptions2 = [
    'options' => ['class' => 'form-group'],
    'inputTemplate' => '<div class="form-group">{input}</div>'
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
                            ->field($model,'title',$fieldOptions1)
                            ->textInput(['placeholder'=>$model->getAttributeLabel('title')]); ?>
                        <?= $form
                            ->field($model,'category_id',$fieldOptions2)
                            ->dropDownList(['1'=>'很多','2'=>'很少','3'=>'特别的爱','4'=>'特别的你'],['class'=>'form-control select2','style'=>'width:100%','prompt'=>'请选择相关分类']) ?>
                        <?= $form
                            ->field($model,'content',$fieldOptions1)
                            ->textarea(['placeholder'=>'文章内容','id'=>'content']) ?>

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

<script>
<?php $this->beginBlock('script'); ?>
    $(function () {
        $('.select2').select2();

        var um = UM.getEditor('content');
        um.setHeight('300');
        um.setWidth('100%');
    });
<?php $this->endBlock('script'); ?>
<?php $this->registerJs($this->blocks['script'],\yii\web\View::POS_END) ?>
</script>