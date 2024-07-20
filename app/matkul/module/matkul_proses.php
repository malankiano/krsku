<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']) || $_SESSION[sebagai]=="admin" )
{ 
	// file ini digunakan untuk memproses 'Mata Kuliah' 

	///////////PROSES SIMPAN DATA//////////
	//jika $aksi=simpan
	if($_POST[aksi]=='simpan') 
	{
		//jika kategori tidak diisi 
		if(!empty($_POST[MKid]) || !empty($_POST[MKNama]))
		{
			$simpan=mysql_query("insert into matakuliah values('$_POST[MKid]', '$_POST[MKNama]', '$_POST[MKSem]', '$_POST[MKsksT]', '$_POST[MKsksP]')") or die (mysql_error());
			
			// setelah proses penyimpanan selesai .. user langsung diarahkan ke daftar 'Mata Kuliah' dengan script dibawah ini
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"0.1; URL=index.php\">";
			echo "<img src='img/ajax-loader.gif'>";
		} 
		else 
		{
			echo "<h3>Konfirmasi Penyimpanan data</h3>";
			echo "<font color=red>";
			echo "<h4>Data Kurang Lengkap  ...";
			echo "|"; 
			echo "<a href=\"javascript:history.back()\">kembali</a></h4>";
			echo"</font>";
		}
	}
	
	///////////PROSES UPDATE DATA//////////
	//jika $aksi=update
	if($_POST[aksi]=='update') 
	{
		$update=mysql_query("update matakuliah set MKid='$_POST[MKid]',  MKNama='$_POST[MKNama]',  MKSem='$_POST[MKSem]', MKsksT='$_POST[MKsksT]',  MKsksP='$_POST[MKsksP]' where MKid='$_POST[id]'");

	// setelah proses penyimpana selesai .. user langsung diarahkan ke daftar 'Mata Kuliah' dengan script dibawah ini
	echo "<META HTTP-EQUIV=Refresh CONTENT=\"0.1; URL=index.php\">";
	echo "<img src='img/ajax-loader.gif'>";
	}

	///////////PROSES  DELETE / HAPUS DATA//////////
	//aksi untuk menghapus 'Mata Kuliah'
	if($_GET[aksi]=='hapus') 
	{
		$hapus=mysql_query("delete from matakuliah where MKid='$_GET[id]'");
		echo "<h2> Mata Kuliah telah sukses dihapus</h2>";
		echo "<img src='img/ajax-loader.gif'>";
		
		// alihkan user ke daftar menu setelah menghapus halaman
		echo "<META HTTP-EQUIV=Refresh CONTENT=\"1; URL=index.php\">";
	}

	///////////PROSES KONFIRMASI DELETE / HAPUS DATA//////////
	if($_GET[aksi]=='konfirmasi') 
	{
		//ambil data 'Mata Kuliah' yang akan dihapus
		$isimatkul=mysql_fetch_array(mysql_query("select * from matakuliah where MKid='$_GET[id]'  "));

		echo "<h3>Konfirmasi Penghapusan 'Mata Kuliah'</h3>";
		echo "Apakah anda yakin akan menghapus Mata Kuliah <b>$isimatkul[MKNama]</b> ?<br><br>";
		echo "<a href=index.php?p=module/matkul_proses&aksi=hapus&id=$_GET[id]>Ya</a> ";
		echo "| ";
		echo "<a href=\"javascript:history.back()\">Tidak</a>";
	}


}
else
{ 
// jika gagal login
header("Location: ../index.php");
}
?>