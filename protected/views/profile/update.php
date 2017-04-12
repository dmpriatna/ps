<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->Name=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-list pull-right"></i>List User', 'url'=>array('index')),
	array('label'=>'<i class="fa fa-user-plus pull-right"></i>Create User', 'url'=>array('create')),
	array('label'=>'<i class="fa fa-folder-open-o pull-right"></i>View User', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'<i class="fa fa-list-alt pull-right"></i>Manage User', 'url'=>array('admin')),
);
?>

<h1>Update User <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'profile'=>$profile)); ?>