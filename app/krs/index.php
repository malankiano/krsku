<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin"  )
{
	if(!empty($_SESSION['namauser']) ||!empty($_SESSION['pwd']) )
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
				  <h2><span>Kelola Formulir KRS</span></h2>
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
					//formulir pemilihan semester, tahun dan Jurusan
						echo "<div align='center'><b> ";
						echo "
						<form name='form1' method='get' action='input_form.php'>
	  Semester :
	  <select name='smt' id='smt' class=rounded>
		  <option value='1'>1</option>
		  <option value='2'>2</option>
		  <option value='3'>3</option>
		  <option value='4'>4</option>
		  <option value='5'>5</option>
		  <option value='6'>6</option>
		</select>&nbsp; &nbsp;&nbsp;
	  Tahun Akd: 
	  <input name='tahun' class=rounded type='text' id='tahun' size='4' maxlength='4'>&nbsp; &nbsp;&nbsp; ";
	 
	//<!-- Menampilkan pilihan Jurusan --> 
						echo "Jurusan : <SELECT NAME='JurusanId' id='JurusanId' class=rounded>";
						
						////menampilkan nama prgrma studi  daari tabel jurusan berdasar jurusanId dari tabel  mahasiswa
						$isiJurusan=mysql_fetch_array(mysql_query("select * from jurusan where JurusanId='$isiMahasiswa[JurusanId]' "));
						echo "$isiJurusan[JurusanNama]";
						////menampilkan nama Jurusan seluruhnya 
						$perintahJurusan="select * from jurusan";
						$hasilJurusan=mysql_query($perintahJurusan);
	
						while($rowJurusan=mysql_fetch_array($hasilJurusan))
						{
							echo("<OPTION value='$rowJurusan[JurusanId]'>$rowJurusan[JurusanNama]");
						}
						echo(" </OPTION></select>");
	 echo" &nbsp; &nbsp;&nbsp;<input type='submit' class=rounded name='Submit' value='Proses !'>
	</form>";			
	echo "</b></div>";			
						
					
					/////////////////	formulir
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
