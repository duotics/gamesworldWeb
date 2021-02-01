<?php require('../../init.php');
include('gamed.fnc.php');
$body['tit']=$row['name'];
include(RAIZf.'head.php');
require(RAIZf.'nav.php');
?>
<?php if($view){?>
<style>
    .game-head{background-image: url(<?php echo $RAIZd."gamesbg/".$row['bg'] ?>);}
</style>
<div class="game-head">
    <?php $hitsS=updHitsH($row['idg'],'gm'); ?>
    <div class="container">
        <div class="p-5 text-center">
            <div class="mb-4">
            <img src="<?php echo $RAIZd ?>/games/<?php echo $row['img'] ?>" class="img-fluid img-thumbnail rounded" style="height:300px">
            </div>
            <div class="mb-2">
            <a href="<?php echo $RAIZ ?>games/" class="btn btn-secondary btn-lg">Videojuego <i class="fas fa-gamepad"></i></a> <span class="btn btn-light btn-lg"><?php echo $row['name'] ?></span>
            </div>
        </div>
    </div>
</div>
<div class="container pt-3">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $RAIZ ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $RAIZ ?>games/">Videojuegos</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $row['name'] ?></li>
  </ol>
</nav>
</div>
    <div class="bg-white">
        <div class="container pt-4 pb-4">
            <h3>Streamers Favoritos</h3>
            <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4">
            <?php do{ ?>
            <?php $dS=detRow('tbl_profile','idp',$dRSls['idp']); ?>
            <div class="col">
            <a href="<?php echo $RAIZ.$dS['url'] ?>">
                <div class="card h-100 cont-view-streamer">
                <img src="<?php echo $RAIZd.'logos/'.$dS['logo'] ?>" class="card-img-top img-streamer" alt="<?php echo $dS['name'] ?>">
                <div class="card-body text-center">
                    <p class="card-text"><?php echo $dS['name'] ?></p>
                </div>
                </div>
                </a>
            </div>
            <?php }while($dRSls = mysqli_fetch_assoc($RSls)); ?>
            </div>
        </div>
    </div>
<?php }else{ ?>
    <div class="container">
        <div class="alert">
            <h4>Game not found</h4>
        </div>
    </div>
<?php } ?>