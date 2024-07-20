<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd'])){
include('config/config.php');
?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
	<title>KRS ONLINE</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css">
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
	</head>
	
	<body>
	<!-- Start Dialog Box -->
	<div id="kotak-dialog">
	<h3 class="title"><?php echo "Halo <b>$_SESSION[namauser]</b>"; ?><a href="#" class="close"><img src="images/ui/close.png"></a></h3>
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
			<ul>
				<li class="active"><a href="logout.php"><img src="images/ico/logout.png" align="left">Logout</a></li>
				<li class="active"><a href="password.php"><img src="images/ico/password.png" align="left">Password</a></li>
				<li class="active"><a href="utama.php"><img src="images/ico/home.png" align="left">Home</a></li>
				<li class="active"><br><b>Halloo, <?php echo "$_SESSION[namauser]";  ?></b></li>
			  
			</ul>
		  </div>
	  <div class="content">
	   
		  <div class="mainbar">
			<div class="article">
			  <h2><span>Selamat Datang</span></h2>
	
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
			// jika user mengakses home atau index.php maka jalankan script dibawah ini
			else 
			{ 
				echo "<p>KRS Online adalah fasilitas untuk pengambilan mata kuliah pada semester tertentu</p>";
			}
			?>      
			</div>
			</div>
		  <div class="sidebar">
		   <?php
		   include('menu.php');
		   ?>
		  </div>
		  <div class="clr"></div>
		</div>
	  </div>
	  <div class="fbg">
		 <div class="footer">
		  <p class="lf">&copy; Fajar Pamungkas.</p>
		  <div class="clr"></div>
		</div>
	
	</div>
	</body>
	</html>
<?php
}
else
{
	header("Location: index.php");
}
?>
