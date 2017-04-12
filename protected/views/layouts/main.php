<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/dist/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/dist/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/dist/css/skins/_all-skins.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/datatables/buttons.dataTables.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/datatables/responsive.dataTables.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/datatables/fixedHeader.dataTables.css">
	<!-- Slider -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/slider/js-image-slider.css">

	<!-- REQUIRED JS SCRIPTS -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/jquery.js"></script>
	<!-- jQuery 2.2.0 -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- Bootstrap 3.3.5 -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/bootstrap/js/bootstrap.min.js"></script>
	<!-- DataTables -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/datatables/dataTables.buttons.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/datatables/buttons.colVis.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/datatables/dataTables.responsive.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/datatables/dataTables.fixedHeader.js"></script>
	<!-- Slimscroll -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/dist/js/app.min.js"></script>
	<!-- Slider -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/plugins/slider/js-image-slider.js"></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
	@media(min-width:1024px){
		.custom {
			margin: auto;
			width: 50%;
		}
	}
	</style>
	<?php $url = Yii::app()->request->baseUrl; $user = Yii::app()->user; ?>
</head>
<body class="hold-transition skin-green fixed sidebar-collapse">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a class="logo" style="padding:0px !important">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PaperlessFlow</b> Systems</span>
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
			  <?php if(!$user->isGuest){ echo"
              <img src='$url/themes/alte/dist/img/user.png' class='user-image' alt='User Image'>";
			  }else{ echo"
              <img src='$url/themes/alte/dist/img/android.png' class='user-image' alt='User Image'>";
			  } echo $user->name; ?>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
			    <?php if(!$user->isGuest){ echo"
              <img src='$url/themes/alte/dist/img/user.png' class='user-image' alt='User Image'>";
			  }else{ echo"
              <img src='$url/themes/alte/dist/img/android.png' class='user-image' alt='User Image'>";
			  } ?>
                <p><small>Today <?=date('d - m - Y')?></small></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
				  <?php if(!$user->isGuest){ echo"
                  <a href='$url/profile/update/$user->guid' class='btn btn-default btn-flat'>Profile</a>";
				  } ?>
                </div>
                <div class="pull-right">
				  <?php if(!$user->isGuest){ echo"
                  <a href='$url/site/logout' class='btn btn-default btn-flat'>Sign out</a>";
				  }else{ echo"
                  <a href='$url/site/login' class='btn btn-default btn-flat'>Sign in</a>";
				  } ?>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
		  <?php if($user->level == "Super Admin" || $user->level == "Admin"){ echo"
			<li><a href='#' data-toggle='control-sidebar'><i class='fa fa-gears'></i></a></li>"; } ?>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
	<h4 style="text-align:center; color:#3c8dbc">MAIN NAVIGATION</h4>
	  <?php $menu=array(
			array('label'=>'<i class="fa fa-files-o pull-right"></i>Documents', 'url'=>array('/role')),
			array('label'=>'<i class="fa fa-files-o pull-right"></i>Report', 'url'=>array('/report')),
			array('label'=>'<i class="fa fa-th pull-right"></i>Structure Diagram', 'url'=>array('/site/page', 'view'=>'dc')),
		);

		$this->beginWidget('zii.widgets.CPortlet');
		$this->widget('zii.widgets.CMenu', array(
			'encodeLabel' => false,
			'items'=>$menu,
			'htmlOptions'=>array('class'=>'sidebar-menu'),
		));
		$this->endWidget(); ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs,)); ?>
		<?php endif?>
    </section>

    <!-- Main content -->
    <section class="content">

      <?php echo $content; ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      PaperlessFlow Systems
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">PS</a>.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/alte/dist/js/demo.js"></script>
</body>
</html>