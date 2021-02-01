<?php require('../../init.php');
include('game.fnc.php');
$body['tit']="Videojuegos";
include(RAIZf.'head.php');
include(RAIZf.'nav.php'); ?>
<div class="container">
    <div class="pt-4 pb-4">
    <h1 class="mb-4">Videojuegos Populares</h1>

    <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4">
    <?php do{ ?>
        <?php echo getBtnGame($dRSgt) ?>
    <?php }while($dRSgt = mysqli_fetch_assoc($RSgt)); ?>
    </div>

    </div>
</div>
<?php require(RAIZf.'foot.php'); ?>