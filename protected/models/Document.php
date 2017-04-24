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
			array('Code, DocumentName, Description, IdRequiredBy, RequiredBy, IdApprovedBy, ApprovedBy, IdExecutedBy, ExecutedBy, ApprovalStatus, DocumentStatus, CreatedBy', 'length', 'max'=>256),
			array('Id', 'length', 'max'=>36),
			array('Instruction', 'safe'),
			array('Code, DocumentName, Priority, Description, IdRequiredBy, RequiredBy, ApprovedBy, ExecutedBy, Instruction, CreatedBy, CreatedDate, Id, ModifiedBy, ModifiedDate, RowStatus, DocumentStatus, Since, Until', 'safe', 'on'=>'search'),
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
		// $criteria->compare('CreatedDate',$this->CreatedDate,true);
		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy,true);
		$criteria->compare('ModifiedDate',$this->ModifiedDate,true);
		$criteria->compare('RowStatus',$this->RowStatus);
		$criteria->compare('IdRequiredBy',$this->IdRequiredBy);
		$criteria->compare('DocumentStatus',$this->DocumentStatus);
		$criteria->addBetweenCondition('CreatedDate', $this->Since, $this->Until);
		$sort->attributes = array('UserOpen'=>array('asc'=>'RequiredBy ASC', 'desc'=>'RequiredBy DESC'), '*');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}
	
	public function active()
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
		$criteria->compare('CreatedDate',$this->CreatedDate,true);
		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy,true);
		$criteria->compare('ModifiedDate',$this->ModifiedDate,true);
		$criteria->compare('RowStatus',$this->RowStatus);
		$criteria->compare('IdRequiredBy',$this->IdRequiredBy);
		$criteria->compare('DocumentStatus',$this->DocumentStatus);
		$criteria->condition = 'DocumentStatus = IdRequiredBy';
		$sort->attributes = array('UserOpen'=>array('asc'=>'RequiredBy ASC', 'desc'=>'RequiredBy DESC'), '*');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}
	
	public function process()
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
		$criteria->compare('CreatedDate',$this->CreatedDate,true);
		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy,true);
		$criteria->compare('ModifiedDate',$this->ModifiedDate,true);
		$criteria->compare('RowStatus',$this->RowStatus);
		$criteria->compare('IdRequiredBy',$this->IdRequiredBy);
		$criteria->compare('DocumentStatus',$this->DocumentStatus);
		$criteria->condition = 'DocumentStatus LIKE (IdApprovedBy) OR ';
		$criteria->condition .= 'DocumentStatus = IdExecutedBy';
		$sort->attributes = array('UserOpen'=>array('asc'=>'RequiredBy ASC', 'desc'=>'RequiredBy DESC'), '*');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}
	
	// public function getUser()
	// {
		// return CHtml::ListData(User::model()->findAll(), "Id", "Name");
	// }
	
	// public function getApprove()
	// {
		// return CHtml::ListData(User::model()->findAll(), "Id", "Name");
	// }
	
	// public function getExecute()
	// {
		// return CHtml::ListData(User::model()->findAll(), "Id", "Name");
	// }

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
			// $this->DocumentStatus = "NEW";
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