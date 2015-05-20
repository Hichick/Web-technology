  <?php for($i=0;$i<count($arrayObj);$i++):?>
 <div class="deck">
  <div class="cover_mask"></div>
  <div class="cover_img"><img  width="272" height="145"  src="<?php echo $arrayObj[$i]->GetImage();?>" alt="<?php echo $arrayObj[$i]->GetTitle();?>" /></div>
  <div class="deck_content">
  <a href="controller.php?action=info&id=<?php echo $arrayObj[$i]->GetId();?>"><?php echo $arrayObj[$i]->GetTitle();?></a>
  <hr/>
  <?php echo $arrayObj[$i]->GetDescription();?>
  </div>
  
  </div>
 <?php endfor?> 
 