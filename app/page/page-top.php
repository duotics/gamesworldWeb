<div class="container mb-2">
    <div class="p-4 text-center">
        <div class="text-center mb-5 mt-2" id="<?php echo md5($row['idp']) ?>">
            <img src="<?php echo $RAIZd.'logos/'.$row['logo'] ?>" alt="<?php echo $row['name'] ?>" style="" class="<?php echo $row['logo-css'] ?> cont-logo-main img-fluid animate__animated animate__heartBeat">
        </div>
        <div class="text-center mb-2">
        <a href="<?php echo $RAIZ ?>creators" class="btn btn-secondary">Creador Contenido</a>
        <span class="btn btn-light"><?php echo $row['name'] ?> <a href="#"><span class="ml-2 flag-icon flag-icon-<?php echo $dC_flag ?>"></span></a></span>
        </div>
    </div>
</div>