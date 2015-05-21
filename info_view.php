<div class="deck_img">
<img width="1050" height="1050" src="<?php echo $Obj->GetImage();?>" alt="Колода" />
</div>
<div class="deck_description">
<h2><?php echo $Obj->GetTitle();?></h2>
<?php  echo $Obj->GetDescription();?>

<p>Вы считаете эту колоду играбельной ?  <img id="like_img" align="middle" src="img/like.png" width="50" height="50" onclick="callServer(<?php  echo $Obj->GetId();?>,1)" /> <img id="dislike_img" align="middle" src="img/dislike.png" width="50" height="50" onclick="callServer(<?php  echo $Obj->GetId();?>,-1)" /> ( Всего: <span id="like"><?php  echo $Obj->GetLike();?></span> считают играбельной ) </p>
</div>

<script>
    
      var request = new XMLHttpRequest();
      
      var f = 0;
      
      function callServer(id,like) {
        
    
      f = like;
      var xmlString = "<deck>" +
        "  <id>" + escape(id) + "</id>" +
        "  <like>" + escape(like) + "</like>" +
        "</deck>";
    
      // Построим URL для соединения
      var url = "/controller.php";
    
      // Откроем соединение с сервером
      request.open("POST", url, true);
    
      // Сообщим серверу, что вы посылаете данные в формате XML
      request.setRequestHeader("Content-Type", "text/xml");
    
      // Установим функцию запуска сервера, когда это выполнено
      request.onreadystatechange = updatePage;
    
      // Отправим заказ
      request.send(xmlString);
    }
    
    function sizeChange()
    {
        if(f>0)
        {
          var like_img = document.getElementById('like_img');  
        }else
        {
          var like_img = document.getElementById('dislike_img');  
        }
        
        like_img.classList.add("like_class");
        
        setTimeout(deleteClass, 2000);
    }
    
    function deleteClass() {
      
      if(f>0)
        {
          var like_img = document.getElementById('like_img');  
        }else
        {
          var like_img = document.getElementById('dislike_img');  
        }
        
      like_img.classList.remove("like_class");
    }
    
    function updatePage() {
      if (request.readyState == 4) {
        if (request.status == 200) {
         
            var xmlDoc = request.responseText;
            
            var id = xmlDoc.match(/<id>(.*?)<\/id>/);
            var like = xmlDoc.match(/<like>(.*?)<\/like>/);
            
            document.getElementById('like').innerHTML="";
            document.getElementById('like').innerHTML=like[1];
            
            sizeChange();
              
            //alert(xmlDoc);
          }
        }
      }
 
    </script>