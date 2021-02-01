<?php require('../../init.php');
include('creator.fnc.php');
include('creator.css.php');
$body['tit']="Creadores de Contenido";
include(RAIZf . 'head.php');
include(RAIZf . 'nav.php'); ?>
<div class="bg-animate">
    <div class="container">
        <div class="pt-4 pb-4">
            <h1 class="mb-4">Creadores de Contenido</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-2 text-center">
                            <a href="<?php echo $RAIZ ?>creators/" class="btn btn-outline-secondary">Mostrar todos</a>
                        </div>
                        <div class="col-sm-4">
                            <?php genSelect('lc', $RSlp, $idc, 'form-control', NULL, 'listPaises', NULL, TRUE, 'all', "Todos"); ?>
                        </div>
                        <div class="col-sm-4">
                            <?php genSelect('lg', $RSlg, $idg, 'form-control', NULL, 'listGames', NULL, TRUE, 'all', "Todos"); ?>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control form-control-sm" id="selSort">
                                <option value="top" <?php if ($ids == 'top') echo 'selected' ?>>Mas populares</option>
                                <option value="brand" <?php if ($ids == 'min') echo 'selected' ?>>Menos populares</option>
                                <option value="az" <?php if ($ids == 'az') echo 'selected' ?>>A-Z</option>
                                <option value="za" <?php if ($ids == 'za') echo 'selected' ?>>Z-A</option>
                                <option value="new" <?php if ($ids == 'new') echo 'selected' ?>>Nuevos perfiles</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white">
    <div class="container">
        <div class="container p-4">
            <?php if ($tRSst > 0) { ?>
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4">
                    <?php do { ?>
                        <div class="col">
                            <a href="<?php echo $RAIZ . $dRSst['url'] ?>" style="text-decoration:none" class="text-dark">
                                <div class="card h-100 cont-view-streamer">
                                    <img src="<?php echo $RAIZd . 'logos/' . $dRSst['logo'] ?>" class="card-img-top img-streamer" alt="<?php echo $dRSst['name'] ?>">
                                    <div class="card-body text-center">
                                        <p class="card-text">
                                            <span class="ml-2 flag-icon flag-icon-<?php echo $dRSst['pais'] ?>"></span>
                                            <?php echo $dRSst['name'] ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } while ($dRSst = mysqli_fetch_assoc($RSst)); ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-info">
                    <h4>Sin Resultados</h4>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('#listGames').select2();
        $('#listPaises').select2();
        $('#listPaises').change(function() {
            var url = RAIZ + 'creators/' + $('#listPaises').val() + "/" + $('#listGames').val() + '/' + $('#selSort').val();
            location.href = url;
        });
        $('#listGames').change(function() {
            var url = RAIZ + 'creators/' + $('#listPaises').val() + "/" + $('#listGames').val() + '/' + $('#selSort').val();
            location.href = url;
        });
    });
</script>
<?php require(RAIZf . 'foot.php'); ?>