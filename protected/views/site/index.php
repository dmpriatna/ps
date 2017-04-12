<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Dashboard',
);

$a = count($active);
$p = count($process);
$e = count($execute);
$f = count($final);
?>
<div class="nav-tabs-custom">
	<ul class="nav nav-tabs" style="display: flex; overflow-y: hidden; white-space: nowrap">
		<li class="active"><a href="#tab_1" data-toggle="tab">Active Documents<span class="badge bg-yellow" style="margin:-10px -10px 0 10px"><?=$a?></span></a></li>
		<li><a href="#tab_2" data-toggle="tab">Process Documents<span class="badge bg-yellow" style="margin:-10px -10px 0 10px"><?=$p?></span></a></li>
		<li><a href="#tab_3" data-toggle="tab">Execute Tasks<span class="badge bg-yellow" style="margin:-10px -10px 0 10px"><?=$e?></span></a></li>
		<li><a href="#tab_4" data-toggle="tab">Final Notifications<span class="badge bg-yellow" style="margin:-10px -10px 0 10px"><?=$f?></span></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tab_1">
			<div class="box box-primary">
				<div class="box-header with-border">
				</div>
				<div class="box-body">
					<table id="pol_pdprri" class="table table-bordered table-striped" width="100%">
						<thead>
							<tr>
								<th width="25%">Code</th>
								<th width="25%">Document Name</th>
								<th width="25%">User Open</th>
								<th width="25%">Priority</th>
							</tr>
							<?php if($active != null) foreach($active as $row) {
								$url = (yii::app()->user->guid == $row->IdRequiredBy) ? yii::app()->baseurl."/document/view/" : yii::app()->baseurl."/document/approve/";
							echo ("<tr>
								<td><a href='$url$row->Id'>$row->Code</a></td>
								<td>$row->DocumentName</td>
								<td>$row->RequiredBy</td>
								<td>$row->Priority</td>
							</tr>");
							} ?>
						</thead>
					</table>
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
					<table id="pol_kdprri" class="table table-bordered table-striped" width="100%">
						<thead>
							<tr>
								<th width="25%">Code</th>
								<th width="25%">Document Name</th>
								<th width="25%">Document Position</th>
								<th width="25%">Priority</th>
							</tr>
							<tr>
							<?php if($process != null) foreach($process as $row) { $uo = User::model()->findByPk($row->DocumentStatus);
							$raw = $uo == null ? $row->DocumentStatus : $uo->Name;
							echo ("<tr>
								<td><a href='".yii::app()->baseurl."/document/view/$row->Id'>$row->Code</a></td>
								<td>$row->DocumentName</td>
								<td>$raw</td>
								<td>$row->Priority</td>
							</tr>");
							} ?>
							</tr>
						</thead>
					</table>
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
					<table id="pol_pdprdp" class="table table-bordered table-striped" width="100%">
						<thead>
							<tr>
								<th width="25%">Code</th>
								<th width="25%">Document Name</th>
								<th width="25%">User Open</th>
								<th width="25%">Priority</th>
							</tr>
							<tr>
							<?php if($execute != null) foreach($execute as $row) {
							echo ("<tr>
								<td><a href='".yii::app()->baseurl."/document/approve/$row->Id'>$row->Code</a></td>
								<td>$row->DocumentName</td>
								<td>$row->RequiredBy</td>
								<td>$row->Priority</td>
							</tr>");
							} ?>
							</tr>
						</thead>
					</table>
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
					<table id="pol_kdprdp" class="table table-bordered table-striped" width="100%">
						<thead>
							<tr>
								<th width="25%">Code</th>
								<th width="25%">Document Name</th>
								<th width="25%">User Open</th>
								<th width="25%">Priority</th>
							</tr>
							<tr>
							<?php if($final != null) foreach($final as $row) {
							echo ("<tr>
								<td><a href='".yii::app()->baseurl."/document/view/$row->Id'>$row->Code</a></td>
								<td>$row->DocumentName</td>
								<td>$row->RequiredBy ($row->DocumentStatus)</td>
								<td>$row->Priority</td>
							</tr>");
							} ?>
							</tr>
						</thead>
					</table>
				</div>
				<div class="box-footer">
				</div>
			</div>
		</div>
	<!-- END TAB -->
	</div>
</div>