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

	public function actionView($id)
	{
		$model = Document::model()->findByPk($id);
		$comment = Comment::model()->findAllByAttributes(array('DocumentId'=>$id), array('order'=>'CreatedDate desc'));
		$log = History::model()->findAllByAttributes(array('Subject'=>$id), array('order'=>'CreatedDate desc'));
		$this->render('view',array(
			'model'=>$model,
			'comment'=>$comment,
			'history'=>$log,
		));
	}

	public function actionReminder()
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

	public function actionFinal()
	{
		$model = new Document('search');
		$model->DocumentStatus = "FINAL";
		$model->Since = date('Y-m-d', strtotime(date('Y').date('m')."01"));
		$model->Until = date('Y-m-d');
		if(isset($_REQUEST['Document'])){
			$model->attributes=$_REQUEST['Document'];
		}
		$this->render('final',array(
			'model'=>$model,
		));
	}

	public function actionCancel()
	{
		$model = new Document('search');
		$model->DocumentStatus = "CANCEL";
		$model->Since = date('Y-m-d', strtotime(date('Y').date('m')."01"));
		$model->Until = date('Y-m-d');
		if(isset($_REQUEST['Document'])){
			$model->attributes=$_REQUEST['Document'];
		}
		$this->render('cancel',array(
			'model'=>$model,
		));
	}

	public function actionReal()
	{
		$model = new Document('search');
		$model->DocumentStatus = "FINAL";
		$model->Since = date('Y-m-d', strtotime(date('Y').date('m')."01"));
		$model->Until = date('Y-m-d');
		if(isset($_REQUEST['Document'])){
			$model->attributes=$_REQUEST['Document'];
		}
		$this->render('real',array(
			'model'=>$model,
		));
	}
}