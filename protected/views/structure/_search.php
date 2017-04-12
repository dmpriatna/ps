<!-- /.box-header -->
<div class="box box-info">
	<!-- form start -->
	<?php $form=$this->beginWidget('CActiveForm',
		array('action'=>Yii::app()->createUrl($this->route),
			'htmlOptions'=>array('class'=>'form-horizontal')
		)); ?>
		<div class="box-body">
			<div class="form-group">
				<?php echo $form->labelEx($model,'Level',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						'attribute' => 'Level',
						'model' => $model,
						'sourceUrl' => $this->createUrl('level'),
						'options' => array('minLength' => '1'),
						'htmlOptions' => array('class' => 'form-control','maxlength'=>1,'placeholder'=>'Number of Level'),
					)); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $form->error($model,'Level'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'Division',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-5">
					<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						'attribute' => 'Division',
						'model' => $model,
						'sourceUrl' => $this->createUrl('division'),
						'options' => array('minLength' => '1'),
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
					<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						'attribute' => 'GroupEmployee',
						'model' => $model,
						'sourceUrl' => $this->createUrl('group'),
						'options' => array('minLength' => '1'),
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
		<button type="submit" class="btn btn-primary pull-right">Search</button>
		</div>
		<!-- /.box-footer -->
	<?php $this->endWidget(); ?>
	<?php echo $form->errorSummary($model); ?>
</div>