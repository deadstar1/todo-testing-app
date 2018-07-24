<div>
    <?php
    foreach ($this->nullParameters as $parameter){
        if ($parameter!=NULL){
            echo  $parameter . " parameter is required. </br>";
        }
    }
    ?>
    <br>
    <a href="<?php echo $_SERVER['HTTP_REFERER'];?>">Back</a>
    <!--todo: use javascript to go back into history-->
</div>