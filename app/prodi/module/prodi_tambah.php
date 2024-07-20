<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin")
{
if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']) )
{ 

		$isiprodi=mysql_fetch_array(mysql_query("select * from jurusan where JurusanId='$_GET[id]'"));
		if (!empty($isiprodi['JurusanId'])) 
		{
			$aksi="update";
		} 
		else 
		{
			$aksi="simpan";
		}

	echo"<h3>Penambahan Jurusan Baru</h3>";
	//// MEMBUAT FORM //////////
	
	echo"<form name=f_menu method=post action=index.php?p=module/prodi_proses>";
	echo "<table>";
	echo "<tr>";
	echo"<td width=30%><b>Kode </b></td>";
	echo"<td><input type=text name=kodejur class=rounded size=10  maxlength=20 value=\"$isiprodi[kodejur]\"></td>";
	echo "</tr>";
	echo "<tr>";
	echo"<td><b>Nama Jurusan</b></td>";
	echo"<td><input type=text name=JurusanNama class=rounded size=30 maxlength=40 value=\"$isiprodi[JurusanNama]\"></td>";
	echo "</tr>";
	echo"<td><b>Ketua Jurusan</b></td>";
	echo"<td><input type=text onKeyUp='suggest(this.value);' onBlur='fill2();' id='kajur' name='kajur' class=rounded size=30 value=\"$isiprodi[kajur]\">	
	<input type=text disabled='disabled' onBlur='fil1();' id='DosenNama' name='DosenNama' class=rounded size=30 >	
	<div class='suggestionsBox' id='suggestions' style='display: none;'> <img src='arrow.png' style='position: relative; top: -12px; left: 30px;' alt='upArrow' />
				   <div class='suggestionList' id='suggestionsList'> &nbsp; </div>
	</div></td>";
  	echo "</tr>";
	echo "<tr>";	
	echo"<td>"; 
	/// Untuk menentukan apakah membuat Jurusan baru atau mengedit yang telah ada --> 
	echo"<input type=hidden name=aksi value=\"$aksi\"> ";
	/// Untuk mengambil ID record Jurusan --> 
	echo"<input type=hidden name=id value=\"$isiprodi[JurusanId]\"></td> ";
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