<?php
class Study extends Controller
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
        
          if (!isset($this->view->js)){
          $this->view->js = array('study/js/default.js');
          }
          else{
           array_push($this->view->js,'study/js/default.js');
          }
        
    }
    
    function index()
    {
        
          $this->view->render('study/index');
    }
    
   
   function xhrGetListings(){
        $this->model->xhrGetListings();
    }
   
    
    function xhrGetImageName(){
         $this->model->xhrGetImageName();
    }
    function xhrIsNumberExist(){
        $this->model->xhrIsNumberExist();
    }
    
}
 
?>