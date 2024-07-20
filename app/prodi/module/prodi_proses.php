<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']) )
	{ 
		// file ini digunakan untuk memproses Jurusan 
		///////////PROSES SIMPAN DATA//////////
		//jika $aksi=simpan
		if($_POST['aksi']=='simpan') 
		{
			//jika kategori tidak diisi 
			if(!empty($_POST[JurusanNama]) || !empty($_POST[kajur]) || !empty($_POST[kodejur]))
			{
				$simpan=mysql_query("insert into jurusan values(' ', '$_POST[JurusanNama]', '$_POST[kajur]', '$_POST[kodejur]')") or die (mysql_error());
				
				// setelah proses penyimpana selesai .. user langsung diarahkan ke daftar jurusan dengan script dibawah ini
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
		if($_POST['aksi']=='update') 
		{
			$update=mysql_query("update jurusan set kodejur='$_POST[kodejur]',  JurusanNama='$_POST[JurusanNama]',  kajur='$_POST[kajur]' where JurusanId='$_POST[id]'");
	
		// setelah proses penyimpana selesai .. user langsung diarahkan ke daftar jurusan dengan script dibawah ini
		echo "<META HTTP-EQUIV=Refresh CONTENT=\"0.1; URL=index.php\">";
		echo "<img src='img/ajax-loader.gif'>";
		}
	
		///////////PROSES  DELETE / HAPUS DATA//////////
		//aksi untuk menghapus jurusan
		if($_GET['aksi']=='hapus') 
		{
			$hapus=mysql_query("delete from jurusan where JurusanId='$_GET[id]'");
			echo "<h2> Jurusan telah sukses dihapus</h2>";
			echo "<img src='img/ajax-loader.gif'>";
			
			// alihkan user ke daftar menu setelah menghapus halaman
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"1; URL=index.php\">";
		}
	
		///////////PROSES KONFIRMASI DELETE / HAPUS DATA//////////
		if($_GET['aksi']=='konfirmasi') 
		{
			//ambil data Jurusan yang akan dihapus
			$isijurusan=mysql_fetch_array(mysql_query("select * from jurusan where JurusanId='$_GET[id]'"));
	
			echo "<h3>Konfirmasi Penghapusan jurusan</h3>";
			echo "Apakah anda yakin akan menghapus Jurusan <b>$isijurusan[JurusanNama]</b> ?<br><br>";
			echo "<a href=index.php?p=module/prodi_proses&aksi=hapus&id=$_GET[id]>Ya</a> ";
			echo "| ";
			echo "<a href=\"javascript:history.back()\">Tidak</a>";
		}
	
	
	}
	else
	{ 
	// jika gagal login
	header("Location: ../index.php");
	}
}
else
{
	echo "Anda tidak berhak mengkases halaman ini";
}
?>