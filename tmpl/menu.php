<div class="menu">

  <?php
  $active = "";
  foreach ($menu as $item) {
    if($item['id'] == $active_index){
       $active = " active";
    }else{
      $active = "";
    }
   ?>

      <a class="<?= $active;?>" id="<?= $item['css']; ?>" href="<?= INDEX_PAGE.'?id='.$item['id']; ?>"><div class="ico"></div><div class="text"><?= $item['name']; ?></div><?php
        if($active != ""){
          echo '<div class="rightPartBg"></div>';
        }
      ?></a>
  <?php }  ?>
</div>
