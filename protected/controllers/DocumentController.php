<?php

class DocumentController extends Controller
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
		$array = array('index');
		switch(yii::app()->user->level)
		{
			case "Super Admin" :
				$array = array_merge($array,array('admin','create','delete','update','view'));
			break;
			case "Admin" :
				$array = array_merge($array,array('add','admin','create','view'));
			break;
			case "User" :
				$array = array_merge($array,array('add','create','view','update','approve'));
			break;
			case "Reader" :
				$array = array_merge($array,array('read'));
			break;
			default :
				$array = array_merge($array,array());
			break;
		}
		return array(
			array('allow',  // allow all users
				'actions'=>$array,
				'users'=>array('*'),
			),
			array('allow',  // allow all authenticate users
				'actions'=>$array,
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAdd()
	{
		$model = new Attachment;
		$history = new History;
		if(isset($_POST['submit']))
		{
			$id = $_POST['DocumentId'];
			$file = array();
			$count = 0;
			foreach($_FILES['Attachment'] as $key1 => $value1) {
				foreach($value1['UploadedFile'] as $key2 => $value2) {
					$file[$key2][$key1] = $value2;
				}
			}			
			foreach($file as $value) {
				$charid = strtoupper(md5(uniqid(rand(), true)));
				$ext = pathinfo($value['name'], PATHINFO_EXTENSION);
				$new = Yii::app()->basePath.'/views/images/'.$charid.'.'.$ext;
				$model = new Attachment;
				$model->Name = $charid.'.'.$ext;
				$model->Type = $value['type'];
				$model->Size = $value['size'];
				$model->DocumentId = $id;
				if($model->save()) { move_uploaded_file($value['tmp_name'], $new); $count++; }
			}
			if($count == count($file))
			{
				$history->Subject = $id;
				$history->Predicate = "Add $count Attachment";
				$history->save();
				$this->redirect(array('approve','id'=>$id));
			}
		}
	}

	public function actionApprove($id)
	{
		$model=$this->loadModel($id);
		$comment = Comment::model()->findAllByAttributes(array('DocumentId'=>$id));
		$log = History::model()->findAllByAttributes(array('Subject'=>$id));
		$history = new History;
		if(isset($_POST['submit']))
		{
			$count = 0;
			$swap = unserialize($model->ApprovalData);
			$swap[yii::app()->user->guid] = 1;
			foreach($swap as $value){
				$count += $value;
			}
			foreach($swap as $key => $value){
				if($value == 0) {
					 $model->DocumentStatus = $key;
					 break;
				}
			}
			$model->ApprovalData = serialize($swap);
			if($count == count($swap)) {
				$model->ApprovalStatus = "Approved";
				$model->DocumentStatus = $model->IdExecutedBy;
			} else
				$model->ApprovalStatus = "Proccess";
			if($model->save()) {
				$history->Subject = $model->Id;
				$history->Predicate = "Approval";
				$history->save();
				$this->redirect(array('view','id'=>$model->Id));
			}
		}
		if(isset($_POST['exec'])) {
			$model->Realization = $_POST['Document']['Realization'];
			if($model->Realization <= 0) 
				$model->addError('Realization', 'Realization must be greater than 0');
			else if($model->Realization > $model->Budget)
				$model->addError('Realization', 'Realization must be equal or less than Budget');
			else {
				$model->ApprovalStatus = "Executed";
				$model->DocumentStatus = "FINAL";
				if($model->save()) {
					$history->Subject = $model->Id;
					$history->Predicate = "Executed";
					$history->save();
					$this->redirect(array('view','id'=>$model->Id));
				}				
			}
		}
		if(isset($_POST['back'])) {
			$model->ApprovalStatus = "Revise";
			$model->DocumentStatus = $model->IdRequiredBy;
			if($model->save()) {
				$history->Subject = $model->Id;
				$history->Predicate = "Revisi";
				$history->save();
				$this->redirect(array('view','id'=>$model->Id));
			}
		}
		$this->render('approve',array(
			'model'=>$model,
			'comment'=>$comment,
			'history'=>$log,
		));
	}

	public function actionView($id)
	{
		/* $model = Attachment::model()->find(array('condition'=>'DocumentId = "'.$id.'"'));
 
		// header('Pragma: public');
		// header('Expires: 0');
		// header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		// header('Content-Transfer-Encoding: binary');
		header('Content-length: '.$model->Size);
		header('Content-Type: '.$model->Type);
		// header('Content-Disposition: attachment; filename='.$model->Name);
 
        echo $model->Content; */
		$model=$this->loadModel($id);
		$comment = Comment::model()->findAllByAttributes(array('DocumentId'=>$id), array('order'=>'CreatedDate desc'));
		$log = History::model()->findAllByAttributes(array('Subject'=>$id), array('order'=>'CreatedDate desc'));

		$this->render('view',array(
			'model'=>$model,
			'comment'=>$comment,
			'history'=>$log,
		));
	}

	public function actionRead($id)
	{
		$model=$this->loadModel($id);
		$comment = Comment::model()->findAllByAttributes(array('DocumentId'=>$id), array('order'=>'CreatedDate desc'));
		$log = History::model()->findAllByAttributes(array('Subject'=>$id), array('order'=>'CreatedDate desc'));

		$this->render('read',array(
			'model'=>$model,
			'comment'=>$comment,
			'history'=>$log,
		));
	}

	public function actionCreate()
	{
		$model=new Document;
		$attach = new Attachment;
		$history = new History;
		if(isset($_SERVER['CONTENT_LENGTH']))
			if(8388608 < $_SERVER['CONTENT_LENGTH'])
				$attach->addError('Size', 'Size of File is Over than Allowed <b>8Mb</b> (8388608 byte)');
		$role = Role::model()->findByPk($_GET['id']);
		preg_match_all('~[^, ]++~', $role->IdApprovedBy,$result);
		$userCreate = User::model()->findByAttributes(array('StructureId'=>$role->IdRequiredBy));
		$IdApprovedBy = array();
		$ApprovedBy = array();
		foreach($result[0] as $value) {
			$user = User::model()->findByAttributes(array('StructureId'=>$value));
			$IdApprovedBy[] = $user->Id;
			$ApprovedBy[] = $user->Name;
		}
		$value = array_fill(0, count($IdApprovedBy), 0);
		$userExecute = User::model()->findByAttributes(array('StructureId'=>$role->IdExecutedBy));
		$model->Code = $role->Code." ".$role->Number;
		$model->DocumentName = $role->DocumentName;
		$model->Priority = $role->Priority;
		$model->Description = $role->Description;
		$model->IdRequiredBy = $userCreate->Id;
		$model->RequiredBy = $userCreate->Name;
		$model->IdApprovedBy = join(', ', $IdApprovedBy);
		$model->ApprovedBy = join(', ', $ApprovedBy);
		$model->ApprovalData = serialize(array_combine($IdApprovedBy, $value));
		$model->DocumentStatus = $IdApprovedBy[0];
		$model->IdExecutedBy = $userExecute->Id;
		$model->ExecutedBy = $userExecute->Name;
		if(isset($_POST['Document']))
		{
			$model->attributes=$_POST['Document'];
			$trans = Yii::app()->db->beginTransaction();
			try {
				if($model->save()) {
					$history->Subject = $model->Id;
					$history->Predicate = "Create Document";
					$history->save();
					
					$num = explode("/", $role->Number);
					$role->Number = sprintf("%04s%s",++$num[0],"/".$num[1]."/".$num[2]);
					$role->save();

					if($_FILES['Attachment']['name']['UploadedFile'][0] != null){
						$file = array();
						foreach($_FILES['Attachment'] as $key1 => $value1) {
							foreach($value1['UploadedFile'] as $key2 => $value2) {
								$file[$key2][$key1] = $value2;
							}
						}
						
						foreach($file as $value) {
							$charid = strtoupper(md5(uniqid(rand(), true)));
							$ext = pathinfo($value['name'], PATHINFO_EXTENSION);
							$new = Yii::app()->basePath.'/views/images/'.$charid.'.'.$ext;
							$attach = new Attachment;
							$attach->Name = $charid.'.'.$ext;
							$attach->Type = $value['type'];
							$attach->Size = $value['size'];
							$attach->DocumentId = $model->Id;
							if($attach->save()) move_uploaded_file($value['tmp_name'], $new);
						}
					}
				}
				$trans->commit();
					$this->redirect(array('view','id'=>$model->Id));
			} catch(Exception $e) {
				$trans->rollback();
				$this->render('create',array(
					'attach'=>$attach,
					'model'=>$model,
				));
			}
		}
		
		$this->render('create',array(
			'attach'=>$attach,
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$role = Role::model()->findByPk($_GET['id']);
		$swap=Attachment::model()->find(array('condition'=>'DocumentId = "'.$id.'"'));
		$attach=$swap == null ? new Attachment : $swap;
		$history = new History;
		if(isset($_POST['cancel'])) {
			$model->ApprovalStatus = "Rejected";
			$model->DocumentStatus = "CANCEL";
			if($model->save()) {
				$history->Subject = $model->Id;
				$history->Predicate = "Rejected";
				$history->save();
				$this->redirect(array('view','id'=>$model->Id));
			}
		} else if(isset($_POST['Document'])) {
			$model->attributes=$_POST['Document'];
			$model->ApprovalStatus = NULL;
			// $user = User::model()->find(array('condition'=>'Id = "'.explode(",", $model->IdApprovedBy)[0].'"'));
			// $model->DocumentStatus = $user == null ? "User Can't Find" : $user->Id;
			$model->DocumentStatus = trim(explode(",", $model->IdApprovedBy)[0]);
			$trans = Yii::app()->db->beginTransaction();
			try {
				if($model->save()) {
					$history->Subject = $model->Id;
					$history->Predicate = "Update";
					$history->save();
					$file = array();
					foreach($_FILES['Attachment'] as $key1 => $value1) {
						foreach($value1['UploadedFile'] as $key2 => $value2) {
							$file[$key2][$key1] = $value2;
						}
					}
					
					foreach($file as $value) {
						$charid = strtoupper(md5(uniqid(rand(), true)));
						$ext = pathinfo($value['name'], PATHINFO_EXTENSION);
						$new = Yii::app()->basePath.'/views/images/'.$charid.'.'.$ext;
						$attach = new Attachment;
						$attach->Name = $charid.'.'.$ext;
						$attach->Type = $value['type'];
						$attach->Size = $value['size'];
						$attach->DocumentId = $model->Id;
						if($attach->save()) move_uploaded_file($value['tmp_name'], $new);
					}
					$trans->commit();
					$this->redirect(array('view','id'=>$model->Id));
				}
			} catch(Exception $e) {
				$trans->rollback();
				Yii::app()->user->setFlash('error', "{$e->getMessage()}");
				$this->refresh();
			}
		}

		$this->render('update',array(
			'attach'=>$attach,
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		$pict = Attachment::model()->findAllByAttributes(array('DocumentId'=>$id));
		foreach($pict as $value) {
			if(file_exists(yii::app()->basepath.'\\views\images\\'.$value->Name))
				unlink(yii::app()->basepath.'\\views\images\\'.$value->Name);
			$value->delete();
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$this->render('index',array(
			'model'=>new Document('search'),
		));
	}

	public function actionAdmin()
	{
		$model=new Document('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_REQUEST['Document']))
			$model->attributes=$_REQUEST['Document'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Document::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='document-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}