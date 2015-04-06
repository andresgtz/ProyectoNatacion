<!DOCTYPE html>
<?php


include "./includes/conexion.php";
session_start();

	if(!isset($_SESSION['nomina'])){
		echo "<script language=\"javascript\">
					alert(\"Inicie sesion primero\");
					window.location.href = \"index.html\"
				</script>";
	}

$idCurso= isset($_POST["IdCurso"]) ? $_POST['IdCurso'] : -1;
$idAlumno= isset($_POST["idAlumno"]) ? $_POST['idAlumno'] : -1;


if($idCurso!= -1 && $idAlumno!=-1){

  $sql= "UPDATE inscripcion set pagada='1' WHERE idAlumno=$idAlumno and idCurso=$idCurso";
  $result = mysql_query($sql);
}

	echo "<script language=\"javascript\">
					window.location.href = \"pantallaRegistrarPagos.php\"
				</script>";


?>