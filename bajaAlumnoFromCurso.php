<!DOCTYPE html>
<?php
require_once("includes/conexion.php");

$idAlumno="";
if(isset($_GET['idAlumno'])){
    $idAlumno=$_GET['idAlumno'];
}
$idCurso="";
if(isset($_GET['idCurso'])){
    $idCurso=$_GET['idCurso'];
}

$sql= "update curso set AlumnosInscritos=AlumnosInscritos-1 where idCurso=$idCurso";
$result = mysql_query($sql);

$sql = "DELETE FROM inscripcion WHERE IdAlumno = '$idAlumno'";
$result = mysql_query($sql);

echo "<script language=\"javascript\">
					window.location.href = \"pantallaRegistrarCurso.php?idAlumno=$idAlumno\"
				</script>";

// A partir de aqui hay que eliminar las relaciones con las tablas de cursos
// Y desinscribir al alumno del curso y con esto aumentar un espacio en el cupo del curso
?>