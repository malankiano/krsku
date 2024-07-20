<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']) || $_SESSION[sebagai]=="admin" )
{ 
	$isimatkul=mysql_fetch_array(mysql_query("select * from matakuliah where MKid='$_GET[id]'"));
	if (!empty($isimatkul[MKid])) 
	{
		$aksi="update";
	} 
	else 
	{
	$aksi="simpan";
	}
	echo"<h3>Penambahan Mata Kuliah Baru</h3>";
	//// MEMBUAT FORM //////////
	
	echo"<form name=f_menu method=post action=index.php?p=module/matkul_proses>";
	echo "<table>";
	echo "<tr>";
	echo"<td width=30%><b>KODE </b></td>";
	echo"<td><input type=text name=MKid class=rounded size=10  maxlength=20 value=\"$isimatkul[MKid]\"></td>";
	echo "</tr>";
	
	echo "<tr>";
	echo"<td><b>Nama MK</b></td>";
	echo"<td><input type=text name=MKNama class=rounded size=30 maxlength=50 value=\"$isimatkul[MKNama]\"></td>";
	echo "</tr>";
	
	echo "<tr>";
  	echo"<td><b>Semester</b></td>";
	echo"<td><input type=text name=MKSem class=rounded size=1 maxlength=1 value=\"$isimatkul[MKSem]\"></td>";
  	echo "</tr>";
	
	echo "<tr>";
	echo"<td><b>SKS Teori</b></td>";
	echo"<td><input type=text name=MKsksT class=rounded size=1 maxlength=1 value=\"$isimatkul[MKsksT]\"></td>";
  	echo "</tr>";
	
	echo "<tr>";
	echo"<td><b>SKS Praktek</b></td>";
	echo"<td><input type=text name=MKsksP class=rounded size=12 maxlength=12 value=\"$isimatkul[MKsksP]\"></td>";
  	echo "</tr>";	

	echo "<tr>";	
	echo"<td>"; 
	/// Untuk menentukan apakah membuat Mata Kuliah baru atau mengedit yang telah ada --> 
	echo"<input type=hidden name=aksi value=\"$aksi\"> ";
	/// Untuk mengambil ID record Mata Kuliah --> 
	echo"<input type=hidden name=id value=\"$isimatkul[MKid]\"></td> ";
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
?>