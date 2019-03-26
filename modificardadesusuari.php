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
    
    $user=trim($_POST['cn']);
    $gid=trim($_POST['gidNumber']);
    $uid=trim($_POST['uidNumber']);
    
    if($uid != NULL && $gid != NULL  ){
	$info["gidnumber"] = $gid;
	$info["uidnumber"] = $uid;
	
	$dn = "cn=".$user.",dc=fjeclot,dc=net";

	$r = ldap_modify($ldapconn, "$dn", $info);
}

 if($uid == NULL && $gid != NULL ){
	$info["gidnumber"] = $gid;
	
	
	$dn = "cn=".$user.",dc=fjeclot,dc=net";

	$r = ldap_modify($ldapconn, "$dn", $info);
}

 if($gid == NULL && $uid != NULL ){
	$info["uidnumber"] = $uid;
	
	
	$dn = "cn=".$user.",dc=fjeclot,dc=net";

	$r = ldap_modify($ldapconn, "$dn", $info);
}
	if($r) {
			echo "usuari modificat";
			}
		
		else {
			echo "usuari no modificat";
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
    <title>Modificar usuari</title>
	</head>
 <body class="p-3 mb-2 bg-danger text-white">
	 <div class="container" style="text-align:center;margin-top:50px;">
    <form action="" method=post>
		<table class="table" cellspacing=3 cellpadding=3>
		   <tr>
			  <td>Nom i cognom: </td>
			  <td><input class="form-control" type=text name=cn size=16 maxlength=15></td>
		   </tr>
		   <tr>
			  <td>uidnumber: </td>
			  <td><input class="form-control" type=text name=uidNumber size=16 maxlength=15></td>
		   </tr>
		   <tr>
			  <td>gidnumber: </td>
			  <td><input class="form-control" type=text name=gidNumber size=16 maxlength=15></td>
		   </tr>
		   <tr>
			  <td colspan=2><input class="btn btn-dark"  type=submit value="Modificar"></td>
		   </tr>
		</table>
	</form>
       </div>
  </body>
</html>
