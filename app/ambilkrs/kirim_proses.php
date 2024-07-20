<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin" || $_SESSION[sebagai]=="mhs")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']) )
	{ 
		include('../../config/config.php'); 
	
		
		
	
	
		///////////PROSES  KIRIM KRS//////////
		//aksi untuk mengubah status T manjadi Y
		if(isset($_GET['Submit']))
		 
		{
			if($_GET[smt]=='Ganjil')
			{
				$update=mysql_query("update krs set status='Y' where (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='1') or (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='3') or (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='5') ");
			}
			else
			{
				$update=mysql_query("update krs set status='Y' where (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='2') or (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='4') or (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='6') ");
			}
	
			echo "<h2> Mata Kuliah Sukses dikirim</h2>";
			echo "<img src='img/ajax-loader.gif'>";
			
			// alihkan ke halaman inputan
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"1; URL=input_form.php?smt=$_GET[smt]&tahun=$_GET[tahun]&JurusanId=$_GET[JurusanId]\">";
		}
	
		///////////PROSES KONFIRMASI DELETE / HAPUS DATA//////////
		if(isset($_GET['Drop'])) 
		{
	
			echo "<h3>Konfirmasi Penghapusan 'Mata Kuliah'</h3>";
			echo "Apakah anda yakin akan menghapus KRS semester <b>$_GET[smt]</b> Tahun <b>$_GET[tahun]</b>  yang belum Anda kirim ?<br><br>";
			echo "<a href=kirim_proses.php?aksi=hapus&nim=$_GET[nim]&smt=$_GET[smt]&tahun=$_GET[tahun]&JurusanId=$_GET[JurusanId]>Ya</a> ";
			echo "| ";
			echo "<a href=\"javascript:history.back()\">Tidak</a>";
		}
		
			if($_GET[aksi]=='hapus') 
		{
			if($_GET[smt]=='Ganjil')
			{
				$update=mysql_query("delete from krs where (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='1') or (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='3') or (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='5') ");
			}
			else
			{
				$update=mysql_query("delete from krs where (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='2') or (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='4') or (MHSid='$_GET[nim]' AND KRSThAk='$_GET[tahun]' AND KRSSem='6') ");
			}
		
			echo "<h2>Form KRS Anda telah kosong..</h2>";
			echo "<img src='img/ajax-loader.gif'>";
			
			// alihkan ke halaman inputan
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"1; URL=input_form.php?smt=$_GET[smt]&tahun=$_GET[tahun]&JurusanId=$_GET[JurusanId]\">";
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