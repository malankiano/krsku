<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
	{ 
		// file ini digunakan untuk memproses Mahasiswa 
	
		///////////PROSES SIMPAN DATA//////////
		//jika $aksi=simpan
		if($_POST[aksi]=='simpan') 
		{
			//jika kategori tidak diisi 
			if(!empty($_POST[MHSID]) || !empty($_POST[MHSNAMA]))
			{
				$simpan=mysql_query("insert into mahasiswa values(
				'$_POST[MHSID]', 
				'$_POST[MHSNAMA]', 
				'$_POST[MHSJKEL]', 
				'$_POST[MHSTMLHR]', 
				'$_POST[MHSTGLHR]', 
				'$_POST[MHSWARGA]', 
				'$_POST[MHSAGAMA]', 
				'$_POST[MHSALMT]', 
				'$_POST[MHSKOTA]', 
				'$_POST[MHSNOTEL]', 
				'$_POST[MHSKODEP]', 
				'$_POST[MHSLULUS]', 
				'$_POST[MHSASALP]', 
				'$_POST[MHSORTUN]', 
				'$_POST[MHSORALM]', 
				'$_POST[MHSORKOTA]', 
				'$_POST[MHSORKODEP]', 
				'$_POST[MHSORPEG]',
				'$_POST[MHSPA]', 
				'$_POST[JurusanId]',' ')") or die (mysql_error());
				
				// setelah proses penyimpanan selesai .. user langsung diarahkan ke daftar Mahasiswa dengan script dibawah ini
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
			$update=mysql_query("update mahasiswa set 
			MHSID='$_POST[MHSID]',  
			MHSNAMA='$_POST[MHSNAMA]',  
			MHSJKEL='$_POST[MHSJKEL]',  
			MHSTMLHR='$_POST[MHSTMLHR]',  
			MHSTGLHR='$_POST[MHSTGLHR]',  
			MHSWARGA='$_POST[MHSWARGA]', 
			MHSAGAMA='$_POST[MHSAGAMA]',
			MHSALMT='$_POST[MHSALMT]',
			MHSKOTA='$_POST[MHSKOTA]',
			MHSNOTEL='$_POST[MHSNOTEL]',
			MHSLULUS='$_POST[MHSLULUS]',
			MHSASALP='$_POST[MHSASALP]',
			MHSORTUN='$_POST[MHSORTUN]',
			MHSORALM='$_POST[MHSORALM]',
			MHSORKOTA='$_POST[MHSORKOTA]',
			MHSORKODEP='$_POST[MHSORKODEP]',
			MHSORPEG='$_POST[MHSORPEG]',
			MHSPA='$_POST[MHSPA]', 
			JurusanId='$_POST[JurusanId]' where MHSID='$_POST[id]'");
	
		// setelah proses penyimpana selesai .. user langsung diarahkan ke daftar Mahasiswa dengan script dibawah ini
		echo "<META HTTP-EQUIV=Refresh CONTENT=\"0.1; URL=index.php\">";
		echo "<img src='img/ajax-loader.gif'>";
		}
	
		///////////PROSES  DELETE / HAPUS DATA//////////
		//aksi untuk menghapus Mahasiswa
		if($_GET[aksi]=='hapus') 
		{
			$hapus=mysql_query("delete from mahasiswa where MHSID='$_GET[id]'");
			echo "<h2> Mahasiswa telah sukses dihapus</h2>";
			echo "<img src='img/ajax-loader.gif'>";
			
			// alihkan user ke daftar menu setelah menghapus halaman
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"1; URL=index.php\">";
		}
	
		///////////PROSES KONFIRMASI DELETE / HAPUS DATA//////////
		if($_GET[aksi]=='konfirmasi') 
		{
			//ambil data Mahasiswa yang akan dihapus
			$isiMahasiswa=mysql_fetch_array(mysql_query("select * from mahasiswa where MHSID='$_GET[id]'  "));
	
			echo "<h3>Konfirmasi Penghapusan Mahasiswa</h3>";
			echo "Apakah anda yakin akan menghapus Mahasiswa <b>$isiMahasiswa[MHSNAMA]</b> ?<br><br>";
			echo "<a href=index.php?p=module/mhs_proses&aksi=hapus&id=$_GET[id]>Ya</a> ";
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
	echo "<center><blink><font color='red'><b>Anda tidak berhak mengkases halaman ini</b></font></blink></center>";
}
?>