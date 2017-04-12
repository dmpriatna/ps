<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
		<?php echo $content; ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    </ul>
    <!-- Tab panes
    <div class="tab-content">
      <!-- Home tab content
      <div class="tab-pane" id="control-sidebar-home-tab"> -->
  <h4 style="text-align:center; color:#3c8dbc">ADMIN NAVIGATION</h4>
		<?php
		$menu=array(
			array(
				'label'=>'<i class="fa fa-users"></i><i class="fa fa-angle-left pull-right"></i>Users',
				'url'=>'#',
				'itemOptions' => array('class' => 'treeview'),
				'submenuOptions'=>array('class'=>'treeview-menu'),
				'items' => array(
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-user-plus pull-right"></i>Create',
						'url' => array('/user/create'),
					),
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-users pull-right"></i>List',
						'url' => array('/user/index'),
					),
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-list-alt pull-right"></i>Manage',
						'url' => array('/user/admin'),
					)
				)
			),
			array(
				'label'=>'<i class="fa fa-users"></i><i class="fa fa-angle-left pull-right"></i>Profile',
				'url'=>'#',
				'itemOptions' => array('class' => 'treeview'),
				'submenuOptions'=>array('class'=>'treeview-menu'),
				'items' => array(
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-user-plus pull-right"></i>Create',
						'url' => array('/profile/create'),
					),
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-list-alt pull-right"></i>Manage',
						'url' => array('/profile/index'),
					)
				)
			),
			array(
				'label'=>'<i class="fa fa-database"></i><i class="fa fa-angle-left pull-right"></i>Structure',
				'url'=>'#',
				'itemOptions' => array('class' => 'treeview'),
				'submenuOptions'=>array('class'=>'treeview-menu'),
				'items' => array(
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-plus pull-right"></i>Create',
						'url' => array('/structure/create'),
					),
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-list pull-right"></i>List',
						'url' => array('/structure/index'),
					),
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-list-alt pull-right"></i>Manage',
						'url' => array('/structure/admin'),
					)
				)
			),
			array(
				'label'=>'<i class="fa fa-files-o"></i><i class="fa fa-angle-left pull-right"></i>Documents',
				'url'=>'#',
				'itemOptions' => array('class' => 'treeview'),
				'submenuOptions'=>array('class'=>'treeview-menu'),
				'items' => array(
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-plus pull-right"></i>Create',
						'url' => array('/role/create'),
					),
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-list pull-right"></i>List',
						'url' => array('/role/index'),
					),
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-list-alt pull-right"></i>Manage',
						'url' => array('/role/admin'),
					)
				)
			),
			array(
				'label'=>'<i class="fa fa-files-o"></i><i class="fa fa-angle-left pull-right"></i>Transaction',
				'url'=>'#',
				'itemOptions' => array('class' => 'treeview'),
				'submenuOptions'=>array('class'=>'treeview-menu'),
				'items' => array(
					array(
						'label' => '<i class="fa fa-circle-o"></i><i class="fa fa-list-alt pull-right"></i>Manage',
						'url' => array('/document/admin'),
					)
				)
			),
			// array('label'=>'<i class="fa fa-th pull-right"></i>Structure Diagram', 'url'=>array('/Site/Page', 'view'=>'dc')),
		);

		$this->beginWidget('zii.widgets.CPortlet');
		$this->widget('zii.widgets.CMenu', array(
			'encodeLabel' => false,
			'items'=>$menu,
			'htmlOptions'=>array('class'=>'sidebar sidebar-menu'),
		));
		$this->endWidget();
		?>
		<!-- </div>
    </div> -->
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
<?php $this->endContent(); ?>