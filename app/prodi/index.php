<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin")
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
		//Menampilkan lightbox window
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
		
		<script type="text/javascript" src="jquery.js"></script>
		<script>
		function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#country').addClass('load');
			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
			}
		}
	
		function fill(thisValue) {
			$('#DosenNama').val(thisValue);
			setTimeout("$('#suggestions').fadeOut();", 50);
		}
		
		function fill2(thisValue) {
			$('#kajur').val(thisValue);
			setTimeout("$('#suggestions').fadeOut();", 50);
		}
	
	</script>
	
	<style>
	#result {
		height:20px;
		font-size:13px;
		font-family:Arial, Helvetica, sans-serif;
		color:#333;
		padding:5px;
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
		left: 275px;
		top:220px;
		margin: 26px 0px 0px 0px;
		width: 200px;
		padding:0px;
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
			<ul>
				<li class="active"><a href="index.php"><img src="img/browse.png" alt="Lihat Data" align="left">&nbsp; <b>Daftar Jurusan</b></a></li>
				<li class="active"><a href="index.php?p=module/prodi_tambah"><img src="img/sisip.png" alt="Tambah Data" align="left">&nbsp; <b> Tambah Jurusan</b></a></li>
			</ul>
		  </div>
		  <div class="content">	   
			  <div class="mainbar">
				<div class="article">
				  <h2><span>Jurusan</span></h2>
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
						// jika user mengakses home atau index.php maka jalankan script dibawah ini
						///////// Menampilkan indeks Halaman //////////////
						
						// limit digunakan untuk membatasi jumlah record yang tampil
						$limit=8;
		
						//query ke table artikel diurutkan Desc berdasar tanggal input artikel
						$numresult=@mysql_query("select * from jurusan order by JurusanId desc");
		
						//menghitung  jumlah total seluruh record (artikel) 
						$numrow=mysql_num_rows($numresult);
		
						// next akan muncul bila offset telah dimasukan jika tidak maka diisi 1
						if (empty($_GET['offset'])) 
						{
							$_GET['offset']=0;
						}
		
						//jika tidak ada artikel 
						if ($numrow==0) 
						{
							echo "<p>Halaman ini digunakan untuk mengelola data Jurusan. Sampai saat ini belum terdapat  Jurusan</p>";
		
						} 
						else 
						{
							//jika ditemukan ada data Jurusan
							//menmapilkan Jurusan
							echo "<p>Halaman ini digunakan untuk mengelola Jurusan. Sampai saat ini terdapat $numrow  Jurusan yang telah dibuat sebagai berikut :</p>";
							// ambil hasil
							$n= "0";
							$i="1";
							$offset=$_GET['offset']; //digunakan untuk pendefinisian halaman Jurusan
							if ($offset!=0) 
							{
							$no=0+$offset;
							}
							else
							{
							$no=0;
							}
							$result=@mysql_query("select * from jurusan order by JurusanId desc  limit $offset,$limit");
							echo "<table border=0 width=800px>";
							echo "<tr bgcolor=#dedede><td colspan=5></td></tr>";
							echo "<tr bgcolor=#dedede><td colspan=5></td></tr>";
							echo "<tr bgcolor=grey><th >No.</th><th>KODE</th><th>NAMA Jurusan</th><TH>KAJUR</TH></tr>";
							echo "<tr bgcolor=#dedede><td colspan=5></td></tr>";
							while ($isiresult=@mysql_fetch_array($result)) 
							{
								//membuat nomer urut 						
								$no++; 
								if ($n==0) 
								{
									echo "<tr bgcolor=#eeeEE valign=top>";$n++; } else {echo "<tr bgcolor=white valign=top>";$n--; 
								}
								echo "<td width=5%>$no.</td>";
								echo "<td width=5%>$isiresult[kodejur]</td>";
		
								echo "<td width=50%>$isiresult[JurusanNama]</td>";
								//menampilkan nama Kajur dari table dosen
								$isidosen=mysql_fetch_array(mysql_query("select * from dosen where DosenNIK='$isiresult[kajur]'  "));
								echo "<td WIDTH=30%>$isidosen[DosenNama]</td>";										
								echo "<td width=10%>";
								echo "<a href=index.php?p=module/prodi_tambah&id=$isiresult[JurusanId]&idnik=$isiresult[kajur]><img src='img/b_edit.png' alt='Edit'></a>";
								echo "<a href=index.php?p=module/prodi_proses&aksi=konfirmasi&id=$isiresult[JurusanId]><img src='img/b_drop.png' alt='Hapus'></a>";
								echo "</td>";
								echo "</tr>";
								echo "<tr bgcolor=#dedede><td colspan=5></td></tr>";
							}
							echo "</table>";
							//paging halaman
							echo "<div class='paging'>";
		
								if ($_GET['offset']!=0) 
								{
									// jangan cetak prev apabila offset = 0 
									$prevoffset=$_GET['offset']-$limit;
									echo "<span class='prevnext'><a href=index.php?offset=$prevoffset style=text-decoration:none> &larr;Prev </a></span>";
								}
		
							// hitung jumlah
								$halaman=intval($numrow/$limit); // hasil diintegerkan
								if ($numrow%$limit) 
								{
									// jka ada sisa maka halaman + 1
									$halaman++;
								}
								
								for ($i1;$i<=$halaman;$i++) 
								{ 
									// loping dimulai dari 1
									$newoffset=$limit*($i-1);
									
									if ($_GET['offset']!=$newoffset) 
									{									
										echo "<a  href=index.php?offset=$newoffset style=text-decoration:none> $i </a>";
										// cetak nomor halaman
									}
									else 
									{
										echo " <span class='current'><b>".$i."</b></span>"; // cetak artikel tanpa link
									}
									
								}
								
							
								// cek jika telah sampai halaman akhir
								if (!(($offset/$limit)+1==$halaman) && $halaman!=1)
								{
									// jika bukan halaman akhir maka berikan link NEXT
									$newoffset=$_GET['offset']+$limit;
									echo "<span class='prevnext'><a href=index.php?&offset=$newoffset style=text-decoration:none> Next &rarr;</a></span>";
								}
								echo "</div>";							
						} 
					
					/////////////////	akhir paging halaman			
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
