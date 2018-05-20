<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => '管理员管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label'=>'管理员列表','icon'=>'dashboard','url'=>['/admin/list']],
                            ['label'=>'管理员添加','icon'=>'dashboard','url'=>['/admin/add']],
                            ['label'=>'个人信息','icon'=>'dashboard','url'=>['/admin/my']],
                            ['label'=>'修改密码','icon'=>'dashboard','url'=>['/admin/pass']],
                        ]
                    ],
                    [
                        'label' => '权限管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label'=>'角色列表','icon'=>'dashboard','url'=>['/permission/roles']],
                            ['label'=>'添加角色','icon'=>'dashboard','url'=>['/permission/role-create']],
                        ]
                    ],
                    [
                        'label' => '文章管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label'=>'文章分类','icon'=>'dashboard','url'=>['/category/list']],
                            ['label'=>'文章列表','icon'=>'dashboard','url'=>['/article/list']],
                            ['label'=>'添加文章','icon'=>'dashboard','url'=>['/article/add']],
                        ]
                    ],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    ['label' => '退出登录', 'icon' => 'file-code-o', 'url' => ['/site/logout']],
                ],
            ]
        ) ?>

    </section>

</aside>
