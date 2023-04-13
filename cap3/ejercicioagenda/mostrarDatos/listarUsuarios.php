<?php
require_once(dirname(__FILE__)."/../usuario/Usuario.php");
require_once(dirname(__FILE__)."/../SelectorPersistente.php");
if(session_status() !== PHP_SESSION_ACTIVE){ 
    session_start();  
} 

if(!isset($_SESSION["id"])){
    header("location:login.php");
}
$usuarios = SelectorPersistente::getUsuarioPersistenteClass()::listar();
//$usuarios = SelectorPersistente::getUsuarioPersistente()->listar();
/*
if($usuarios[$_SESSION["id"]]->getRol() == 1){
var_dump($usuarios);
}
*/
include("../header.php");
?>


<!--
    <select class="menus" onchange="location = this.value;">
        <option>Eventos</option>
        <option value="agenda.php">Listado Eventos</option>
        <option value="../añadir/eventos.php">Crear evento</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option value="#">Usuarios</option>
        <option value="../añadir/nuevoUsuario.php">Añadir Usuario</option>
    </select>
    
    <button class="cerrar" onclick="window.location.href = '../cerrarSesion.php';">Cerrar sesión</button>
-->   
        <?php 
        if($usuarios[$_SESSION["id"]]->getRol() == 1){
            
    ?>
        <section class="intro">
  <div class="bg-image h-100" style="background-image: url(https://mdbootstrap.com/img/Photos/new-templates/glassmorphism-article/img7.jpg);">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
        <h1>LISTA DE USUARIOS</h1>
          <div class="col-12">
            <div class="card mask-custom">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-borderless text-white mb-0">
                    <thead>
                      <tr>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php    
                    foreach ($usuarios as $id => $usuario) {
                ?>
                        <tr>
                            <td><?= $usuario->getNombre() ?></td>
                            <td><?= $usuario->getCorreo() ?></td>
                            <td><?= $usuario->getRol() ?></td>
                            <td><a  href="../modificar/modifUsuarios.php?id=<?= $usuario->getId_usuario() ?>"><button type="button" class="btn btn-warning">Modificar usuario</button></a></td>
                            <td><a  href="../eliminar/eliminarUsuarios.php?id=<?= $usuario->getId_usuario() ?>" onclick="javascript:return confirm('Estás seguro de eliminar este usuario?')"><button type="button" class="btn btn-danger">Eliminar usuario</button></a></td>
                        </tr>
                <?php 
                    }
                ?>
            </table>
        
        <?php
        }else{
        ?>
        <h2>No tienes permiso para ver los usuarios</h2>
        <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>