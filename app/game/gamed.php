<?php require('../../init.php');
include('gamed.fnc.php');
include(RAIZf.'head.php');
?>
<?php if($view){?>
    <div class="container mb-2">
        <div class="p-4 text-center">    
            <div class="text-center mb-5 mt-2">
                <img src="<?php echo $RAIZd ?>/games/<?php echo $row['img'] ?>" alt="img-fluid img-thumbnail">
            </div>
            <div class="text-center mb-2">
                <span class="btn btn-secondary">Videojuego <i class="fas fa-gamepad"></i></span>    
                <span class="btn btn-light"><?php echo $row['name'] ?></span>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="container pt-4 pb-4">
            <h4>Streamers Favoritos</h4>
            <div class="row">
            <?php do{ ?>
            <?php $dS=detRow('tbl_profile','idp',$dRSls['idp']); ?>
            
                <div class="card col-sm-2">
                <a href="<?php echo $RAIZ.$dS['url'] ?>">
                <img src="<?php echo $RAIZd.'logos/'.$dS['logo'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text"><?php echo $dS['name'] ?></p>
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