<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-list pull-right"></i>List User', 'url'=>array('index')),
	array('label'=>'<i class="fa fa-list pull-right"></i>Manage User', 'url'=>array('admin')),
);
?>

<h1>Create User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'profile'=>$profile)); ?>