<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
	{ 
		$isiMahasiswa=mysql_fetch_array(mysql_query("select * from mahasiswa where MHSID='$_GET[id]'"));
		if (!empty($isiMahasiswa[MHSID])) 
		{
			$aksi="update";
		} 
		else 
		{
		$aksi="simpan";
		}
		echo"<h3>Penambahan Mahasiswa</h3>";
		//// MEMBUAT FORM //////////
		
		echo"<form name=f_menu method=post action=index.php?p=module/mhs_proses>";
		echo "<table>";
		echo "<tr>";
		echo"<td width=30%><b>NIM </b></td>";
		echo"<td><input type=text name=MHSID class=rounded size=10  maxlength=10 value=\"$isiMahasiswa[MHSID]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>Nama </b></td>";
		echo"<td><input type=text name=MHSNAMA class=rounded size=30 maxlength=40 value=\"$isiMahasiswa[MHSNAMA]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>J K</b></td>";
		echo"<td><input type=text name=MHSJKEL class=rounded size=1 maxlength=1 value=\"$isiMahasiswa[MHSJKEL]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>TMP LAHIR</b></td>";
		echo"<td><input type=text name=MHSTMLHR class=rounded size=30 maxlength=30 value=\"$isiMahasiswa[MHSTMLHR]\">TGL LAHIR: <input type=text name=MHSTGLHR class=rounded size=12 maxlength=12 value=\"$isiMahasiswa[MHSTGLHR]\"></td>";
		echo "</tr>";
		
	
		echo "<tr>";
		echo"<td><b>WARGA NEGARA</b></td>";
		echo"<td><input type=text name=MHSWARGA class=rounded size=30 maxlength=30 value=\"$isiMahasiswa[MHSWARGA]\"></td>";
		echo "</tr>";
	
		echo "<tr>";
		echo"<td><b>AGAMA</b></td>";
		echo"<td><input type=text name=MHSAGAMA class=rounded size=30 maxlength=30 value=\"$isiMahasiswa[MHSAGAMA]\"></td>";
		echo "</tr>";	
		
		echo "<tr>";
		echo"<td><b>ALAMAT</b></td>";
		echo"<td><input type=text name=MHSALMT class=rounded size=50 maxlength=50 value=\"$isiMahasiswa[MHSALMT]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>KOTA</b></td>";
		echo"<td><input type=text name=MHSKOTA class=rounded size=30 maxlength=30 value=\"$isiMahasiswa[MHSKOTA]\"></td>";
		echo "</tr>";
	
		echo "<tr>";
		echo"<td><b>TELPON</b></td>";
		echo"<td><input type=text name=MHSNOTEL class=rounded size=15 maxlength=15 value=\"$isiMahasiswa[MHSNOTEL]\"> KODE POS: <input type=text name=MHSKODEP class=rounded size=6 maxlength=6 value=\"$isiMahasiswa[MHSKODEP]\"></td>";
		echo "</tr>";
		
	
		echo "<tr>";
		echo"<td><b>TH LULUS</b></td>";
		echo"<td><input type=text name=MHSLULUS class=rounded size=4 maxlength=4 value=\"$isiMahasiswa[MHSLULUS]\">		 SEKOLAH ASAL <input type=text name=MHSASALP class=rounded size=40 maxlength=50 value=\"$isiMahasiswa[MHSASALP]\"></td>";
		
		
		echo "</tr>";
		echo "<tr>";
		echo"<td><b>ORTU</b></td>";
		echo"<td><input type=text name=MHSORTUN class=rounded size=30 maxlength=30 value=\"$isiMahasiswa[MHSORTUN]\"></td>";
		echo "</tr>";
		
		
		echo "<tr>";
		echo"<td><b>ALAMAT ORTU</b></td>";
		echo"<td><input type=text name=MHSORALM class=rounded size=40 maxlength=40 value=\"$isiMahasiswa[MHSORALM]\"></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td><b>KOTA ORTU</b></td>";
		echo"<td><input type=text name=MHSORKOTA class=rounded size=30 maxlength=30 value=\"$isiMahasiswa[MHSORKOTA]\"> KODE POS <input type=text name=MHSORKODEP class=rounded size=6 maxlength=6 value=\"$isiMahasiswa[MHSORKODEP]\">	</td>";
		echo "</tr>";
	
		
		echo "<tr>";
		echo"<td><b>PEKERJAAN</b></td>";
		echo"<td><input type=text name=MHSORPEG class=rounded size=4 maxlength=4 value=\"$isiMahasiswa[MHSORPEG]\">		</td>";
		
		
		echo "<tr>";
		echo"<td><b>P A</b></td>";
		echo"<td><input type=text name=MHSPA class=rounded size=10 maxlength=10 value=\"$isiMahasiswa[MHSPA]\"></td>";
		echo "<tr>";
		echo"<td><b>Jurusan</b></td><td>";
	
		//<!-- Menampilkan pilihan Jurusan --> 
						echo "<SELECT NAME='JurusanId' id='JurusanId'>
						  <OPTION value= '$isiMahasiswa[JurusanId]' SELECTED>";
						
						////menampilkan nama prgrma studi  daari tabel jurusan berdasar jurusanId dari tabel  mahasiswa
						$isiJurusan=mysql_fetch_array(mysql_query("select * from jurusan where JurusanId='$isiMahasiswa[JurusanId]' "));
						echo "$isiJurusan[JurusanNama]";
						////menampilkan nama Jurusan seluruhnya 
						$perintahJurusan="select * from jurusan";
						$hasilJurusan=mysql_query($perintahJurusan);
	
						while($rowJurusan=mysql_fetch_array($hasilJurusan))
						{
							echo("<OPTION value='$rowJurusan[JurusanId]'>$rowJurusan[JurusanNama]");
						}
						echo(" </OPTION></select></td></tr>");
	
		echo "<tr>";	
		echo"<td>"; 
		/// Untuk menentukan apakah membuat Dosen baru atau mengedit yang telah ada --> 
		echo"<input type=hidden name=aksi value=\"$aksi\"> ";
		/// Untuk mengambil ID record Dosen --> 
		echo"<input type=hidden name=id value=\"$isiMahasiswa[MHSID]\"></td> ";
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