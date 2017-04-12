<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'<i class="fa fa-list pull-right"></i>List User', 'url'=>array('index')),
	array('label'=>'<i class="fa fa-user-plus pull-right"></i>Create User', 'url'=>array('create')),
	array('label'=>'<i class="fa fa-pencil-square-o pull-right"></i>Update User', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'<i class="fa fa-trash-o pull-right"></i>Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="fa fa-list-alt pull-right"></i>Manage User', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'Name',
		'Email',
		'Password',
		'Phone',
		'Status',
		'Level',
		'StructureId',
		'CreatedBy',
		'CreatedDate',
		'ModifiedBy',
		'ModifiedDate',
		'RowStatus',
	),
)); ?>
