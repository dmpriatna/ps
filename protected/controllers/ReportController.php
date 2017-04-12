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
		$final = new Document('search');
		$final->DocumentStatus = 'FINAL';
		$this->render('index',array(
			'active'=>$active,
			'process'=>$process,
			'final'=>$final,
		));
	}
}