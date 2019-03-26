<?php

if(isset($_POST['cn'])){
$ldaphost = "ldap://172.20.22.126";
$ldappass = "fjeclot";
$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 


$ldapconn = ldap_connect($ldaphost) or die(header('Location: loginadminerror.php'));

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {

$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

if($ldapbind) {
    
    $r = ldap_delete($ldapconn, "cn=".trim($_POST['cn']).", dc=fjeclot, dc=net");
    
		if($r) {
			header('Location: esborrarusuariexit.php');
		}
		
		else {
			header('Location: esborrarusuarierror.php'); 
			}
     ldap_close($ldapconn);
} else {
	header('Location: loginadminerror.php'); 	
}

}

}
?>


<html>
	<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Borrar usuari</title>
	</head>
<body class="p-3 mb-2 bg-danger text-white">
		<div class="container" style="text-align:center;margin-top:150px;">
    <form action=esborrarusuari.php method=post>
		<table class="table" cellspacing=3 cellpadding=3>
		   <tr>
			  <td>Nom i cognom: </td>
			  <td><input class="form-control" type=text name=cn size=16 maxlength=15></td>
		   </tr>
		   <tr>
			  <td colspan=2><input class="btn btn-dark" type=submit value="Esborrar"></td>
		   </tr>
		</table>
	</form>
</div>
	  </body>
</html>






