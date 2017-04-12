<?php

class History extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'history';
	}

	public function rules()
	{
		return array(
			array('CreatedBy, CreatedDate, Id, Predicate, RowStatus, Subject', 'required'),
			array('RowStatus', 'numerical', 'integerOnly'=>true),
			array('CreatedBy, Predicate, Subject', 'length', 'max'=>255),
			array('Id', 'length', 'max'=>36),
			array('CreatedBy, CreatedDate, Id, Predicate, RowStatus, Subject', 'safe', 'on'=>'search'),
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
			'Subject' => 'Subject',
			'Predicate' => 'Predicate',
			'CreatedBy' => 'Created By',
			'CreatedDate' => 'Created Date',
			'Id' => 'ID',
			'RowStatus' => 'Row Status',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('Subject',$this->Subject,true);
		$criteria->compare('Predicate',$this->Predicate,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('CreatedDate',$this->CreatedDate,true);
		$criteria->compare('Id',$this->Id,true);
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
			$this->CreatedBy = $user;
			$this->CreatedDate = $date;
			$this->Id = $id;
			$this->RowStatus = 0;
		}
		return true;
	}
}