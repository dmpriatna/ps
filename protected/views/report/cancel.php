<?php
$this->breadcrumbs=array(
	'Cancel',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cancel-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
$('#today').submit(function(){
	$('#cancel-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
$('#week').submit(function(){
	$('#cancel-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
echo('
<div class="box box-solid">
  <div class="box-header with-border">
	<h4 class="box-title">
	  Cancel Document
	</h4>'.
	CHtml::link('Search By Date','#',array('class'=>'search-button btn btn-primary pull-right')).'
  </div>
	<div class="box-body">
	<div class="search-form" style="display:none">');
$this->renderPartial('_search2',array(
	'model'=>$model,
));
echo('</div>
<form style="float:left; margin-right:5px" id="today" method="post">
<input name="Document[Since]" type="hidden" value="'.date('Y-m-d').'"/>
<input name="Document[Until]" type="hidden" value="'.date('Y-m-d').'"/>
<button class="btn btn-primary">Today</button>
</form>
<form id="week" method="post">
<input name="Document[Since]" type="hidden" value="'.date('Y-m-d', strtotime("-1 week")).'"/>
<input name="Document[Until]" type="hidden" value="'.date('Y-m-d').'"/>
<button class="btn btn-primary">This Week</button>
</form>');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cancel-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		array('name'  => 'No', 'value' => '$this->grid->dataProvider->pagination->offset + $row + 1'),
		array('name'=>'CancelDate', 'value'=>'$data->canceldate()'),
		array('name'  => 'Code',
			'value' => 'CHtml::link($data->Code, Yii::app()->createUrl("report/view", array("id"=>$data->Id)))',
			'type'  => 'raw'),
		'DocumentName',
		'SubName',
		array('name'=>'UserOpen', 'value'=>'$data->RequiredBy'),
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