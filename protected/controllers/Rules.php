<?php

		$array = array('index','print');
		switch(yii::app()->user->level)
		{
			case "Super Admin" :
				$array = array_merge($array,array('admin','create','delete','update','view','pass','reminder','final','cancel','real'));
			break;
			case "Admin" :
				$array = array_merge($array,array('add','admin','create','update','view','pass','reminder','final','cancel','real'));
			break;
			case "User" :
				if(isset($_REQUEST['id']))
				if($_REQUEST['id'] == yii::app()->user->guid)
					$array = array_merge($array,array('update'));
				$array = array_merge($array,array('add','create','view','approve','pass','reminder'));
			break;
			case "Reader" :
				$array = array_merge($array,array('reminder','final','cancel','real','view'));
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
