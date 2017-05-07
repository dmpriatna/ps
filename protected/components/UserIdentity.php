<?php

class UserIdentity extends CUserIdentity
{
	public function authenticate()
	{
		$users = User::model()->find(array('condition'=>'Name = "'.$this->username.'" AND Status = "Aktif" OR Email = "'.$this->username.'"'));
		if($users===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(!$users->magic($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else {
			$this->errorCode = self::ERROR_NONE;
			if($users->Email === $this->username)
				$this->username = $users->Name;
		}
		return !$this->errorCode;
	}
}