<?php

/**
 * @var $content string
 */

use yii\helpers\Html;
use common\widgets\Alert;
use yii\helpers\Url;
use kartik\social\FacebookPlugin;


yiister\adminlte\assets\Asset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <script>
        $("#language").click(function(){
            alert("clicked");
        });

    </script>
    <![endif]-->
    <?php $this->head() ?>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>QR5.0</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>QR5.0</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="http://placehold.it/160x160" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                   echo Yii::$app->user->identity->username;
                                }
                                ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="http://placehold.it/160x160" class="img-circle" alt="User Image">
                                <p>
                                    <?php
                                   if (!Yii::$app->user->isGuest) {

                                       echo Yii::$app->user->identity->username;
                                         $user_id=Yii::$app->user->identity->id;
                                   }

                                    ?>

                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <?php
                                    if(!Yii::$app->user->isGuest) {
                                        echo Html::beginForm(['/site/logout'], 'post');
                                        echo Html::submitButton(
                                            'Logout (' . Yii::$app->user->identity->username . ')',
                                            ['class' => 'btn btn-link logout']
                                        );
                                        echo Html::endForm();
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">


            <!-- Sidebar Menu -->
            <?php if (!Yii::$app->user->isGuest) {?>
            <?=

            \yiister\adminlte\widgets\Menu::widget(
                [
                    "items" => [
                        ["label" =>Yii::t('app','Home'), "url" =>  Yii::$app->homeUrl, "icon" => "home"],

                        [
                                "label" =>Yii::t('app','Cases'),
                                "url" =>  "#",
                                "icon" => "fa fa-folder-o",
                                "items" => [
                                    [
                                        'visible' => yii::$app->User->can('Level0')|| yii::$app->User->can('admin'),
                                        "label" => "New Case",
                                        "url" => ["/customer-case/create"],
                                        "icon" => "fa fa-lightbulb-o",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('Level5')|| yii::$app->User->can('admin'),
                                        "label" => "Pending Cases",
                                        "url" => ["/customer-case/index"],
                                        "icon" => "fa fa-server",
                                    ],
                                    [
                                        'visible' => yii::$app->User->can('Level0') || yii::$app->User->can('Level5')|| yii::$app->User->can('admin'),
                                        "label" => "My Cases",
                                        "url" => ["/customer-case/pending"],
                                        "icon" => "fa fa-server",
                                    ],
                                    [       'visible' => (Yii::$app->user->identity->username == 'admin'),
                                            "label" =>Yii::t('app','Case Settings'),
                                            "url" =>  Yii::$app->homeUrl,
                                            "icon" => "fa fa-gear",
                                    "items" => [

                                    [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Case Sources",
                                    "url" => ["/case-source/index"],
                                    "icon" => "fa fa-lightbulb-o",
                                    ],
                                    [
                                        'visible' => (Yii::$app->user->identity->username == 'admin'),
                                        "label" => "Case Types",
                                        "url" => ["/case-type/index"],
                                        "icon" => "fa fa-lightbulb-o",
                                    ],
                                    [
                                        'visible' => (Yii::$app->user->identity->username == 'admin'),
                                        "label" => "Case priorities",
                                        "url" => ["/case-priority/index"],
                                        "icon" => "fa fa-lightbulb-o",
                                    ],

                                ],
                                        ],
                                    ],

                        ],

                        [
                            'visible' => (Yii::$app->user->identity->username == 'admin'),
                            "label" =>Yii::t('app','Admin'),
                            "url" => "#",
                            "icon" => "fa fa-gears",
                            "items" => [


                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Case Statuses",
                                    "url" => ["/case-status/index"],
                                    "icon" => "fa fa-lock",
                                ],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Branches",
                                    "url" => ["/branch/index"],
                                    "icon" => "fa fa-user",
                                ],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Departments",
                                    "url" => ["/department/index"],
                                    "icon" => "fa fa-user",
                                ],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Departments Activities",
                                    "url" => ["/department-module-activity/index"],
                                    "icon" => "fa fa-user",
                                ],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Employees",
                                    "url" => ["/employee/index"],
                                    "icon" => "fa fa-user",
                                ],


                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Users",
                                    "url" => ["/user"],
                                    "icon" => "fa fa-user",
                                ],

                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    'label' => Yii::t('app', 'Manager Permissions'),
                                    'url' => ['/auth-item/index'],
                                    'icon' => 'fa fa-lock',
                                ],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    'label' => Yii::t('app', 'Manage User Roles'),
                                    'url' => ['/role/index'],
                                    'icon' => 'fa fa-lock',
                                ],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "System Activities",
                                    "url" => ["/module-activity/index"],
                                    "icon" => "fa fa-user",
                                ],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "System Modules",
                                    "url" => ["/system-module/index"],
                                    "icon" => "fa fa-user",
                                ],


                            ],
                        ],
                    ],
                ]
            )
            ?>
            <?php }?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php // Html::encode(isset($this->params['h1']) ? $this->params['h1'] : $this->title) ?>
            </h1>
            <?php if (isset($this->params['breadcrumbs'])): ?>
                <?=
                \yii\widgets\Breadcrumbs::widget(
                    [
                        'encodeLabels' => false,
                        'homeLink' => [
                            'label' => new \rmrevin\yii\fontawesome\component\Icon('home') .Yii::t('app','Home'),
                            "url" =>  Yii::$app->homeUrl,
                        ],
                        'links' => $this->params['breadcrumbs'],
                    ]
                )
                ?>
            <?php endif; ?>
        </section>

        <!-- Main content -->
        <section class="content" style="background: #fff">
            <div style="padding-top: 10px"><?= Alert::widget() ?></div>
            <?= $content ?>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Powered by Erico
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; KCB Group <?= date("Y") ?></strong>
        <?php // echo FacebookPlugin::widget(['appId'=>'mwakalingaadolph']);?>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Some information about this general settings option
                        </p>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
    $("#purchasemaster-country").change(function(){
        var id =document.getElementById("purchasemaster-country").value;
        if(id==1){
            $( "#rates" ).hide( "slow", function() {
                //alert( "Animation complete." );
            });
        }
        else if(id==2){
            $( "#rates" ).show( "slow", function() {
            });
        }
        else if(id==0){
            $( "#rates" ).show( "slow", function() {
            });
        }


    });

</script>

<script>
    $(document).ready(function(){
        var id =document.getElementById("purchasemaster-country").value;
        if(id==1){
            $( "#rates" ).hide( "slow", function() {
                //alert( "Animation complete." );
            });
        }
        else if(id==2){
            $( "#rates" ).show( "slow", function() {
            });
        }
        else if(id==0){
            $( "#rates" ).show( "slow", function() {
            });
        }


    });

</script>



<script>
    $("#departmentmoduleactivity-module_activity_id").change(function(){
        var id =document.getElementById("departmentmoduleactivity-module_activity_id").value;
        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['module-activity/filter','id'=>'']);?>"+id,function(data) {
            //alert(data);
            document.getElementById("departmentmoduleactivity-activity_module").value=data;
            document.getElementById("departmentmoduleactivity-related_module").value=data;

        });
    });

</script>


<script>
    $("#customercase-related_module").change(function(){
        var id =document.getElementById("customercase-related_module").value;
        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['system-module/filter','id'=>'']);?>"+id,function(data) {

            //alert(data);
            $("#customercase-related_activity").html(data);


        });
    });

    $("#customercase-related_activity").change(function(){
        var id =document.getElementById("customercase-related_activity").value;
        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['department-module-activity/filter','id'=>'']);?>"+id,function(data) {

            //alert(data);
            $("#customercase-assigned_to").html(data);


        });

        $.get("<?php echo Yii::$app->urlManager->createUrl(['department-module-activity/department','id'=>'']);?>"+id,function(data) {

            //alert(data);
            document.getElementById("customercase-related_department").value=data;



        });

        $.get("<?php echo Yii::$app->urlManager->createUrl(['department-module-activity/filter-department','id'=>'']);?>"+id,function(data) {

            //alert(data);
            document.getElementById("customercase-department_related").value=data;



        });


    });

    $("#customer-id").click(function(){
        var id =document.getElementById("customercase-customer_number").value;
        //alert(id);
        theUrl='http://localhost/mkopo/index.php?r=customer/get-customer&id='+id;
        //theUrl='http://demo.vikobafeta.or.tz/index.php?r=customer/get-customer&id='+id;
        //alert(theUrl);
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
        xmlHttp.send( null );
           // alert(xmlHttp.responseText);

        var myObj = JSON.parse(xmlHttp.responseText);
                // No parsing necessary with JSON!
    if(xmlHttp.responseText == "Undefined") {

        document.getElementById("customer-phone_1").value = "";
        document.getElementById("customer-name").value = "";
        document.getElementById("customer-address").value = "";
        document.getElementById("customer-customer_number").value = "";
        document.getElementById("customer-email").value ="";


    }else{
        document.getElementById("customer-phone_1").value = myObj.data.mobile_no1;
        document.getElementById("customer-name").value = myObj.data.first_name + " " + myObj.data.last_name;
        document.getElementById("customer-address").value = myObj.data.address;
        document.getElementById("customer-customer_number").value = myObj.data.customer_no;
        document.getElementById("customer-email").value = myObj.data.email;
    }

    });





    window.onload = function() {
        var id ='KCB';
        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['customer-case/reference','id'=>'']);?>"+id,function(data) {

            //alert(data);
            document.getElementById("customercase-case_number").value=data;

        });
    };


    $("#reassign-user").click(function(){
        var id =document.getElementById("case-id").value;
        var id1 =document.getElementById("customercase-assigned_to").value;
        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['customer-case/reassign','id'=>'']);?>"+"&id="+id+"&id1="+id1,function(data) {

            //alert(data);
            //document.getElementById("customercase-case_number").value=data;

        });
    });

</script>


