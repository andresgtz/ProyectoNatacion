<!DOCTYPE html>
<?php 
//Andrés Gutiérrez Castaño A01191581
//Jesús Navarro Marín A00813111

	require_once("includes/conexion.php"); 
	$Nomina="";
	if(isset($_GET['nomina'])){
		$Nomina=$_GET['nomina'];
	}
	
	$sql = "DELETE FROM usuario WHERE Nomina = '$Nomina'";

	$result = mysql_query($sql);
	//header('Location: pantallaAltasBajasCambiosStaff.php');
	echo "<script language=\"javascript\">
					window.location.href = \"pantallaAltasBajasCambiosStaff.php\"
				</script>";

?>