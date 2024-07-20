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
	
	   $username = $_POST['username'];

function randomPassword()
{
// function untuk membuat password random 6 digit karakter

$digit = 6;
$karakter = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";

srand((double)microtime()*1000000);
$i = 0;
$pass = "";
while ($i <= $digit-1)
{
$num = rand() % 32;
$tmp = substr($karakter,$num,1);
$pass = $pass.$tmp;
$i++;
}
return $pass;
}

// membuat password baru secara random -> memanggil function randomPassword
$newPassword = randomPassword();

// perlu dibuat sebarang pengacak
$pengacak  = "NDJS3289JSKS190JISJI";

// mengenkripsi password dengan md5() dan pengacak
$newPasswordEnkrip = md5($pengacak . md5($newPassword) . $pengacak);

// mencari alamat email si user
$query = "SELECT * FROM user WHERE username = '$username'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$alamatEmail = $data['email'];

// title atau subject email
$title  = "Password baru";

// isi pesan email disertai password
$pesan  = "Username Anda : ".$username.". \nPassword Anda yang baru adalah ".$newPassword;

// header email berisi alamat pengirim
$header = "From: poltek@politama.ac.id.id";

// mengirim email
$kirimEmail = mail($alamatEmail, $title, $pesan, $header);

// cek status pengiriman email
	if ($kirimEmail) {
    // update password baru ke database (jika pengiriman email sukses)
	$passwordbaru = md5($newPassword);
    $query = "UPDATE user SET password = '$passwordbaru' WHERE username = '$_POST[username]'";
    $hasil = mysql_query($query);
    if ($hasil) 
	{
	echo "Password baru telah direset dan sudah dikirim ke email Anda<br> Silahkan Anda cek email Anda.<br>Bila tidak ditemukan di Inbox anda buka folder Spam<br> <a href='index.php'>Klik Disni untuk Login !</b>";
    }
	else 
	{
	echo "Pengiriman password baru ke email gagal";
	}
	}
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
	
		
		return ! errfound;
	}
	
	// end JavaScript -->
	</script>
	
		</head>
	
		<body onload="document.forms[0].username.focus();">
			<div id="container">
				<form  method="post" name="f1"  onSubmit="return loginCheck(this);">
					<div class="login">LOGIN</div>
					<div class="username-text">Masukkan Username Anda:</div>
					<div class="password-text">&nbsp;</div>
					<div class="username-field">
						<input type="text" name="username" id="username"  />
					</div>
					
					<input type="submit" name="submit" value="GO" />
				</form>
			</div>
						
				
			
			<div id="footer">
				SISTEM INFORMASI AKADEMIK POLITAMA</div>
		</body>
	</html>
<?php
}
?>