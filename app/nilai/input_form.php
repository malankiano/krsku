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
	
	?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<title>KRS ONLINE</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<script type="text/javascript" src="../../jquery-1.7.1.min.js"></script>
		<link href="../style.css" rel="stylesheet" type="text/css">
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
		
		<body>
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
				<li class="active"><a href="index.php"><img src="img/browse.png" alt="Depan" align="left">&nbsp; <b>Home</b></a></li>
	
		  </div>
		  <div class="content">	   
			  <div class="mainbar">
				<div class="article">
				<?php //menampilkan nama Jurusan dari table jurusan
					$isiJurusan=mysql_fetch_array(mysql_query("select JurusanNama from jurusan where JurusanId='$_GET[JurusanId]'  "));
				?>
					<h3><span>Kelola Nilai ( <?php echo "SMT: $_GET[smt] TH AKD: $_GET[tahun] Jurusan: $isiJurusan[JurusanNama]"; ?> ) </span></h3>
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
					
									
						
					
					/////////////////	akhir formulir
					/// menampilkan isi dari formulir yang telah diinput
					//query ke table formkrs diurutkan Desc berdasar idformkrs
						$numresult=@mysql_query("select * from formkrs where smt='$_GET[smt]' AND tahun='$_GET[tahun]' AND JurusanId='$_GET[JurusanId]'  order by idformkrs desc");
		
						//menghitung  jumlah total seluruh record (mata kuliah) 
						$numrow=mysql_num_rows($numresult);
		
						// next akan muncul bila offset telah dimasukan jika tidak maka diisi 1
						if (empty($_GET['offset'])) 
						{
							$_GET['offset']=0;
						}
		
						//jika tidak ada artikel 
						if ($numrow==0) 
						{
							echo "<p>Belum terdapat mata kuliah</p>";
		
						} 
						else 
						{
							//jika ditemukan ada data form kRS
							//menmapilkan form krs
							echo "<p>Halaman ini digunakan untuk mengelola Nilai tiap mata kuliah. Sampai saat ini terdapat $numrow  mata kuliah yang diinputkan</p>";
							// ambil hasil
							$n= "0";
							$i="1";
							
							$result=@mysql_query("select * from formkrs where smt='$_GET[smt]' AND tahun='$_GET[tahun]' AND JurusanId='$_GET[JurusanId]' order by idformkrs desc");
							echo "<table border=0 width=800px>";
							echo "<tr bgcolor=#dedede><td colspan=6></td></tr>";
							echo "<tr bgcolor=#dedede><td colspan=6></td></tr>";
							echo "<tr bgcolor=grey><th >No.</th><th>Kode MK</th><th>Nama Mata Kuliah</th><TH>SKS Teori</TH><TH>SKS Praktek</TH></tr>";
							echo "<tr bgcolor=#dedede><td colspan=6></td></tr>";
							while ($isiresult=@mysql_fetch_array($result)) 
							{
								//membuat nomer urut 						
								$no++; 
								if ($n==0) 
								{
									echo "<tr bgcolor=#eeeEE valign=top>";$n++; } else {echo "<tr bgcolor=white valign=top>";$n--; 
								}
								echo "<td width=5%>$no.</td>";
								echo "<td>$isiresult[MKid]</td>";
	
								//menampilkan nama mata Kuliah dari table matakuliah
								$isimakul=mysql_fetch_array(mysql_query("select MKNama from matakuliah where MKid='$isiresult[MKid]'  "));
								echo "<td WIDTH=30%>$isimakul[MKNama]</td>";	
								echo "<td>$isiresult[MKsksT]</td>";
								echo "<td>$isiresult[MKsksP]</td>";											
								echo "<td width=10%>";
								echo "<a class='open-dialog' href=beri_nilai.php?MKid=$isiresult[MKid]&smt=$_GET[smt]&tahun=$_GET[tahun]&JurusanId=$_GET[JurusanId]>Kelola Nilai</a>";
								echo "</td>";
								echo "</tr>";
								echo "<tr bgcolor=#dedede><td colspan=5></td></tr>";
							}
							echo "</table>";
													
						} 
						//// akhir menmapilkan data
					
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
