<?php
$this->breadcrumbs=array(
	'Report',
);
echo('
<div class="box box-solid">
	<div class="box-body">
	  <div class="box-group" id="accordion">
		<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
		<div class="panel box box-primary">
		  <div class="box-header with-border">
			<h4 class="box-title">
			  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				Active Document
			  </a>
			</h4>
		  </div>
		  <div id="collapseOne" class="panel-collapse collapse in">
			<div class="box-body">');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'document-grid',
	'dataProvider'=>$active->active(),
	'columns'=>array(
		'DocumentName',
		array('name'=>'UserOpen', 'value'=>'$data->RequiredBy'),
		'CreatedDate',
		'Priority',
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
));
				echo('
			</div>
		  </div>
		</div>
		<div class="panel box box-danger">
		  <div class="box-header with-border">
			<h4 class="box-title">
			  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
				Process Document
			  </a>
			</h4>
		  </div>
		  <div id="collapseTwo" class="panel-collapse collapse">
			<div class="box-body">');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'document-grid',
	'dataProvider'=>$process->process(),
	'columns'=>array(
		'DocumentName',
		array('name'=>'Position Document', 'value'=>'User::model()->findByPk($data->DocumentStatus)->Name'),
		'CreatedDate',
		'Priority',
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
));
				echo('
			</div>
		  </div>
		</div>
		<div class="panel box box-success">
		  <div class="box-header with-border">
			<h4 class="box-title">
			  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
				Final Document
			  </a>
			</h4>
		  </div>
		  <div id="collapseThree" class="panel-collapse collapse">
			<div class="box-body">');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'document-grid',
	'dataProvider'=>$final->search(),
	'columns'=>array(
		'DocumentName',
		'DocumentStatus',
		'CreatedDate',
		'Priority',
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
));
			echo('
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>');

?>

<script>
	$('#close').on('click',function() {
		history.back();
	} );
</script>
