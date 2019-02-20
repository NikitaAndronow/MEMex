<?php

class Login_Model extends Model
{
    
   function __construct()
    {
       parent::__construct();
       
    }
    
   
      public function run()
    {
          
          
    $sth= $this->db->prepare('SELECT id,salt, role, password FROM USERS WHERE LOGIN = :login');
    $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array(
        ':login'    => $_POST['login']));
        
        $data = $sth->fetchAll();
        
          $count = $sth->rowCount();
          if($count > 0){
            
        //check password
            $salt= $data[0]['salt'];    
            $passHash=$this->getPassHash(11,$salt,$_POST['password']);
           
            if ($data[0]['password']== $passHash){       
                  //login    
            Session::init();
            Session::set('loggedIn',true);
            Session::set('role',$data[0]['role']);
            if ($data[0]['role']=='admin'){
            header('location: ../admin');
            }
                else
            header('location: ../board');
            return true;
                
            }
        }
        //show an error!
            header('location: ../login');
        
        
    } 
    
     public function getPassHash($cost,$salt,$pass){
        $options = [
        'cost' => $cost,
        'salt' => $salt,
        ];
        return password_hash($pass, PASSWORD_BCRYPT, $options);
    }
   
    
}  