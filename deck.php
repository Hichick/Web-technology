<?php

/**
 * @author Hichas
 * @copyright 2015
 */


class deck {
    
    private $id;
    private $title;
    private $description;
    private $class;
    private $img;
    
    public function __construct($deck) {
        
       $this->id = $deck['id'];
       $this->title = $deck['title'];
       $this->description = $deck['description'];
       $this->class = $deck['class'];
       $this->img = $deck['img'];
    }
    
    public function AddDeck() // Добавление деки
    {
        $db = new database();
        
        if($this->ValidationTitle() && $this->ValidationDescription() && $this->ValidationImage())
        {
            $db->InsertDeck($this);            
        }
            
    }
    
    public function ValidationTitle()
    {
        if(!preg_match("/^[А-яA-Za-zа-я0-9 ]{8,90}$/ui", $this->title)) { 
            return false;
        }else{
            return true;
        } 
        
    }
    
    public function ValidationDescription()
    {
        $description=trim($this->description);    
    	$description=stripslashes($description);
        $original_len = strlen($description);
        $description=strip_tags($description);
        $current_len = strlen($description);
        
        if(strlen($description)<7 && $original_len!=$current_len)
        {
            return false;
        }else
        {
           return true;
        }
    }
    
    
    public function ValidationImage() // проверять картинку будем только при добавлении
    {
        $imageinfo = getimagesize($this->img['tmp_name']); // Для удостоверения что изоброжение
        
        $list_extension = array("jpg", "jpeg", "png");
         
        $path_info = pathinfo($this->img['name']);
             
        if($imageinfo['mime'] != 'image/png' && $imageinfo['mime'] != 'image/jpeg' && !in_array($path_info['extension'], $list_extension)) 
         {
           return false;
         }else
         {
           return true;
         }
         
    }
    
    public function GetId ()
    {
        return $this->id;
    }
    
    public function GetTitle ()
    {
        return $this->title;
    }
    
    public function GetDescription()
    {
        return $this->description;
    }
    
    public function GetClass()
    {
        return $this->class;
    }
    
    public function GetImage()
    {
        return $this->img;
    }
    
}


?>