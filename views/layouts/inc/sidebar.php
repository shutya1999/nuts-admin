<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/<?= Yii::$app->user->identity->photo ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->name ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active">
                <a href="<?= \yii\helpers\Url::to(['/']) ?>">
                    <i class="fa fa-bar-chart"></i>
                    <span>Статистика магазину</span>
                </a>
            </li>
            <li>
                <a href="/order">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Замовлення</span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?= \yii\helpers\Url::to(['category/index'])?>"><i class="fa fa-cubes">
                    </i><span>Категорії</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['category/index'])?>">Список категорій</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['category/create'])?>">Додати категорію</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="<?= \yii\helpers\Url::to(['product/index'])?>"><i class="fa fa-cutlery">
                    </i><span>Товари</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['product/index'])?>">Список товарів</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['product/create'])?>">Додати товар</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>