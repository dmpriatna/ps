<?php

class Document extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'document';
	}

	public $Since, $Until;
	
	public function rules()
	{
		return array(
			array('Code, DocumentName, Priority, Description, RequiredBy, ApprovedBy, ExecutedBy, Budget, PlanningDate, DocumentStatus, CreatedBy, CreatedDate, Id, RowStatus', 'required'),
			array('Budget, Realization, RowStatus', 'numerical', 'integerOnly'=>true),
			array('Budget', 'greaterThanZero'),
			array('Code, DocumentName, SubName, Description, IdRequiredBy, RequiredBy, IdApprovedBy, ApprovedBy, IdExecutedBy, ExecutedBy, ApprovalStatus, DocumentStatus, CreatedBy', 'length', 'max'=>256),
			array('Id', 'length', 'max'=>36),
			array('Instruction', 'safe'),
			array('Code, DocumentName, Priority, Description, IdRequiredBy, RequiredBy, ApprovedBy, ExecutedBy, Instruction, CreatedBy, CreatedDate, Id, ModifiedBy, ModifiedDate, RowStatus, DocumentStatus, Since, Until', 'safe', 'on'=>'search'),
			array('Code, DocumentName, Priority, Description, IdRequiredBy, RequiredBy, ApprovedBy, ExecutedBy, Instruction, CreatedBy, CreatedDate, Id, ModifiedBy, ModifiedDate, RowStatus, DocumentStatus, Since, Until', 'safe', 'on'=>'execute'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'Code' => 'Code',
			'DocumentName' => 'Document Name',
			'SubName' => 'Sub Name',
			'Priority' => 'Priority',
			'Description' => 'Description',
			'RequiredBy' => 'Required By',
			'ApprovedBy' => 'Approved By',
			'ExecutedBy' => 'Executed By',
			'Budget' => 'Budget',
			'Realization' => 'Realization',
			'PlanningDate' => 'Planning Date',
			'RealizationDate' => 'Realization Date',
			'Instruction' => 'Instruction',
			'ApprovalStatus' => 'Approval Status',
			'DocumentStatus' => 'Document Status',
			'CreatedBy' => 'Created By',
			'CreatedDate' => 'Created Date',
			'Id' => 'ID',
			'ModifiedBy' => 'Modified By',
			'ModifiedDate' => 'Modified Date',
			'RowStatus' => 'Row Status',
			'UserOpen' => 'User Open',
			'Since' => 'Form',
			'Until' => 'To',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$sort = new CSort();

		$criteria->compare('Code',$this->Code,true);
		$criteria->compare('DocumentName',$this->DocumentName,true);
		$criteria->compare('Priority',$this->Priority);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('RequiredBy',$this->RequiredBy,true);
		$criteria->compare('ApprovedBy',$this->ApprovedBy,true);
		$criteria->compare('ExecutedBy',$this->ExecutedBy,true);
		$criteria->compare('Budget',$this->Instruction);
		$criteria->compare('Instruction',$this->Instruction,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy,true);
		$criteria->compare('ModifiedDate',$this->ModifiedDate,true);
		$criteria->compare('RowStatus',$this->RowStatus);
		$criteria->compare('IdRequiredBy',$this->IdRequiredBy);
		$criteria->compare('DocumentStatus',$this->DocumentStatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array('defaultOrder'=>'CreatedDate desc')
		));
	}
	
	public function active()
	{
		$criteria=new CDbCriteria;
		$sort = new CSort();
		$user = yii::app()->user->guid;

		$criteria->compare('RowStatus', $this->RowStatus);
		$criteria->condition = 'IdExecutedBy != "'.$user.'" AND DocumentStatus = "'.$user.'"';
		$sort->attributes = array('UserOpen'=>array('asc'=>'RequiredBy ASC', 'desc'=>'RequiredBy DESC'), '*', 'defaultOrder'=>'CreatedDate desc');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}
	
	public function process()
	{
		$criteria=new CDbCriteria;
		$sort = new CSort();
		$user = yii::app()->user->guid;

		$criteria->compare('RowStatus', $this->RowStatus);
		$criteria->condition = '(IdRequiredBy = "'.$user.'" OR IdApprovedBy LIKE "%'.$user.'%" OR IdExecutedBy = "'.$user.'") AND DocumentStatus NOT IN ("'.$user.'","FINAL","CANCEL")';
		$sort->attributes = array('Position Document'=>array('asc'=>'DocumentStatus ASC', 'desc'=>'DocumentStatus DESC'), '*', 'defaultOrder'=>'CreatedDate desc');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}
	
	public function execute()
	{
		$criteria=new CDbCriteria;
		$sort = new CSort();
		$user = yii::app()->user->guid;

		$criteria->compare('RowStatus', $this->RowStatus);
		$criteria->condition = '(IdRequiredBy = "'.$user.'" OR IdApprovedBy LIKE "%'.$user.'%" OR IdExecutedBy = "'.$user.'") AND DocumentStatus = "FINAL"';
		if($this->Since != '' && $this->Until != '')
			$criteria->condition .= ' AND CreatedDate BETWEEN "'.$this->Since.'" AND "'.$this->Until.'"';
		$sort->attributes = array('defaultOrder'=>'CreatedDate desc');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}
	
	public function exe()
	{
		$criteria=new CDbCriteria;
		$sort = new CSort();
		$user = yii::app()->user->guid;

		$criteria->compare('RowStatus', $this->RowStatus);
		$criteria->condition = 'IdExecutedBy = "'.$user.'" AND ApprovalStatus = "Approved"';
		$sort->attributes = array('defaultOrder'=>'CreatedDate desc');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}
	
	public function greaterThanZero($attribute, $params)
	{
		if ($this->$attribute <= 0)
			$this->addError($attribute, $attribute.' must be greater than 0');
	}

	protected function beforeValidate()
	{
		parent::beforeValidate();
		$guid = new UUID;
		$id = $guid->getGUID();
		$user = yii::app()->user->name;
		$date = date('Y-m-d H:m:s');
		if($this->isNewRecord)
		{
			$this->CreatedBy = $this->CreatedBy == null ? $user : $this->CreatedBy;
			$this->CreatedDate = $date;
			$this->Id = $id;
			$this->RowStatus = $this->RowStatus == null ? 0 : $this->RowStatus;
			$this->Realization = 0;
		}
		else
		{
			$this->ModifiedBy = $user;
			$this->ModifiedDate = $date;
		}
		return true;
	}
}