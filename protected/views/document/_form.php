	<!-- form start -->
	<?php $form=$this->beginWidget(
		'CActiveForm',
		array('enableAjaxValidation'=>false, 
			'htmlOptions'=>array('class'=>'form-horizontal', 'enctype' => 'multipart/form-data'),
			'id'=>'document-form')); ?>
<div class="nav-tabs-custom">
	<div class="tab-content">
		<div class="tab-pane active" id="tab_1">
<!-- /.box-header -->
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Data Document</h3>
	</div>
		<div class="box-body">
			<div class="form-group">
				<?php echo $form->labelEx($model,'Code',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'Code', array('class' => 'form-control', 'placeholder'=>'Auto Field', 'readonly'=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'DocumentName',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'DocumentName', array('class' => 'form-control', 'placeholder'=>'Auto Field', 'readonly'=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'SubName',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'SubName', array('class' => 'form-control', 'placeholder'=>'Sub Document Name')); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Priority',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'Priority', array('class' => 'form-control', 'placeholder'=>'Auto Field', 'readonly'=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Description',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textArea($model,'Description', array('class' => 'form-control', 'placeholder'=>'Auto Field', 'readonly'=>true, 'rows'=>6)); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'RequiredBy',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'RequiredBy', array('class' => 'form-control', 'placeholder'=>'Auto Field', 'readonly'=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'ApprovedBy',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'ApprovedBy', array('class' => 'form-control', 'placeholder'=>'Auto Field', 'readonly'=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'ExecutedBy',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'ExecutedBy', array('class' => 'form-control', 'placeholder'=>'Auto Field', 'readonly'=>true)); ?>
				</div>
			</div>
		<div class="box-footer">
			<div class="col-sm-3">
				<button id="close" type="button" class="btn btn-warning pull-right">Back</button>
			</div>
			<div class="col-sm-5">
				<?php if($model->DocumentStatus == yii::app()->user->guid) : ?>
				<button name="cancel" type="submit" class="btn btn-danger">Cancel</button>
				<?php endif; ?>
				<a href="#tab_2" data-toggle="tab">
					<button type="button" class="btn btn-primary pull-right">Next</button>
				</a>
			</div>			
		</div>
</div>
</div>
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->errorSummary($attach); ?>
		</div>
		<div class="tab-pane" id="tab_2">
<!-- /.box-header -->
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Data Document</h3>
	</div>
		<div class="box-body">
			<div class="form-group">
				<?php echo $form->labelEx($model,'Budget',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'Budget', array('class' => 'form-control', 'placeholder'=>'Type Here')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Budget'); ?>
				</div>
			</div>
			<?php if($model->IdExecutedBy == yii::app()->user->guid) : ?>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Realization',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'Realization', array('class' => 'form-control', 'placeholder'=>'Type Here')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Realization'); ?>
				</div>
			</div>
			<?php endif; ?>
			<div class="form-group">
				<?php echo $form->labelEx($model,'PlanningDate',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'attribute'=>'PlanningDate',
					'model'=>$model,
					'options'=>array(
						'changeMonth'=>true,
						'changeYear'=>true,
						'dateFormat'=>'yy-mm-dd',
					),
					'htmlOptions'=>array(
						'class'=>'form-control',
						'placeholder'=>'Planning Date of Budget'
					),
				)); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'PlanningDate'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Instruction',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textArea($model,'Instruction', array('class' => 'form-control', 'placeholder'=>'Type Here', 'rows'=>6)); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Instruction'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($attach,'UploadedFile',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->fileField($attach,'UploadedFile[]', array('class' => 'form-control', 'multiple'=>true)); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($attach,'UploadedFile'); ?>
				</div>
			</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<div class="col-sm-3">
				<a href="#tab_1" data-toggle="tab">
					<button type="button" class="btn btn-warning pull-right">Back</button>
				</a>
			</div>
			<div class="col-sm-5">
				<button id="submit" type="submit" class="btn btn-primary pull-right"><?=$model->isNewRecord ? 'Save' : 'Update'?></button>
			</div>			
		</div>
	</div>
		<!-- /.box-footer -->
	<?php $this->endWidget(); ?>
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->errorSummary($attach); ?>
</div>
</div>
	<!-- END TAB -->
	</div>
</div>

<script>
	$('#close').on('click',function() {
		history.back();
	} );
</script>