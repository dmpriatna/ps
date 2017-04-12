<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Data Document</h3>
	</div>
<?php $form=$this->beginWidget(
	'CActiveForm',
	array('enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'form-horizontal'),
		'id'=>'role-form')); ?>
		<div class="box-body">
			<div class="form-group">
				<?php echo $form->labelEx($model,'Code',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'Code',array('class'=>'form-control','placeholder'=>'Document Code')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Code'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Number',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'Number',array('class'=>'form-control','placeholder'=>'Number of Document', 'readonly'=>true)); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Number'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'DocumentName',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'DocumentName',array('class'=>'form-control','placeholder'=>'Document Name')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'DocumentName'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Description',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textArea($model,'Description',array('class'=>'form-control','placeholder'=>'Description as You Wish', 'rows'=>6)); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Description'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Priority',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo DHtml::enumList($model,'Priority',array('class'=>'form-control','prompt'=>'Choose Priority')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Priority'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'RequiredBy',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->hiddenField($model,'IdRequiredBy'); ?>
					<?php $this->widget('application.components.AutoComplete', array(
						'model'=>$model,
						'attribute'=>'RequiredBy',
						'sourceUrl'=>$this->createUrl('/config/roles'),
						'options'=>array('minLength'=>'0'),
						'htmlOptions'=>array('class'=>'form-control', 'placeholder'=>'Choose Structure') )); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'RequiredBy'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'ApprovedBy',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->hiddenField($model,'IdApprovedBy'); ?>
					<?php $this->widget('application.components.MultiComplete', array(
						'model'=>$model,
						'attribute'=>'ApprovedBy',
						'splitter'=>',',
						'sourceUrl'=>$this->createUrl('/config/roles'),
						'options'=>array('minLength'=>'0'),
						'htmlOptions'=>array('class'=>'form-control', 'placeholder'=>'Choose Structure') )); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'ApprovedBy'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'ExecutedBy',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->hiddenField($model,'IdExecutedBy'); ?>
					<?php $this->widget('application.components.AutoComplete', array(
						'model'=>$model,
						'attribute'=>'ExecutedBy',
						'sourceUrl'=>$this->createUrl('/config/roles'),
						'options'=>array('minLength'=>'0'),
						'htmlOptions'=>array('class'=>'form-control', 'placeholder'=>'Choose Structure') )); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'ExecutedBy'); ?>
				</div>
			</div>
		<div class="box-footer">
			<button id="close" type="button" class="btn btn-warning">Cancel</button>
			<button id="submit" type="submit" class="btn btn-primary pull-right"><?= $model->isNewRecord ? 'Save' : 'Update' ?></button>
		</div>
	<?php $this->endWidget(); ?>
	<?php echo $form->errorSummary($model); ?>
</div>

<script>
	$('#close').on('click',function() {
		history.back();
	} );
</script>