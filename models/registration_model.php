<?php

class Registration_Model extends Model
{
    
   function __construct()
    {
       parent::__construct();
      
   

      
    }
    public function run()
    {
     $error_pass = false;
     $error_login= false;
     $error_email= false;
        
     $login = $this->check_input($_POST['login']);
     $pass  = $this->check_input($_POST["password"]);
     $passAg= $this->check_input($_POST["password_again"]);
     $email = $this->check_input($_POST["email"]);
     $salt = $this->getSalt();
      
            
         if ($pass != $passAg)
             $error_pass =true;
         if ($this->error_login($login))
              $error_login =true;
         if ($this->error_email($email))
              $error_email =true;
        
        if (($error_pass == false) && ($error_login == false) && ($error_email == false)){
             
       $passHash = $this->getPassHash(11,$salt,$pass);
             
       $sth=  $this->db->prepare("insert into users(login,password,email,salt) VALUES(:login,:pass,:email,:salt)");
       $sth->execute(array(':login'=>$login,':pass'=>$passHash,':email'=>$email,':salt'=> $salt ));
        
        
       
        }
        $data =array('errorPass'=>$error_pass,'errorLogin'=>$error_login,'errorEmail'=>$error_email);
       
       echo json_encode($data);
        
    }   
    /*
    public function run()
    {
     $error = false;
     $login = $this->check_input($_POST['login']);
     $pass  = $this->check_input($_POST["password"]);
     $passAg= $this->check_input($_POST["password_again"]);
     $email = $this->check_input($_POST["email"]);
     $salt = $this->getSalt();
      
            
         if ($pass != $passAg)
             $error =true;
         if ($this->error_login_email($login,$email))
              $error =true;
        
        if ($error == false){
       $passHash = $this->getPassHash(11,$salt,$pass);
             
       $sth=  $this->db->prepare("insert into users(login,password,email,salt) VALUES(:login,:pass,:email,:salt)");
       $sth->execute(array(':login'=>$login,':pass'=>$passHash,':email'=>$email,':salt'=> $salt ));
        
        header('location: ../registration');
        }
        else{
        
          header('location: ../index');
        }
        
    }   */
  public function error_login_email($log, $email){
       $sth= $this->db->prepare('select id  from USERS where login=:login or email=:email; ');
       $sth->execute(array(':login'=> $log , ':email'=> $email));
        
        $data = $sth->fetchAll();
        $count = $sth->rowCount();
       if ($count > 0)
           return true;
       else 
           return false;
  }
    
    public function error_login($log){
       $sth= $this->db->prepare('select id  from USERS where login=:login ;');
       $sth->execute(array(':login'=> $log));
        
        $data = $sth->fetchAll();
        $count = $sth->rowCount();
       if ($count > 0)
           return true;
       else 
           return false;
  }
    
    public function error_email($email){
       $sth= $this->db->prepare('select id  from USERS where email=:email;');
       $sth->execute(array(':email'=> $email));
        
        $data = $sth->fetchAll();
        $count = $sth->rowCount();
       if ($count > 0)
           return true;
       else 
           return false;
  }
   
    public function check_input($data) {
       
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    
    private function getSalt(){
       return mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
    }
    
    
    public function getPassHash($cost,$salt,$pass){
        $options = [
        'cost' => $cost,
        'salt' => $salt,
        ];
        return password_hash($pass, PASSWORD_BCRYPT, $options);
    }
    
    
    
   
    
}
?>