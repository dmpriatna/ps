<?php

class Role extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'role';
	}

	public function rules()
	{
		return array(
			array('Code, Number, DocumentName, Description, Priority, IdRequiredBy, RequiredBy, IdApprovedBy, ApprovedBy, IdExecutedBy, ExecutedBy, CreatedBy, CreatedDate, Id, RowStatus', 'required'),
			array('RowStatus', 'numerical', 'integerOnly'=>true),
			array('Code, Number, DocumentName, Description, IdRequiredBy, RequiredBy, IdApprovedBy, ApprovedBy, IdExecutedBy, ExecutedBy, CreatedBy, ModifiedBy', 'length', 'max'=>255),
			array('Priority', 'length', 'max'=>7),
			array('Id', 'length', 'max'=>36),
			array('ModifiedDate', 'safe'),
			array('DocumentName, Priority, IdRequiredBy, RequiredBy, ApprovedBy, ExecutedBy, CreatedBy, CreatedDate, Id, ModifiedBy, ModifiedDate, RowStatus', 'safe', 'on'=>'search'),
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
			'DocumentName' => 'Document Name',
			'Priority' => 'Priority',
			'RequiredBy' => 'Required By',
			'ApprovedBy' => 'Approved By',
			'ExecutedBy' => 'Executed By',
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

		$criteria->compare('DocumentName',$this->DocumentName,true);
		$criteria->compare('Priority',$this->Priority,true);
		$criteria->compare('IdRequiredBy',$this->IdRequiredBy);
		$criteria->compare('RequiredBy',$this->RequiredBy,true);
		$criteria->compare('ApprovedBy',$this->ApprovedBy,true);
		$criteria->compare('ExecutedBy',$this->ExecutedBy,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('CreatedDate',$this->CreatedDate,true);
		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy,true);
		$criteria->compare('ModifiedDate',$this->ModifiedDate,true);
		$criteria->compare('RowStatus',$this->RowStatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array('defaultOrder'=>'CreatedDate desc')
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
			$tail = substr($this->ApprovedBy,0,-2);
			$rplc = str_replace(", ","\",\"",$tail);
			$string = "(\"".$rplc."\")";
			$tempId = array();
			$struc = Structure::model()->findAll(array('condition'=>'concat(GroupEmployee," ",Division) in '.$string));
			foreach($struc as $data){
				$tempId[] = User::model()->find(array('condition'=>'StructureId = "'.$data->Id.'"'))->Id;
			}
			$this->IdApprovedBy = join(', ', $tempId);
			$this->ModifiedBy = $user;
			$this->ModifiedDate = $date;
		}
		return true;
	}
}