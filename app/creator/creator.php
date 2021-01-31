<?php require('../../init.php');
include('creator.fnc.php');
include('creator.css.php');
include(RAIZf.'head.php');
include(RAIZf.'nav.php'); ?>
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
            <a href="<?php echo $RAIZ.$dRSst['url'] ?>" style="text-decoration:none" class="text-dark">
                <div class="card h-100 cont-view-streamer">
                <img src="<?php echo $RAIZd.'logos/'.$dRSst['logo'] ?>" class="card-img-top img-streamer" alt="<?php echo $dRSst['name'] ?>">
                <div class="card-body text-center">
                    <p class="card-text">
                        <span class="ml-2 flag-icon flag-icon-<?php echo $dRSst['pais'] ?>"></span>
                        <?php echo $dRSst['name'] ?>
                    </p>
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
<?php require(RAIZf.'foot.php'); ?>