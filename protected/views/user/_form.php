<!-- /.box-header -->
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Data Pengguna</h3>
	</div>
	<!-- form start -->
	<?php $form=$this->beginWidget('CActiveForm', array('enableAjaxValidation'=>false,'htmlOptions'=>array('class'=>'form-horizontal'))); ?>
		<div class="box-body">
			<div class="form-group">
				<?php echo $form->labelEx($model,'Name',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'Name',array('class'=>'form-control','placeholder'=>'Your Name')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Name'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Email',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->emailField($model,'Email',array('class'=>'form-control','placeholder'=>'Valid Email Only')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Email'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Password',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->passwordField($model,'Password',array('class'=>'form-control','placeholder'=>'Your Credential')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Password'); ?>
				</div>
			</div><?php /*
			<div class="form-group">
				<?php echo $form->labelEx($model,'Phone',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'Phone',array('class'=>'form-control','placeholder'=>'Your Phone Number')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Phone'); ?>
				</div>
			</div>*/ ?>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Status',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo DHtml::enumList($model,'Status',array('class'=>'form-control','prompt'=>'Set One')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Status'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Level',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo DHtml::enumList($model,'Level',array('class'=>'form-control','prompt'=>'Set One')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Level'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'StructureId',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->dropDownList($model,'StructureId',CHtml::listData(Structure::model()->findAll(),'Id','lookup'),array('class'=>'form-control','prompt'=>'Choose One')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'StructureId'); ?>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
		<button id="close" type="button" class="btn btn-warning">Cancel</button>
		<button type="submit" class="btn btn-primary pull-right"><?=$model->isNewRecord ? 'Save' : 'Update'?></button>
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