<?php

foreach ($page['content'] as $key => $value) {
?>
<div class="answerBlock">
    <div class="answerFile">
        <div class="img"></div>
        <div class="fileName">
            <div class="fileNameContainer">
                <a  class="name" href="<?= $value['file_path'];?>"><?= $value['file_name'];?></a>
                <a class = "delete" href="#"></a>

            </div>

            <div class="answerData">
                <?= toRuDate($value['file_date']);?>
            </div>
        </div>


    </div>

    <?php
    if(is_array($value['jury_comments'])){
         foreach ($value['jury_comments'] as  $comment) {
    ?>
         <div class="jury_comments">
             <div class="jury_comments_name_date">
                 <div class="name">
                     Коментарий жюри

                 </div>
                 <div class="date">
                     <?= toRuDate($comment['date_comment']);?>

                 </div>

             </div>
             <div class="comment_text">
                 <?=$comment['comment_text'];?>

             </div>

         </div>

     <?php
          }
    }
    ?>
</div>


<?php
}
 ?>
