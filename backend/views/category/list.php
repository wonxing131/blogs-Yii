<?php
$this->title = '分类列表';

?>

<?= \yii\helpers\Html::button('顶级分类',['class'=>'btn btn-primary','style'=>'float:right','id'=>'addBtn']) ?>
<?= \yii\helpers\Html::textInput('search','',['placeholder'=>'搜索','style'=>'float:right;height:34px','id'=>'search']); ?>

<?= \yiidreamteam\jstree\JsTree::widget([
    'containerOptions' => [
        'class' => 'data-tree',
        'id' => 'category'
    ]
]) ?>

<script>
    <?php $this->beginBlock('script') ?>

        var csrf_value = "<?= Yii::$app->request->getCsrfToken(); ?>";

        $("#category").jstree({

            "core": {

                "animation" : 0,

                "check_callback" : true,

                "data" : { 'url' : "<?= \yii\helpers\Url::to(['category/data']) ?>" },

                "themes" : { "stripes" : true , 'variant' : 'large' },

            },

            "types" : { "default" : { "icon" : false } },

            "contextmenu": {

                "items": {

                    "create": {

                        "label": "新增分类",

                        "action": function (obj) {

                            var inst = jQuery.jstree.reference(obj.reference);

                            var clickedNode = inst.get_node(obj.reference);

                            if (clickedNode['original']['is_show'] == 3){
                                alert('禁用状态不能添加下级');
                                return false;
                            }

                            var newNode = inst.create_node(inst.get_node(obj.reference),'请输入分类名称',"last","","");

                            inst.edit(newNode,newNode.val)

                        }

                    },

                    "rename":{

                        "label": "修改分类",

                        "action": function (obj) {

                            var inst = jQuery.jstree.reference(obj.reference);

                            var clickedNode = inst.get_node(obj.reference);

                            inst.edit(obj.reference,clickedNode.val);
                        }

                    },

                    "delete": {

                        "label": "是否显示",

                        "action": function (obj) {

                            var inst = jQuery.jstree.reference(obj.reference);

                            var clickedNode = inst.get_node(obj.reference);

                            // inst.delete_node(obj.reference);
                            del(inst,obj);


                        }

                    }

                }

            },

            "plugins": ["contextmenu", "dnd", "search", "state", "types", "wholerow"],

        });


    $('#category').on('rename_node.jstree',function(e,data){
        var newVal = data.text;
        var id = data.node.id;
        var numReg = /^\d+$/;
        if (numReg.test(id)){
            var postData = {
                "<?= Yii::$app->request->csrfParam; ?>" : csrf_value,
                'category_name' : newVal,
                'category_id'  : id
            };
            $.post("<?= \yii\helpers\Url::toRoute(['category/edit']) ?>",postData,function(data){
                if (data.state === 0){
                    alert('修改失败:'+data.message);
                    // window.location.reload();
                    return;
                }
            });
        }else{
            var parentId = data.node['parent'];
            if (parentId == '#'){
                parentId = 0;
            }
            var postData = {
                "<?= Yii::$app->request->csrfParam ?>" : csrf_value,
                'parent_id' : parentId,
                'category_name' : newVal
            };
            $.post("<?= \yii\helpers\Url::toRoute(['category/add']) ?>",postData,function (data) {
                if (data.state === 0){
                    alert('添加失败'+data.message);
                    window.location.reload();
                    return;
                }else if(data.state === 1){
                    alert(data.message);
                }
            })
        }
    });

    var to = false;
    $('#search').keyup(function () {
        if(to) {
            clearTimeout(to);
        }

        to = setTimeout(function () {
            $('#category').jstree(true).search($('#search').val());

        }, 250);
    });

    $('#addBtn').click(function () {
        var category_name = prompt('请输入分类名字:');
        $.post('<?= \yii\helpers\Url::toRoute(['category/add']) ?>',{
            '<?= Yii::$app->request->csrfParam ?>' : '<?= Yii::$app->request->getCsrfToken() ?>',
            'parent_id' : 0,
            'category_name' : category_name
        },function (data) {
            if (data.state === 0){
                alert('修改失败'+data.message);
            }else if(data.state === 1){
                alert(data.message);
                window.location.reload();
            }
        });
    });

    function del(inst,obj){
        if (window.confirm('确定禁止/启动当前以及所有下属子分类吗?') === true){
            var is_show = inst.get_node(obj.reference)['original']['is_show'];
            var ids = inst.get_node(obj.reference)['children_d'];
            ids.push(inst.get_node(obj.reference)['id']);
            $.post('<?= \yii\helpers\Url::toRoute(['category/del']) ?>',{
                '<?= Yii::$app->request->csrfParam ?>' : '<?= Yii::$app->request->getCsrfToken() ?>',
                'ids' : ids,
                'is_show' : is_show
            },function (data) {
                if (data.state === 0){
                    alert('修改失败'+data.message);
                }else if(data.state === 1){
                    alert(data.message);
                    window.location.reload();
                }
            });
        }
    }


    <?php $this->endBlock(); ?>
    <?php $this->registerJs($this->blocks['script'],\yii\web\View::POS_END) ?>
</script>