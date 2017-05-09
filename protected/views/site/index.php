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
});");
// $a = count($active);
// $p = count($process);
// $e = count($execute);
// $f = count($final);
$userGuid = yii::app()->user->guid;
$userLevel = yii::app()->user->level;
?>
<div class="nav-tabs-custom">
	<ul class="nav nav-tabs" style="display: flex; overflow-y: hidden; white-space: nowrap">
		<li class="active"><a href="#tab_1" data-toggle="tab">Active Documents<?php echo $a > 0 ? '<span class="badge bg-yellow" style="margin:-10px -10px 0 10px">'.$a.'</span>' : '' ?></a></li>
		<li><a href="#tab_2" data-toggle="tab">Process Documents<?php echo $p > 0 ? '<span class="badge bg-yellow" style="margin:-10px -10px 0 10px">'.$p.'</span>' : '' ?></a></li>
		<li><a href="#tab_3" data-toggle="tab">Execute Tasks<?php echo $e > 0 ? '<span class="badge bg-yellow" style="margin:-10px -10px 0 10px">'.$e.'</span>' : '' ?></a></li>
		<li><a href="#tab_4" data-toggle="tab">Final Notifications<?php echo $f > 0 ? '<span class="badge bg-yellow" style="margin:-10px -10px 0 10px">'.$f.'</span>' : '' ?></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tab_1">
			<div class="box box-primary">
				<div class="box-header with-border">
				</div>
				<div class="box-body">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'active-grid',
	'dataProvider'=>$active->active(),
	'columns'=>array(
		array('name'  => 'Code',
			'value' => 'CHtml::link($data->Code, Yii::app()->createUrl(Yii::app()->user->level == "Reader" ? "document/read" : Yii::app()->user->guid ? "document/view" : "document/approve", array("id"=>$data->Id)))',
			'type'  => 'raw'),
		'DocumentName',
		array('name'=>'UserOpen', 'value'=>'$data->RequiredBy'),
		'Priority',
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
)); ?>
<?php /*					<table id="pol_pdprri" class="table table-bordered table-striped" width="100%">
						<thead>
							<tr>
								<th width="25%">Code</th>
								<th width="25%">Document Name</th>
								<th width="25%">User Open</th>
								<th width="25%">Priority</th>
							</tr>
							<?php if($active != null) foreach($active as $row) {
								$url = ($userLevel == "Reader") ? yii::app()->baseurl."/document/read/" : ($userGuid == $row->IdRequiredBy ? yii::app()->baseurl."/document/view/" : yii::app()->baseurl."/document/approve/");
							echo ("<tr>
								<td><a href='$url$row->Id'>$row->Code</a></td>
								<td>$row->DocumentName</td>
								<td>$row->RequiredBy</td>
								<td>$row->Priority</td>
							</tr>");
							} ?>
						</thead>
					</table> */ ?>
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
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'process-grid',
	'dataProvider'=>$process->process(),
	'columns'=>array(
		array('name'  => 'Code',
			'value' => 'CHtml::link($data->Code, Yii::app()->createUrl(Yii::app()->user->level == "Reader" ? "document/read" : "document/view", array("id"=>$data->Id)))',
			'type'  => 'raw'),
		'DocumentName',
		array('name'=>'Position Document', 'value'=>'User::model()->findByPk($data->DocumentStatus) != null ? User::model()->findByPk($data->DocumentStatus)->Name : $data->DocumentStatus'),
		'Priority',
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
)); ?>
<?php /*					<table id="pol_kdprri" class="table table-bordered table-striped" width="100%">
						<thead>
							<tr>
								<th width="25%">Code</th>
								<th width="25%">Document Name</th>
								<th width="25%">Document Position</th>
								<th width="25%">Priority</th>
							</tr>
							<tr>
							<?php if($process != null) foreach($process as $row) { $uo = User::model()->findByPk($row->DocumentStatus);
							$url2 = ($userLevel == "Reader") ? yii::app()->baseurl."/document/read/" : yii::app()->baseurl."/document/view/";
							$raw = $uo == null ? $row->DocumentStatus : $uo->Name;
							echo ("<tr>
								<td><a href='$url2$row->Id'>$row->Code</a></td>
								<td>$row->DocumentName</td>
								<td>$raw</td>
								<td>$row->Priority</td>
							</tr>");
							} ?>
							</tr>
						</thead>
					</table> */ ?>
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
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'active-grid',
	'dataProvider'=>$execute->exe(),
	'columns'=>array(
		array('name'  => 'Code',
			'value' => 'CHtml::link($data->Code, Yii::app()->createUrl(Yii::app()->user->level == "Reader" ? "document/read" : "document/approve", array("id"=>$data->Id)))',
			'type'  => 'raw'),
		'DocumentName',
		array('name'=>'UserOpen', 'value'=>'$data->RequiredBy'),
		'Priority',
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
)); ?>
<?php /*					<table id="pol_pdprdp" class="table table-bordered table-striped" width="100%">
						<thead>
							<tr>
								<th width="25%">Code</th>
								<th width="25%">Document Name</th>
								<th width="25%">User Open</th>
								<th width="25%">Priority</th>
							</tr>
							<tr>
							<?php if($execute != null) foreach($execute as $row) {
							$url3 = ($userLevel == "Reader") ? yii::app()->baseurl."/document/read/" : yii::app()->baseurl."/document/approve/";
							echo ("<tr>
								<td><a href='$url3$row->Id'>$row->Code</a></td>
								<td>$row->DocumentName</td>
								<td>$row->RequiredBy</td>
								<td>$row->Priority</td>
							</tr>");
							} ?>
							</tr>
						</thead>
					</table> */ ?>
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
<?php echo('<form style="float:left; margin-right:5px" id="today" method="post">
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
		array('name'  => 'Code',
			'value' => 'CHtml::link($data->Code, Yii::app()->createUrl(Yii::app()->user->level == "Reader" ? "document/read" : "document/view", array("id"=>$data->Id)))',
			'type'  => 'raw'),
		'DocumentName',
		array('name'=>'DocumentStatus', 'value'=>'$data->RequiredBy." ( ".$data->DocumentStatus." )"'),
		'Priority',
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
)); ?>
<?php /*					<table id="pol_kdprdp" class="table table-bordered table-striped" width="100%">
						<thead>
							<tr>
								<th width="25%">Code</th>
								<th width="25%">Document Name</th>
								<th width="25%">User Open</th>
								<th width="25%">Priority</th>
							</tr>
							<tr>
							<?php if($final != null) foreach($final as $row) {
							$url4 = ($userLevel == "Reader") ? yii::app()->baseurl."/document/read/" : yii::app()->baseurl."/document/view/";
							echo ("<tr>
								<td><a href='$url4$row->Id'>$row->Code</a></td>
								<td>$row->DocumentName</td>
								<td>$row->RequiredBy ($row->DocumentStatus)</td>
								<td>$row->Priority</td>
							</tr>");
							} ?>
							</tr>
						</thead>
					</table> */ ?>
				</div>
				<div class="box-footer">
				</div>
			</div>
		</div>
	<!-- END TAB -->
	</div>
</div>