<script>
    function showBlock(id){
        $("#block_"+id).css('display','block');
        $("#questionText_"+id).css('display','none');
    }
    function hideBlock(id){
        $("#block_"+id).css('display','none');
        $("#questionText_"+id).css('display','block');
        return false;

    }
    function deleteQuestion(id, text){
        let res = confirm('Вы действительно хотите удалить вопрос "'+text+'"?');
        if(res == false)
            return false;
        $.ajax({
            url: 'delete_admin_question.php',
            method: 'get',
            dataType: 'html',
            data: {id: id},
            success: function(data){
                if(data == "true"){
                    $("#questionText_"+id).fadeOut(300);
                }else{
                    $("#errorMessage").html("<p class = 'updateError'>Не удалось удалить вопрос.</p>");
                    $("#errorMessage").css('display','block');
                    setTimeout(() => {
                        $("#errorMessage").fadeOut(300);
                    }, 3000);


                }
            }

        });
        return false;
    }
</script>
<div class="tabBar">
    <?php
        $active = array("","",""); 
        if(!isset($_GET['answer'])){
            $active[0] = " active";
        }else if($_GET['answer']==1){
            $active[1] = " active";
        }else{
            $active[2] = " active";
        }
    ?>
    <a id="noOtv" class="tab <?=$active[0]?>" href="<?=INDEX_PAGE;?>?id=5">Без ответа</a>
    <a id="otv" class="tab <?=$active[1]?>" href="<?=INDEX_PAGE;?>?id=5&answer=1">С ответом</a>
    <a id="vce" class="tab<?=$active[2]?>" href="<?=INDEX_PAGE;?>?id=5&answer=2">Все</a>
    
</div>
<?php 
if(isset($_GET['adminQotvet'])){
    ?>
    <div class="answerBlock adminQ">
        <div class="answerFile">
            <div class="img"></div>
            <div class="fileName">
                <div class="fileNameContainer">
                    <a  class="name" target="_blank" href="<?= $path;?>"><?= $page['content']['question'];?></a>
                    <a class = "delete" href="<?= INDEX_PAGE.'?id='.$_GET['id'].'&del='.$page['content'][$_GET['adminQotvet']]['id'];?>" onclick="return confirm('Вы действительно хотите удалить вопрос <?php /*echo $page['content']['question'];*/?>?')"></a>
                    
                </div>

                <div class="answerData">
                    <?= toRuDate($page['content']['date']);?>
                </div>
            </div>
            <?php
            if(isset($page['content']['answers'])){ 
                    foreach($page['content']['answers'] as $answer){ 
                    ?>
                    <div class="jury_comments otvet">
                    <div class="jury_comments_name_date">
                        <div class="name">
                            Ответ

                        </div>
                        <div class="date">
                        <?= toRuDate($answer['date_comment']);?>
                        </div>

                    </div>
                    <div class="comment_text">
                        <p><?= $answer['comment_text'];?></p>

                    </div>
                    <a class = "delJrc" href="<?= INDEX_PAGE.'?id='.$_GET['id'].'&adminQotvet='.$_GET['adminQotvet'].'&user='.$_GET['user'].'&delAdA='.$answer['id'].'&aAID='.$answer['answer_id'];?>" onclick="return confirm('Вы действительно хотите удалить ответ <?=$answer['comment_text']; ?>?')">Удалить</a>
                </div>
                        
                    <?php 
                    }
                }
                ?>


        </div>
        <form action="index.php?id=<?=$_GET['id'];?>&adminQotvet=<?=$_GET['adminQotvet']?>&user=<?=$_GET['user']?>" method = "post">
            <div class="textAreaBlock">
                <textarea name="adminAnswer" id="question"></textarea>
            </div>
            <div class="buttonblock register-buttonblock clearFloat">
                <div class="right-buttonblock">
                    <input type="submit" name="register" value="Отправить">
                </div>
            </div>
        </form>
        

        <?php

}
else{
    if(is_array($page['content'])){
        foreach($page['content'] as $value){
            
            $id = $value['id'];
            $user_id;
            if(isset($value['uq_user_id'])){
                $user_id = $value['uq_user_id'];
            }else{
                $user_id = $value['user_id'];
            }
            echo '<div class="smallQuestionText" id="questionText_'.$id.'">';
            echo "<p style='display:block;' id='titleBlock_$id' onclick='showBlock($id)'> ". getStrPart($value['question'],100)." </p>";
            ?>
                <a class = "adminQotvet" href="<?= INDEX_PAGE.'?id='.$_GET['id'].'&adminQotvet='.$value['id'].'&user='.$user_id;?>"></a>
                <a class = "delete" href="#" onclick="return deleteQuestion(<?=$value['id'];?> ,'<?=getStrPart($value['question'],50)?>')"></a>
            <?php
            echo '</div>';
            ?>
            <div style= "display:none" id="block_<?=$id;?>" class="questionAndAnswerBlock" >
            <div  class="questionBlock">
                <a class = "delete" href="#" onclick="return deleteQuestion(<?=$value['id'];?> ,'<?=getStrPart($value['question'],50)?>')"></a>
                <p><?=nl2br( $value['question']);?></p>
            </div>
                <?php
                if(is_array($value['answers'])){ 
                    foreach($value['answers'] as $answer){ 
                    // print_r($answer);
                    ?>
                    <div class="jury_comments otvet">
                    <div class="jury_comments_name_date">
                        <div class="name">
                            Ответ

                        </div>
                        <div class="date">
                        <?= toRuDate($answer['date_comment']);?>
                        </div>

                    </div>
                    <div class="comment_text">
                        <p><?= $answer['comment_text'];?></p>

                    </div>
                    <a class = "delJrc" href="<?= INDEX_PAGE.'?id='.$_GET['id'].'&answer_id='.$answer['id'].'&aAID='.$answer['answer_id'].'&answer='.$_GET['answer']?>" onclick="return confirm('Вы действительно хотите удалить ответ <?=$answer['comment_text']; ?>?')">Удалить</a>

                </div>
                        
                    <?php 
                    }
                }
                ?>
                <p><a href="#" onclick = 'return hideBlock(<?=$id;?>)'>Свернуть</a></p>
            </div>
            <?php
            

        }
    }
}
?>
<script type="text/javascript" src="../js/style.js"></script>

