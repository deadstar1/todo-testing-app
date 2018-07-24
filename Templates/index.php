<div id="index">
    <?php if($this->rowCount==0){echo 'no record(s)';?>
        </br><a href="?action=new">New Recipe</a>
        <?php exit;
    }?>
    <div id="title"><h1>Listing <?php echo pathinfo($_SERVER['REQUEST_URI'])['filename']. "s"; ?></h1></div>
    <div id="list">
        <?php /*$this->pretty_print->output($this->records)*/?>
        <?php foreach ($this->records as $listOfUsers){?>
        <div class="record">
            <?php foreach ($listOfUsers as $field=>$value){?>
                <b><?php echo $field; ?>: </b><?php echo($value); ?>
            <?php }?>
            <a href="?action=findbyid&id=<?php echo($listOfUsers[$this->ID]);?>">Show</a>|<a href="?action=tomodify&id=<?php echo($listOfUsers[$this->ID]);?>">edit</a>|<a href="?action=delete&id=<?php echo($listOfUsers[$this->ID]);?>">delete</a>
        </div>
        <?php }?>
    </div>
    <a href="?action=new">New Recipe</a>
</div>