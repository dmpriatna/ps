<?php
class AWebUser extends CWebUser{
 
    protected $_model;
 
    protected function loadUser()
    {
        if ( $this->_model === null ) {
                $this->_model = User::model()->findByAttributes(array('Name'=>$this->id));
        }
        return $this->_model;
    }
    
    function getLevel()
    {
        $user=$this->loadUser();
        if($user)
            return $user->Level;
        return "";
    }

    function getGuid()
    {
        $user=$this->loadUser();
        if($user)
            return $user->Id;
        return "";
    }
}