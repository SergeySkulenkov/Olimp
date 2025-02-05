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
        confirm('Вы действительно хотите удалить вопрос "'+text+'"?');
        $.ajax({
            url: 'delete_question.php',
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
<div>
    <a href="<?=INDEX_PAGE;?>/?id=5">Без ответа</a>
    <a href="<?=INDEX_PAGE;?>/?id=5&answer=1">С ответом</a>
    <a href="<?=INDEX_PAGE;?>/?id=5&answer=2">Все</a>
    
</div>
<?php 
if(is_array($page['content'])){
    foreach($page['content'] as $value){
        $id = $value['id'];
        echo '<div class="smallQuestionText" id="questionText_'.$id.'">';
        echo "<p style='display:block;' id='titleBlock_$id' onclick='showBlock($id)'> ". getStrPart($value['question'],100)." </p>";
        ?>
            <a class = "delete" href="#" onclick="return deleteQuestion(<?=$value['id'];?> ,'<?=getStrPart($value['question'],50)?>')"></a>
        <?php
        echo '</div>';
        ?>
        
        <div style= "display:none" class="questionBlock" id="block_<?=$id;?>">
            <a class = "delete" href="#" onclick="return deleteQuestion(<?=$value['id'];?> ,'<?=getStrPart($value['question'],50)?>')"></a>
            <p><?=nl2br( $value['question']);?></p>
            <?php
            if(is_array($value['answers'])){ 
                foreach($value['answers'] as $answer){ 
                // print_r($answer);
                ?>
                <div class="jury_comments">
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
$_SESSION['question'] = rand(1,1000);
?>
<div id="errorMessage" style="display: none"></div>
<?= $message; ?>
<form action="index.php?id=<?=$_GET['id'];?>" method = "post">
    <div class="textAreaBlock">
        <textarea name="question_<?=$_SESSION['question']?>" id="question"></textarea>
    </div>
    <div class="buttonblock register-buttonblock clearFloat">
        <div class="right-buttonblock">
            <input type="submit" name="register" value="Отправить">
        </div>
    </div>
</form>
