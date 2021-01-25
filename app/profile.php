<?php require('../init.php');
//require_once('../vendor/autoload.php');
if($_REQUEST['name']) $name=$_REQUEST['name'];
?>

<div class="card">
    <div class="card-header">
        Profile from database: <?php echo $name ?> *
    </div>
    <div class="card-body">
        Content
    </div>
</div>