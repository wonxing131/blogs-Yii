<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '添加文章';
\backend\assets\AppAsset::addCss($this,'@web/vendor/select2/dist/css/select2.min.css');
\backend\assets\AppAsset::addScript($this,'@web/vendor/select2/dist/js/select2.full.min.js');
\backend\assets\AppAsset::addScript($this,'@web/vendor/laydate/laydate.js');
$fieldOptions1 = [
    'options' => ['class' => 'form-group'],
    'inputTemplate' => "<div class='form-group'>{input}</div>"
];
if (!empty($this->is_del)){
    $model->is_del = 2;
}
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
                            ->field($model,'category_id',$fieldOptions1)
                            ->dropDownList($category_list,['class'=>'form-control select2','style'=>'width:100%','prompt'=>'请选择相关分类']) ?>
                        <?= $form
                            ->field($model,'content')
                            ->widget(\yiichina\mdeditor\MdEditor::className(),['allowUpload'=>true])?>
                        <?= $form
                            ->field($model,'article_label_id',$fieldOptions1)
                            ->dropDownList($label_list,['class'=>'form-control select2','style'=>'width:100%','prompt'=>'请选择文章标签','multiple'=>'multiple'])?>
                        <?= $form
                            ->field($model,'is_del',$fieldOptions1)
                            ->radioList(['2'=>'立即发布','4'=>'稍后发布'])?>
                        <?= $form
                            ->field($model,'sendTime',$fieldOptions1)
                            ->textInput(['id'=>'sendTime','placeholder'=>'发布时间'])?>

<!--                        <div class="form-group sentTime">-->
<!--                            <label class="control-label" for="article-title">发布时间</label>-->
<!--                            <div class="form-group">-->
<!--                                <input type="text" class="form-control" name="sendTime" id="sendTime" placeholder="发布时间">-->
<!--                            </div>-->
<!--                        </div>-->

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

        if ($('input[type="radio"]').val() == 2){
            $('.field-sendTime').css('display','none');
        }else{
            $('.field-sendTime').css('display','block');
        }

        laydate.render({
            elem : '#sendTime',
            format : 'yyyy-MM-dd HH:mm',
            type : 'datetime',
            min : '<?= date('Y-m-d H:i',time()) ?>',
            calendar : true,
        });

    });

    $('input[type="radio"]').change(function () {
        if ($(this).val() == 2){
            $('.field-sendTime').css('display','none');
        }else if($(this).val() == 4){
            $('.field-sendTime').css('display','block');
        }
    });

    <?php if ($model->is_del == 4): ?>
        $('.field-sendTime').css('display','none');
    <?php endif; ?>


<?php $this->endBlock('script'); ?>
<?php $this->registerJs($this->blocks['script'],\yii\web\View::POS_END) ?>
</script>