<?php

class user{
  var $username,
  $password,
  $gender,
  $age,
  $favoritefood1,
  $favoritefood2,
  $extra1,
  $extra2;
  public function constructor($setusername, $setpassword, $setgender, $setage, $setfavoritefood1, $setfavoritefood2)
  {
      $this->username = $setusername;
      $this->password = $setpassword;
      $this->gender = $setgender;
      $this->age = $setage;
      $this->setfavoritefood1 = $setfavoritefood1;
      $this->setfavoritefood2 = $setfavoritefood2;
  }
  public function destructor()
  {
      
      
  }
  public function setusername($setusername)
  {
      $this->username = $setusername;
  }
  public function setpassword($setpassword)
  {
      $this->password = $setpassword;
  }
  public function setgender($setgender)
  {
      $this->gender = $setgender;   
  }   
  public function setage($setage)
  {
      $this->age = $setage;   
  }   
  public function setfavoritefood1($setfavoritefood1)
  {
      $this->favoritefood1 = $setfavoritefood1;   
  }   
  public function setfavoritefood2($setfavoritefood2)
  {
      $this->favoritefood2 = $setfavoritefood2;   
  }   
  public function setall($setusername, $setpassword)
  {
      if($setusername && $setpassword != "none")
      {
         $this->username = $setusername;
         $this->password = $setpassword; 
      }
  }
  
  public function getusername()
  {
      return $this->username;
  }
  public function getpassword()
  {
      return $this->password;
  }
  public function getgender()
  {
      return $this->gender;
  }
  public function getage()
  {
      return $this->age;
  }
  public function getfavoritefood1()
  {
      return $this->favortiefood1;
  }
  public function getfavoritefood2()
  {
      return $this->favoritefood2;
  }
 
};

$newuser = new user();
$newuser->setusername('bob');
echo $newuser->getusername(); 




?>
