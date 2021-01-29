<?php require('../../init.php');
require('search.fnc.php');
require(RAIZf.'head.php');
require(RAIZf.'nav.php');
?>
<style>
    .cont-search{
        background-image: url('<?php echo $RAIZa ?>img/bg-home-01.jpg');
        background-position: center center;
        padding: 30px 0 30px 0;
        background-attachment: fixed;
    }
    .cont-search h3{
        text-shadow: 3px 3px #0d6efd, -4px -4px #000;
        font-weight: bold;
    }
</style>
<div class="cont-search">
    <div class="container pt-4 pb-4 text-center">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <h3 class="display-3 text-light text-bold mb-4">Buscador</h3>
                <form>
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Escribe aqui el nombre del creador o del videojuego" value="<?php echo $str ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="bg-white">
        <div class="container pt-4 pb-4">
            <?php if($tRt>0){ ?>
                <?php if($tRSsg>0){ ?>
                <h3>Videojuegos</h3>
                <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4">
                <?php do{ ?>
                    <?php echo getBtnGame($dRSsg) ?>
                <?php }while($dRSsg = mysqli_fetch_assoc($RSsg)); ?>
                </div>
                <hr>
                <?php } ?>
                <?php if($tRSss>0){ ?>
                <h3>Streamers</h3>
                <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4">
                <?php do{ ?>
                <?php $dS=detRow('tbl_profile','idp',$dRSss['idp']); ?>
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
                <?php }while($dRSss = mysqli_fetch_assoc($RSss)); ?>
                </div>
                <?php } ?>
            <?php }else{ ?>
                <div class="alert">
                    <h4>Sin Resultados</h4>
                </div>
            <?php } ?>
        </div>
    </div>

<?php require(RAIZf.'foot.php'); ?>