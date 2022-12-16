<?php
$dsn = "mysql:dbname=docker_demo;host=docker-mysql";
$usuario ="root";
$password = "root123";
$bd = new PDO($dsn, $usuario, $password);

$stm = $bd->prepare("SELECT * from usuario");
$stm->execute();
$usuarios = $stm->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Usuarios</title>
    <style>
        td {
            border: 1px solid;
        }
        a {
            text-decoration:none;
        }
    </style>
</head>
<body>
    <table>
        
        <?php
                foreach ($usuarios as $valor) {
            ?>      <tr>
                        <td><?php echo $valor["idusuario"]?></td>
                        <td><?php echo $valor["nombre"]?></td>
                        <td><?php echo $valor["apellidos"]?></td>
                        <td><?php echo $valor["email"]?></td>
                        <td><a  href="modificar.php?id=<?= $valor["idusuario"]?>">Modificar usuario</a></td>
                        <td><a  href="delete.php?id=<?= $valor["idusuario"]?>">Eliminar usuario</a></td>
                    </tr>
                <?php
                }
            ?>
        
    </table>

    <form action="privado.php">
        <input type="submit" value="Registrar nuevo usuario" />
    </form>
</body>
</html>