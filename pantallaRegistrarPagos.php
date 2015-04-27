<?php

/**
* Este archivo es la pantalla que despliega los pagos de algun alumno.
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
*///Andrés Gutiérrez Castaño A01191581
//Jesús Navarro Marín A00813111


	include "./includes/conexion.php";
	session_start();

	if(!isset($_SESSION['nomina'])){
		echo "<script language=\"javascript\">
					alert(\"Inicie sesion primero\");
					window.location.href = \"index.html\"
				</script>";
	}

	$sql="select
        a.idAlumno as folio,
        a.Nombre,
        a.Telefono,
        a.email,
        a.CURP,
        i.idCurso,
        i.pagada,
        c.Nombre as curso,
        c.Precio

      from
        inscripcion i inner join alumno a inner join curso c
                            on i.idAlumno = a.idAlumno and i.idCurso = c.IdCurso
       WHERE i.pagada=0 ";

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
  <link rel="stylesheet" href="../assets/css/bootswatch.min.css">
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
<?php
	if($_SESSION['tipo']){
		echo "<a href=\"pantallaMenuStaff.php\" class=\"navbar-brand\">Tec Deportes</a>";
	} else{
		echo "<a href=\"pantallaIndexAdmin.php\" class=\"navbar-brand\">Tec Deportes</a>";
	}
?>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
      <ul class="nav navbar-nav">
        <form class="navbar-form navbar-left" action="pantallaPagos.php" method="POST">
          <input type="text" name="buscar" class="form-control col-lg-8" placeholder="Busqueda">
		  <input type="submit" class="form-control col-lg-8">
        </form>

      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
      </ul>
    </div>
  </div>

	<div class="container">
		<div class="jumbotron">
			<h1>Registrar Pagos</h1>
			<p>Da click en el botn pagó de los alumnos que han realizado sus pagos.</p>
		</div>

  <div class="container">
    <table class="table table-striped table-hover ">
      <thead>
        <tr>
          <th>Folio Alumno</th>
          <th>CURP</th>
          <th>Nombre</th>
          <th>Tel&eacute;fono</th>
		      <th>Correo Electr&oacute;nico</th>
          <th>Curso</th>
          <th>Precio</th>
          <th>¿Pagó?</th>

          </tr>
        </thead>
        <tbody>
<?php

		while($row = mysql_fetch_array($result)){
			$idAlumno=$row['folio'];
			$CURP=$row['CURP'];
			$Nombre=$row['Nombre'];
			$Telefono=$row['Telefono'];
			$email=$row['email'];
      $precio=$row['Precio'];
      $curso=$row['curso'];
      $IdCurso=$row['idCurso'];



			echo "	<tr id=\"". $idAlumno ."\">
						<td>$idAlumno</td>
						<td><a href='pantallaDetallePago.php?idAlumno=$idAlumno'>$CURP</a></td>
						<td>$Nombre</td>
						<td>$Telefono</td>
						<td>$email</td>
            <td>$curso</td>
            <td>$precio</td>
            <form action='registrarPagos.php' method='POST'>
          <input type='hidden' name='IdCurso' value='$IdCurso'/>
          <input type='hidden' name='idAlumno' value='$idAlumno'/>
          <td><input type='submit' class='btn btn-primary btn-xs' value='Ya pagó'></td>
          </form>
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
