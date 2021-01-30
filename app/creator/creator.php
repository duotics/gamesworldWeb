<?php require('../../init.php');
include('creator.fnc.php');
include(RAIZf.'head.php');
include(RAIZf.'nav.php'); ?>
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
<div class="container">
    <div class="pt-4 pb-4">
    <h1 class="mb-4">Creadores de Contenido Populares</h1>

    <div class="card mb-4">
        <div class="card-body">
            Filtros
        </div>
    </div>

    <div class="bg-white">
        <div class="container p-4">
            <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4">
            <?php do{ ?>
            <div class="col">
            <a href="<?php echo $RAIZ.$dRSst['url'] ?>">
                <div class="card h-100 cont-view-streamer">
                <img src="<?php echo $RAIZd.'logos/'.$dRSst['logo'] ?>" class="card-img-top img-streamer" alt="<?php echo $dRSst['name'] ?>">
                <div class="card-body text-center">
                    <p class="card-text"><?php echo $dRSst['name'] ?></p>
                </div>
                </div>
                </a>
            </div>
            <?php }while($dRSst = mysqli_fetch_assoc($RSst)); ?>
            </div>
        </div>
    </div>

    </div>
</div>
<?php
require(RAIZf.'foot.php');
?>