<?php
    
    $db = mysql_connect("localhost","root","")  or die("Невозможно соединиться с базой");
    mysql_select_db("hs",$db)  or die("Невозможно выбрать базу");
    
    
    $error = "";
    
    $validation = false;
    
    
    // Функция для генерирования имени
    function getRandomFileName($path, $extension='')
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';
 
        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));
 
        return $name;
    }
    //-------------------------------------------
    
    if(isset($_POST['send']))
    {
       $class = $_POST['class'];
       if(isset($_POST['title']) && !empty($_POST['title']))	
        {
            $title = trim($_POST['title']);
            
            $title=strip_tags($title); // вырезаем теги
        	$title=stripslashes($title);
            
            if(!preg_match("/^[А-яA-Za-zа-я0-9 ]{8,90}$/ui", $title)) { 
                $error.= "Название колоды в неправильном формате. Можно использовать [А-яA-Za-zа-я0-9 ]."; 
            }else{
                $validation = true;
            } 
        }else
        {
            $error.= "Вы не ввели название колоды.";
            $validation = false;
        }
        
        if(isset($_POST['description']) && !empty($_POST['description']))	
        {
            $description=trim($_POST['description']);
            
            // strip_tags($text, '<p><a>'); Можно потом разрешить теги 
        	$description=stripslashes($description);
            
            $original_len = strlen($description);
            $description=strip_tags($description);
            
            $current_len = strlen($description);
            
            if(strlen($description)>7)
            {
                $validation = true;
            }else
            {
               $validation =false;
               $error.= "Слишком маленькое описание."; 
            }
            
            if($original_len!=$current_len)
            {
                $error.= "Ваше описание содержит html теги."; 
            }else
            {
                $validation = true;
            }
            /*
            $ptn = "/<([^\/^>]*)>/isu";
            preg_match($ptn, $description,$array);
            preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/", $description, $tags, PREG_SET_ORDER);

            if(count($array)>0) { 
                $error.= "Ваше описание содержит html теги."; 
            }else{
                $validation = true;
            } 
            
            foreach ($tags as $val) {
                echo "matched: " . $val[0] . "\n";
                echo "part 1: " . $val[1] . "\n";
                echo "part 2: " . $val[2] . "\n";
                echo "part 3: " . $val[3] . "\n";
                echo "part 4: " . $val[4] . "\n\n";
            }
            */
            
        }else
        {
            $error.= "Вы не ввели свой комментарий.";
            $validation = false;
        }
        
        
        if(isset($_FILES['image']) && !empty($_FILES['image']))	
        {
            /*
            if($_FILES['image']['type'] != "image/jpeg" || $_FILES['image']['type'] != "image/png" ) // Проверка Content-Type 
            {
               $error.="Загружать можно только jpg и png.";
               $validation = false;
             }
             */
             
             $imageinfo = getimagesize($_FILES['image']['tmp_name']); // Для удостоверения что изоброжение
             
             if($imageinfo['mime'] != 'image/png' && $imageinfo['mime'] != 'image/jpeg') 
             {
               $error.="Загружать можно только jpg и png.";
               $validation = false;
             }
             
             $list_extension = array("jpg", "jpeg", "png");
             
             $path_info = pathinfo($_FILES['image']['name']);
             
             if (!in_array($path_info['extension'], $list_extension)) 
             {
                $error.="Загружать можно только поддерживаемый тип данных jpg и png.";
                $validation = false;
             }
             
             
             
            if($validation)
            {
                $uploaddir = 'uploads/'; // Путь для картинок
                
                $filename = getRandomFileName($uploaddir,$path_info['extension']); // генерирует имя
                
                $uploadfile = $uploaddir.$filename.'.'.$path_info['extension'];
                
                 if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    
                   // Файл загружен
                   
                   mysql_query("INSERT INTO deck SET title='$title',description='$description',class='$class',img='$uploadfile'",$db);
                   
                   $id =  mysql_insert_id();
                   
                   echo "<meta http-equiv=\"refresh\" content=\"1;url=http://hs/info.php?id=".$id."\" />"; // перенаправление на страницу
                   
                 } else {
                   $error.="Файл не загружен.";
                 } 
            }
            
        
        }else
        {
            $error.= "Вы не выбрали картинку.";
            $validation = false;
        }
        
        
        
        
    }
    
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Hichas" />

	<title>Добавляем колоду</title>
    
    <link rel="stylesheet" type="text/css" href="style.css" />
    
    <script>
 
    function CheckDescription(input) 
    {

        var str = input.value;
        var re = new RegExp("<(.|\n)*?>", "g");
        var myArray = str.match(re);
               
        if (input.value.length < 7 || myArray != null) 
        {
            if(input.value.length < 7)
            {
                input.setCustomValidity("Слишком маленький комментарий!"); 
            }else
            {
                input.setCustomValidity("В вашем описании присутствуют html теги."); 
            }
            
        }else
        {
            input.setCustomValidity(""); 
        }
    }
    
    function CheckImage(input){
     
     var file = input.value;
     var files = input.files;
     
     var accept = ["image/png","image/jpeg"]; // Тип контента
     
     var extension = file.substring(file.lastIndexOf('.')+1).toLowerCase(); // Расширение
     
     if(extension!="jpeg" || extension!="jpg" || extension!="png"  && (accept.indexOf(files[0].type)<-1) )
     {
        alert("Неправильный формат данных.");
        return false;
     }
     
    };

    </script>
        
</head>
<body>

<header>
<div class="logo">
<img src="img/logo.png" alt="HearthStone" />
</div>

</header>

<div class="main">

<nav>
        <a href="/">Главная</a> <a href="decks.php">Все колоды</a> <a href="add.php">Добавить колоду</a>
</nav>

<div class="content">
  
  
  <p>Здравствуйте, вы можете добавить свою колоду на наш сайт.</p>
  
  <?php
	
    if($error!="")
    {
        echo "<div class=\"warning\"> <b>!</b> ".$error." </div><br/>";
    }
  ?>
  
  <form method="POST" ENCTYPE="multipart/form-data">
  <label>Название колоды:</label>
 <input class="textbox" name="title" type="text" placeholder="Введите название вашей колоды" pattern="[А-Я а-яA-Za-z0-9]{8,90}" title="от 8 до 90 символов [А-Я а-яA-Za-z0-9]" required/>
 <label>Выберете класс:</label>
 <select class="textbox_2" name="class" size="1">
	<option value="Воин">Воин</option>
    <option value="Паладин">Паладин</option>
    <option value="Жрец">Жрец</option>
    <option value="Разбойник">Разбойник</option>
</select>
<br />
<label>Описание колоды:</label>
 <textarea class="message" name="description" placeholder="Введите описание вашей колоды" oninput="CheckDescription(this)" required></textarea>
 
 <p>Для генерирования картинки колоды используйте сервис <a href="http://hspic.pro/">http://hspic.pro/</a> </p>
 <label>Выберете картинку для загрузки:</label>
 <input type="file" name="image" onchange="CheckImage(this)" accept="image/jpeg,image/png" required />
 <br /><br />
 <button name="send" class="button" type="submit">Добавить колоду</button>
 </form> 
  
  
  
  
</div>

</div>

<footer>

</footer>


</body>
</html>