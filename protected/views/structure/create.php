<?php
/* @var $this StructureOrganisationController */
/* @var $model StructureOrganisation */

$this->breadcrumbs=array(
	'Structure'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-list pull-right"></i>List Structure', 'url'=>array('index')),
	array('label'=>'<i class="fa fa-list-alt pull-right"></i>Manage Structure', 'url'=>array('admin')),
);
?>

<h1>Create Structure</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>