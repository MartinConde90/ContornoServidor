<?php
require_once("Evento.php");
require_once("SelectorPersistente.php");
if(session_status() !== PHP_SESSION_ACTIVE){ 
    session_start();  
} 
if(!isset($_SESSION["id"])){
    header("location:index.php");
}
//var_dump($eventos);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
        crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" 
        crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" 
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" 
        crossorigin="anonymous">
    </script>
</head>
<body>
    
    <select class="menus" onchange="location = this.value;">
        <option>Eventos</option>
        <option value="eventos.php">Crear Eventos</option>
    </select>
    <select class="menus" onchange="location = this.value;">
        <option value="#">Opciones</option>
        <option value="listarUsuarios.php">Listar Usuarios</option>
        <option value="nuevoUsuario.php">Añadir Usuario</option>
    </select>
    <button class="cerrar" onclick="window.location.href = 'cerrarSesion.php';">Cerrar sesión</button>

    


    <section class="intro">
  <div class="bg-image h-100" style="background-image: url(https://mdbootstrap.com/img/Photos/new-templates/glassmorphism-article/img7.jpg);">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
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
                            <td><a  href="modifEvento.php?id=<?= $evento->getId_evento() ?>">Modificar evento</a></td>
                            <td><a  href="eliminarEvento.php?id=<?= $evento->getId_evento() ?>" onclick="javascript:return confirm('Estás seguro de eliminar el evento?')">Eliminar evento</a></td>
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