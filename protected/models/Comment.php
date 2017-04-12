<?php

class Comment extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'comment';
	}

	public function rules()
	{
		return array(
			array('Content, DocumentId, UserId, CreatedBy, CreatedDate, Id, RowStatus', 'required'),
			array('RowStatus', 'numerical', 'integerOnly'=>true),
			array('Content, CreatedBy, ModifiedBy', 'length', 'max'=>255),
			array('DocumentId, UserId, Id', 'length', 'max'=>36),
			array('Content, DocumentId, UserId, CreatedBy, CreatedDate, Id, ModifiedBy, ModifiedDate, RowStatus', 'safe', 'on'=>'search'),
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
			'Content' => 'Content',
			'DocumentId' => 'Document Id',
			'UserId' => 'User Id',
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

		$criteria->compare('Content',$this->Content,true);
		$criteria->compare('DocumentId',$this->DocumentId,true);
		$criteria->compare('UserId',$this->UserId,true);
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
			$this->CreatedBy = $user;
			$this->CreatedDate = $date;
			$this->Id = $id;
			$this->RowStatus = 0;
		}
		else
		{
			$this->ModifiedBy = $user;
			$this->ModifiedDate = $date;
		}
		return true;
	}
}