<?php
class board  extends Controller
{
    function __construct(){
        parent::__construct();
      Session::init();
       $logged=Session::get("loggedIn");
        if ( $logged == false){
            Session::destroy();
            header('location: ../login');
            exit;
        }
        
          
          $this->view->js = array('board/js/default.js');
         
    }
    
   
    
    function index()
    {
        
          $this->view->render('board/index');
    }
  
   function xhrGetListings(){
        $this->model->xhrGetListings();
    }
  
        
}
 
?>