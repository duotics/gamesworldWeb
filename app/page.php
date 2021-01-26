<?php require('../init.php');
if($_REQUEST['url']) $url=$_REQUEST['url'];
$row=detRow('tbl_profile','url',$url);

$qlN=sprintf("SELECT * FROM tbl_network WHERE idp=%s AND tip=%s  ORDER BY ord ASC",
SSQL($row['idp'],'int'),
SSQL('s','text'));
//echo $qlN;
$RSln = mysqli_query($conn,$qlN) or die(mysqli_error($conn));
$dRSln = mysqli_fetch_assoc($RSln);
$tRSln = mysqli_num_rows($RSln);

$qlD=sprintf("SELECT * FROM tbl_network WHERE idp=%s AND tip=%s ORDER BY ord ASC",
SSQL($row['idp'],'int'),
SSQL('d','text'));
$RSld = mysqli_query($conn,$qlD) or die(mysqli_error($conn));
$dRSld = mysqli_fetch_assoc($RSld);
$tRSld = mysqli_num_rows($RSld);

$qlG=sprintf("SELECT * FROM tbl_profile_game WHERE idp=%s",
SSQL($row['idp'],'int'));
$RSlg = mysqli_query($conn,$qlG) or die(mysqli_error($conn));
$dRSlg = mysqli_fetch_assoc($RSlg);
$tRSlg = mysqli_num_rows($RSlg);

$qlP=sprintf("SELECT * FROM tbl_post WHERE idp=%s",
SSQL($row['idp'],'int'));
$RSlp = mysqli_query($conn,$qlP) or die(mysqli_error($conn));
$dRSlp = mysqli_fetch_assoc($RSlp);
$tRSlp = mysqli_num_rows($RSlp);

$body['tit']=$row['name'];
$body['bg']=$row['bg'];
include(RAIZf.'head.php') ?>
<div class="container mb-2">
    <div class="p-4 mb-2 text-center">
        <div class="text-center mb-4 mt-2">
            <img src="<?php echo $RAIZd.'logos/'.$row['logo'] ?>" alt="" style="height:300px;" class="cont-logo-main img-fluid animate__animated animate__heartBeat">
        </div>
        <div class="text-center mt-4 mb-0">
            <span class="btn btn-secondary"><?php echo $row['name'] ?> <a href="#"><span class="ml-2 flag-icon flag-icon-<?php echo $row['pais'] ?>"></span></a></span>
        </div>
    </div>
    <div mb-4>
        
    </div>
</div>
<div class="container-fluid bg-white p-4">
<div class="text-center">
        <?php //$varDelay=null; ?>
        <?php do{ ?>
        <span class="btn-sec-soc">
            <a href="<?php echo $dRSln['url'] ?>" class="btn btn-<?php echo $dRSln['css'] ?> m-4 animate__animated animate__backInUp animate__delay-1s" style="background:<?php echo $dRSln['color'] ?>" target="black">
                <i class="<?php echo $dRSln['icon'] ?> fa-2x"></i><br>
                <?php echo $dRSln['username'] ?>
            </a>
        </span>
        <?php //$varDelay.=" animate__delay-1s " ?>
        <?php }while($dRSln = mysqli_fetch_assoc($RSln)); ?>
        </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-2 mb-2 animate__animated animate__backInLeft animate__delay-2s">
            <div class="card">
                <h4 class="card-header">JUEGOS</h4>
                <div class="card-body">
                    <table class="table table-sm">
                    <?php do{ ?>
                    <?php $dG=detRow('tbl_games','idg',$dRSlg['idg']) ?>
                        <tr>
                            <td class="text-center">
                            <a href="#">
                                <img src="<?php echo $RAIZd.'games/'.$dG['img'] ?>" alt="" class="img-fluid rounded">
                                <span class="small"><?php echo $dG['name'] ?></span>
                            </a>
                            </td>
                        </tr>
                        <?php }while($dRSlg = mysqli_fetch_assoc($RSlg)); ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-8 col-md-10 mb-2 animate__animated animate__backInRight animate__delay-2s">
            
            <div class="card">
                <div class="card-body">
                <?php do{ ?>
                <div class="card">
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

<div class="bg-white p-5">
    <div class="container">
        <h1 class="display-5">Formas de apoyar al creador</h1>
        
        <div class="text-center animate__animated animate__backInUp animate__delay-1s">
        <?php //$varDelay=null; ?>
        <?php do{ ?>
        <a href="<?php echo $dRSld['url'] ?>" class="btn btn-<?php echo $dRSld['css'] ?> m-4" style="background:<?php echo $dRSld['color'] ?>" target="black">
            <i class="<?php echo $dRSld['icon'] ?> fa-2x"></i><br>
            <?php echo $dRSld['username'] ?>
        </a>
        <?php //$varDelay.=" animate__delay-1s " ?>
        <?php }while($dRSld = mysqli_fetch_assoc($RSld)); ?>
        </div>
        </div>
        
    </div>
</div>

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

<?php include(RAIZf.'foot.php') ?>