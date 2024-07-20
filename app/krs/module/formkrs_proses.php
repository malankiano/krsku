<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin"  )
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']) )
	{ 
		// file ini digunakan untuk memproses 'Mata Kuliah' 
	
		
		
	
	
		///////////PROSES  DELETE / HAPUS DATA//////////
		//aksi untuk menghapus 'Mata Kuliah'
		if($_GET[aksi]=='hapus') 
		{
			$hapus=mysql_query("delete from formkrs where idformkrs='$_GET[id]'");
			echo "<h2> Mata Kuliah telah sukses dihapus</h2>";
			echo "<img src='img/ajax-loader.gif'>";
			
			// alihkan user ke daftar menu setelah menghapus halaman
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"1; URL=input_form.php?smt=$_GET[smt]&tahun=$_GET[tahun]&JurusanId=$_GET[JurusanId]\">";
		}
	
		///////////PROSES KONFIRMASI DELETE / HAPUS DATA//////////
		if($_GET[aksi]=='konfirmasi') 
		{
			//ambil data 'Mata Kuliah' yang akan dihapus
			$isimatkul=mysql_fetch_array(mysql_query("select * from formkrs where idformkrs='$_GET[id]'  "));
	
			echo "<h3>Konfirmasi Penghapusan 'Mata Kuliah'</h3>";
			echo "Apakah anda yakin akan menghapus Mata Kuliah <b>$isimatkul[MKid]</b> ?<br><br>";
			echo "<a href=input_form.php?p=module/formkrs_proses&aksi=hapus&id=$_GET[id]&smt=$_GET[smt]&tahun=$_GET[tahun]&JurusanId=$_GET[JurusanId]>Ya</a> ";
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