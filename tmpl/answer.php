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
                     Комментарий жюри

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
 <div class="downloadButtonBlock">
     <div class="ico"></div>
     <button type="button" class="downloadButton" name="button">Загрузить</button>


 </div>



<div class="window">
    <div class="windowTitle">
        <div class="windowText">
            Загрузка файла
        </div>
        <div class="windowClose">

        </div>
    </div>
    <div class="windowContent">
        <p>Формат файла.</p>
        <form class="" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="userfile" value="">
            <div class="uploadButton">
                <input type="submit" name="" value="Загрузить файл на сервер">
            </div>


        </form>

    </div>


</div>
<div class="shadow"></div>
<script type="text/javascript" src="js/upload.js">

</script>
