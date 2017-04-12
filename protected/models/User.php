<?php

class User extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'user';
	}
	
	public $Pass;

	public function rules()
	{
		return array(
			array('Name, Email, Password, UniqKey, Status, Level, StructureId, CreatedBy, CreatedDate, Id, RowStatus', 'required'),
			array('RowStatus', 'numerical', 'integerOnly'=>true),
			array('Name, Email, Password, CreatedBy, ModifiedBy', 'length', 'max'=>255),
			array('Id, StructureId', 'length', 'max'=>36),
			array('Status, Level', 'length', 'max'=>11),
			array('ModifiedDate', 'safe'),
			array('Name, Email', 'unique'),
			array('Name, Email, Password, Status, CreatedBy, CreatedDate, Id, ModifiedBy, ModifiedDate, RowStatus', 'safe', 'on'=>'search'),
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
			'Name' => 'Name',
			'Email' => 'Email',
			'Password' => 'Password',
			'UniqKey' => 'Uniq Key',
			'Status' => 'Status',
			'Level' => 'Level',
			'StructureId' => 'Structure',
			'CreatedBy' => 'Created By',
			'CreatedDate' => 'Created Date',
			'Id' => 'ID',
			'ModifiedBy' => 'Modified By',
			'ModifiedDate' => 'Modified Date',
			'RowStatus' => 'Row Status',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('Level',$this->Level);
		$criteria->compare('StructureId',$this->StructureId);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('CreatedDate',$this->CreatedDate,true);
		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy,true);
		$criteria->compare('ModifiedDate',$this->ModifiedDate,true);
		$criteria->compare('RowStatus',$this->RowStatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function magic($param)
	{
		return md5($param.$this->UniqKey)===$this->Password;
	}

	// public function getLevelName()
	// {
		// switch($this->Level)
		// {
			// case 0 : return "Super Admin"; break;
			// case 1 : return "Admin"; break;
			// case 2 : return "User"; break;
			// default : return "-"; break;
		// }
	// }
	
	// public function getStatusName()
	// {
		// return $this->Status == 1 ? "Aktif" : "Nonaktif";
	// }
	
	public function getStructureName()
	{
		$r = Structure::model()->findByPk($this->StructureId);
		return $r !== null ? $r->Lookup : "";
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
			$this->UniqKey = $guid->getGUID();
			$this->CreatedBy = $this->CreatedBy !== null ? $this->CreatedBy : $user != "Guest" ? $user : "System";
			$this->CreatedDate = $date;
			$this->Id = $id;
			$this->Password = md5($this->Password.$this->UniqKey);
			$this->RowStatus = 0;
		}
		else
		{
			$this->Password = md5($this->Password.$this->UniqKey);
			$this->ModifiedBy = $user;
			$this->ModifiedDate = $date;
		}
		return true;
	}
	
	protected function afterFind()
	{
		// if($this->scenario == 'update')
			// $this->StructureId = Structure::model()->findByPk($this->StructureId)->lookup;
		parent::afterFind();
	}
}