<?php require('../../init.php');
include('gamed.fnc.php');
include(RAIZf.'head.php');
?>
<?php if($view){?>
<style>
.game-head{
    background-image: url(<?php echo $RAIZd."gamesbg/".$row['bg'] ?>); 
    /* Background image is centered vertically and horizontally at all times */
    background-position: center center;
    /* Background image doesn't tile */
    background-repeat: no-repeat;
    /* Background image is fixed in the viewport so that it doesn't move when the content's height is greater than the image's height */
    background-attachment: fixed;
    /* This is what makes the background image rescale based on the container's size */
    background-size: cover;
    /* Set a background color that will be displayed while the background image is loading */
    background-color: #eee;
}
.cont-streamer{
    overflow:hidden;
    background:#eee;
}
.img-streamer{
    height:100%;
    width:100%;
    object-fit: cover;
    
}
</style>
<div class="game-head">
    <?php $hitsS=updHitsH($row['idg'],'gm'); ?>
    <div class="container">
        <div class="p-5 text-center">
            <div class="mb-4">
            <img src="<?php echo $RAIZd ?>/games/<?php echo $row['img'] ?>" class="img-fluid img-thumbnail rounded" style="height:300px">
            </div>
            <div class="mb-2">
            <a href="<?php echo $RAIZ ?>game/" class="btn btn-secondary btn-lg">Videojuego <i class="fas fa-gamepad"></i></a> <span class="btn btn-light btn-lg"><?php echo $row['name'] ?></span>
            </div>
        </div>
    </div>
</div>
<div class="container pt-3">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $RAIZ ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $RAIZ ?>game/">Videojuegos</a></li>
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
                <div class="card h-100">
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