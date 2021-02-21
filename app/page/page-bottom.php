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
                                <td><span class="ml-2 flag-icon flag-icon-<?php echo $dC_flag ?>"></span></td>
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