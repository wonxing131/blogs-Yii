<?php
use yii\grid\GridView;
use yii\bootstrap\Html;
$this->title = '管理员列表';
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">管理员信息</h3>
                </div>
                <!-- /.box-header -->
                <?php
                echo GridView::widget([
                    'dataProvider' => $data,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn'
                        ],
                        'admin_name:text:用户名',
                        'admin_email:text:邮箱',
                        [
                            'label'=>'手机号',
                            'attribute' => 'admin_mobile',
                            'value' => 'admin_mobile'
                        ],
                        [
                            'label' => '真实姓名',
                            'attribute' => 'admin_real',
                            'value' => 'admin_real',
                            'content' => function($data){
                                return $data['admin_real'] ? $data['admin_real'] : '未设置';
                            }
                        ],
                        [
                            'label' => 'QQ号',
                            'attribute' => 'admin_qq',
                            'value' => 'admin_qq',
                            'content' => function($data){
                                return $data['admin_qq'] ? $data['admin_qq'] : '未设置';
                            }
                        ],
                        'login_time:datetime:最后登录时间',
                        'created_at:datetime:创建时间',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{update} {delete}',
                            'buttons' => [
                                'update' => function($url, $model, $key){
                                    return Html::a('更新',['update','admin_id'=>$model['admin_id']]);
                                },
                                'delete' => function($url, $model, $key){
                                    return Html::a('删除',['del','admin_id'=>$model['admin_id']]);
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

