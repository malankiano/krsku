<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin" || $_SESSION[sebagai]=="pa")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
	{
	include('../../../config/config.php');
	include('../../../config/format_tanggal.php');
	
	?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<title>KRS ONLINE</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<script type="text/javascript" src="../../../jquery-1.7.1.min.js"></script>
		<link href="../../style.css" rel="stylesheet" type="text/css">
		<script type="text/javascript">
		$(function() {
			$('.open-dialog').click(function() {
				$('#kotak-dialog').show().find('#iframeContainer').html('<iframe src="' + this.href + '"></iframe>');
						$('#dialog-overlay').fadeTo(400, 0.8);
				return false;
			});
			$('#kotak-dialog .close').click(function() {
				$('#kotak-dialog').fadeOut('normal', function() {
					$('iframe', this).remove();
				});
				$('#dialog-overlay').hide();
				return false;
			});
			
		
		
		
		});
		
		</script>
		
		
		<script language="javascript">
		//show animation
		$(function(){
		$("#ajax_display").ajaxStart(function(){
		$(this).html(<div style="position:absolute;"><imgsrc="img/ajax-loader-refresh.gif"/> <br><strong>Loading..</strong><br><br>Pleasebe patien,? do not close the window. <br>Gathering data beingprogress .</div>);
		});
		$("#ajax_display").ajaxSuccess(function(){
		$(this).html();
		});
		$("#ajax_display").ajaxError(function(url){
		alert(jqSajax is error );
		});
		});
		</script>
	
		</head>
		
		<body">
		<!-- Start Dialog Box -->
		<div id="kotak-dialog">
			<h3 class="title"><?php echo "Halo <b>$_SESSION[namauser]</b>, Keep Spirit!"; ?><a href="#" class="close"><img src="images/ui/close.png"></a></h3>
			<div class="isi-dialog">
				<div id="iframeContainer"></div>
				<div class="button-wrapper">
					<button class="close">Tutup Kotak Dialog</button>
				</div>
			</div>
		</div>
		<div id="dialog-overlay"></div>
		<!-- End Dialog Box -->
		
		<div class="main">
		  <div class="header">
			<div class="header_resize">
			  <div class="search"></div>	
			</div>
		  </div>
		  <div class="menu_nav">
				<li class="active"><a href="index.php"><img src="../img/browse.png" alt="Depan" align="left">&nbsp; <b>Home</b></a></li>
	
		  </div>
		  <div class="content">	   
			  <div class="mainbar">
				<div class="article">
				<?php //menampilkan nama Jurusan dari table jurusan
					$isiJurusan=mysql_fetch_array(mysql_query("select JurusanNama from jurusan where JurusanId='$_GET[JurusanId]'  "));
				?>
					<h3><span>Pengambilan Mata Kuliah / KRS  ( <?php echo "SMT: $_GET[smt] TH AKD: $_GET[tahun]"; ?> ) </span></h3>
					<?php
					// jika salah satu link menu diklik maka jalankan script dibawah ini untuk menmpilkan isi menu
					if(!empty($_GET['p']))
					{ 
						if(file_exists($_GET['p'].".php")) 
						{
							require_once($_GET['p'].".php"); } 
							else {echo "<h3 align=center><br>Error !!</h3>
							<b>Halaman yang dituju tidak ada</b>";
						}
					} 
					else 
					{ 
						////menampilkan KRS jika pernah input
						
						$nimuser=$_GET[MHSid];
							if($_GET[smt]=='Ganjil') 
								{
								$semester = "1";
								} else {
								$semester = "2";
								}
						$krssudah = mysql_query("SELECT * FROM krs WHERE MHSid='$nimuser' AND KRSSem='$semester' AND KRSThAk='$_GET[tahun]' AND status='Y'");
						if(mysql_num_rows($krssudah)!=0) //jika data ditemukan
						{
							// tampilkan formulir KRS online
							echo "<table cellspacing='0' cellpadding='2' border=0 width=700 style='border-collapse:collapse' bordercolor='#999999'>";
							$isinamamhs=mysql_fetch_array(mysql_query("select MHSNAMA from mahasiswa where MHSID='$nimuser'  "));
							echo "<tr><td width ='100px'>NIM/Nama: </td><td><b>$nimuser / $isinamamhs[MHSNAMA]</b></tr>";
							echo "<tr><td>Sem/Th. Akd: </td><td><b>$_GET[smt] / $_GET[tahun]</b></td></tr>";
							echo "</table>";
							echo "
							<table cellspacing='0' cellpadding='5' border=3 width=700 style='border-collapse:collapse' bordercolor='#999999'>
							<tr bgcolor='#CCCCCC'><td><b>No.</td><td><b>Kode</b></td><td><b>Nama Mata Kuliah</b></td>
							<td><b>SMT</b></td><td><b>SKS</b></td><td><b>Nilai</b><td><b>Bobot</b></td></tr>";
							
							$jum = 0;
							$i = 1;
							while($k = mysql_fetch_array($krssudah)){
								$tanggalinput=$k['tanggal'];
								$jam=$k['jam'];
								$status=$k['status'];
								echo "<tr><td>$i</td>";
								echo "<td>".$k['MKid']."</td>";
								$isimata=mysql_fetch_array(mysql_query("select MKNama from matakuliah where MKid='$k[MKid]'  "));
								echo "<td id=k2$i>".$isimata[MKNama]."</td>";							
								$isiformkrs_jum=mysql_fetch_array(mysql_query("select MKsksT + MKsksP as jumlah_sks, smt from formkrs where MKid='$k[MKid]' and tahun='$_GET[tahun]'"));
								echo "<td>".$isiformkrs_jum[smt]."</td>";
								echo "<td>".$isiformkrs_jum[jumlah_sks]."</td>";
																if (!empty($k['nilai']))
								{
								$biji=$k['nilai'];
								}
								else
								{
								$biji=X;
								}
								echo "<td>$biji</td>";
								if ($k['nilai']=='A')
								{
								$bobot = $isiformkrs_jum[jumlah_sks]*4;
								}
								elseif ($k['nilai']=='B')
								{
								$bobot = $isiformkrs_jum[jumlah_sks]*3;
								}
								elseif ($k['nilai']=='C')
								{
								$bobot = $isiformkrs_jum[jumlah_sks]*2;
								}
								elseif ($k['nilai']=='D')
								{
								$bobot = $isiformkrs_jum[jumlah_sks]*1;
								}
								else
								{
								$bobot = 0;
								}
								echo "<td>$bobot</td></tr>";
								$jum = $jum + $isiformkrs_jum[jumlah_sks];
								$jumbot = $jumbot + $bobot;
								$ipk = $jumbot/$jum;
								$i++;
							}
							$bulatipk=round($ipk,2);
							echo "<tr><td colspan=4>JUMLAH</td><td>$jum</td><td>$jumbot</td><td>$bulatipk</td></tr></table>";
							echo "Indeks Prestasi: <b>$bulatipk</b>";
							if ($bulatipk >= '3')
								{
								$ambil = 24;
								}
							elseif ($bulatipk >= '2.5')
								{
								$ambil = 21;
								}
							elseif ($bulatipk >= '2')
								{
								$ambil = 18;
								}
							elseif ($bulatipk >= '1')
								{
								$ambil = 18;
								}
							else
								{
								$ambil = 12;
								}
							echo "<br> Jumlah SKS yang dapat diambil <b>$ambil</b>";
						}
						else
						{
						
						////
						
						
							echo "<font color='red'><b>Data KHS kosong / tidak ditemukan</b></font>";
						}
						}
				?>      
				
				</div>
				</div>
		
			</div>
		  </div>
	
		</body>
		</html>
	<?php
	}
	else
	{
		header("Location: ../../index.php");
	}
}
else
{
	echo "Anda tidak berhak mengkases halaman ini";
}
?>
