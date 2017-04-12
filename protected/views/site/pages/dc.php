<?php

$this->pageTitle=Yii::app()->name . ' - Diagram Charts';
$this->breadcrumbs=array(
	'Dc',
);

$temp = Structure::model()->findAll();
$level = array();
foreach($temp as $key => $val){
	if ($val->Level == 1) $level[0][] = $val->GroupEmployee;
	if ($val->Level == 2) $level[1][] = $val->GroupEmployee;
	if ($val->Level == 3) $level[2][] = $val->GroupEmployee;
	if ($val->Level == 4) $level[3][] = $val->GroupEmployee;
}

?>

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/orgchart/orgchart.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/orgchart/orgchart.js"></script>
	<style type="text/css">
	a{
		color: #FFC107;
		text-decoration: none;
	}
	.pembatas{
		border:solid 1px #3b5998;
		padding: 25px 25px 25px 25px;
		
	}
	.judul{
		border:solid 1px #3b5998;
		padding: 25px 25px 25px 25px;
		border-top-left-radius: 10px;
		border-top-right-radius: 10px;
		font-size:20px;
		color:white;
		text-align: center;
	}
	</style>
<body>
<!--- Bagian Konten-->
<div class="container">
	<div class="row judul" style="background-color:#3b5998">
	<strong>Struktur Organisasi</strong>
	</div>
</div>	

<div class="container" >
<div class="row pembatas" >

	<ul id="tree-data" style="display:none">
			<li id="root">
				<?php echo $level[0][0] ?>
				<ul>
					
					<li id="node1">
						<?php echo $level[1][0] ?>
						<ul>
							<li id="node2">
								<?php echo $level[2][0] ?>
								<ul>
									<li id="node2">
										<?php echo $level[3][0] ?>
									</li>
									<li id="node3">
										<?php echo $level[3][1] ?>
									</li>
									<li id="node3">
										<?php echo $level[3][2] ?>
									</li>
									<li id="node3">
										<?php echo $level[3][3] ?>
									</li>
									<li id="node3">
										<?php echo $level[3][4] ?>
									</li>
									<li id="node3">
										<?php echo $level[3][5] ?>
									</li>
								</ul>
							</li>
							<li id="node3">
								<?php echo $level[2][1] ?>
								<ul>
									<li id="node2">
										<?php echo $level[3][6] ?>
									</li>
									<li id="node2">
										<?php echo $level[3][7] ?>
									</li>
									<li id="node2">
										<?php echo $level[3][8] ?>
									</li>
									<li id="node2">
										<?php echo $level[3][9] ?>
									</li>
									<li id="node3">
										<?php echo $level[3][10] ?>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					
				</ul>
				
			</li>
	</ul>
    <div id="tree-view"></div>	
<script>
	$(document).ready(function () {
	// create a tree
	$("#tree-data").jOrgChart({
		chartElement: $("#tree-view"), 
		nodeClicked: nodeClicked
	});
	
	// lighting a node in the selection
	function nodeClicked(node, type) {
		node = node || $(this);
		$('.jOrgChart .selected').removeClass('selected');
			node.addClass('selected');
		}
	});
</script>		
		
</div>
</div>

<!--- Akhir Bagian Konten-->	
	
	
<br><br> 
</body>
