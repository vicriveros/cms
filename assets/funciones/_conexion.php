<?php
//Configuracion de la conexion a base de datos
$bd_host      = 'localhost'; 
$bd_usuario   = 'postgres'; 
$bd_password  = 'vradmin'; 
$bd_base      = 'koala'; 

$conn_string = "host=".$bd_host." port=5432 dbname=".$bd_base." user=".$bd_usuario." password=".$bd_password;
$con = pg_connect($conn_string); 
?>
