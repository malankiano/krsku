<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin" || $_SESSION[sebagai]=="mhs")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
	{
	include('../../../config/config.php');
	include('../../../config/format_tanggal.php');
					
					$kuliah = mysql_query("select smt,tahun,MKid,JurusanId,MKsksT + MKsksP as jum_sks from formkrs  order by smt ASC");
														
					while($k = mysql_fetch_array($kuliah))
					{
						$MKid[] = $k['MKid'];
						$jum_sks[] = $k['jum_sks'];
						$smt[] = $k['smt'];
						
					}
	
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
		
		
	<script>
	
	<?php
	echo "var jumlah = ".count($MKid).";\n";
	echo "var jum_sks = new Array();\n";
	//mengambil sks matakuliah dan memasukkan ke array javascript
	for($j=0;$j<count($MKid);$j++){
		echo "jum_sks['".$MKid[$j]."'] = ".$jum_sks[$j].";\n";
	}
	?>
	function hitungtotal(){
		jum = 0;
		for(i=0;i<jumlah;i++){
			id = "mk"+i;
			td1 = "k1"+i;
			td2 = "k2"+i;
			td3 = "k3"+i;
			td4 = "k4"+i;
			td5 = "k5"+i;
			if(document.getElementById(id).checked){
				MKid = document.getElementById(id).value
				jum = jum + jum_sks[MKid];
				//untuk mengubah warna latar tabel apabila diceklist
				document.getElementById(td1).style.backgroundColor = "lightblue";
				document.getElementById(td2).style.backgroundColor = "lightblue";
				document.getElementById(td3).style.backgroundColor = "lightblue";
				document.getElementById(td4).style.backgroundColor = "lightblue";
				document.getElementById(td5).style.backgroundColor = "lightblue";
				}else {
				document.getElementById(td1).style.backgroundColor = "white";
				document.getElementById(td2).style.backgroundColor = "white";
				document.getElementById(td3).style.backgroundColor = "white";
				document.getElementById(td4).style.backgroundColor = "white";
				document.getElementById(td5).style.backgroundColor = "white";
				}
		}
		//menampilkan total jumlah SKS yang diambil
		document.getElementById("jsks").innerHTML = jum;
	}
	</script>
	
	</script>
	
	<style>
	#result {
		height:20px;
		font-size:13px;
		font-family:Arial, Helvetica, sans-serif;
		color:#333;
		padding:10px;
		margin-bottom:10px;
		background-color:#000000;
	}
	#country{
		padding:3px;
		border:1px #CCC solid;
		font-size:12px;
	}
	.suggestionsBox {
		position: absolute;
		left: 175px;
		top:120px;
		margin: 26px 0px 0px 0px;
		width: 300px;
		padding:5px;
		background-color:#480d44;
		border-top: 3px solid #999999;
		color: #fff;
	}
	.suggestionList {
		margin: 0px;
		padding: 0px;
	}
	.suggestionList ul li {
		list-style:none;
		margin: 0px;
		padding: 6px;
		border-bottom:1px dotted #666;
		cursor: pointer;
	}
	.suggestionList ul li:hover {
		background-color: #FC3;
		color:#000;
	}
	ul {
		font-size:11px;
		color:#FFF;
		padding:0;
		margin:0;
	}
	
	.load{
	background-image:url(loader.gif);
	background-position:right;
	background-repeat:no-repeat;
	}
	
	#suggest {
		position:relative;
	}
	</style>
		</head>
		
		<body onload="document.forms[0].MKNama.focus();">
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
	
		  </div>
		  <div class="content">	   
			  <div class="mainbar">
				<div class="article">
				<?php //menampilkan nama data mahasiswa
					$nimuser=$_SESSION[uid];
					$isimahasiswa=mysql_fetch_array(mysql_query("select MHSID, MHSNAMA, JurusanId from mahasiswa where MHSID='$nimuser'  "));
					//menampilkan nama Jurusan dari table jurusan
					$isiJurusan=mysql_fetch_array(mysql_query("select JurusanNama from jurusan where JurusanId='$isimahasiswa[JurusanId]'  "));
				?>
					<h3><span>TRANSKIP NILAI AKADEMIK  ( <?php echo " Jurusan $isiJurusan[JurusanNama]"; ?> ) </span></h3>
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
						////menampilkan nilai
						
						
						$krssudah = mysql_query("SELECT idperkul, MHSid, MKid, KRSSem, KRSThAk, tanggal, jam, status, MIN(nilai) nilaimax  FROM krs WHERE MHSid='$nimuser' AND status='Y' GROUP BY  MKid,MHSid");
						if(mysql_num_rows($krssudah)!=0) //jika data ditemukan
						{
							// tampilkan nilai
							echo "<table cellspacing='0' cellpadding='2' border=0 width=700 style='border-collapse:collapse' bordercolor='#999999'>";
							echo "<tr><td width ='100px'>NIM/Nama: </td><td><b>$isimahasiswa[MHSID] / $isimahasiswa[MHSNAMA]</b></tr>";
						echo "</table>";
							echo "
							<table cellspacing='0' cellpadding='5' border=3 width=700 style='border-collapse:collapse' bordercolor='#999999'>
							<tr bgcolor='#CCCCCC'><td><b>No.</td><td><b>Kode</b></td><td><b>Nama Mata Kuliah</b></td>
							<td><b>SMT</b></td><td><b>SKS</b></td><td><b>Nilai</b><td><b>Bobot</b></td></tr>";
							
							$jum = 0;
							$jumbot = 0;
							$i = 1;
							while($k = mysql_fetch_array($krssudah)){
								$tanggalinput=$k['tanggal'];
								$jam=$k['jam'];
								$status=$k['status'];
								echo "<tr><td>$i</td>";
								echo "<td>".$k['MKid']."</td>";
								$isimata=mysql_fetch_array(mysql_query("select MKNama from matakuliah where MKid='$k[MKid]'  "));
								echo "<td id=k2$i>".$isimata[MKNama]."</td>";							
								$isiformkrs_jum=mysql_fetch_array(mysql_query("select MKsksT + MKsksP as jumlah_sks, smt from formkrs where MKid='$k[MKid]'"));
								echo "<td>".$isiformkrs_jum[smt]."</td>";
								echo "<td>".$isiformkrs_jum[jumlah_sks]."</td>";
								if (!empty($k['nilaimax']))
								{
								$biji=$k['nilaimax'];
								}
								else
								{
								$biji=X;
								}
								echo "<td>$biji</td>";
								if ($k['nilaimax']=='A')
								{
								$bobot = $isiformkrs_jum[jumlah_sks]*4;
								}
								elseif ($k['nilaimax']=='B')
								{
								$bobot = $isiformkrs_jum[jumlah_sks]*3;
								}
								elseif ($k['nilaimax']=='C')
								{
								$bobot = $isiformkrs_jum[jumlah_sks]*2;
								}
								elseif ($k['nilaimax']=='D')
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
							$tanggal	=  tanggal_format_indonesia($tanggalinput);
							
							echo "<p>
							<form name='formkirim' method='get' action='print_transkip.php'>
							<input type='hidden' name='status' value='$status'>
							<input type='hidden' name='tahun' value='$_GET[tahun]'>
							<input type='hidden' name='smt' value='$_GET[smt]'>
							<input type='hidden' name='JurusanId' value='$isimahasiswa[JurusanId]'>
							<input type='hidden' name='nim' value='$_SESSION[uid]'>
							<input type='submit' class='rounded' name='Cetak' value='CETAK TRANSKIP'>
							</form><br>";
							
							echo "</p>";
							
						}
						else
						{
						
						////
						
						
							if(mysql_num_rows($kuliah)!=0) //jika data tidak ditemukan
							{
							// tampilkan formulir KRS online
																				
							echo "Mata Kuliah belum tersedia";
							}		
					
						
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
