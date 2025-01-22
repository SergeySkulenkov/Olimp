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
</script>
<?php 
$id = 1;
foreach($page['content'] as $value){
    
    echo "<p style='display:block;' id='titleBlock_$id' onclick='showBlock($id)'> ". getStrPart($value['question'],100)." </p>";
    ?>
    <div style= "display:none" id="block_<?=$id;?>">
        <p><?= $value['question'];?></p>
        <p><a href="#" onclick = 'return hideBlock(<?=$id;?>)'>Свернуть</a></p>
    </div>

    <?php
    $id++;
    

}
?>