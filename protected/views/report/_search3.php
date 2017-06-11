<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'htmlOptions'=>array('class'=>'form-horizontal')
)); ?>
<!-- /.box-header -->
<div class="box box-info">
	<div class="box-body">
		<div class="form-group">
			<?php echo $form->labelEx($model,'Since',array('class'=>'col-sm-1 control-label')); ?>
			<div class="col-sm-3">
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'attribute'=>'Since',
					'model'=>$model,
					'options'=>array(
						'changeMonth'=>true,
						'changeYear'=>true,
						'dateFormat'=>'yy-mm-dd',
					),
					'htmlOptions'=>array(
						'class'=>'form-control',
						'placeholder'=>'Search Field'
					),
				)); ?>
			</div>
			<?php echo $form->labelEx($model,'Until',array('class'=>'col-sm-1 control-label')); ?>
			<div class="col-sm-3">
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'attribute'=>'Until',
					'model'=>$model,
					'options'=>array(
						'changeMonth'=>true,
						'changeYear'=>true,
						'dateFormat'=>'yy-mm-dd',
					),
					'htmlOptions'=>array(
						'class'=>'form-control',
						'placeholder'=>'Search Field'
					),
				)); ?>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<button id="submit" type="submit" class="btn btn-primary pull-right">Search</button>
	</div>
</div>
<?php $this->endWidget(); ?>
<?php echo $form->errorSummary($model); ?>