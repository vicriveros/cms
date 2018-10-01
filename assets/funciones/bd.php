<?php
function bd_update ($tabla,$campo_id,$id) {
	global $con;
	$n2 = count($_POST);
	$tags2 = array_keys($_POST);
	$valores2 = array_values($_POST);

	for($i=0;$i<$n2;$i++){
	$grabar.=$tags2[$i]."='".$valores2[$i]."'";
	if (($i+1)!=$n2) {$grabar.=', ';}
	}
    pg_query("SET NAMES utf8");
	pg_query($con, "UPDATE $tabla SET $grabar WHERE $campo_id='$id'")
	or die("Problemas en update:".pg_last_error());
	return true;
}

function bd_insert ($tabla) {
	global $con;

	$n2 = count($_POST);
	$tags2 = array_keys($_POST);
	$valores2 = array_values($_POST);

	for($i=0;$i<$n2;$i++){
	$names.=$tags2[$i];
	$grabar.="'".$valores2[$i]."'";
	if (($i+1)!=$n2) {$grabar.=', '; $names.=', ';}
	}
    pg_query("SET NAMES utf8");
	pg_query($con, "INSERT INTO $tabla ($names) VALUES ($grabar)")
	or die("Problemas en funcion bd_insert:".pg_last_error());
	return true;
}

function bd_delete ($tabla,$campo_id,$id) {
	global $con;

	$campos = pg_query ($con, "DELETE FROM $tabla WHERE $campo_id='$id' ") or die ("Problemas en $-campos:".pg_last_error());
}

//CONSULTAS A BD
function select ($tabla,$id,$label,$val) {
	global $con;
	pg_query("SET NAMES utf8");
	$campos = pg_query ($con, "SELECT * from $tabla ") or die ("Problemas en $-campos:".pg_last_error());

	 while($d=pg_fetch_array($campos)){
		 if ($d[$id] == $val) {
		 		$return.='<option value="'.$d[$id].'" selected>'.$d[$label].'</option>';
		 }else{
		 $return.='<option value="'.$d[$id].'">'.$d[$label].'</option>';
	 	 }
	 }
return $return;
}

function label ($tabla,$campo_id,$id,$label) {
	global $con;
	pg_query("SET NAMES utf8");
	$campos = pg_query ($con, "SELECT * from $tabla where $campo_id=$id") or die ("Problemas en $-campos:".pg_last_error());
	$d=pg_fetch_array($campos);
	$return=$d[$label];
	return $return;
}

function bd_select ($tabla,$campo_id,$id) {
	global $con, $bd;
	pg_query("SET NAMES utf8");
	$campos = pg_query ($con, "SELECT * from $tabla ") or die ("Problemas en $-campos:".pg_last_error());
	$c=0;
	$n_cp = pg_num_fields($campos) - 1;

	while($n_cp >= $c)
	{
		$rec_cp[$c]=pg_field_name($campos, $c);
		$c++;
	}

	pg_query("SET NAMES utf8");
	$sql="SELECT * FROM ".$tabla." where ".$campo_id."=".$id;
	$rec_db=pg_query($con, $sql) or die ("Problemas en insert:".pg_last_error());

	 while($d=pg_fetch_array($rec_db)){
		 $i=0;
		while($i<count($rec_cp)){
			$bdval[$rec_cp[$i]] = $d[$rec_cp[$i]];
			$bdnom[$rec_cp[$i]] = $rec_cp[$i];
			$i++;
		}
	 }
return $bdval;
}


?>
