<?php

/**
* Este archivo es la pantalla de inicio del staff.
*
* @category   Proyecto
* @package    Sistema de Inscripciones de Natacion
* @author     Azael Alberto Alanis Garza <azaelalanis.g@gmail.com>
* @author     Andres Gerardo Cavazos Hernandez <andrscvz@gmail.com>
* @author			Eugenio Jose Martinez Ramos <eugeniomartinez92@gmail.com>
* @author			Roberto Carlos Rivera Martinez <robert_rivmtz@hotmail.com>
* @author			Hector Palomares Gonzalez <hpalomares@itesm.mx>
* @copyright  2014
* @license    The MIT License
* @version    1.0
* @link       https://github.com/azaelalanis/Sistema-de-Inscripciones-de-Natacion.git
*/
//Andrés Gutiérrez Castaño A01191581
//Jesús Navarro Marín A00813111

include "./includes/conexion.php";
include "./includes/sesionStaff.php";

$sql="select
idAlumno,
CURP,
Nombre,
Telefono,
email
from
alumno";

if(isset($_POST["buscar"])){
	$buscar = $_POST["buscar"];
	$sql = $sql . " where CURP like '%$buscar%'";
}
$result = mysql_query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Reporte</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css" media="screen">
	<script>
	function valida(curp){
		if (confirm("¿Esta seguro?") == true) {
			window.location.href = "bajaAlumno.php?curp="+curp;
		}
	}
	</script>
</head>
<body>
	<!-- Este div container es para la navigation bar de arriba -->
	<div class="navbar navbar-default">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="pantallaMenuStaff.php" class="navbar-brand">Tec Deportes</a>
		</div>
		<div class="navbar-collapse collapse navbar-responsive-collapse">
			<ul class="nav navbar-nav">
				<form class="navbar-form navbar-left" action="pantallaIndexStaff.php" method="POST">
					<input type="text" name="buscar" class="form-control col-lg-8" placeholder="Busqueda por CURP">
					<input type="submit" class="form-control col-lg-8">
				</form>
				<li><a href="pantallaRegistroAlumno.php">Agregar nuevo alumno</a></li>
				<li><a href="pantallaEliminarAlumno.php">Eliminar alumno</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="cerrarSesion.php">Cerrar sesión</a></li>
			</ul>
		</div>
	</div>

	<div class="container">

		<table class="table table-striped table-hover ">
			<thead>
				<tr>
					<th>Folio</th>
					<th>CURP</th>
					<th>Nombre</th>
					<th>Tel&eacute;fono</th>
					<th>Correo Electr&oacute;nico</th>
					<th>Inscribir a curso</th>
				</tr>
			</thead>
			<tbody>
				<?php

				while($row = mysql_fetch_array($result)){
					$idAlumno=$row['idAlumno'];
					$CURP=$row['CURP'];
					$Nombre=$row['Nombre'];
					$Telefono=$row['Telefono'];
					$email=$row['email'];



					echo "	<tr id=\"". $idAlumno ."\">
					<td>$idAlumno</td>
					<td><a href='pantallaModificaAlumno.php?curp=$CURP'>$CURP</a></td>
					<td>$Nombre</td>
					<td>$Telefono</td>
					<td>$email</td>
					<td><a href='pantallaRegistrarCurso.php?idAlumno=$idAlumno&bloque=1' class='btn btn-primary btn-xs'>Inscribir a curso</a></td>
					</tr>";
				}
				?>

			</tbody>
		</table>


		<hr>
		<footer>
			<p>&copy; ITESM 2014</p>
		</footer>
	</div>

	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootswatch.js"></script>
</body>
</html>
