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
        <a href="controller.php?action=index">Главная</a> <a href="controller.php?action=decks">Все колоды</a> <a href="controller.php?action=add">Добавить колоду</a>
</nav>

<div class="content">
   
  <?php include "".$content_view.".php"; ?>
  
</div>

</div>

<footer>

</footer>


</body>
</html>