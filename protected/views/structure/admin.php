<?php
/* @var $this StructureOrganisationController */
/* @var $model StructureOrganisation */

$this->breadcrumbs=array(
	'Structure'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-list pull-right"></i>List Structure', 'url'=>array('index')),
	array('label'=>'<i class="fa fa-plus pull-right"></i>Create Structure', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form-horizontal').submit(function(){
	$('#structure-organisation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Structure</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'structure-organisation-grid',
	'dataProvider'=>$model->search(),
	// 'filter'=>$model,
	'columns'=>array(
		'Level',
		'GroupEmployee',
		'Division',
		array('name'=>'MemberOf','value'=>'$data->member'),
		/*
		'Id',
		'CreatedBy',
		'CreatedDate',
		'ModifiedBy',
		'ModifiedDate',
		'RowStatus',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
	'pager'=>array('header'=>''),
	'pagerCssClass'=>'pagination',
	// 'itemsCssClass' => 'table table-bordered table-striped',
	'htmlOptions'=>array('style'=>'overflow:auto; white-space:nowrap')
)); ?>
