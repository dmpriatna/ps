<?php
$this->breadcrumbs=array(
	'Report',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#final-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
$('#today').submit(function(){
	$('#final-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
$('#week').submit(function(){
	$('#final-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
echo('
<div class="box box-solid">
	<div class="box-body">');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'active-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		array('name'  => 'Code',
			'value' => 'CHtml::link($data->Code, Yii::app()->createUrl("report/view", array("id"=>$data->Id)))',
			'type'  => 'raw'),
		// 'Code',
		'DocumentName',
		'SubName',
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
		  </div>');

?>