<?php
/* @var $this DocumentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Transaction',
);

$this->menu=array(
	array('label'=>'Create Document', 'url'=>array('create')),
	array('label'=>'Manage Document', 'url'=>array('admin')),
);
?>

<h1>Transaction</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'document-grid',
	'dataProvider'=>$model->search(),
	// 'filter'=>$model,
	'columns'=>array(
		'Code',
		'DocumentName',
		'Priority',
		'RequiredBy',
		'ApprovedBy',
		'ExecutedBy',
		'Instruction',
		/*
		'CreatedBy',
		'CreatedDate',
		'Id',
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
