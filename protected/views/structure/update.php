<?php
/* @var $this StructureOrganisationController */
/* @var $model StructureOrganisation */

$this->breadcrumbs=array(
	'Structure'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-list pull-right"></i>List Structure', 'url'=>array('index')),
	array('label'=>'<i class="fa fa-plus pull-right"></i>Create Structure', 'url'=>array('create')),
	array('label'=>'<i class="fa fa-folder-open-o pull-right"></i>View Structure', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'<i class="fa fa-list-alt pull-right"></i>Manage Structure', 'url'=>array('admin')),
);
?>

<h1>Update Structure <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>