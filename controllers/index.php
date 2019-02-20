<?php
class Index  extends Controller
{
    function __construct(){
        parent::__construct();
   
          $this->view->js = array('index/js/default.js');
         
        
        
    }
    
    function index()
    {
        
          $this->view->render('index/index');
    }
    function run()
    {
        $this->model->run();
    }
    
    
}
 
?>