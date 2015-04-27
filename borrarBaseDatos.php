<?php

/**
* Este archivo se encarga de borrar la base de datos cada que inicia un nuevo verano de inscripciones.
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
include "./includes/sesionAdmin.php";

$sql="delete from inscripcion";

$result = mysql_query($sql);

echo "	<script language=\"javascript\">
window.location.href = \"pantallaIndexAdmin.php\"
</script>";
?>
