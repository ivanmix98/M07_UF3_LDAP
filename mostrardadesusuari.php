
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
    $r = ldap_search($ldapconn, "dc=fjeclot, dc=net","cn=".$user);
    
		if($r) {
			$info = ldap_get_entries($ldapconn, $r);
			
			if($info['count']==0){
			
			header('Location: mostrardadesusuarierror.php'); 
		}else{
			for ($i=0; $i<$info["count"]; $i++)
			{
				echo "uid: ".$info[$i]["uid"][0]. "<br />";
				echo "cn: ".$info[$i]["cn"][0]. "<br />";
				echo "sn: ".$info[$i]["sn"][0]. "<br />";
				echo "given name: ".$info[$i]["givenname"][0]. "<br />";
				echo "title: ".$info[$i]["title"][0]. "<br />";
				echo "telephoneNumber: ".$info[$i]["telephonenumber"][0]. "<br />";
				echo "mobile: ".$info[$i]["mobile"][0]. "<br />";
				echo "postaladdress: ".$info[$i]["postaladdress"][0]. "<br />";
				echo "gidnumber: ".$info[$i]["gidnumber"][0]. "<br />";
				echo "uidnumber: ".$info[$i]["uidnumber"][0]. "<br />";
				echo "homedirectory: ".$info[$i]["homedirectory"][0]. "<br />";
				echo "description: ".$info[$i]["description"][0]. "<br />";
				echo "<a href='gestioadmin.php'>Tornar enrere</a>";
			} 
		}
			
			
			
			
				
		}
		
		 
			
   
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
    <title>Mostrar usuari</title>
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
			  <td colspan=2><input class="btn btn-dark" type=submit value="Mostrar"></td>
		   </tr>
		</table>
	</form>

       </div>
  </body>
</html>






