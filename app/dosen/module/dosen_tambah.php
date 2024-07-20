<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
	{ 
		$isidosen=mysql_fetch_array(mysql_query("select * from dosen where DosenId='$_GET[id]'"));
		if (!empty($isidosen[DosenId])) 
		{
			$aksi="update";
		} 
		else 
		{
		$aksi="simpan";
		}
		echo"<h3>Penambahan Dosen Baru</h3>";
		//// MEMBUAT FORM //////////
		
		echo"<form name=f_menu method=post action=index.php?p=module/dosen_proses>";
		echo "<table>";
		echo "<tr>";
		echo"<td width=30%><b>NIK </b></td>";
		echo"<td><input type=text name=DosenNIK class=rounded size=10  maxlength=15 value=\"$isidosen[DosenNIK]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>Nama Dosen</b></td>";
		echo"<td><input type=text name=DosenNama class=rounded size=30 maxlength=40 value=\"$isidosen[DosenNama]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>Alamat</b></td>";
		echo"<td><input type=text name=DosenAlamat class=rounded size=50 maxlength=50 value=\"$isidosen[DosenAlamat]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>Kota</b></td>";
		echo"<td><input type=text name=DosenKota class=rounded size=30 maxlength=30 value=\"$isidosen[DosenKota]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>Telp</b></td>";
		echo"<td><input type=text name=DosenTelp class=rounded size=12 maxlength=12 value=\"$isidosen[DosenTelp]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>Hanphone</b></td>";
		echo"<td><input type=text name=DosenHp class=rounded size=15 maxlength=15 value=\"$isidosen[DosenHp]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>Email</b></td>";
		echo"<td><input type=text name=DosenEmail class=rounded size=40 maxlength=50 value=\"$isidosen[DosenEmail]\"></td>";
		echo "</tr>";
		
		echo "<tr>";	
		echo"<td>"; 
		/// Untuk menentukan apakah membuat Dosen baru atau mengedit yang telah ada --> 
		echo"<input type=hidden name=aksi value=\"$aksi\"> ";
		/// Untuk mengambil ID record Dosen --> 
		echo"<input type=hidden name=id value=\"$isidosen[DosenId]\"></td> ";
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