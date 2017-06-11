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
		$model = new Document('reminder');
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
		$model = new Document('reportFinal');
		if(isset($_REQUEST['Document'])){
			$model->Since = $_REQUEST['Document']['Since'];
			setcookie('Since', $_REQUEST['Document']['Since'], time() + 3600);
			$model->Until = $_REQUEST['Document']['Until'];
			setcookie('Until', $_REQUEST['Document']['Until'], time() + 3600);
			$model->Code = $_REQUEST['Document']['Code'];
			$model->SubName = $_REQUEST['Document']['SubName'];
		} else {
			$model->Since = isset($_COOKIE['Since']) ? $_COOKIE['Since'] : date('Y-m-d', strtotime(date('Y').date('m')."01"));
			$model->Until = isset($_COOKIE['Until']) ? $_COOKIE['Until'] : date('Y-m-d');
		}
		$this->render('final',array(
			'model'=>$model,
		));
	}

	public function actionCancel()
	{
		$model = new Document('search');
		if(isset($_REQUEST['Document'])){
			$model->DocumentStatus = "CANCEL";
			$model->Since = $_REQUEST['Document']['Since'];
			setcookie('Since', $_REQUEST['Document']['Since'], time() + 3600);
			$model->Until = $_REQUEST['Document']['Until'];
			setcookie('Until', $_REQUEST['Document']['Until'], time() + 3600);
			$model->Code = $_REQUEST['Document']['Code'];
			$model->SubName = $_REQUEST['Document']['SubName'];
		} else {
			$model->DocumentStatus = "CANCEL";
			$model->Since = isset($_COOKIE['Since']) ? $_COOKIE['Since'] : date('Y-m-d', strtotime(date('Y').date('m')."01"));
			$model->Until = isset($_COOKIE['Until']) ? $_COOKIE['Until'] : date('Y-m-d');
		}
		$this->render('cancel',array(
			'model'=>$model,
		));
	}

	public function actionReal()
	{
		$model = new Document('search');
		if(isset($_REQUEST['Document'])){
			$model->DocumentStatus = "FINAL";
			$model->Since = $_REQUEST['Document']['Since'];
			setcookie('Since', $_REQUEST['Document']['Since'], time() + 3600);
			$model->Until = $_REQUEST['Document']['Until'];
			setcookie('Until', $_REQUEST['Document']['Until'], time() + 3600);
			$model->Code = $_REQUEST['Document']['Code'];
			$model->SubName = $_REQUEST['Document']['SubName'];
		} else {
			$model->DocumentStatus = "FINAL";
			$model->Since = isset($_COOKIE['Since']) ? $_COOKIE['Since'] : date('Y-m-d', strtotime(date('Y').date('m')."01"));
			$model->Until = isset($_COOKIE['Until']) ? $_COOKIE['Until'] : date('Y-m-d');
		}
		$this->render('real',array(
			'model'=>$model,
		));
	}
	public function actionPrint()
	{
		$dataReportItem = new Document('execute');
		Yii::app()->request->sendFile('items_periode_.xls',
			$this->renderPartial('print',array(
				'dataReportItem' =>$dataReportItem,
			)
		),true);                
	}
}