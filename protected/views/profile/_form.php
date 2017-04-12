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
				<div class="col-sm-4">
					<?php echo $form->passwordField($model,'Password',array('class'=>'form-control','placeholder'=>'Your Credential','readonly'=>true)); ?>
				</div>
				<div class="col-sm-1">
					<a href="<?php echo yii::app()->baseurl.'/profile/pass/'.$model->Id ?>"><button class="btn btn-block btn-warning" type="button">Edit</button></a>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Password'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Status',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php
						if(yii::app()->user->level=='User')
							echo $form->textField($model,'Status',array('class'=>'form-control','readonly'=>true));
						else
							echo DHtml::enumList($model,'Status',array('class'=>'form-control','prompt'=>'Set One'));
					?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Status'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Level',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php
						if(yii::app()->user->level=='User')
							echo $form->textField($model,'Level',array('class'=>'form-control','readonly'=>true));
						else
							echo DHtml::enumList($model,'Level',array('class'=>'form-control','prompt'=>'Set One'));
					?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Level'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'StructureId',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php
						if(yii::app()->user->level=='User')
							echo $form->textField($model,'StructureName',array('class'=>'form-control','readonly'=>true));
						else
							echo $form->dropDownList($model,'StructureId',CHtml::listData(Structure::model()->findAll(),'Id','lookup'),array('class'=>'form-control','prompt'=>'Choose One'));
					?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'StructureId'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($profile,'Gender',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo RHtml::enumList($profile,'Gender',array('class'=>'')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($profile,'Gender'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($profile,'Name',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($profile,'Name',array('class'=>'form-control','placeholder'=>'Your Name')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($profile,'Name'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($profile,'PlaceAndDateOfBirth',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($profile,'Place',array('class'=>'form-control','placeholder'=>'Place Of Birth')); ?>
				</div>
				<div class="col-sm-2">
					<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'attribute'=>'DateOfBirth',
						'model'=>$profile,
						'options'=>array(
							'changeMonth'=>true,
							'changeYear'=>true,
							'dateFormat'=>'yy-mm-dd',
							'maxDate'=>'-17Y',
						),
						'htmlOptions'=>array(
							'class'=>'form-control'
						),
					)); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($profile,'PlaceAndDateOfBirth'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($profile,'Phone',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($profile,'Phone',array('class'=>'form-control','placeholder'=>'Your Phone Number')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($profile,'Phone'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($profile,'Address',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($profile,'Address',array('class'=>'form-control','placeholder'=>'Your Address')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($profile,'Address'); ?>
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
	<?php echo $form->errorSummary($profile); ?>
</div>

<script>
	$('#close').on('click',function() {
		history.back();
	} );
	$('#edit').on('click', function() {
		window.location.href = 'google';
	});
</script>