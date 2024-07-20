<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
//session dengan sebagai 'admiin' dimaksudkan sebagai administrator
if($_SESSION[sebagai]=="admin")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']) )
	{ 
		// file ini digunakan untuk memproses Dosen 
	
		///////////PROSES SIMPAN DATA//////////
		//jika $aksi=simpan
		if($_POST[aksi]=='simpan') 
		{
			//jika kategori tidak diisi 
			if(!empty($_POST[DosenNama]) || !empty($_POST[DosenHp]))
			{
				$simpan=mysql_query("insert into dosen values(' ', '$_POST[DosenNama]', '$_POST[DosenAlamat]', '$_POST[DosenKota]', '$_POST[DosenTelp]', '$_POST[DosenHp]', '$_POST[DosenEmail]', '$_POST[DosenNIK]')") or die (mysql_error());
				
				// setelah proses penyimpanan selesai .. user langsung diarahkan ke daftar dosen dengan script dibawah ini
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
			$update=mysql_query("update dosen set DosenNama='$_POST[DosenNama]',  DosenAlamat='$_POST[DosenAlamat]',  DosenKota='$_POST[DosenKota]',  DosenTelp='$_POST[DosenTelp]',  DosenHp='$_POST[DosenHp]',  DosenEmail='$_POST[DosenEmail]',  DosenNIK='$_POST[DosenNIK]' where DosenId='$_POST[id]'");
	
		// setelah proses penyimpana selesai .. user langsung diarahkan ke daftar dosen dengan script dibawah ini
		echo "<META HTTP-EQUIV=Refresh CONTENT=\"0.1; URL=index.php\">";
		echo "<img src='img/ajax-loader.gif'>";
		}
	
		///////////PROSES  DELETE / HAPUS DATA//////////
		//aksi untuk menghapus dosen
		if($_GET[aksi]=='hapus') 
		{
			$hapus=mysql_query("delete from dosen where DosenId='$_GET[id]'");
			echo "<h2> Dosen telah sukses dihapus</h2>";
			echo "<img src='img/ajax-loader.gif'>";
			
			// alihkan user ke daftar menu setelah menghapus halaman
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"1; URL=index.php\">";
		}
	
		///////////PROSES KONFIRMASI DELETE / HAPUS DATA//////////
		if($_GET[aksi]=='konfirmasi') 
		{
			//ambil data Dosen yang akan dihapus
			$isidosen=mysql_fetch_array(mysql_query("select * from dosen where DosenId='$_GET[id]'  "));
	
			echo "<h3>Konfirmasi Penghapusan Dosen</h3>";
			echo "Apakah anda yakin akan menghapus Dosen <b>$isidosen[DosenNama]</b> ?<br><br>";
			echo "<a href=index.php?p=module/dosen_proses&aksi=hapus&id=$_GET[id]>Ya</a> ";
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