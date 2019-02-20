<?php

class board_Model extends Model
{
    function __construct()
    {
        
        parent::__construct();
    }

    function xhrGetListings(){
       $sth= $this->db->prepare("
       SELECT id_card, number,hero.caption as hero,action.caption as action, item.caption as item,
      hero.img_name as imghero, action.img_name as imgaction, item.img_name as imgitem
      FROM assocard 
      inner join Dependence hero on hero.id_dep = id_hero
      inner join Dependence action on action.id_dep = id_action
      inner join Dependence item on item.id_dep = id_item
      order by number ");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
       $sth->execute();
       $data=$sth->fetchAll();
        echo json_encode($data);
    }
  
}