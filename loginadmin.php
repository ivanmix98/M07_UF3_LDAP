<?php
session_start(); 
if(isset($_POST['password']))
{

$ldaphost = "ldap://172.20.22.126";
$ldappass = trim($_POST['password']);
$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 

$ldapconn = ldap_connect($ldaphost) or die(header('Location: loginadminerror.php'));

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {

    // realizando la autenticación
    
    $ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

    // verificación del enlace
    if ($ldapbind) {
        echo header('Location: gestioadmin.php');
    } else {
		header('Location: loginadminerror.php'); 
    }

}
}
?>


<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>P&agrave;gina d'indentificaci&oacute; de l'usuari del qual es volen mostrar dades</title>
	</head>
	<body class="p-3 mb-2 bg-danger text-white">
		<div class="container" style="text-align:center;margin-top:150px;">
	<form action=loginadmin.php method=post>
	<h1 style="text-align:center">USUARI DINS DEL DOMINI fjeclot.net DEL QUAL ES VOLEN MOSTRAR DADES</h1><br>	
	Si us plau, identificat amb el teu nom d'usuari, unitat organitzativa i contrasenya:
		<table class="table" cellspacing=3 cellpadding=3 align="center">
		   
		   <tr>
			  <td>Contrasenya de l'administrador LDAP: </td>
			  <td ><input class="form-control" type=password name=password size=16 maxlength=15></td>
		   </tr>
		   <tr>
			  <td colspan=2 align="center"><input class="btn btn-dark" type=submit value="Comprovar login admin"></td>
			 
		   </tr>
		</table>
	</form>
	</div>
	  </body>
</html>

