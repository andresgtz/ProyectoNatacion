
<?php

/**
* Este archivo es la pantalla de registrar cursos
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

$idAlumno= isset($_GET["idAlumno"]) ? $_GET['idAlumno'] : -1;
$bloque= isset($_GET["bloque"]) ? $_GET['bloque'] : -1;
if($bloque == 1){
    $b1 = "danger";
    $b2 = "primary";
    $b3 = "primary";
    $b4 = "primary";
}else if($bloque == 2){
    $b1 = "primary";
    $b2 = "danger";
    $b3 = "primary";
    $b4 = "primary";
}else if($bloque == 3){
    $b1 = "primary";
    $b2 = "primary";
    $b3 = "danger";
    $b4 = "primary";
}else if($bloque == 4){
    $b1 = "primary";
    $b2 = "primary";
    $b3 = "primary";
    $b4 = "danger";
}else {
    $b1 = "primary";
    $b2 = "primary";
    $b3 = "primary";
    $b4 = "primary";
}
$query="select FechaNacimiento from alumno where idAlumno='$idAlumno'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$FechaNacimiento=$row['FechaNacimiento'];
$now = new DateTime();
$fecha = new DateTime($FechaNacimiento);
$diff = abs($now->format("Y") - $fecha->format("Y"));
$sql="select
        idCurso,
        Nombre,
        Cupo,
        EdadMinima,
        AlumnosInscritos,
        DiasDeLaSemana,
		HoraInicio,
        CanMaestros,
        Precio
      from
        curso  where bloque=$bloque and edadminima<= $diff and edadmaxima>= $diff and idCurso not in (
          SELECT ins.IDCURSO FROM inscripcion ins WHERE ins.idAlumno = $idAlumno AND ins.IDCURSO = IDCURSO)";

  $result = mysql_query($sql);

$sql2="select
        idCurso,
        bloque,
        Nombre,
        Cupo,
        EdadMinima,
        AlumnosInscritos,
        DiasDeLaSemana,
		HoraInicio,
        CanMaestros,
        Precio
      from
        curso  where idCurso in (
          SELECT ins.IDCURSO FROM inscripcion ins WHERE ins.idAlumno = $idAlumno AND ins.IDCURSO = IDCURSO)";

$result2 = mysql_query($sql2);

$sql3="select
        idAlumno,
        Nombre,
        CURP,
        NombrePadre,
        Telefono,
        email
      from
        alumno  where idAlumno=$idAlumno";

$result3 = mysql_query($sql3);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Registrar alumnos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <script language="javascript">
        function valida(idAlumno, idCurso){

            if (confirm("¿Esta seguro?") == true) {
                window.location.href = "bajaAlumnoFromCurso.php?idAlumno="+idAlumno+"&idCurso="+idCurso;
            }
        }
    </script>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script>
		$(document).ready(function(){
			  $('.tags').mouseover(function(){
				var x = this.id;
				  $.ajax({
				  url: 'difCupo.php',
				  data: ({'id': x}),
				  success: function(data) {
					document.getElementById("c"+x).innerHTML = data;
				  }
			  });
			});
		  });

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
      <a href="pantallaIndexStaff.php" class="navbar-brand">Tec Deportes</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">

      <ul class="nav navbar-nav navbar-right">
        <li><a href="cerrarSesion.php">Cerrar sesión</a></li>
      </ul>
    </div>
  </div>

  <div class="container">
    <div align="center">
      <a href="pantallaRegistrarCurso.php?idAlumno=<?php echo $idAlumno;?>&bloque=1"><button id='bloque 1' class='btn btn-<?php echo $b1;?> btn-xs' >Curso 1</button></a>
      <a href="pantallaRegistrarCurso.php?idAlumno=<?php echo $idAlumno;?>&bloque=2"><button id='bloque 2' class='btn btn-<?php echo $b2;?> btn-xs' >Curso 2</button></a>
      <a href="pantallaRegistrarCurso.php?idAlumno=<?php echo $idAlumno;?>&bloque=3"><button id='bloque 3' class='btn btn-<?php echo $b3;?> btn-xs' >Curso 3</button></a>
      <a href="pantallaRegistrarCurso.php?idAlumno=<?php echo $idAlumno;?>&bloque=4"><button id='bloque 4' class='btn btn-<?php echo $b4;?> btn-xs' >Curso 4</button></a>
    </div>


      <table class="table table-striped table-hover ">
          <thead>
          <p> DATOS DEL ALUMNO </p>
          <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>CURP</th>
              <th>Nombre del Padre</th>
              <th>Telefono</th>
              <th>email</th>
          </tr>
          </thead>
          <tbody>


          <?php
          while($row = mysql_fetch_array($result3)){
              $idAlumno = $row['idAlumno'];
              $Nombre = $row['Nombre'];
              $CURP = $row['CURP'];
              $NombrePadre = $row['NombrePadre'];
              $Telefono = $row['Telefono'];
              $email= $row['email'];

              echo "  <tr class='tags' id=$idAlumno>
          <td>$idAlumno</td>
          <td>$Nombre</td>
          <td>$CURP</td>
          <td>$NombrePadre</td>
          <td>$Telefono</td>
			<td>$email</td>
          </tr>";
          }
          ?>


    <table class="table table-striped table-hover ">
        <thead>
        <p> CURSOS DISPONIBLES </p>
        <tr>
            <th>#</th>
            <th>Curso</th>
            <th>Num. Maestros</th>
            <th>Edad M&iacute;nima</th>
            <th>D&iacute;as de la semana</th>
            <th>Hora de inicio</th>
            <th>Precio</th>
            <th>Cupo</th>
            <th>Cupo Actual</th>
            <th>Inscribir a curso</th>
        </tr>
        </thead>
        <tbody>


        <?php

        while($row = mysql_fetch_array($result)){
          $idCurso = $row['idCurso'];
          $Nombre = $row['Nombre'];
          $Cupo = $row['Cupo'];
          $AlumnosInscritos = $row['AlumnosInscritos']; //Restar Cupo - AlumnosInscritos nos dara el cupo actual
          $CupoActual = $Cupo - $AlumnosInscritos;
          $NumMaestros = $row['CanMaestros'];
          $EdadMinima = $row['EdadMinima'];
          $DiasDeLaSemana = $row['DiasDeLaSemana'];
          $Precio = $row['Precio'];
	  $HoraInicio= $row['HoraInicio'];

      echo "  <tr class='tags' id=$idCurso>
          <td>$idCurso</td>
          <td>$Nombre</td>
          <td>$NumMaestros</td>
          <td>$EdadMinima</td>
          <td>$DiasDeLaSemana</td>
			<td>$HoraInicio</td>
          <td>$Precio</td>
			<td>$Cupo</td>
            <td id=c$idCurso> $CupoActual</td>
          <form action='inscripcionAlumno.php' method='POST'>
          <input type='hidden' name='idCurso' value='$idCurso'/>
          <input type='hidden' name='idAlumno' value='$idAlumno'/>
          <td><input type='submit' class='btn btn-primary btn-xs' value='Inscribir a curso'></td>
          </form>
          </tr>";
        }
        ?>


      </tbody>

    </table>

      <table class="table table-striped table-hover ">
          <thead>
          <p> CURSOS INSCRITOS </p>
          <tr>
              <th>#</th>
              <th>Periodo</th>
              <th>Curso</th>
              <th>Num. Maestros</th>
              <th>Edad M&iacute;nima</th>
              <th>D&iacute;as de la semana</th>
              <th>Hora de inicio</th>
              <th>Precio</th>
              <th>Cupo</th>
              <th>Cupo Actual</th>
              <th>Dar de Baja</th>
          </tr>
          </thead>
          <tbody>

          <?php

          while($row = mysql_fetch_array($result2)){
              $idCurso = $row['idCurso'];
              $bloque = $row['bloque'];
              $Nombre = $row['Nombre'];
              $Cupo = $row['Cupo'];
              $AlumnosInscritos = $row['AlumnosInscritos']; //Restar Cupo - AlumnosInscritos nos dara el cupo actual
              $CupoActual = $Cupo - $AlumnosInscritos;
              $NumMaestros = $row['CanMaestros'];
              $EdadMinima = $row['EdadMinima'];
              $DiasDeLaSemana = $row['DiasDeLaSemana'];
              $Precio = $row['Precio'];
              $HoraInicio= $row['HoraInicio'];

              echo "  <tr class='tags' id=$idCurso>
          <td>$idCurso</td>
           <td>$bloque</td>
          <td>$Nombre</td>
          <td>$NumMaestros</td>
          <td>$EdadMinima</td>
          <td>$DiasDeLaSemana</td>
			<td>$HoraInicio</td>
          <td>$Precio</td>
			<td>$Cupo</td>
            <td id=c$idCurso> $CupoActual</td>
          <form action='bajaAlumnoFromCurso.php' method='POST'>
          <input type='hidden' name='idCurso' value='$idCurso'/>
          <input type='hidden' name='idAlumno' value='$idAlumno'/>
          <td><a onclick=\"valida($idAlumno, $idCurso)\" class=\"btn btn-danger btn-xs\">Dar de Baja</a></td>
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
</body>
</html>
