<?php require('../../init.php');
require('profile.fnc.php');
require(RAIZf.'head.php');
require(RAIZf.'nav.php');
?>
<script src="<?php echo $RAIZv ?>nnnick/chartjs/dist/Chart.min.js"></script>
<div class="pt-4">
<div class="container">
<?php if($view){ ?>

    <div class="row">
        <div class="col-sm-3">
            <div class="card bg-primary text-light">
                <h4 class="card-header">Datos Generales Streamer</h4>
                <div class="card-body bg-light">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2"><img src="<?php echo $RAIZd?>logos/<?php echo $dP['logo'] ?>" alt="<?php echo $dP['name'] ?>" class="img-fluid"></td>
                    </tr>
                    <tr>
                        <td>Creador Contenido</td>
                        <td><a href="<?php echo $RAIZ.$dP['url'] ?>" target="blank"><?php echo $dP['name'] ?></a></td>
                    </tr>
                    <tr>
                        <td>Afiliado desde</td>
                        <td><?php echo $dP['datec'] ?></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><?php echo $dP['rname'] ?></td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <h4 class="card-header">Estadisticas Visitas</h4>
                <div class="card-body"><canvas id="myChart" width="400" height="400"></canvas></div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="card">
                <h4 class="card-header">Estadisticas Juegos <span class="badge bg-secondary"><?php echo getFecActFormat("Y-m") ?></span></h4>
                <div class="card-body"><canvas id="myChartG"></canvas></div>
            </div>
        </div>
    </div>
<script type="text/javascript">
$.getJSON( RAIZ+"app/profile/data/profile-hits.php", { idp: <?php echo $id?>, tip: "pr" } )
  .done(function( json ) {
    console.log( "JSON Data: " + json.hits);
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: json.date,
        datasets: [{
            label: 'Visitas Mensuales',
            backgroundColor: 'rgb(13, 110, 253)',
            borderColor: 'rgb(33, 37, 41)',
            data: json.hits
        }]
    },
    // Configuration options go here
    options: {}
    });
  })
  .fail(function( jqxhr, textStatus, error ) {
    var err = textStatus + ", " + error;
    console.log( "Request Failed: " + err );
});

///////////////////// GAMES /////////////////////////

$.getJSON( RAIZ+"app/profile/data/game-hits.php", { idp: <?php echo $id?>, tip: "pr" } )
  .done(function( json ) {
    //console.log( "JSON Data: " + json.date);
    var ctx = document.getElementById('myChartG').getContext('2d');
    var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: json.name,
        datasets: [{
            label: 'Juegos Populares',
            backgroundColor: 'rgb(25, 250, 110)',
            borderColor: 'rgb(33, 37, 41)',
            data: json.hits
        }]
    },
    // Configuration options go here
    options: {}
    });
  })
  .fail(function( jqxhr, textStatus, error ) {
    var err = textStatus + ", " + error;
    console.log( "Request Failed: " + err );
});
</script>
<?php }else{ ?>
    <div class="alert alert-info">
        <h4>Perfil no encontrado</h4>
    </div>
<?php } ?>
</div>
</div>
<?php require(RAIZf.'foot.php'); ?>