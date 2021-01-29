<?php require('../../init.php');
$body['tit']='Red Social de creadores de contenido';
require(RAIZf.'head.php');
require(RAIZf.'nav.php') ?>
<style>
    .home-content{
        background-image: url('<?php echo $RAIZa ?>img/bg-home-01.jpg');
        background-position: center center;
        padding: 30px 0 30px 0;
        background-attachment: fixed;
    }
    .home-content h1{
        text-shadow: 3px 3px #0d6efd, -4px -4px #000;
        font-weight: bold;
    }
    .home-content h2{
        text-decoration: inherit;
        --animate-delay: 0.9s;
    }
    .home-content h3{
        text-decoration: inherit;
    }
    .home-content-btn{
        padding: 30px 0 30px 0;
    }
    .home-content-info{
        padding: 30px 0 30px 0;
    }
</style>
<div class="home-content">
<div class="container">
    <div class="text-center pt-5 pb-5">
        <h1 class="display-1 text-light text-bold mt-4 mb-4 pt-5 pb-1">
            <span class="animate__animated animate__flipInX">GamesWorld.live</span>
        </h1>
        <h2 class="mt-4 mb-4">
            <span class="badge bg-primary animate__animated animate__flipInX animate__delay-1s">Red Social de Creadores de Contenido</span>
        </h2>
        <h3 class="mt-4 mb-4 pb-5 text-secondary">
            <span class="animate__animated animate__bounceIn animate__delay-2s"><i class="fas fa-wrench"></i> En Construcción</span>
        </h3>
    </div>
</div>
</div>
<div class="home-content-btn">
<div class="container">
    <div class="pt-5 pb-5 text-center animate__animated animate__bounceIn animate__delay-3s">
        <a href="<?php echo $RAIZ?>creators/" class="btn btn-primary btn-lg">Creadores de Contenido <span class="badge bg-secondary">20</span></a>
        <a href="<?php echo $RAIZ?>games/" class="btn btn-info btn-lg">Videojuegos <span class="badge bg-secondary">5</span></a>
        <a href="<?php echo $RAIZ?>networks/" class="btn btn-light btn-lg">Redes Sociales <span class="badge bg-secondary">7</span></a>
    </div>
</div>
</div>
<div class="home-content-info bg-primary text-light">
<div class="container pt-5 pb-5 text-center animate__animated animate__bounceIn animate__delay-3s">
    <p class="lead">Para contribuir con el creador 
        <a href="https://www.paypal.me/duotics" target="blank" class="btn btn-info">
            PayPal <i class="fab fa-paypal fa-lg"></i>
        </a>
    </p>
    <h4>Mas información <span class="badge bg-secondary text-light">info@duotics.com</span></h4>
</div>
</div>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">DUOTICS ® 2021</a>
  </div>
</nav>
<?php require(RAIZf.'foot.php') ?>