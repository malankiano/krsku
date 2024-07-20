<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin" || $_SESSION[sebagai]=="staff")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']) )
	{ 
		// file ini digunakan untuk memproses username Dosen
	
		///////////PROSES SIMPAN DATA//////////
		//jika $aksi=simpan
		if($_POST[aksi]=='simpan') 
		{
			if(!empty($_POST[password]) || !empty($_POST[email]))
			{
				$pass=md5($_POST['password']);
				$simpan=mysql_query("insert into user values(
				'', 
				'$_POST[DosenNIK]', 
				'$_POST[DosenNama]', 
				'$pass', 
				'pa', 
				'$_POST[email]')") or die (mysql_error());
				
				// setelah proses penyimpanan selesai .. user langsung diarahkan ke daftar Mahasiswa dengan script dibawah ini
				echo "<META HTTP-EQUIV=Refresh CONTENT=\"0.1; URL=index.php?p=module/dosen_password_proses_view&uname=$_POST[DosenNIK]&nama=$_POST[DosenNama]&pword=$_POST[password]&email=$_POST[email]\">";
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
				$update=mysql_query("update user set username='$_POST[DosenNIK]',  nama='$_POST[DosenNama]',  email='$_POST[email]' where username='$_POST[id]'");
			}
			else
			{
				$pass=md5($_POST['password']);
				$update=mysql_query("update user set username='$_POST[DosenNIK]',  nama='$_POST[DosenNama]',  password='$pass',  email='$_POST[email]' where username='$_POST[id]'");
			}
	
					
		// setelah proses penyimpana selesai .. user langsung diarahkan ke daftar Mahasiswa dengan script dibawah ini
		echo "<META HTTP-EQUIV=Refresh CONTENT=\"0.1; URL=index.php?p=module/dosen_password_proses_view&uname=$_POST[DosenNIK]&nama=$_POST[DosenNama]&pword=$_POST[password]&email=$_POST[email]\">";
		echo "<img src='img/ajax-loader.gif'>";
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