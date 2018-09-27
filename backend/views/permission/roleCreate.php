<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '添加角色';

?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">角色信息</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php $form =  ActiveForm::begin() ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label" >名称</label>
                        <div class="form-group">
                            <input type="text"  class="form-control" name="description" value="" placeholder="名称">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" >标识</label>
                        <div class="form-group">
                            <input type="text"  class="form-control" name="name" value="" placeholder="标识">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" >规则名称</label>
                        <div class="form-group">
                            <input type="text"  class="form-control" name="rule_name" value="" placeholder="规则名称">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" >数据</label>
                        <div class="form-group">
                            <textarea class="form-control" name="data" placeholder="数据"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= Html::submitButton('添加',['class'=>'btn btn-primary']) ?>
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

