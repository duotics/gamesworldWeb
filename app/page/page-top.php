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