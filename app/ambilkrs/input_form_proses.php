<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin" || $_SESSION[sebagai]=="mhs")
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
				<?php
				$isiJurusan=mysql_fetch_array(mysql_query("select * from mahasiswa where MHSID='$_SESSION[uid]'"));
				$isiJurusannama=mysql_fetch_array(mysql_query("select JurusanNama from jurusan where JurusanId='$isiJurusan[JurusanId]'  "));
				?>
				  <h3><span>Pengambilan Mata Kuliah / KRS | Jurusan:  <?php echo "$isiJurusannama[JurusanNama]"; ?></span></h3>
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
					//Proses simpan dan menampilkan data
					
					$nim = $_POST[nim]; 
					$tahun = $_POST[tahun];
					if($_POST[smt]=='Ganjil') 
					{
					$semester = "1";
					} else {
					$semester = "2";
					}
			
	
	//cek apakah sudah pernah input;
	$cek = mysql_query("SELECT * FROM krs WHERE MHSid='$nim'
		AND KRSSem='$semester' AND KRSThAk='$tahun'");
	if(mysql_num_rows($cek) > 0 ){
		die("sudah pernah input data");
	}
	$tglsk=gmdate("Y-m-d", time() +60*60*7);
	$jam=gmdate("H:i:s", time() +60*60*7);
	foreach($_POST['mk'] as $value){
		//input ke database krs
		mysql_query("INSERT INTO krs VALUES('','$nim','$value','$semester','$tahun','$tglsk', '$jam','T','' )");
	}
	
	//Menampilkan kembali yang sudah diambil
	// menuju ke halaman isian
			echo "<h2>Proses..</h2>";
			echo "<img src='img/ajax-loader.gif'>";
			
			// alihkan ke halaman inputan
			echo "<META HTTP-EQUIV=Refresh CONTENT=\"1; URL=input_form.php?smt=$_POST[smt]&tahun=$_POST[tahun]&JurusanId=$_POST[JurusanId]\">";
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
