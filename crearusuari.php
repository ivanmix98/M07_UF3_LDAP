<?php

if(isset($_POST['uid']) && ($_POST['nom']) && ($_POST['cognom']) && ($_POST['givenName']) && ($_POST['title']) && ($_POST['telephoneNumber']) && ($_POST['mobile']) && ($_POST['postalAddress']) && ($_POST['gidNumber']) && ($_POST['uidNumber']) && ($_POST['description'])){
$ldaphost = "ldap://172.20.22.126";
$ldappass = "fjeclot";
$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 


$ldapconn = ldap_connect($ldaphost) or die(header('Location: loginadminerror.php'));

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {

$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

if($ldapbind) {
    // prepare data
    
    $info["objectclass"][0] = 'top';
    $info["objectclass"][1] = 'person';
    $info["objectclass"][2] = 'organizationalPerson';
    $info["objectclass"][3] = 'inetOrgPerson';
    $info["objectclass"][4] = 'posixAccount';
    $info["objectclass"][5] = 'shadowAccount';
    $info["uid"] = trim($_POST['uid']);
    $info["cn"] = $_POST['nom']." ".$_POST['cognom'];
    $info["sn"] = trim($_POST['cognom']);
	
	$info["givenname"] = trim($_POST['givenName']);
	$info["title"] = trim($_POST['title']);
	$info["telephonenumber"] = trim($_POST['telephoneNumber']);
	$info["mobile"] = trim($_POST['mobile']);
	$info["postaladdress"] = trim($_POST['postalAddress']);
	$info["loginshell"] = '/bin/bash';
	$info["gidnumber"] = trim($_POST['gidNumber']);
	$info["uidnumber"] = trim($_POST['uidNumber']);
	$info["homedirectory"] = "/home/".trim($_POST['uid'])."/";
	$info["description"] = trim($_POST['description']);

	$dn = "cn=".trim($_POST['nom'])." ".trim($_POST['cognom']).",dc=fjeclot,dc=net";
    // add data to directory
    $r = ldap_add($ldapconn, "$dn", $info);
    
		if($r) {
			header('Location: crearusuariexit.php');
			
		}
		
		else {
			header('Location: crearusuarierror.php'); 
			//ldap_get_option($ldapconn, LDAP_OPT_DIAGNOSTIC_MESSAGE,$err);
			//echo"Error al crear el usuario:". $err;
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
    <title>Creació usuari</title>
	</head>
 <body class="p-3 mb-2 bg-danger text-white">
	 <div class="container" style="text-align:center;margin-top:50px;">
    <form action='' method=post>
		<table class="table" cellspacing=3 cellpadding=3>
		   <tr>
			  <td>uid: </td>
			  <td><input class="form-control" type=text name=uid ></td>
		   </tr>
		   <tr>
			  <td>nom: </td>
			  <td><input class="form-control" type=text name=nom ></td>
		   </tr>
		   <tr>
			  <td>cognom: </td>
			  <td><input class="form-control" type=text name=cognom ></td>
		   </tr>
		   <tr>
			  <td>givenName: </td>
			  <td><input class="form-control" type=text name=givenName ></td>
		   </tr>
		   <tr>
			  <td>title: </td>
			  <td><input class="form-control" type=text name=title ></td>
		   </tr>
		   <tr>
			  <td>telephoneNumber: </td>
			  <td><input class="form-control"type=text name=telephoneNumber ></td>
		   </tr>
		   <tr>
			  <td>mobile: </td>
			  <td><input  class="form-control"type=text name=mobile ></td>
		   </tr>
		   <tr>
			  <td>postalAddress: </td>
			  <td><input class="form-control" type=text name=postalAddress ></td>
		   </tr>
		   <tr>
			  <td>gidNumber: </td>
			  <td><input class="form-control" type=text name=gidNumber ></td>
		   </tr>
		   <tr>
			  <td>uidNumber: </td>
			  <td><input class="form-control" type=text name=uidNumber ></td>
		   </tr>
		    <tr>
			  <td>description: </td>
			  <td><input class="form-control" type=text name=description ></td>
		   </tr>
		   <tr>
			  <td colspan=2><input class="btn btn-dark" type=submit value="Crear"></td>
		   </tr>
		</table>
	</form>
     </div>
  </body>
</html>





