<?php
class Registration  extends Controller
{
    function __construct(){
        parent::__construct();
   
          $this->view->js = array('registration/js/default.js');
         
        
        
    }
    
    function index()
    {
        
          $this->view->render('registration/index');
    }
    function run()
    {
        $this->model->run();
    }
    
    
}
 
?>