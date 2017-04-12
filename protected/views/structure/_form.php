<!-- /.box-header -->
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Data Structure</h3>
	</div>
	<!-- form start -->
	<?php $form=$this->beginWidget('CActiveForm', array('enableAjaxValidation'=>false,'htmlOptions'=>array('class'=>'form-horizontal'),'id'=>'form-data')); ?>
		<div class="box-body">
			<div class="form-group">
				<?php echo $form->labelEx($model,'Level',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php $this->widget('application.components.AutoComplete', array(
						'attribute' => 'Level',
						'model' => $model,
						'sourceUrl' => $this->createUrl('/config/level'),
						'options' => array('minLength' => '0'),
						'htmlOptions' => array('class' => 'form-control','maxlength'=>1,'placeholder'=>'Number of Level'),
					)); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Level'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'MemberOf',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->hiddenField($model,'IdMemberOf'); ?>
					<?php $this->widget('application.components.AutoComplete', array(
						'attribute' => 'MemberOf',
						'model' => $model,
						'sourceUrl' => $this->createUrl('/config/member'),
						'options' => array('minLength' => '0', 'param'=>'eval($(\'input[name=\"Structure[Level]\"]\').val())'),
						'htmlOptions' => array('class' => 'form-control','placeholder'=>'Choose One'))); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'MemberOf'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Division',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php $this->widget('application.components.AutoComplete', array(
						'attribute' => 'Division',
						'model' => $model,
						'sourceUrl' => $this->createUrl('/config/division'),
						'options' => array('minLength' => '0'),
						'htmlOptions' => array('class' => 'form-control','placeholder'=>'Name of Division'),
					)); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Division'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'GroupEmployee',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php $this->widget('application.components.AutoComplete', array(
						'attribute' => 'GroupEmployee',
						'model' => $model,
						'sourceUrl' => $this->createUrl('/config/group'),
						'options' => array('minLength' => '0'),
						'htmlOptions' => array('class' => 'form-control','placeholder'=>'Name of Position'),
					)); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'GroupEmployee'); ?>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
		<button id="close" type="button" class="btn btn-warning">Cancel</button>
		<button id="submit" type="submit" class="btn btn-primary pull-right"><?=$model->isNewRecord ? 'Save' : 'Update'?></button>
		</div>
		<!-- /.box-footer -->
	<?php $this->endWidget(); ?>
	<?php echo $form->errorSummary($model); ?>
</div>

<script>
	$('#close').on('click',function() {
		history.back();
	} );
</script>