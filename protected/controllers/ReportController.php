<?php

class ReportController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			// 'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return require(dirname(__FILE__).'/Rules.php');
	}

	public function actionIndex()
	{
		$active = new Document('active');
		$process = new Document('process');
		$final = new Document('execute');
		if(isset($_REQUEST['Document'])){
			$final->attributes=$_REQUEST['Document'];
		}
		$this->render('index',array(
			'active'=>$active,
			'process'=>$process,
			'final'=>$final,
		));
	}

	public function actionView()
	{
		$model = new Document('search');
		$model->RowStatus = 2;
		if(isset($_REQUEST['Document'])){
			$model->attributes=$_REQUEST['Document'];
		}
		$this->render('reminder',array(
			'model'=>$model,
		));
	}
}