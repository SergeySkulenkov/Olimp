<?php
echo $deleteFileError;
if(is_array($page['content'])){
    ?>
    <p>УAловите свое руки мощные вдохновениевкладывает в ваши творческие инструменты, которые обеспечивают абсолютный контроль над текстом. их помощью вы любым элементам тени, эффекты с использованием прозрачности. Они позволят вам создавать элегантные таблицы. И не бойтесь экспериментировать у вас всегда ть отменить или выполнить повторно действия.</p>
    <?php
    foreach ($page['content'] as $key => $value) {
    ?>
    <div class="answerBlock">
        <div class="answerFile">
            <div class="img"></div>
            <div class="fileName">
                <div class="fileNameContainer">
                    <?php $path=INDEX_PAGE."upload/users/".$_SESSION['user']['id']."/".$value['file_name']; ?>
                    <a  class="name" target="_blank" href="<?= $path;?>"><?= $value['file_name'];?></a>
                    <a class = "delete" href="<?= INDEX_PAGE.'?id='.$_GET['id'].'&del='.$value['id'];?>" onclick="return confirm('Вы действительно хотите удалить файл <?= $value['file_name'];?>?')"></a>
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
        <div class="windowClose" >

        </div>
    </div>
    <div class="windowContent">
        <p>Формат файла.</p>
        <form class="" action="<?= INDEX_PAGE.'?id='.$_GET['id'].'&upload=1';?>" method="post" enctype="multipart/form-data">
            <input  type="file" name="userfile" value="">
            <div class="uploadButton">
                <input type="submit" name="" value="Загрузить файл на сервер">
            </div>


        </form>

    </div>


</div>
<div class="shadow"></div>
<script type="text/javascript" src="js/upload.js">

</script>
