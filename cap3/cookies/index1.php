<?php
if(!isset($_COOKIE["nombre"])){
    setcookie("nombre","Luis", time()+3600); //si no existe la creamos
}else{
    setcookie("nombre","", time()-3600); //si existe la borramos
}
echo "Mi nombre es: " .$_COOKIE["nombre"];