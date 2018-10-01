<?php
include('_conexion.php');
include('bd.php');


if ($_POST['accion']=='insert') {
    $tabla = $_POST['tabla']; 
    unset  ($_POST['accion']);
    unset  ($_POST['tabla']);
    unset  ($_POST['campo_id']);
    bd_insert ($tabla);
    echo '
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="material-icons">close</i>
    </button>
    <span>
      <b> Registro Actualizado!</b> </span>
  </div>
    ';
}


if (@$_POST['accion']=='update') {
    $tabla = $_POST['tabla'];
    $campo_id = $_POST['campo_id'];
    unset  ($_POST['accion']);
    unset  ($_POST['tabla']);
    unset  ($_POST['campo_id']);
    bd_update ($tabla,$campo_id,$_POST[$campo_id]);
    echo '
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="material-icons">close</i>
    </button>
    <span>
      <b> Registro Actualizado!</b> </span>
  </div>
    ';
    
   }

?>