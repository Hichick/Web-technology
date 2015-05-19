<?php
    
    $db = mysql_connect("localhost","root","")  or die("Невозможно соединиться с базой");
    mysql_select_db("hs",$db)  or die("Невозможно выбрать базу");
    
    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        $id = $_GET['id'];
        
        $result = mysql_query("SELECT * FROM deck WHERE id=$id",$db);
        
        $row = mysql_fetch_array($result);
        
    }    
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Hichas" />

	<title>Просмотр колоды</title>
    
    <link rel="stylesheet" type="text/css" href="style.css" />
        
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

  <?php
    echo '<div class="deck_img"><img width="1050" height="1050" src="'.$row['img'].'" alt="Колода" /></div>';
  ?>
  
  <div class="deck_description">
  <?php
	
    echo "<h2>".$row['title']."</h2>";
    echo $row['description'];
    
    
  ?>
  
  </div>
  
  
</div>

</div>

<footer>

</footer>


</body>
</html>