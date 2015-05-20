<?php

/**
 * @author Hichas
 * @copyright 2015
 */

require_once 'deck.php';
require_once 'helper.php';

class database {
    
    private $host;
    private $user;
    private $pass;
    
    public function __construct() {
      
       $this->host = "localhost";
       $this->user = "root";
       $this->pass = "";
    }
    
    public function InsertDeck ($deck)
    {
        $db = mysql_connect($this->host,$this->user,$this->pass)  or die("Невозможно соединиться с базой");
        mysql_select_db("hs",$db)  or die("Невозможно выбрать базу");
        
        $uploaddir = 'uploads/'; // Путь для картинок
        
        $image = $deck->GetImage();
        $path_info = pathinfo($image['name']);
         
        $filename = helper::getRandomFileName($uploaddir,$path_info['extension']); // генерирует имя
        
        $uploadfile = $uploaddir.$filename.'.'.$path_info['extension'];
        
         if (move_uploaded_file($image['tmp_name'], $uploadfile)) {
           
           return mysql_query("INSERT INTO deck SET title='".$deck->GetTitle()."',description='".$deck->GetDescription()."',class='".$deck->GetClass()."',img='".$uploadfile."'",$db);
            
         } else {
           return;
         } 
        
    }
    
    public function SelectDeck ($id)
    {
        $db = mysql_connect($this->host,$this->user,$this->pass)  or die("Невозможно соединиться с базой");
        mysql_select_db("hs",$db)  or die("Невозможно выбрать базу");
        
        $result = mysql_query("SELECT * FROM deck WHERE id=$id",$db);
        $row = mysql_fetch_array($result);
        
        $deck = new deck($row);
        
        return $deck;
    }
    
    public function SelectAllDeck ()
    {
        $db = mysql_connect($this->host,$this->user,$this->pass)  or die("Невозможно соединиться с базой");
        mysql_select_db("hs",$db)  or die("Невозможно выбрать базу");
        
        $result = mysql_query("SELECT * FROM deck",$db);
        
        $deck_array = array();
        
        while($row = mysql_fetch_array($result))
        {
            $deck = new deck($row);
            
            $deck_array[]=$deck;
        }
        
        return $deck_array;
        
    }
    
}


?>