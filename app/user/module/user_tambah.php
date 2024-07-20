<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin")
{
if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
{ 
	$isiuser=mysql_fetch_array(mysql_query("select * from user where iduser='$_GET[id]'"));
	if (!empty($isiuser[iduser])) 
	{
		$aksi="update";
		$pesan="<font size='1.2em' color='red'>Kosongkan password jika tidak akan merubah password</font>";
	} 
	else 
	{
	$aksi="simpan";
	$pesan=" ";
	}
	echo"<h3>Tambah / Edit Staff Pengelola</h3>";
	//// MEMBUAT FORM //////////
	
	echo"<form name=f_menu method=post action=index.php?p=module/user_proses>";
	echo "<table>";
	echo "<tr>";
	echo"<td width=30%><b>Username </b></td>";
	echo"<td><input type=text name=username class=rounded size=10  maxlength=10 value=\"$isiuser[username]\"></td>";
	echo "</tr>";
	
	echo "<tr>";
	echo"<td><b>Nama</b></td>";
	echo"<td><input type=text name=nama class=rounded size=30 maxlength=60 value=\"$isiuser[nama]\"></td>";
	echo "</tr>";
	
	echo "<tr>";
  	echo"<td><b>Password</b></td>";
	echo"<td><input type=text name=password class=rounded size=10 maxlength=40> $pesan</td>";
  	echo "</tr>";
	
	echo "<tr>";
	echo"<td><b>Email</b></td>";
	echo"<td><input type=text name=email class=rounded size=30 maxlength=50 value=\"$isiuser[email]\"></td>";
  	echo "</tr>";
	
	
	echo "<tr>";	
	echo"<td>"; 
	/// Untuk menentukan apakah membuat Dosen baru atau mengedit yang telah ada --> 
	echo"<input type=hidden name=aksi value=\"$aksi\"> ";
	/// Untuk mengambil ID record Dosen --> 
	echo"<input type=hidden name=id value=\"$isiuser[iduser]\"></td> ";
	echo "</tr>";
	
	echo "<tr>";	
	echo "<td>";
	echo"<input type=submit class=rounded name=proses value=Simpan></td>";
	echo "</tr>";
	echo "</table>";	
	echo"</form>";
		
} 
// jika gagal login
else 
{ 
	header("Location: ../index.php");
}
}
else
{
	echo "Anda tidak berhak mengkases halaman ini";
}
?>