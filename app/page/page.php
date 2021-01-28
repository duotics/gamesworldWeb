<?php require('../../init.php');
include('page.fnc.php');
$body['tit']=$row['name'];
$body['bg']=$row['bg'];
include(RAIZf.'head.php') ?>

<?php if($view){ ?>
<!--TOP-->
<div class="container mb-2">
    <div class="p-4 text-center">
        <div class="text-center mb-5 mt-2">
            <img src="<?php echo $RAIZd.'logos/'.$row['logo'] ?>" alt="" style="" class="<?php echo $row['logo-css'] ?> cont-logo-main img-fluid animate__animated animate__heartBeat">
        </div>
        <div class="text-center mb-2">
        <span class="btn btn-secondary">Creador Contenido</span>    
        <span class="btn btn-light"><?php echo $row['name'] ?> <a href="#"><span class="ml-2 flag-icon flag-icon-<?php echo $row['pais'] ?>"></span></a></span>
        </div>
    </div>
</div>
<!--NETWORKS LIST-->
<div class="container-fluid bg-white p-4">
    <div class="text-center animate__animated animate__backInUp animate__delay-1s">
        <?php do{ ?>
        <span class="btn-sec-soc m-3">
            <?php echo getBtnNetwork($dRSln); ?>
        </span>
        <?php }while($dRSln = mysqli_fetch_assoc($RSln)); ?>
    </div>
</div>
<!--CONTENT-->
<div class="container mt-5 mb-5">
    <div class="row">
        <!--GAMES SECTION-->
        <div class="col-xs-6 col-sm-4 col-md-2 mb-2 animate__animated animate__backInLeft animate__delay-2s">
            <div class="card">
                <h4 class="card-header">JUEGOS</h4>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                    <?php do{ ?>
                    <?php $dG=detRow('tbl_games','idg',$dRSlg['idg']) ?>
                        <tr>
                            <td class="text-center">
                            <a href="<?php echo $RAIZ ?>game/<?php echo $dG['url'] ?>"  class="cont-game">
                                <div class="card">
                                <img src="<?php echo $RAIZd.'games/'.$dG['img'] ?>" class="card-img-top" alt="...">
                                <div class="card-body bg-dark text-light p-2">
                                    <?php echo $dG['name'] ?>
                                </div>
                                </div>
                            </a>
                            </td>
                        </tr>
                        <?php }while($dRSlg = mysqli_fetch_assoc($RSlg)); ?>
                    </table>
                </div>
            </div>
        </div>
        <!--POST SECTION-->
        <div class="col-xs-6 col-sm-8 col-md-10 mb-2 animate__animated animate__backInRight animate__delay-2s">
            <div class="card">
                <div class="card-body">
                <?php do{ ?>
                <div class="card mb-2">
                    <?php if($dRSlp['tit']){ ?>
                    <h4 class="card-header"><?php echo $dRSlp['tit'] ?></h4>
                        <?php } ?>
                    <div class="card-body">
                        <?php echo $dRSlp['cont'] ?>
                    </div>
                </div>
                <?php }while($dRSlp = mysqli_fetch_assoc($RSlp)); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--APOYO CREATOR-->
<div class="bg-white p-5">
    <div class="container">
        <h1 class="display-5">Formas de apoyar al creador</h1>
        
        <div class="text-center animate__animated animate__backInUp animate__delay-1s">
        <?php do{ ?>
        <span class="btn-sec-soc">
        <?php echo getBtnNetwork($dRSld,'m-4'); ?>
        </span>
        <?php }while($dRSld = mysqli_fetch_assoc($RSld)); ?>
        </div>
        </div>
        
    </div>
</div>
<!--BOTTOM-->
<div class="bg-dark text-light pt-5 pb-5">
    <div class="container">
            <div class="row">
                <div class="col-sm-6">
                        <h4>Información del Creador de Contenido</h4>
                        <table class="table text-light">
                            <tr>
                                <td>Nombre</td>
                                <td><?php echo $row['rname'] ?></td>
                            </tr>
                            <tr>
                                <td>Pais</td>
                                <td><span class="ml-2 flag-icon flag-icon-<?php echo $row['pais'] ?>"></span></td>
                            </tr>
                            <tr>
                                <td>Bio</td>
                                <td><?php echo $row['bio'] ?></td>
                            </tr>
                        </table>
                </div>
                <div class="col-sm-6">
                        <h4>Contacto</h4>
                        <table class="table text-light">
                            <tr>
                                <td>Email</td>
                                <td><?php echo $row['email'] ?></td>
                            </tr>
                        </table>
                </div>
            </div>
    </div>
</div>

<nav class="navbar navbar-dark bg-secondary">
  <div class="container-fluid pb-6">
    <a class="navbar-brand" href="#"><?php echo $row['name'] ?> ® 2021</a>
  </div>
</nav>
<?php }else{ ?>
    <div class="container pt-4 pb-4">
        <div class="alert alert-warning">
            <h4 class="text-center">No existe el usuario que buscas</h4>
        </div>
    </div>
<?php } ?>
<?php include(RAIZf.'foot.php') ?>