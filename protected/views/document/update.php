<?php
/* @var $this DocumentController */
/* @var $model Document */

$this->breadcrumbs=array(
	'Documents'=>array('/role/index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Document', 'url'=>array('index')),
	array('label'=>'Create Document', 'url'=>array('create')),
	array('label'=>'View Document', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage Document', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('attach'=>$attach, 'model'=>$model)); ?>

<?php
if($flashes = Yii::app()->user->getFlashes()) {
    foreach($flashes as $key => $model) {
        if($key != 'counters') {
			$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
				'id'=>$key,
				'options'=>array(
					'show' => 'blind',
					'hide' => 'explode',
					'modal' => 'true',
					'title' => $key,
					'autoOpen'=>true,
					),
				));
			echo $model;
            $this->endWidget('zii.widgets.jui.CJuiDialog');
        }
    }
}
?>