<?php
/* @var $this StructureOrganisationController */
/* @var $data StructureOrganisation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Level')); ?>:</b>
	<?php echo CHtml::encode($data->Level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Division')); ?>:</b>
	<?php echo CHtml::encode($data->Division); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GroupEmployee')); ?>:</b>
	<?php echo CHtml::encode($data->GroupEmployee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatedBy')); ?>:</b>
	<?php echo CHtml::encode($data->CreatedBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatedDate')); ?>:</b>
	<?php echo CHtml::encode($data->CreatedDate); ?>
	<br />

	<?php /*
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