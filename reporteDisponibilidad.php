<?php

/**
* Este archivo te descarga en excel el reporte de disponibilidad de cursos y los espacios que tiene disponibles cada curso.
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

// connection with the database
include "./includes/conexion.php";

// require the PHPExcel file
require './Classes/PHPExcel.php';

// simple query

$query = "SELECT Nombre, bloque, Cupo - AlumnosInscritos, DiasDeLaSemana, EdadMinima, EdadMaxima, Precio FROM curso WHERE Cupo - AlumnosInscritos > 0 ORDER BY bloque";
$headings = array('Nombre del Curso', 'Bloque','Espacios Disponibles', 'Dias de la Semana', 'Edad Minima', 'Edad Maxima', 'Precio');

if ($result = mysql_query($query) or die(mysql_error())) {
  // Create a new PHPExcel object
  $objPHPExcel = new PHPExcel();
  $objPHPExcel->getActiveSheet()->setTitle('Lista de cursos disponibles');

  $rowNumber = 1;
  $col = 'A';
  foreach($headings as $heading) {
    $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading);
    $col++;
  }

  // Loop through the result set
  $rowNumber = 2;
  while ($row = mysql_fetch_row($result)) {
    $col = 'A';
    foreach($row as $cell) {
      $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$cell);
      $col++;
    }
    $rowNumber++;
  }

  // Freeze pane so that the heading line won't scroll
  $objPHPExcel->getActiveSheet()->freezePane('A2');

  // Save as an Excel BIFF (xls) file
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="reporteDisponibilidad.xls"');
  header('Cache-Control: max-age=0');

  $objWriter->save('php://output');
  exit();
}
echo 'A problem has occurred... no data retrieved from the database';
?>
