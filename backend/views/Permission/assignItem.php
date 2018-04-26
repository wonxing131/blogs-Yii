<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '权限分配';

?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">权限分配</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php $form =  ActiveForm::begin() ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label" >角色名称</label>
                        <div class="form-group">
                            <input type="text"  class="form-control" name="description" value="<?= $parent ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <?= Html::label('角色子节点',null).Html::checkboxList('children',$children['roles'],$roles) ?>
                    </div>
                    <div class="form-group">
                        <?= Html::label('节点列表',null).Html::checkboxList('children',$children['permissions'],$permissions) ?>
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

