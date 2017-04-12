<?php

class ConfigController extends Controller
{
	public function actionDivision() {
		$return = Structure::model()->division();
		echo CJSON::encode($return);
    }

	public function actionMember() {
		$param = isset($_REQUEST['term']) ? $_REQUEST['term']!=1 ? $_REQUEST['term']-1: $_REQUEST['term'] : 0;
		$list = Structure::model()->findAll(
			array('condition' => 'Level = '.$param));
		$return = array();
		foreach($list as $key => $value)
		{
			$return[] = array("id"=>$value->Id,"label"=>$value->GroupEmployee.", ".$value->Division);
		}
		echo CJSON::encode($return);
    }

	public function actionGroup() {
		$return = Structure::model()->groupEmployee();
		echo CJSON::encode($return);
    }

	public function actionLevel() {
		$return = Structure::model()->level();
		echo CJSON::encode($return);
    }
	
	public function actionRoles()
	{
		$param = array('condition'=>'GroupEmployee LIKE "'.$_REQUEST['term'].'%"');
		$list =	Structure::model()->findAll($param);
		$return = array();
		foreach($list as $key => $value)
		{
			$return[] = array("id"=>$value->Id,"label"=>$value->GroupEmployee." ".$value->Division);
		}
		echo CJSON::encode($return);
	}
	
	public function actionRight()
	{
		$term = $_REQUEST['term'];
		$rule = $_REQUEST['rule'];
		$param = array('condition'=>'StructureId = "'.$rule.'" AND Name LIKE "'.$term.'%"');
		$list =	User::model()->findAll($param);
		$return = $list == null ? array("label"=>"No User Attach With This Role") : array();
		foreach($list as $key => $value)
		{
			$return[] = array("id"=>$value->Id,"label"=>$value->Name);
		}
		echo CJSON::encode($return);
	}
	
	public function actionRights()
	{
		$term = $_REQUEST['term'];
		$str = substr($_REQUEST['rule'], 0, strlen($_REQUEST['rule'])-1);
		$rule = '"'.preg_replace('|, |', '","', $str).'"';
		$param = array('condition'=>'StructureId IN ('.$rule.') AND Name LIKE "'.$term.'%"');
		// echo "<pre>"; print_r($param); echo "</pre>"; die;
		$list =	User::model()->findAll($param);
		$return = $list == null ? array("label"=>"No User Attach With This Role") : array();
		foreach($list as $key => $value)
		{
			$return[] = array("id"=>$value->Id,"label"=>$value->Name);
		}
		echo CJSON::encode($return);
	}
	
	public function actionRequired()
	{
		// To Do
	}
	
	public function actionRequiredBy()
	{
		// To Do
	}
	
	public function actionApproved()
	{
		// To Do
	}
	
	public function actionApprovedBy()
	{
		// To Do
	}
	
	public function actionExecuted()
	{
		// To Do
	}

	public function actionExecutedBy()
	{
		// To Do
	}

	public function actionTest()
	{
		// echo CJSON::encode(
			// CHtml::listData(
				// User::model()->findAll(
					// array('condition' => 'Name LIKE "'.$_REQUEST['term'].'%"')),
			// 'Id', 'Name'));
			
		// $sql= "SELECT Id As id , Name AS label FROM user WHERE Name LIKE '$_REQUEST[term]%'";
        // echo CJSON::encode( Yii::app()->db->createCommand($sql)->queryAll() );
		
		// $list =	User::model()->findAll(/*array('condition' => 'Name LIKE "'.$_REQUEST['term'].'%"')*/);
		// $return = array();
		// foreach($list as $key => $value)
		// {
			// $return[] = array("id"=>$value->Id,"label"=>$value->Name);
		// }
		// echo CJSON::encode($return);

		echo CJSON::encode("ok");
	}
}