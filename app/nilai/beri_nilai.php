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
					 	$sql = "SELECT * FROM krs WHERE MKid = '$_GET[MKid]' AND KRSThAk= '$_GET[tahun]' AND KRSSem='$_GET[smt]' order by MHSid ASC";
						$result = mysql_query($sql) or die (mysql_error());
						$i = 0;

							$isimata=mysql_fetch_array(mysql_query("select MKNama from matakuliah where MKid='$_GET[MKid]'  "));

							echo "Mata Kuliah : <b>$isimata[MKNama]</b>";
							echo "<table border=0 width=500px>";
							echo "<tr bgcolor=#dedede><td colspan=4></td></tr>";
							echo "<tr bgcolor=#dedede><td colspan=4></td></tr>";
							echo "<tr bgcolor=grey><th>No.</th><th>Nim</th><th>Nama</th><th>Nilai</th></tr>";
							echo "<tr bgcolor=#dedede><td colspan=4></td></tr>";
							echo" <form name='form_update' action='nilai_proses.php' method='POST'>  ";                         
						
						$nomor = 0;
						while ($students = mysql_fetch_array($result)) {
						$nomor++;
							if ($n==0) 
								{
									echo "<tr bgcolor=#eeeEE valign=top>";$n++; } else {echo "<tr bgcolor=white valign=top>";$n--; 
								}
								echo "<td width='25px'> $nomor </td>";
								echo "<td width='150px'>{$students['MHSid']}<input type='hidden' name='idperkul[$i]' value='{$students['idperkul']}' /></td>";
								$isimahasiswa=mysql_fetch_array(mysql_query("select  MHSNAMA from mahasiswa where MHSID='$students[MHSid]'  "));
								echo "<td width='300px'>{$isimahasiswa['MHSNAMA']}</td>";
								echo "<td width='25px'><input class='rounded' type='text' size='1' id='nilai[$i]' name='nilai[$i]' value='{$students['nilai']}' /></td>";
								echo "</tr>";
								echo "<tr bgcolor=#dedede><td colspan=4></td></tr>";
								++$i;

						}
						echo '<tr>';
						echo "<td>
						<input type='hidden' name='MKid' value='$_GET[MKid]' />
						<input type='hidden' name='JurusanId' value='$_GET[JurusanId]' />
						<input type='hidden' name='tahun' value='$_GET[tahun]' />
						<input type='hidden' name='smt' value='$_GET[smt]' />
						<input class='rounded' type='submit' value='submit' /></td>";
						echo '</tr>';
						echo "</form>";
						echo '</table>';					

					
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
