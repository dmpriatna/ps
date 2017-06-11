<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Dashboard',
);

Yii::app()->clientScript->registerScript('search', "
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
$('#codep').submit(function(){
	$('#process-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
$('#codef').submit(function(){
	$('#final-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
$('#codex').submit(function(){
	$('#exe-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
$('#datex').submit(function(){
	$('#exe-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});");

$userGuid = yii::app()->user->guid;
$userLevel = yii::app()->user->level;
?>
<div class="nav-tabs-custom">
	<ul class="nav nav-tabs" style="display: flex; overflow-y: hidden; white-space: nowrap">
		<li id="ctab1"><a href="#tab_1" data-toggle="tab" onclick="setC(this)">Active Documents<?php echo $a > 0 ? '<span class="badge bg-yellow" style="margin:-10px -10px 0 10px">'.$a.'</span>' : '' ?></a></li>
		<li id="ctab2"><a href="#tab_2" data-toggle="tab" onclick="setC(this)">Process Documents<?php echo $p > 0 ? '<span class="badge bg-yellow" style="margin:-10px -10px 0 10px">'.$p.'</span>' : '' ?></a></li>
		<li id="ctab3"><a href="#tab_3" data-toggle="tab" onclick="setC(this)">Execute Tasks<?php echo $e > 0 ? '<span class="badge bg-yellow" style="margin:-10px -10px 0 10px">'.$e.'</span>' : '' ?></a></li>
		<li id="ctab4"><a href="#tab_4" data-toggle="tab" onclick="setC(this)">Final Notifications<?php echo $f > 0 ? '<span class="badge bg-yellow" style="margin:-10px -10px 0 10px">'.$f.'</span>' : '' ?></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane" id="tab_1">
			<div class="box box-primary">
				<div class="box-header with-border">
				</div>
				<div class="box-body">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'active-grid',
	'dataProvider'=>$active->active(),
	'columns'=>array(
		array('name'  => 'Code',
			'value' => 'CHtml::link($data->Code, Yii::app()->createUrl(Yii::app()->user->level == "Reader" ? "document/read" : Yii::app()->user->guid == $data->IdRequiredBy ? "document/view" : "document/approve", array("id"=>$data->Id)))',
			'type'  => 'raw'),
		'DocumentName',
		array('name'=>'SubName', 'value'=>'strlen($data->SubName) > 21 ? substr($data->SubName, 0, 20)." . . ." : $data->SubName'),
		'PlanningDate',
		array(
			'name'=>'Budget',
			'value'=>function($data){
				return number_format($data->Budget, 0, '', '.');
			},
		),
		array('name'=>'UserOpen', 'value'=>'$data->RequiredBy'),
		'Priority',
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
)); ?>

				</div>
				<div class="box-footer">
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_2">
			<div class="box box-primary">
				<div class="box-header with-border">
				</div>
				<div class="box-body">
<?php echo('<form id="codep" method="post">
<input name="Proccess[Code]" type="text" placeholder="Search By Code"/>
<button class="btn btn-primary">Search</button>
</form>');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'process-grid',
	'dataProvider'=>$process->process(),
	'columns'=>array(
		array('name'  => 'Code',
			'value' => 'CHtml::link($data->Code, Yii::app()->createUrl(Yii::app()->user->level == "Reader" ? "document/read" : "document/view", array("id"=>$data->Id)))',
			'type'  => 'raw'),
		'DocumentName',
		array('name'=>'SubName', 'value'=>'strlen($data->SubName) > 21 ? substr($data->SubName, 0, 20)." . . ." : $data->SubName'),
		'PlanningDate',
		array(
			'name'=>'Budget',
			'value'=>function($data){
				return number_format($data->Budget, 0, '', '.');
			},
		),
		array('name'=>'Position Document', 'value'=>'User::model()->findByPk($data->DocumentStatus) != null ? User::model()->findByPk($data->DocumentStatus)->Name : $data->DocumentStatus'),
		'Priority',
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
)); ?>

				</div>
				<div class="box-footer">
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_3">
			<div class="box box-primary">
				<div class="box-header with-border">
				</div>
				<div class="box-body">
<?php echo('<form id="codex" method="post">
<input name="Executed[Code]" type="text" placeholder="Search By Code"/>
<button class="btn btn-primary">Search</button>
</form>');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'exe-grid',
	'dataProvider'=>$execute->exe(),
	'columns'=>array(
		array('name'  => 'Code',
			'value' => 'CHtml::link($data->Code, Yii::app()->createUrl(Yii::app()->user->level == "Reader" ? "document/read" : "document/approve", array("id"=>$data->Id)))',
			'type'  => 'raw'),
		'DocumentName',
		array('name'=>'SubName', 'value'=>'strlen($data->SubName) > 21 ? substr($data->SubName, 0, 20)." . . ." : $data->SubName'),
		'PlanningDate',
		array(
			'name'=>'Budget',
			'value'=>function($data){
				return number_format($data->Budget, 0, '', '.');
			},
		),
		array('name'=>'UserOpen', 'value'=>'$data->RequiredBy'),
		'Priority',
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
)); ?>

				</div>
				<div class="box-footer">
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_4">
			<div class="box box-primary">
				<div class="box-header with-border">
				</div>
				<div class="box-body">
<?php echo('<form id="today" method="post" style="float:left; margin-right:5px">
<input name="Document[Since]" type="hidden" value="'.date('Y-m-d', strtotime("-1 day")).'"/>
<input name="Document[Until]" type="hidden" value="'.date('Y-m-d', strtotime("+1 day")).'"/>
<button class="btn btn-primary">Today</button>
</form>
<form id="week" method="post" style="float:left; margin-right:5px">
<input name="Document[Since]" type="hidden" value="'.date('Y-m-d', strtotime("-1 week")).'"/>
<input name="Document[Until]" type="hidden" value="'.date('Y-m-d').'"/>
<button class="btn btn-primary">This Week</button>
</form>
<form id="codef" method="post">
<input name="Document[Code]" type="text" placeholder="Search By Code"/>
<button class="btn btn-primary">Search</button>
</form>
<hr>
<form id="datex" method="post">
From : ');
$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	'attribute'=>'Since',
	'model'=>$final,
	'options'=>array(
		'changeMonth'=>true,
		'changeYear'=>true,
		'dateFormat'=>'yy-mm-dd',
	),
	'htmlOptions'=>array(
		'placeholder'=>'Date Field'
	),
));
echo(' To : ');
$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	'attribute'=>'Until',
	'model'=>$final,
	'options'=>array(
		'changeMonth'=>true,
		'changeYear'=>true,
		'dateFormat'=>'yy-mm-dd',
	),
	'htmlOptions'=>array(
		'placeholder'=>'Date Field'
	),
));
echo(' <button type="submit" class="btn btn-primary">Search</button></form>');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'final-grid',
	'dataProvider'=>$final->execute(),
	'columns'=>array(
		array('name'  => 'Code',
			'value' => 'CHtml::link($data->Code, Yii::app()->createUrl(Yii::app()->user->level == "Reader" ? "document/read" : "document/view", array("id"=>$data->Id)))',
			'type'  => 'raw'),
		array(
			'name'=>'Final Date',
			'value'=>'substr($data->ModifiedDate, 0, 10)'
		),
		'DocumentName',
		array('name'=>'SubName', 'value'=>'strlen($data->SubName) > 21 ? substr($data->SubName, 0, 20)." . . ." : $data->SubName'),
		array(
			'name'=>'Realization',
			'value'=>function($data){
				return number_format($data->Realization, 0, '', '.');
			},
		),
		array('name'=>'DocumentStatus', 'value'=>'$data->RequiredBy." ( ".$data->DocumentStatus." )"'),
		'Priority',
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
)); ?>

				</div>
				<div class="box-footer">
				</div>
			</div>
		</div>
	<!-- END TAB -->
	</div>
</div>

<script>
var c = null;
var ca = document.cookie.split(';');
for(var i = 0; i < ca.length; i++) {
	var ci = ca[i];
	while (ci.charAt(0) == ' ') {
		ci = ci.substring(1);
	}
	if (ci.indexOf('tabular') == 0) {
		c = ci.substring(('tabular').length+1, ci.length);
	}
}
switch(c)
{
	case "tab_2":
		$('#ctab2').addClass('active');
		$('#tab_2').addClass('active');
		break;
	case "tab_3":
		$('#ctab3').addClass('active');
		$('#tab_3').addClass('active');
		break;
	case "tab_4":
		$('#ctab4').addClass('active');
		$('#tab_4').addClass('active');
		break;
	default :
		$('#ctab1').addClass('active');
		$('#tab_1').addClass('active');
		break;
}
function setC(p)
{
	var cvalue = p.href.split('#')[1];
	// alert(cvalue);
	var d = new Date();
    d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = "tabular=" + cvalue + ";" + expires+ ";path=/";
}
</script>