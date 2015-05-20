<p>Здравствуйте, вы можете добавить свою колоду на наш сайт.</p>

<?php if($error!=""):?>
<div class="warning"> <b>!</b><?php echo $error;?> </div><br/>
<?php endif?>
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
            input.setCustomValidity("Слишком маленькое описание!"); 
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
 
 if( (extension!="jpeg" || extension!="jpg" || extension!="png")  && (accept.indexOf(files[0].type)<-1) )
 {
    alert("Неправильный формат данных.");
    return false;
 }
 
};

</script>