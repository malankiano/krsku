<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
//session dengan sebagai 'admiin' dimaksudkan sebagai administrator
if($_SESSION[sebagai]=="admin")
{
if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
{ 
	// file ini digunakan untuk memproses Dosen 

	///////////PROSES SIMPAN DATA//////////
	//jika $aksi=simpan
	if($_POST[aksi]=='simpan') 
	{
		//jika kategori tidak diisi 
		if(!empty($_POST[password]) || !empty($_POST[username]) || !empty($_POST[nama]) || !empty($_POST[email]))
		{
			$pass=md5($_POST['password']);
			$simpan=mysql_query("insert into user values(' ', '$_POST[username]', '$_POST[nama]', '$pass', 'staff', '$_POST[email]')") or die (mysql_error());
			
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
		if(empty($_POST[password]))
		{
			$update=mysql_query("update user set username='$_POST[username]',  nama='$_POST[nama]',  email='$_POST[email]' where iduser='$_POST[id]'");
		}
		else
		{
			$pass=md5($_POST['password']);
			$update=mysql_query("update user set username='$_POST[username]',  nama='$_POST[nama]',  password='$pass',  email='$_POST[email]' where iduser='$_POST[id]'");
		}

	// setelah proses penyimpana selesai .. user langsung diarahkan ke daftar dosen dengan script dibawah ini
	echo "<META HTTP-EQUIV=Refresh CONTENT=\"0.1; URL=index.php\">";
	echo "<img src='img/ajax-loader.gif'>";
	}

	///////////PROSES  DELETE / HAPUS DATA//////////
	//aksi untuk menghapus dosen
	if($_GET[aksi]=='hapus') 
	{
		$hapus=mysql_query("delete from user where iduser='$_GET[id]'");
		echo "<h2> User  Staff Pengelola telah sukses dihapus</h2>";
		echo "<img src='img/ajax-loader.gif'>";
		
		// alihkan user ke daftar menu setelah menghapus halaman
		echo "<META HTTP-EQUIV=Refresh CONTENT=\"1; URL=index.php\">";
	}

	///////////PROSES KONFIRMASI DELETE / HAPUS DATA//////////
	if($_GET[aksi]=='konfirmasi') 
	{
		//ambil data Dosen yang akan dihapus
		$isiuser=mysql_fetch_array(mysql_query("select * from user where iduser='$_GET[id]'  "));

		echo "<h3>Konfirmasi Penghapusan Staff Pengelola</h3>";
		echo "Apakah anda yakin akan menghapus Staff pengelola <b>$isiuser[nama]</b> ?<br><br>";
		echo "<a href=index.php?p=module/user_proses&aksi=hapus&id=$_GET[id]>Ya</a> ";
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