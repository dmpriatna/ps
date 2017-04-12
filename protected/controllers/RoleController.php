<?php

class RoleController extends Controller
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

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new Role;
		$model->Number = "0001/".date('m')."/".date('Y');
		if(isset($_POST['Role']))
		{
			$model->attributes=$_POST['Role'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Role']))
		{
			$model->attributes=$_POST['Role'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$beforeRun = Role::model()->findAll(array('condition'=>'RowStatus = 0'));
		foreach($beforeRun as $data) {
			if(explode("/", $data->Number)[1] != date('m')) {
				$data->Number = "0001/".date('m')."/".date('Y');
				$data->save();
			}
		}
		$user = yii::app()->user;
		$id = User::model()->find(array('condition'=>"Id = '$user->guid'"))->StructureId;
		
		$model = new Role('search');
		$model->IdRequiredBy = $user->level == 'User' ? $id : '';
		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionAdmin()
	{
		$model=new Role('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Role']))
			$model->attributes=$_GET['Role'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Role::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='role-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}