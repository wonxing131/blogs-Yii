<?php
use yii\grid\GridView;
use yii\bootstrap\Html;
$this->title = '文章标签';
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">标签列表</h3>
                    <a href="<?= \yii\helpers\Url::toRoute(['article/label-add']) ?>" class="btn btn-primary" style="float: right;">添加标签</a>
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
                            'name:text:名称',
                            [
                                'label' => '颜色',
                                'attribute' => 'class',
                                'value' => function($data){
                                    return $data['class'];
                                },
                                'content' => function($data){
                                    return Yii::$app->params['colorClass'][$data['class']];
                                }
                            ],
                            [
                                'label' => '是否显示',
                                'attribute' => 'is_del',
                                'content' => function($data){
                                    return Yii::$app->params['is_del'][$data['is_del']];
                                }
                            ],
                            'created_at:datetime:创建时间',
                            'updated_at:datetime:更新时间',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '操作',
                                'template' => '{update} {delete}',
                                'buttons' => [
                                    'update' => function($url, $model, $key){
                                        return Html::a('更新',['label-edit','id'=>$model['article_label_id']]);
                                    },
                                    'delete' => function($url, $model, $key){
                                        return Html::a('显示',['label-del','id'=>$model['article_label_id'],'status'=>$model['is_del']]);
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

