<?php

class admin_Model extends Model
{
    function __construct()
    {
        
        parent::__construct();
    }

     function uploadIMG(){
                
                $target_dir = '/OSPanel/domains/memex/public/img/board/';
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
            
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        //echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                       // echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                   // echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000) {
                   // echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                   // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                  //  echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                       echo basename($_FILES["fileToUpload"]["name"]);
                           
                    } else {
                      //  echo "Sorry, there was an error uploading your file.";
                    }
                }
         }
    
    
   
    
    function saveDependence($type,$caption, $imgName){
    
         $sth= $this->db->prepare("insert into dependence(caption,type,img_name)values ('$caption','$type','$imgName');");
         $sth->execute();
         $sth=$this->db->prepare("select id_dep from Dependence where caption = '$caption' AND img_name='$imgName';");
         $sth->setFetchMode(PDO::FETCH_ASSOC);
         $sth->execute();
         $id_dep = $sth->fetchAll();
         
         
         return $id_dep[0]['id_dep'];
        
    }
    
    private function saveCard($number,$idHero,$idAction,$idItem){
        
         $sth= $this->db->prepare("insert into assoCard(number,id_hero,id_action,id_item) values ( $number,$idHero,$idAction,$idItem);");
         $sth->execute();
        
    }
    
   
    
     function checkNumber(){
        
         $number=$_POST["number"];
         
        $sth= $this->db->prepare('select id_card  from AssoCard where number=:number;');
        $sth->execute(array(':number'=> $number));
        
        $data = $sth->fetchAll();
        $count = $sth->rowCount();
        if($count > 0)
          $error_number= true;
         else 
           $error_number=false;
         
         
          $data =array('errorNumber'=>$error_number);
       
         echo json_encode($data);
        
    }
    
    function saveDate(){
       
        $number =   $_POST["number"];
        
        $hero =     $_POST["hero"];
        $action =   $_POST["action"];
        $item =     $_POST["item"];
        
        $imgHero =  $_POST["imgHero"];
        $imgAction =$_POST["imgAction"];
        $imgItem =  $_POST["imgItem"];
       
        /*
        $number    =  11;
        $hero      =  "hero";
        $action    =  "action";
        $item      =  "item";
        $imgHero   =  "imgHero";
        $imgAction =  "imgAction";
        $imgItem   =  "imgItem";
        */
        
        
        $id_hero=$this->saveDependence("Hero",$hero,$imgHero);
        $id_action=$this->saveDependence("Action",$action,$imgAction);
        $id_item=$this->saveDependence("Item",$item,$imgItem);
        
       
        $this->saveCard($number, $id_hero,$id_action,$id_item);
        
    }
    
    function loadSelectDelete(){
        
        
        $sth= $this->db->prepare("select id_card,number from assoCard order by number;");
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $data=$sth->fetchAll();
        
        
        echo json_encode($data);
    }
    
     function deleteNumber(){
         
         $id_card =$_POST['idCard'];
        $sth= $this->db->prepare("select id_hero,id_action,id_item from assoCard
                                    where id_card=$id_card;");
         $sth->execute();
      
        $data=$sth->fetchAll();
         $id_hero= $data[0]["id_hero"];
         $id_action=$data[0]["id_action"];
         $id_item=$data[0]["id_item"];
         
         
         $hero_img_name = $this->getImgName( $id_hero);
         $action_img_name = $this->getImgName( $id_action);
         $item_img_name = $this->getImgName( $id_item);
         
         echo ($hero_img_name);
         echo ( $action_img_name);
           echo (  $item_img_name);
     
         
        
         
      
         $sth=$this->db->prepare("delete from assoCard where id_card=$id_card");
         $sth->execute();
          
         
         $sth=$this->db->prepare("delete from dependence where id_dep=$id_hero");
          $sth->execute();
         $sth=$this->db->prepare("delete from dependence where id_dep=$id_action");
          $sth->execute();
         $sth=$this->db->prepare("delete from dependence where id_dep=$id_item");
          $sth->execute();
         
            $this->delImg($hero_img_name);
          $this->delImg($action_img_name);
         $this-> delImg($item_img_name);
         
          
           
    
    }
    
    
    function getImgName($id_dep){
         $sth= $this->db->prepare("select img_name from Dependence where id_dep=$id_dep;");
      
          $sth->execute();
         $data=$sth->fetchAll();
          $img_name=$data[0]["img_name"];
        return  $img_name;
    }
  
    
    function delImg($img){
    
    $target_dir = '/OSPanel/domains/memex/public/img/board/';

         $full_adr ="{$target_dir}{$img}".".jpg";

        $images = glob($full_adr);
        foreach($images as $image){
             unlink($image);
        }
    
    }
    
    function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
   
  
}
