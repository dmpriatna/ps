<h3>Items | Periode</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    // 'fixedHeader' => true,
    // 'headerOffset' => 40,
    // 'type' => 'striped',
    'dataProvider' => $dataReportItem->execute(),
    // 'responsiveTable' => true,
    'template' => "{items}",
        'columns'=>array(
		'Code',
		'DocumentName',
		'DocumentStatus',
		'CreatedDate',
		'Priority',
        ),
    ));?>
<div align="left">
    <b>Printed By : <?php echo Yii::app()->user->name;?><br/>
Printed At : <?php echo date("d/m/Y H:i:s");?></b>
            <div align="right">Copyright &COPY; <?php echo date('Y'); ?> By Jsource</div>
</div>