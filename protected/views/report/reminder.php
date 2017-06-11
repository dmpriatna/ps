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
echo('</div>
<form id="today" method="post" style="float:left; margin-right:5px">
<input name="Document[Since]" type="hidden" value="'.date('Y-m-d').'"/>
<input name="Document[Until]" type="hidden" value="'.date('Y-m-d').'"/>
<button class="btn btn-primary">Today</button>
</form>
<form id="week" method="post">
<input name="Document[Since]" type="hidden" value="'.date('Y-m-d', strtotime("-1 week")).'"/>
<input name="Document[Until]" type="hidden" value="'.date('Y-m-d').'"/>
<button class="btn btn-primary">This Week</button>
</form>');
$this->renderPartial('_search',array(
	'model'=>$model,
));
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'final-grid',
	'dataProvider'=>$model->reminder(),
	'columns'=>array(
		array('name'  => 'Code',
			'value' => 'CHtml::link($data->Code, Yii::app()->createUrl("report/view", array("id"=>$data->Id)))',
			'type'  => 'raw'),
		'DocumentName',
		'PlanningDate',
		'Budget',
		array('name'=>'SubName', 'value'=>'strlen($data->SubName) > 21 ? substr($data->SubName, 0, 20)." . . ." : $data->SubName'),
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