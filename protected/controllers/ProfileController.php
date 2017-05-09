<?php

class ProfileController extends Controller
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

	public function actionPass($id)
	{
		$model=User::model()->findByPk($id);
		if(isset($_POST['User']))
		{
			if($_POST['User']['Password'] == $_POST['User']['Pass']) {
				$_POST['User']['Password'] = md5($_POST['User']['Password'].$model->UniqKey);
				$model->attributes=$_POST['User'];
				if($model->save())
					$this->redirect(array('update','id'=>$model->Id));
			}
			else
				$model->addError('Password', 'Your Password Not Confirm');
		}

		$this->render('pass',array(
			'model'=>$model,
		));
	}

	public function actionCreate()
	{
		$model=new User;
		$profile=new Profile;
		if(isset($_POST['User']) or isset($_POST['Profile']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			$profile->UserId=$model->Id;
			$trans = Yii::app()->db->beginTransaction();
			try {
				if($model->save() and $profile->save())
					if($trans->commit())
						$this->redirect(array('view','id'=>$model->Id));
			} catch(Exception $e) {
				$trans->rollback();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				$this->refresh();
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$profile=Profile::model()->findByAttributes(array('UserId'=>$id));
		if($profile==null) $profile=new Profile;
		if(isset($_POST['User']) or isset($_POST['Profile']))
		{
			if($model->Password === $_POST['User']['Password']){
				unset($_POST['User']['Password']);
			} else {
				$_POST['User']['Password'] = md5($_POST['User']['Password'].$model->UniqKey);
			}
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			$profile->UserId=$model->Id;
			// $trans = Yii::app()->db->beginTransaction();
			try {
				if($model->save() or $profile->save())
					// if($trans->commit())
						$this->redirect(array('view','id'=>$model->Id));
			} catch(Exception $e) {
				// $trans->rollback();
				// Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				// $this->refresh();
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		Profile::model()->findByPk($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_REQUEST['User']))
			$model->attributes=$_REQUEST['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}