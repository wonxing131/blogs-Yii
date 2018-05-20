<?php
$this->title = '分类列表';
?>

<?= \yiidreamteam\jstree\JsTree::widget([
    'containerOptions' => [
        'class' => 'data-tree',
    ],
    'jsOptions' => [
        'core' => [
            'check_callback'=>true,
            'multiple' => false,
            'data' => [
                'url' => \yii\helpers\Url::to(['category/data']),
            ],
            'themes' => [
                'stripes'=>true,
                'variant'=>'large',
            ]

        ],
        'types'=>[
            'default'=>[
                //小图标地址  http://v3.bootcss.com/components/
                'icon' => 'glyphicon glyphicon-search',
            ],
        ],
        'plugins'=>[
            'contextmenu','dnd','search','state','types','wholerow'
        ]
    ]
]) ?>
