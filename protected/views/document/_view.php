<?php
/* @var $this DocumentController */
/* @var $data Document */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Code')); ?>:</b>
	<?php echo CHtml::encode($data->Code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Number')); ?>:</b>
	<?php echo CHtml::encode($data->Number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocumentName')); ?>:</b>
	<?php echo CHtml::encode($data->DocumentName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Priority')); ?>:</b>
	<?php echo CHtml::encode($data->Priority); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RequiredBy')); ?>:</b>
	<?php echo CHtml::encode($data->RequiredBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ApprovedBy')); ?>:</b>
	<?php echo CHtml::encode($data->ApprovedBy); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ExecutedBy')); ?>:</b>
	<?php echo CHtml::encode($data->ExecutedBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Instruction')); ?>:</b>
	<?php echo CHtml::encode($data->Instruction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Comment')); ?>:</b>
	<?php echo CHtml::encode($data->Comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatedBy')); ?>:</b>
	<?php echo CHtml::encode($data->CreatedBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatedDate')); ?>:</b>
	<?php echo CHtml::encode($data->CreatedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ModifiedBy')); ?>:</b>
	<?php echo CHtml::encode($data->ModifiedBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ModifiedDate')); ?>:</b>
	<?php echo CHtml::encode($data->ModifiedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RowStatus')); ?>:</b>
	<?php echo CHtml::encode($data->RowStatus); ?>
	<br />

	*/ ?>

</div>