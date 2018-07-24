<div id="new">
    <form action="?action=insert" method="post">
        <?php $i=1;?>
        <?php foreach ($this->records as $column=>$value){?>
            <b><?php echo $value['Field'];?>: </b> <input type="text" value="" name="<?php echo $value['Field'];?>"></br>
        <?php $i++;} ?>
        <input type="submit" value="submit">
    </form>
    <a href="">Back</a>
</div>