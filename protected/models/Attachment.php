<?php

class Attachment extends CActiveRecord
{
 
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'attachment';
	}

	public $UploadedFile;

	public function rules()
	{
		return array(
			array('Name, Size, Type, CreatedBy, CreatedDate, DocumentId, Id, RowStatus', 'required'),
			array('Size, RowStatus', 'numerical', 'integerOnly'=>true),
			array('Name, Type, CreatedBy, ModifiedBy', 'length', 'max'=>255),
			array('DocumentId, Id', 'length', 'max'=>36),
			array('Name, Size, Type, Content, CreatedBy, CreatedDate, DocumentId, Id, ModifiedBy, ModifiedDate, RowStatus', 'safe', 'on'=>'search'),
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
			'Size' => 'Size',
			'Type' => 'Type',
			'Content' => 'Content',
			'CreatedBy' => 'Created By',
			'CreatedDate' => 'Created Date',
			'DocumentId' => 'Document',
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
		$criteria->compare('Size',$this->Size);
		$criteria->compare('Type',$this->Type,true);
		$criteria->compare('Content',$this->Content,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('CreatedDate',$this->CreatedDate,true);
		$criteria->compare('DocumentId',$this->DocumentId,true);
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
		$user = yii::app()->user->name;
		$date = date('Y-m-d H:m:s');
		if($this->isNewRecord)
		{
			// if($file=CUploadedFile::getInstance($this,'UploadedFile'))
			// {
				// $this->Name = $file->name;
				// $this->Type = $file->type;
				// $this->Size = $file->size;
				// $this->Content = file_get_contents($file->tempName);
			// }
			$this->CreatedBy = $user;
			$this->CreatedDate = $date;
			$this->Id = $guid->getGUID();
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