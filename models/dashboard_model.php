<?php

class Dashboard_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }
   function xhrInsert(){
       $text=  $_POST['text'];
       $sth=  $this->db->prepare("Insert into data (text)
       values (:text)");
       $sth->execute(array(':text'=>$text));
       $data =array('text' =>$text, 'id' =>$this->db->lastInsertId());
       echo json_encode($data);
   }
    function xhrGetListings(){
       $sth= $this->db->prepare("select count(id_card) as liczba from assoCard;");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
       $sth->execute();
       $data=$sth->fetchAll();
        echo json_encode($data);
    }
    function xhrDeleteListing(){
        $id=$_POST['id'];
        $sth = $this->db->prepare('DELETE FROM DATA WHERE ID ="'.$id.'"');
        $sth->execute();
    }
}