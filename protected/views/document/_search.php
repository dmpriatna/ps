<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'htmlOptions'=>array('class'=>'form-horizontal')
)); ?>
<!-- /.box-header -->
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Data Document</h3>
	</div>
		<div class="box-body">
			<div class="form-group">
				<?php echo $form->labelEx($model,'Code',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'Code', array('class' => 'form-control', 'placeholder'=>'Search Field')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Code'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'DocumentName',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'DocumentName', array('class' => 'form-control', 'placeholder'=>'Search Field')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'DocumentName'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Priority',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php echo $form->textField($model,'Priority', array('class' => 'form-control', 'placeholder'=>'Search Field')); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Priority'); ?>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button id="submit" type="submit" class="btn btn-primary pull-right">Search</button>
		</div>
</div>
<?php $this->endWidget(); ?>
<?php echo $form->errorSummary($model); ?>