<!-- /.box-header -->
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Data Pengguna</h3>
	</div>
	<!-- form start -->
	<?php $form=$this->beginWidget('CActiveForm', array('enableAjaxValidation'=>false,'htmlOptions'=>array('class'=>'form-horizontal'))); ?>
		<div class="box-body">
			<div class="form-group">
				<?php echo $form->labelEx($model,'Password',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->passwordField($model,'Password',array('class'=>'form-control','placeholder'=>'Your Credential')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Password'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Pass',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->passwordField($model,'Pass',array('class'=>'form-control','placeholder'=>'Confirm Your Password')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Pass'); ?>
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