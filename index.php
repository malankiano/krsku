<?php

error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
{
	header("Location: utama.php");	
}
else
{

	if(isset($_POST['submit']))
	{
	//memasukkan file config.php
	include("config/config.php");
	
	   $pass=md5($_POST['password']); //enkripsi data dengan md5
	   $user=$_POST['username'];
	   //membuka koneksi dengan tabel user
	   $perintah_sql="select * from user where username='$user' and password='$pass'";
	   $hasil=@mysql_query($perintah_sql);
	   if(@mysql_num_rows($hasil)!=0)
	   {
		  $data=mysql_fetch_array($hasil);
		  //proses registrasi session
		  $_SESSION[idreg]=$data["iduser"];
		  $_SESSION[uid]=$data["username"];
		  $_SESSION[namauser]=$data["nama"];
		  $_SESSION[pwd]=$data["pasword"];
		  $_SESSION[sebagai]=$data["status"];
			 header("Location: utama.php");	
	   }
	   else
	   echo "<script language=\"JavaScript\">alert(\"Login Gagal\");</script>";
	}
	?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
		<title>Login KRS ONLINE</title>
	
		<!--- CSS --->
		<link rel="stylesheet" href="style-login.css" type="text/css" />
	
	
		<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->
	
		<!--[if (gte IE 6)&(lte IE 8)]>
			<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
			<script type="text/javascript" src="selectivizr.js"></script>
			<noscript><link rel="stylesheet" href="fallback.css" /></noscript>
		<![endif]-->
		<script language="JavaScript">
	<!-- start JavaScript
	
	var errfound = false;
	
	function error(elem, text) {
		if (errfound) return;
		window.alert(text);
		elem.select();
		elem.focus();
		errfound = true;
	}
	
	function loginCheck(f) {
	
		errfound = false;
	
		if (f.username.value == "")
			error(f.username,"Silahkan masukkan username!");
	
		if (f.password.value == "")
		   error(f.password,"Silahkan masukkan password!");
		
		return ! errfound;
	}
	
	// end JavaScript -->
	</script>
	
		</head>
	
		<body onload="document.forms[0].username.focus();">
			<div id="container">
				<form  method="post" name="f1" onSubmit="return loginCheck(this);">
					<div class="login">LOGIN</div>
					<div class="username-text">Username:</div>
					<div class="password-text">Password:</div>
					<div class="username-field">
						<input type="text" name="username" id="username"  />
					</div>
					<div class="password-field">
						<input type="password" name="password" id="password" />
					</div>
					
					<input type="submit" name="submit" value="GO" />
					<div class="username-text"><a href="lupapassword.php">Lupa Password</a></div>
				</form>
			</div>
						
				
			
			<div id="footer">
				SISTEM INFORMASI AKADEMIK POLITAMA</div>
		</body>
	</html>
<?php
}
?>