<?php require('../init.php');
if($_REQUEST['url']) $url=$_REQUEST['url'];
$row=detRow('tbl_profile','url',$url);

$qlN=sprintf("SELECT * FROM tbl_network WHERE idp=%s",
SSQL($row['idp'],'int'));
$RSln = mysqli_query($conn,$qlN) or die(mysqli_error($conn));
$dRSln = mysqli_fetch_assoc($RSln);
$tRSln = mysqli_num_rows($RSln);

$qlG=sprintf("SELECT * FROM tbl_profile_game WHERE idp=%s",
SSQL($row['idp'],'int'));
$RSlg = mysqli_query($conn,$qlG) or die(mysqli_error($conn));
$dRSlg = mysqli_fetch_assoc($RSlg);
$tRSlg = mysqli_num_rows($RSlg);

$body['bg']=$row['bg'];
include(RAIZf.'head.php') ?>
<div class="container mb-4">
    <div class="p-4">
        <div class="text-center mb-2">
            <img src="<?php echo $RAIZd.'logos/'.$row['logo'] ?>" alt="" style="height:275px;" class="img-fluid">
        </div>
        <h5 class="text-center text-white mt-4 mb-0"><?php echo $row['name'] ?></h5>
    </div>
</div>
<div class="container-fluid bg-white p-4">
<div class="text-center">
        <?php do{ ?>
        <a href="<?php echo $dRSln['url'] ?>" class="btn btn-<?php echo $dRSln['css'] ?> m-2" style="background:<?php echo $dRSln['color'] ?>" target="black">
            <i class="<?php echo $dRSln['icon'] ?> fa-2x"></i><br>
            <?php echo $dRSln['username'] ?>
        </a>
        <?php }while($dRSln = mysqli_fetch_assoc($RSln)); ?>
        </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm-2">
            <div class="card">
                <div class="card-header">JUEGOS</div>
                <div class="card-body">
                    <table class="table table-sm">
                    <?php do{ ?>
                    <?php $dG=detRow('tbl_games','idg',$dRSlg['idg']) ?>
                        <tr>
                            <td>
                            <img src="<?php echo $RAIZd.'games/'.$dG['img'] ?>" alt="" class="img-fluid">
                            </td>
                        </tr>
                        <?php }while($dRSlg = mysqli_fetch_assoc($RSlg)); ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-10">
            <div class="card">
                <div class="card-header">CONTENIDO</div>
                <div class="card-body"></div>
            </div>
        </div>
    </div>
</div>

<div class="bg-dark text-light pt-5 pb-5">
    <div class="container">
            123
    </div>
</div>


<nav class="navbar fixed-bottom navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">UNDERTAKER4US ® 2021</a>
  </div>
</nav>

<?php include(RAIZf.'foot.php') ?>