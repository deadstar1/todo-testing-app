<div id="findByID">
    <div id="record">
        <?php
        foreach ($this->records[0] as $column=>$value){
            echo $column ." =" . $value ."</br>";
        }
        ?>
    </div>
    <div id="control">
        <a href="">Back</a>|<a href="?action=tomodify&id=<?php echo $this->records[0][$this->ID];?>">Edit</a>
    </div>
</div>