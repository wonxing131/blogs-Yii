<?php
use yii\grid\GridView;
use yii\bootstrap\Html;
$this->title = '角色列表';
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
                <?php
                    echo GridView::widget([
                        'dataProvider' => $data,
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn'
                            ],
                            'description:text:名称',
                            'name:text:标识',
                            'rule_name:text:规则名称',
                            'created_at:datetime:创建时间',
                            'updated_at:datetime:更新时间',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '操作',
                                'template' => '{assign} {update} {delete}',
                                'buttons' => [
                                    'assign' => function($url, $model, $key){
                                        return Html::a('分配权限',['assign-item', 'name' => $model['name']]);
                                    },
                                    'update' => function($url, $model, $key){
                                        return Html::a('更新',['role-update','name'=>$model['name']]);
                                    },
                                    'delete' => function($url, $model, $key){
                                        return Html::a('删除',['role-del','name'=>$model['name']]);
                                    }
                                ]
                            ],
                        ],
                        'layout' => "\n{items}\n{summary}<div class='pagination pull-right'>{pager}</div>",
                    ]);
                ?>
                <!-- /.box-body -->


            </div>
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

