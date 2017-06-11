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
	<div class="box-body">
	  <div class="box-group" id="accordion">
		<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
		<div class="panel box box-primary">
		  <div class="box-header with-border">
			<h4 class="box-title">
			  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" onclick="setC(this)">
				Active Document
			  </a>
			</h4>
		  </div>
		  <div id="collapseOne" class="panel-collapse collapse">
			<div class="box-body">');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'active-grid',
	'dataProvider'=>$active->active(),
	'columns'=>array(
		'Code',
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
			  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" onclick="setC(this)">
				Process Document
			  </a>
			</h4>
		  </div>
		  <div id="collapseTwo" class="panel-collapse collapse">
			<div class="box-body">');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'process-grid',
	'dataProvider'=>$process->process(),
	'columns'=>array(
		'Code',
		'DocumentName',
		array('name'=>'Position Document', 'value'=>'User::model()->findByPk($data->DocumentStatus) != null ? User::model()->findByPk($data->DocumentStatus)->Name : $data->DocumentStatus'),
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
			  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" onclick="setC(this)">
				Final Document
			  </a>
			</h4>'.
CHtml::link('Search By Date','#',array('class'=>'search-button btn btn-primary pull-right')).'
		  </div>
		  <div id="collapseThree" class="panel-collapse collapse">
			<div class="box-body">
			<div class="search-form" style="display:none">');
$this->renderPartial('_search',array(
	'model'=>$final,
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
	'id'=>'final-grid',
	'dataProvider'=>$final->execute(),
	'columns'=>array(
		'Code',
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
var c = null;
var ca = document.cookie.split(';');
for(var i = 0; i < ca.length; i++) {
	var ci = ca[i];
	while (ci.charAt(0) == ' ') {
		ci = ci.substring(1);
	}
	if (ci.indexOf('accordion') == 0) {
		c = ci.substring(('accordion').length+1, ci.length);
	}
}
switch(c)
{
	case "collapseTwo":
		$('#collapseTwo').addClass('in');
		break;
	case "collapseThree":
		$('#collapseThree').addClass('in');
		break;
	default :
		$('#collapseOne').addClass('in');
		break;
}
function setC(p)
{
	var cvalue = p.href.split('#')[1];
	var d = new Date();
    d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = "accordion=" + cvalue + ";" + expires+ ";path=/";
}
</script>