<?php

class Profile extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'profile';
	}

	public $Place, $DateOfBirth;
	
	public function rules()
	{
		return array(
			array('Name, PlaceAndDateOfBirth, Gender, Phone, Address, UserId, CreatedBy, CreatedDate, Id, RowStatus', 'required'),
			array('RowStatus', 'numerical', 'integerOnly'=>true),
			array('Name, Place, DateOfBirth, PlaceAndDateOfBirth, Address, CreatedBy, ModifiedBy', 'length', 'max'=>255),
			array('Id, UserId', 'length', 'max'=>36),
			array('Gender', 'length', 'max'=>6),
			array('ModifiedDate', 'safe'),
			array('Name, PlaceAndDateOfBirth, Gender, Phone, Address, UserId, CreatedBy, CreatedDate, Id, ModifiedBy, ModifiedDate, RowStatus', 'safe', 'on'=>'search'),
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
			'PlaceAndDateOfBirth' => 'Place And Date Of Birth',
			'Gender' => 'Gender',
			'Phone' => 'Phone',
			'Address' => 'Address',
			'UserId' => 'UserId',
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
		$criteria->compare('PlaceAndDateOfBirth',$this->PlaceAndDateOfBirth,true);
		$criteria->compare('Gender',$this->Gender,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('Address',$this->Address);
		$criteria->compare('UserId',$this->UserId);
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

	protected function beforeValidate()
	{
		parent::beforeValidate();
		$guid = new UUID;
		$id = $guid->getGUID();
		$user = yii::app()->user->name;
		$date = date('Y-m-d H:m:s');
		if($this->isNewRecord)
		{
			$this->PlaceAndDateOfBirth = $this->Place.", ".$this->DateOfBirth;
			$this->CreatedBy = $user;
			$this->CreatedDate = $date;
			$this->Id = $id;
			$this->RowStatus = 0;
		}
		else
		{
			$this->PlaceAndDateOfBirth = $this->Place.", ".$this->DateOfBirth;
			$this->ModifiedBy = $user;
			$this->ModifiedDate = $date;
		}
		return true;
	}
}