<?php
/* @var $this RoleController */
/* @var $model Role */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'DocumentName'); ?>
		<?php echo $form->textField($model,'DocumentName',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Priority'); ?>
		<?php echo $form->textField($model,'Priority'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RequiredBy'); ?>
		<?php echo $form->textField($model,'RequiredBy',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ApprovedBy'); ?>
		<?php echo $form->textField($model,'ApprovedBy',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ExecutedBy'); ?>
		<?php echo $form->textField($model,'ExecutedBy',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreatedBy'); ?>
		<?php echo $form->textField($model,'CreatedBy',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreatedDate'); ?>
		<?php echo $form->textField($model,'CreatedDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Id'); ?>
		<?php echo $form->textField($model,'Id',array('size'=>36,'maxlength'=>36)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ModifiedBy'); ?>
		<?php echo $form->textField($model,'ModifiedBy',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ModifiedDate'); ?>
		<?php echo $form->textField($model,'ModifiedDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RowStatus'); ?>
		<?php echo $form->textField($model,'RowStatus'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->