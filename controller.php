<?php

/**
 * @author Hichas
 * @copyright 2015
 */

require_once 'database.php';

switch($_GET['action'])
{
    case "index" :
        $content_view = "index_view";
        require_once("template_view.php"); 
        break;
     case "decks" :
        $content_view = "decks_view";
        $db = new database();
        
        $arrayObj = array();
        $arrayObj = $db->SelectAllDeck();
        
        require_once("template_view.php"); 
        break;
     case "info" :
        $content_view = "info_view";
        
        $db = new database();
        
        $id = $_GET['id'];
        
        $Obj = $db->SelectDeck($id);
        
        require_once("template_view.php"); 
        break;
     case "add" :
        
        
        if(isset($_POST['send']))
        {   
            $error = "";
            
            $arrayDeck = array(
                'id'=>0,
                'title'=>$_POST['title'],
                'class'=>$_POST['class'],
                'description'=>$_POST['description'],
                'img'=>$_FILES['image']
                
            );
            
            $deck = new deck($arrayDeck);
            
            if(!$deck->ValidationDescription())
            {
              $error.="Описание не прошло валидацию.";
            }
            
            if(!$deck->ValidationTitle())
            {
              $error.="Название колоды не прошло валидацию.";  
            }
            
            if(!$deck->ValidationImage())
            {
                $error.="Формат загружаемой картинки не поддерживаеться.";  
            }
            
            if($deck->ValidationImage() && $deck->ValidationTitle() && $deck->ValidationDescription())
            {
                $deck->AddDeck();
            }
           
        } 
        
        $content_view = "add_view";
        require_once("template_view.php");
        break;
}

?>