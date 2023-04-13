<?php
require_once(dirname(__FILE__)."/../evento/Evento.php");
require_once(dirname(__FILE__)."/../SelectorPersistente.php");
//require_once(dirname(__FILE__)."/../login.php");
if(session_status() !== PHP_SESSION_ACTIVE){ 
    session_start();  
} 
if(!isset($_SESSION["id"])){
    header("location:login.php");
}
//var_dump($eventos);
include("../header.php");
?>

<!--
    <select class="menus" onchange="location = this.value;">
        <option value="#">Eventos</option>
        <option value="../añadir/eventos.php">Crear Eventos</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option value="#">Opciones</option>
        <option value="../mostrarDatos/listarUsuarios.php">Listar Usuarios</option>
        <option value="../añadir/nuevoUsuario.php">Añadir Usuario</option>
    </select>
    
-->
  <section class="intro">
  
    <div class="bg-image h-100" style="background-image: url(https://mdbootstrap.com/img/Photos/new-templates/glassmorphism-article/img7.jpg);">
    
      <div class="mask d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
          <h1>AGENDA DE EVENTOS</h1>
            <div class="col-12">
              <div class="card mask-custom">
                <div class="card-body">
                  <div class="table-responsive">
                    
                    <table class="table table-borderless text-white mb-0">
                      <thead>
                        <tr>
                          <th scope="col">NOMBRE</th>
                          <th scope="col">FECHA DE INICIO</th>
                          <th scope="col">FECHA DE FIN</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          //echo($_SESSION["sistemaGuardado"]);
                                  $eventos = SelectorPersistente::getEventoPersistenteClass()::listar();
                                  //$eventos = SelectorPersistente::getEventoPersistente()->listar();
                                  
                                  if($eventos!= null){
                                  foreach ($eventos as $id => $evento) {
                          //for($i=0; $i< count($eventos); $i++){
                                  ?>
                          <tr>
                              <th><?= $evento->getNombre() ?></th>
                              <td><?= $evento->getFecha_inicio()->format("d-m-Y H:i ") ?></td>
                              <td><?= $evento->getFecha_fin()->format("d-m-Y H:i ") ?></td>
                              <td><a  href="../modificar/modifEvento.php?id=<?= $evento->getId_evento() ?>"><button type="button" class="btn btn-warning">Modificar evento</button></a></td>
                              <td><a  href="../eliminar/eliminarEvento.php?id=<?= $evento->getId_evento() ?>" onclick="javascript:return confirm('Estás seguro de eliminar el evento?')"><button type="button" class="btn btn-danger">Eliminar evento</button></a></td>
                          </tr>
                          <?php }}?>
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