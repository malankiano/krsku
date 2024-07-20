<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin" || $_SESSION[sebagai]=="staff")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']) )
	{ 
		
			include('../../config/config.php');

		 	$size = count($_POST['nilai']);
 
			$i = 0;
			while ($i < $size) 
			{
			$nilai= $_POST['nilai'][$i];
			$idperkul = $_POST['idperkul'][$i];
			 
			$query = "UPDATE krs SET nilai = '$nilai' WHERE idperkul = '$idperkul' LIMIT 1";
			mysql_query($query) or die ("Error in query: $query");
			
			++$i;
			} 
			echo "Nilai Sukses terupdate...<br>"; 
			echo "<img src='img/ajax-loader.gif'>";
			// alihkan user ke daftar menu setelah menghapus halaman
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"1; URL=beri_nilai.php?MKid=$_POST[MKid]&smt=$_POST[smt]&tahun=$_POST[tahun]&JurusanId=$_POST[JurusanId]\">";
	
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