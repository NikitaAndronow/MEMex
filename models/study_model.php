<?php

class Study_Model extends Model
{
    function __construct()
    {
         parent::__construct();
    }
   
      function xhrGetListings(){
       $sth= $this->db->prepare("select count(id_card) as liczba from assoCard;");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
       $sth->execute();
       $data=$sth->fetchAll();
        echo json_encode($data);
    }
   function xhrGetImageName(){
          
       $number = ( $_POST["number"] );
       $type   = ( $_POST["type"] );
        $sth= $this->db->prepare("select img_name from dependence where id_dep = (select id_$type from assoCard where number = $number);");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
       $sth->execute();
       $data=$sth->fetchAll();
      
        echo($data[0]["img_name"]);
   }
    
    
    function xhrIsNumberExist(){
          
       $number = $_POST["num"];
       
        $sth= $this->db->prepare("select count(id_card) as ilosc  from assoCard where number =$number;");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
       $sth->execute();
       $data=$sth->fetchAll();
       $numExist;
        if($data[0]["ilosc"] == 0)
            $numExist=false;
        else
            $numExist=true;
        
        $data= array('numberExist'=>$numExist);
      
        echo json_encode($data);
   }
        
}