<?php require('../../init.php');
include('page.fnc.php');
$body['tit']=$row['name'];
$body['bg']=$row['bg'];
?>
<?php include(RAIZf.'head.php') ?>
<?php if($view){ ?>
<?php $hitsS=updHitsH($row['idp'],'pr'); ?>
<style>
body{
    background: url(<?php echo $RAIZd."bgs/".$body['bg'] ?>) repeat center center; 
    background-attachment: fixed;
}
</style>
<!--TOP-->
<?php include('page-top.php')?>
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
                            <?php echo getBtnGame($dG) ?>
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
<?php include('page-bottom.php')?>
<?php }else{ ?>
    <div class="container pt-4 pb-4">
        <div class="alert alert-warning">
            <h4 class="text-center">No existe el usuario que buscas</h4>
        </div>
    </div>
<?php } ?>
<?php include(RAIZf.'foot.php') ?>