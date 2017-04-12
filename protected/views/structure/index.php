<?php
/* @var $this StructureOrganisationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Structure',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-plus pull-right"></i>Create Structure', 'url'=>array('create')),
	array('label'=>'<i class="fa fa-list-alt pull-right"></i>Manage Structure', 'url'=>array('admin')),
);

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
	'id'=>'all_dialog',
	'options'=>array(
		'autoOpen'=>false,
		'draggable'=>false,
		'height'=>'auto',
		'width'=>'auto',
		'modal'=>true,
		// 'position'=>array(0,50),
		'open'=> 'js:function(event, ui) { $(".ui-dialog-titlebar").hide(); }'
	),
));
echo "<div id='all_frame'></div>";
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<h1>Structure</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'structure-organisation-grid',
	'dataProvider'=>$model->search(),
	// 'filter'=>$model,
	'columns'=>array(
		'Level',
		'GroupEmployee',
		'Division',
		array('name'=>'MemberOf','value'=>'$data->member'),
		/*
		'CreatedBy',
		'CreatedDate',
		'ModifiedBy',
		'ModifiedDate',
		'RowStatus',
		array(
			'class'=>'CButtonColumn',
		),
		*/
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	// 'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
)); ?>
