<?php
/* @var $this StructureOrganisationController */
/* @var $model StructureOrganisation */

$this->breadcrumbs=array(
	'Structure'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'<i class="fa fa-list pull-right"></i>List Structure', 'url'=>array('index')),
	array('label'=>'<i class="fa fa-plus pull-right"></i>Create Structure', 'url'=>array('create')),
	array('label'=>'<i class="fa fa-pencil-square-o pull-right"></i>Update Structure', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'<i class="fa fa-trash-o pull-right"></i>Delete Structure', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="fa fa-list-alt pull-right"></i>Manage Structure', 'url'=>array('admin')),
);
?>

<h1>View Structure #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'Level',
		'Division',
		'GroupEmployee',
		'CreatedBy',
		'CreatedDate',
		'ModifiedBy',
		'ModifiedDate',
		'RowStatus',
	),
)); ?>
