<?php /* @var $this Controller
$this->beginContent('//layouts/main');
<div id="content">
	$content;
</div><!-- content -->
$this->endContent(); ?>
@var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#tab2" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      <li><a href="#tab3" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="tab1">
				<?php
				$this->beginWidget('zii.widgets.CPortlet', array('title'=>'Operations'));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'operations'),
				));
				$this->endWidget();
				?>
      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="tab2"></div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="tab3"></div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
<?php $this->endContent(); ?>