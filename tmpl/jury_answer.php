<?php
if(!isset($_GET['user'])){
    ?>
    <p>УAловите свое руки мощные вдохновениевкладывает в ваши творческие инструменты, которые обеспечивают абсолютный контроль над текстом. их помощью вы любым элементам тени, эффекты с использованием прозрачности. Они позволят вам создавать элегантные таблицы. И не бойтесь экспериментировать у вас всегда ть отменить или выполнить повторно действия.</p>
    <?php
    echo $deleteFileError;
    if(is_array($page['content'])){
        foreach ($page['content'] as $key => $value) {
            ?>
            <div class="smallQuestionText"><a class="userList" href="<?= INDEX_PAGE.'?id='.$_GET['id'].'&user='.$value['user_id'];?>"><?= $value['username'];?></a></div>
            <?php
        }
    }
}else if(isset($_GET['otvet'])){
    ?>
    <p>УAловите свое руки мощные вдохновениевкладывает в ваши творческие</p>
        <div class="answerBlock admin">
            <div class="answerFile">
                <div class="img"></div>
                <div class="fileName">
                    <div class="fileNameContainer">
                        <?php $path=INDEX_PAGE."upload/users/".$_GET['user']."/".$page['content'][0]['file_name']; ?>
                        <a  class="name" target="_blank" href="<?= $path;?>"><?= $page['content'][0]['file_name'];?></a>
                        <a class = "delete" href="<?= INDEX_PAGE.'?id='.$_GET['id'].'&del='.$page['content'][0]['id'];?>" onclick="return confirm('Вы действительно хотите удалить файл <?= $page['content'][0]['file_name'];?>?')"></a>
                        
                    </div>

                    <div class="answerData">
                        <?= toRuDate($page['content'][0]['file_date']);?>
                    </div>
                </div>


            </div>
            <form action="index.php?id=<?=$_GET['id'];?>&user=<?=$_GET['user'];?>&otvet_id=<?=$_GET['otvet']?>" method = "post">
                <div class="textAreaBlock">
                    <textarea name="JuryAnswer" id="question"></textarea>
                </div>
                <div class="buttonblock register-buttonblock clearFloat">
                    <div class="right-buttonblock">
                        <input type="submit" name="register" value="Отправить">
                    </div>
                </div>
            </form>
            

            <?php

}else{
    if(is_array($page['content'])){
        ?>
        <p>УAловите свое руки мощные вдохновениевкладывает в ваши творческие</p>
        <?php
        
        foreach ($page['content'] as $key => $value) {
        ?>
        <div class="answerBlock admin">
            <div class="answerFile">
                <div class="img"></div>
                <div class="fileName">
                    <div class="fileNameContainer">
                        <?php $path=INDEX_PAGE."upload/users/".$_GET['user']."/".$value['file_name']; ?>
                        <a  class="name" target="_blank" href="<?= $path;?>"><?= $value['file_name'];?></a>
                        <a class = "otvet" href="<?= INDEX_PAGE.'?id='.$_GET['id'].'&otvet='.$value['id'];?>&user=<?=$_GET['user']?>"></a>
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
                    <a class = "delJrc" href="<?= INDEX_PAGE.'?id='.$_GET['id'].'&user='.$_GET['user'].'&delJrc='.$comment['id'];?>"  onclick="return confirm('Вы действительно хотите удалить ответ  <?= $comment['comment_text'];?>')">Удалить</a>

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
    


    </div>
    <div class="shadow"></div>
    <script type="text/javascript" src="js/upload.js">

    </script>
<?php
}
?>