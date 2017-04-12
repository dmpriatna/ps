<?php

class Structure extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'structure';
	}

	public function rules()
	{
		return array(
			array('Level, IdMemberOf, MemberOf, Division, GroupEmployee, CreatedBy, CreatedDate, Id, RowStatus', 'required'),
			array('Level, RowStatus', 'numerical', 'integerOnly'=>true),
			array('IdMemberOf, Division, GroupEmployee, CreatedBy, ModifiedBy', 'length', 'max'=>255),
			array('Id, IdMemberOf, MemberOf', 'length', 'max'=>36),
			array('ModifiedDate', 'safe'),
			array('Level, MemberOf, Division, GroupEmployee, CreatedBy, CreatedDate, Id, ModifiedBy, ModifiedDate, RowStatus', 'safe', 'on'=>'search'),
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
			'Level' => 'Level',
			'MemberOf' => 'Member Of',
			'Division' => 'Division',
			'GroupEmployee' => 'Group Employee',
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

		$criteria->compare('Level',$this->Level);
		$criteria->compare('Division',$this->Division,true);
		$criteria->compare('GroupEmployee',$this->GroupEmployee,true);
		$criteria->compare('CreatedBy',$this->CreatedBy,true);
		$criteria->compare('CreatedDate',$this->CreatedDate,true);
		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('ModifiedBy',$this->ModifiedBy,true);
		$criteria->compare('ModifiedDate',$this->ModifiedDate,true);
		$criteria->compare('RowStatus',$this->RowStatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>array(
					'Level'=>false
				)
			)
		));
	}
	
	public function level()
	{
		$listData = CHtml::listData($this::model()->findAll(
			array('select'=>'Level')),
					'Level','Level');
		return $listData;
	}

	public function division()
	{
		if(isset($_GET['term']))
			$listData = CHtml::listData($this::model()->findAll(
				array('condition' => 'Division LIKE :a',
					'params' => array(':a' => "%".$_GET['term']."%"))),
						'Division','Division');
		else
			$listData = CHtml::listData($this::model()->findAll(),
				'Division','Division');			
		return $listData;
	}

	public function groupEmployee()
	{
		$listData = CHtml::listData($this::model()->findAll(
			array('condition' => 'GroupEmployee LIKE :a',
				'params' => array(':a' => "%".$_GET['term']."%"))),
					'GroupEmployee','GroupEmployee');
		return $listData;
	}

	public function getLookup()
	{
		return $this->GroupEmployee.", ".$this->Division;
	}

	public function getMember()
	{
		$m = $this::model()->findByPk($this->IdMemberOf);
		return $m->GroupEmployee.", ".$m->Division;
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
			$this->Division = strtoupper($this->Division);
			$this->GroupEmployee = strtoupper($this->GroupEmployee);
			$this->CreatedBy = $user;
			$this->CreatedDate = $date;
			$this->Id = $id;
			$this->RowStatus = 0;
		}
		else
		{
			$this->Division = strtoupper($this->Division);
			$this->GroupEmployee = strtoupper($this->GroupEmployee);
			$this->ModifiedBy = $user;
			$this->ModifiedDate = $date;
		}
		return true;
	}
}