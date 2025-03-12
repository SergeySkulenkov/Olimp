<?php
$status = array("Не активна","Активна");

if(is_array($page['content'])){
    if(isset($_GET['olimp_id'])){
        ?>
            <div class="answerBlock">
            <div class="answerFile">
                <div class="img"></div>
                <div class="fileName">
                    <div class="fileNameContainer">
                    <a  class="name" href=""><?= $page['content']['title'];?></a>
                    <div class="answerData">
                        <?= $status[$page['content']['status']];?> код: <?= $page['content']['code'];?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            //print_r($page['content']['turs']);
            if(isset($page['content']['turs'])){
                foreach($page['content']['turs'] as $turs){
                    ?>
                    <div class="smallQuestionText"style="clear:both">
                    <?php
                        echo $turs['number'].")  Начало: ".$turs['date_start']." Конец: ".$turs['date_end'];
                    ?>
                    </div>
                    <?php
                }

            }
           ?>     
        <?php

    }else{
        foreach ($page['content'] as $key => $value) {
        ?>
        <div class="answerBlock">
            <div class="answerFile">
                <div class="img"></div>
                <div class="fileName">
                    <div class="fileNameContainer">
                    <a  class="name" href="<?= INDEX_PAGE.'?id='.$_GET['id'].'&olimp_id='.$value['id'];?>"><?= $value['title'];?></a>
                    <div class="answerData">
                        <?= $status[$value['status']];?> код: <?= $value['code'];?>
                        </div>
                    </div>
                </div>


            </div>
            

            <?php

        ?>
    

        </div>


        <?php
        }
        ?>
        <div class="downloadButtonBlock">
            <div class="ico"></div>
            <button type="button" class="downloadButton" name="button">Добавить</button>
        </div>
        <?php
        
    }
   
}

 ?>




<div class="window">
    <div class="windowTitle">
        <div class="windowText">
            Добавить олимпиаду
        </div>
        <div class="windowClose" >

        </div>
    </div>
    <div class="windowContent">
        <form class="" action="<?= INDEX_PAGE.'?id='.$_GET['id'].'&olimp=1';?>" method="post">
            <input class="windowInput" type="text" name="olimpName" value="" placeholder="Название">
            <input class="windowInput" type="text" name ="olimpCode" value="" placeholder="Код"> 
            <br>
            <select name="status" id="status" class="windowInput">
                <option value="0">Не активна</option>
                <option value="1">Активна</option>
            </select>
            <div class="uploadButton">
                <input type="submit" name="" value="Добавить олимпиаду">
            </div>


        </form>

    </div>


</div>
<div class="shadow"></div>
<script type="text/javascript" src="js/upload.js">

</script>
