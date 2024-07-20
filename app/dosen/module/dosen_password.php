<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin" || $_SESSION[sebagai]=="staff")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
	{ 
		$isiDosen=mysql_fetch_array(mysql_query("select * from dosen where DosenNIK='$_GET[id]'"));
		$isiUserDosen=mysql_fetch_array(mysql_query("select * from user where username='$_GET[id]'"));
		if (!empty($isiDosen[DosenNIK]) || !empty($isiDosen[DosenNama]) || empty($isiUserDosen[email])) 
		{
			$aksi="simpan";
		} 
		
		if (!empty($isiUserDosen[username]) || !empty($isiUserDosen[nama]) || !empty($isiUserDosen[email]))
		{
	
			$aksi="update";
		} 
	
		echo"<h3>Penambahan Hak Akses Penasehat Akademik</h3>";
		//// MEMBUAT FORM //////////
		
		echo"<form name=f_menu method=post action=index.php?p=module/dosen_password_proses>";
		echo "<table>";
		echo "<tr>";
		echo"<td width=30%><b>Username </b></td>";
		echo"<td><input type=text readonly=readonly name=DosenNIK class=rounded size=10  maxlength=10 value=\"$isiDosen[DosenNIK]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>Nama </b></td>";
		echo"<td><input type=text readonly=readonly name=DosenNama class=rounded size=30 maxlength=60 value=\"$isiDosen[DosenNama]\"></td>";
		echo "</tr>";
		
		
		echo "<tr>";
		echo"<td><b>Password</b></td>";
		echo"<td><input type=text name=password class=rounded size=15 maxlength=40></td>";
		echo "</tr>";
		
		$isiUser=mysql_fetch_array(mysql_query("select * from user where username='$_GET[id]'"));
	
		echo "<tr>";
		echo"<td><b>Email</b></td>";
		echo"<td><input type=text name=email class=rounded size=30 maxlength=50 value=\"$isiDosen[DosenEmail]\"></td>";
		echo "</tr>";
	
	
		echo "<tr>";	
		echo"<td>"; 
		/// Untuk menentukan apakah membuat Dosen baru atau mengedit yang telah ada --> 
		echo"<input type=hidden name=aksi value=\"$aksi\"> ";
		/// Untuk mengambil ID record user --> 
		echo"<input type=hidden name=id value=\"$_GET[id]\"></td> ";
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
	echo "<center><blink><font color='red'><b>Anda tidak berhak mengkases halaman ini</b></font></blink></center>";
}
?>