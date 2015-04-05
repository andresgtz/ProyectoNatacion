<!DOCTYPE html>
<?php 
	require_once("includes/conexion.php"); 
	$CURP="";
	if(isset($_GET['curp'])){
		$CURP=$_GET['curp'];
	}
	$idAlumno="";
	if(isset($_GET['idAlumno'])){
		$idAlumno=$_GET['idAlumno'];
	}
	$sql = "DELETE FROM alumno WHERE Curp = '$CURP'";
	$result = mysql_query($sql);

    $sql= "update curso set AlumnosInscritos=AlumnosInscritos-1 where idCurso IN (SELECT IdCurso FROM inscripcion WHERE IdAlumno=$idAlumno)";
    $result = mysql_query($sql);

    $sql = "DELETE FROM inscripcion WHERE IdAlumno = '$idAlumno'";
    $result = mysql_query($sql);

	echo "<script language=\"javascript\">
					window.location.href = \"pantallaIndexStaff.php\"
				</script>";

	// A partir de aqui hay que eliminar las relaciones con las tablas de cursos
	// Y desinscribir al alumno del curso y con esto aumentar un espacio en el cupo del curso
?>