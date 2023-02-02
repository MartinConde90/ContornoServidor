<?php
require_once("eventos.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css.css" media="screen" />
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>id_evento</td>
            <td>nombre</td>
            <td>fecha_inicio</td>
            <td>fecha_fin</td>
            <td>id_usuario</td>
        </tr>
        <tr>
            <td><?= $_SESSION["id_evento"] ?></td>
            <td><?= $_SESSION["nombreevento"] ?></td>
            <td><?= $_SESSION["fechainicio"]->format("d-m-Y T H:i ") ?></td>
            <td><?= $_SESSION["fechafin"]->format("d-m-Y T H:i ") ?></td>
            <td><?= $_SESSION["usuario"]["idUsuario"] ?></td>
        </tr>
    </table>
</body>
</html>