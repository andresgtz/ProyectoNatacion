<?php

/**
* Este archivo se encarga de liberar un lugar en el cupo del grupo
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

include "includes/conexion.php";

$idCurso="";
if(isset($_GET['idCurso'])){
	$idCurso=$_GET['idCurso'];
}

$sql="update curso set
AlumnosInscritos=AlumnosInscritos-1
where idCurso = $idCurso";

$result = mysql_query($sql);

?>
