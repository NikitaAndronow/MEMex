<?php
class admin extends Controller
{
    function __construct(){
        parent::__construct();
      Session::init();
       $logged=Session::get("loggedIn");
       $role = Session::get("role");
        if ( $logged == false){
            Session::destroy();
            header('location: ../login');
            exit;
        }
        if ($role != 'admin')
        {
            header('location: ../login');
            exit;
        }
        
          
          $this->view->js = array('admin/js/default.js');
         
    }
    
   
    
    function index()
    {
        
          $this->view->render('admin/index');
    }
  
     function uploadIMG(){
         $this->model->uploadIMG();
     }
 
    
    function saveText(){
        $this->model->saveText();
    }
  
      function checkNumber(){
        $this->model->checkNumber();
    }
    
    
    function saveCard(){
         $this->model->saveCard();
    }
    function  saveDate(){
        $this->model->saveDate();
        
    }
    function loadSelectDelete(){
        $this->model->loadSelectDelete();
        
    }
       function deleteNumber(){
           $this->model->deleteNumber();
       }
        
}
 
?>