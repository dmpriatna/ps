<?php
/* @var $this RoleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documents',
);

$this->menu=array(
	array('label'=>'Create Role', 'url'=>array('create')),
	array('label'=>'Manage Role', 'url'=>array('admin')),
);

$url = yii::app()->user->level == "User" ? "document/create" : "role/view";
?>

<div class="box box-primary" style="overflow: auto; white-space: nowrap">
	<div class="box-body">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'role-grid',
		'dataProvider'=>$model->search(),
		'columns'=>array(
			array(
				'name'=>'Code',
				'type'=>'raw',
				'value'=>'CHtml::link($data->Code, Yii::app()->createUrl("'.$url.'", array("id"=>$data->Id)))',
			),
			'DocumentName',
			'Priority',
			'RequiredBy',
			'ApprovedBy',
			'ExecutedBy',
		),
		'pager'=>array('header'=>''),
		'pagerCssClass'=>'pagination',
		'itemsCssClass' => 'table table-bordered table-striped',
		'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
	)); ?>
	</div>
</div>

