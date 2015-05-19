<?php
    
    $db = mysql_connect("localhost","root","")  or die("Невозможно соединиться с базой");
    mysql_select_db("hs",$db)  or die("Невозможно выбрать базу");
         
    $result = mysql_query("SELECT * FROM deck",$db);       
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Hichas" />

	<title>Фан сайт по ККИ Hearthstone</title>
    
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
 
 <?php while($row=mysql_fetch_array($result)):?>
 <div class="deck">
  
  <div class="cover_mask"></div>
  <div class="cover_img"><img  width="272" height="145"  src="<?php echo $row['img'];?>" alt="<?php echo $row['title'];?>" /></div>
  <div class="deck_content">
  <a href="info.php?id=<?php echo $row['id'];?>"><?php echo $row['title'];?></a>
  <hr/>
  <?php echo $row['description'];?>
  </div>
  
  </div>
 <?php endwhile?> 
  
  
  
  
</div>

</div>

<footer>

</footer>


</body>
</html>