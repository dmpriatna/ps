<!-- /.box-header -->
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Data Pengguna</h3>
	</div>
	<!-- form start -->
	<?php $form=$this->beginWidget('CActiveForm', array('action'=>Yii::app()->createUrl($this->route), 'htmlOptions'=>array('class'=>'form-horizontal'))); ?>
		<div class="box-body">
			<div class="form-group">
				<?php echo $form->labelEx($model,'Name',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'Name',array('class'=>'form-control','placeholder'=>'Search by Name')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Name'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Email',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->emailField($model,'Email',array('class'=>'form-control','placeholder'=>'Search by Email')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Email'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Level',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo DHtml::enumList($model,'Level',array('class'=>'form-control','prompt'=>'Search by Level')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Level'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Status',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo DHtml::enumList($model,'Status',array('class'=>'form-control','prompt'=>'Search by Status')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Status'); ?>
				</div>
			</div>
			<?php /*<div class="form-group">
				<?php echo $form->labelEx($model,'StructureId',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->dropDownList($model,'StructureId',CHtml::listData(Structure::model()->findAll(),'Id','lookup'),array('class'=>'form-control','prompt'=>'Choose One')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'StructureId'); ?>
				</div>
			</div>*/ ?>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
		<button type="submit" class="btn btn-primary pull-right">Search</button>
		</div>
		<!-- /.box-footer -->
	<?php $this->endWidget(); ?>
	<?php echo $form->errorSummary($model); ?>
</div>
