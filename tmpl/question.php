<script>
    function showBlock(id){
        $("#block_"+id).css('display','block');
        $("#titleBlock_"+id).css('display','none');
    }
    function hideBlock(id){
        $("#block_"+id).css('display','none');
        $("#titleBlock_"+id).css('display','block');
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
                alert(data);
            }

        });
        return false;
    }
</script>
<?php 
$id = 1;
foreach($page['content'] as $value){
    echo '<div class="smallQuestionText">';
    echo "<p style='display:block;' id='titleBlock_$id' onclick='showBlock($id)'> ". getStrPart($value['question'],100)." </p>";
    ?>
        <a class = "delete" href="#" onclick="return deleteQuestion(<?=$value['id'];?> ,'<?=getStrPart($value['question'],50)?>')"></a>
    <?php
    echo '</div>';
    ?>
    
    <div style= "display:none" id="block_<?=$id;?>">
        <p><?= $value['question'];?></p>
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
    $id++;
    

}
?>
<?= $message; ?>
<form action="index.php?id=<?=$_GET['id'];?>" method = "post">
    <div class="textAreaBlock">
        <textarea name="question" id="question"></textarea>
    </div>
    <div class="buttonblock register-buttonblock clearFloat">
        <div class="right-buttonblock">
            <input type="submit" name="register" value="Отправить">
        </div>
    </div>
</form>
