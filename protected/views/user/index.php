<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-user-plus pull-right"></i>Create User', 'url'=>array('create')),
	array('label'=>'<i class="fa fa-list-alt pull-right"></i>Manage User', 'url'=>array('admin')),
);
?>

<h1>Users</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	// 'filter'=>$model,
	'columns'=>array(
		'Name',
		'Email',
		array('name'=>'StructureId', 'value'=>'$data->StructureName'),
		'Status',
		'Level',
		/*
		'Id',
		'Password',
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
