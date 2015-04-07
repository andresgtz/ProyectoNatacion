
<!DOCTYPE html>
<?php
include "./includes/sesionStaff.php";

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

require_once('PHPMailer/class.phpmailer.php');
require 'PHPMailer/PHPMailerAutoload.php';

define('GUSER', 'tecnatacion@gmail.com'); // GMail username
define('GPWD', 'nataciontec1'); // GMail password

function smtpmailer($to, $from, $from_name, $subject, $body) {
    global $error;
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = GUSER;
    $mail->Password = GPWD;
    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send()) {
        $error = 'Mail error: '.$mail->ErrorInfo;
        return false;
    } else {
        $error = 'Message sent!';
        return true;
    }
}

$sql= "select Nombre,email from alumno where idAlumno=$idAlumno";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
    $NombreAlumno = $row['Nombre'];
    $email = $row['email'];
}

$sql= "select Nombre,DiasDeLaSemana,HoraInicio from curso where idCurso=$idCurso";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
    $NombreCurso = $row['Nombre'];
    $DiasDeLaSemana = $row['DiasDeLaSemana'];
    $HoraInicio = $row['HoraInicio'];
}
$body = "El motivo de este correo es para notificarle la baja de su hijo $NombreAlumno del curso $NombreCurso en los dias $DiasDeLaSemana a la hora $HoraInicio.";
smtpmailer($email, 'tecnatacion@gmail.com', 'Natacion Tec', 'CONFIRMACION DE REGISTRO CURSO DE NATACION', $body);


echo "<script language=\"javascript\">
					window.location.href = \"pantallaRegistrarCurso.php?idAlumno=$idAlumno\"
				</script>";

// A partir de aqui hay que eliminar las relaciones con las tablas de cursos
// Y desinscribir al alumno del curso y con esto aumentar un espacio en el cupo del curso
?>