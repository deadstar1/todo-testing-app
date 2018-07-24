<div id="toModify">
    <form action="?action=update&id=<?php echo ($this->records[0][$this->ID]);?>" method="post">
        <?php foreach ($this->records[0] as $record=>$value){ ?>
            <?php echo $record?>:<input type="text" value="<?php echo($value); ?>" name="<?php echo $record ?>"><br>
        <?php } ?>
        <input type="submit" value="submit" name="submit">
    </form>
    <a href="">Back</a>
</div>