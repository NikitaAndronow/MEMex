<?php
class Test extends Controller
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
          $this->view->js = array('test/js/default.js');
          }
          else{
           array_push($this->view->js,'test/js/default.js');
          }
        
    }
    
    function index()
    {
        
          $this->view->render('test/index');
    }
    function run()
    {
        $this->model->run();
    }
    
    
}
 
?>