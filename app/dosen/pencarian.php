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
		$(this).html(<div style="position:absolute;"><imgsrc="img/ajax-loader-refresh.gif"/> <br><strong>Loading….</strong><br><br>Pleasebe patien,? do not close the window. <br>Gathering data beingprogress …</div>);
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
			<ul>
				<li class="active"><a href="index.php"><img src="img/browse.png" alt="Lihat Data" align="left">&nbsp; <b>Daftar</b></a></li>
				<li class="active"><a href="index.php?p=module/mhs_tambah"><img src="img/sisip.png" alt="Tambah Data" align="left">&nbsp; <b> Tambah</b></a></li>
				<li class="active"><li class="active"><?php include('module/form_cari.php'); ?></li>
			</ul>
			 
		  </div>
		  <div class="content">	   
			  <div class="mainbar">
				<div class="article">
				  <h2><span>Dosen</span></h2>
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
						$limit=30;
		
						//query ke table dosen diurutkan Desc berdasar DosenNama
						$kunci=$_GET['kunci'];
							if($_GET['pilihcari']=="DosenNama" )
							{
							$numresult=@mysql_query("select * from dosen where DosenNama LIKE '%$kunci%' order by DosenNama ASC");
							}
							if($_GET['pilihcari']=="DosenNIK" )
							{
							$numresult=@mysql_query("select * from dosen where  DosenNIK LIKE '%$kunci%' order by DosenNama ASC");
							}
							if($_GET['pilihcari']=="DosenKota" )
							{
							$numresult=@mysql_query("select * from dosen where DosenKota LIKE '%$kunci%' order by DosenNama ASC");
							}
		
						//menghitung  jumlah total seluruh record (dosen) 
						$numrow=mysql_num_rows($numresult);
		
						// next akan muncul bila offset telah dimasukan jika tidak maka diisi 1
						if (empty($_GET['offset'])) 
						{
							$_GET['offset']=0;
						}
		
						//jika tidak ada mahasiswa 
						if ($numrow==0) 
						{
							echo "<p>Data yang Anda cari tidak diketemukan</p>";
		
						} 
						else 
						{
							//jika ditemukan ada data Dosen
							//menmapilkan mahasiswa
							echo "<p>Ditemukan <b>$numrow</b>  Dosen</p>";
							// ambil hasil
							$n= "0";
							$i="1";
							$offset=$_GET['offset']; //digunakan untuk pendefinisian halaman mahasiswa
							if ($offset!=0) 
							{
							$no=0+$offset;
							}
							else
							{
							$no=0;
							}
							$kunci=$_GET['kunci'];
							if($_GET['pilihcari']=="DosenNama" )
							{
							$result=@mysql_query("select * from dosen where DosenNama LIKE '%$kunci%' order by DosenNama ASC  limit $offset,$limit");
							}
							if($_GET['pilihcari']=="DosenNIK" )
							{
							$result=@mysql_query("select * from dosen where DosenNIK LIKE '%$kunci%' order by DosenNama ASC  limit $offset,$limit");
							}
							if($_GET['pilihcari']=="DosenKota" )
							{
							$result=@mysql_query("select * from dosen where  DosenKota LIKE '%$kunci%' order by DosenNama ASC  limit $offset,$limit");
							}
							
							echo "<table border=0 width=100%>";
							echo "<tr bgcolor=#dedede><td colspan=10></td></tr>";
							echo "<tr bgcolor=#dedede><td colspan=10></td></tr>";
							echo "<tr bgcolor=grey><th >No.</th><th>NIK</th><th>NAMA</th><TH>ALAMAT</TH><TH>KOTA</TH><TH>TELP</TH><TH>HP</TH><TH>EMAIL</TH><TH>KELOLA</TH><TH>HAK AKSES <br>(Penasehat Akademik)</TH></tr>";
							echo "<tr bgcolor=#dedede><td colspan=10></td></tr>";
							while ($isiresult=@mysql_fetch_array($result)) 
							{
								//membuat nomer urut 						
								$no++; 
								if ($n==0) 
								{
									echo "<tr bgcolor=#eeeEE valign=top>";$n++; } else {echo "<tr bgcolor=white valign=top>";$n--; 
								}
								echo "<td>$no.</td>";
								echo "<td>$isiresult[DosenNIK]</td>";
								echo "<td>$isiresult[DosenNama]</td>";
								echo "<td>$isiresult[DosenAlamat]</td>";
								echo "<td>$isiresult[DosenKota]</td>";
								echo "<td>$isiresult[DosenTelp]</td>";
								echo "<td>$isiresult[DosenHp]</td>";
								echo "<td>$isiresult[DosenEmail]</td>";
								echo "<td>";
								echo "<a href=index.php?p=module/dosen_tambah&id=$isiresult[DosenId]><img src='img/b_edit.png' alt='Edit'></a>";
								echo "<a href=index.php?p=module/dosen_proses&aksi=konfirmasi&id=$isiresult[DosenId]><img src='img/b_drop.png' alt='Hapus'></a>";
								echo "</td>";
								echo "<td>";
								echo "<a href=index.php?p=module/dosen_password&id=$isiresult[DosenNIK]><img src='img/password.png' alt='Password'></a>";
								echo "</td>";
								echo "</tr>";
								echo "<tr bgcolor=#dedede><td colspan=10></td></tr>";
							}
							echo "</table>";
							//paging halaman
							echo "<div class='paging'>";
		
								if ($_GET['offset']!=0) 
								{
									// jangan cetak prev apabila offset = 0 
									$prevoffset=$_GET['offset']-$limit;
									echo "<span class='prevnext'><a href=pencarian.php?offset=$prevoffset style=text-decoration:none> &larr;Prev </a></span>";
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
										echo "<a  href=pencarian.php?offset=$newoffset style=text-decoration:none> $i </a>";
										// cetak nomor halaman
									}
									else 
									{
										echo " <span class='current'><b>".$i."</b></span>"; // cetak Dosen tanpa link
									}
									
								}
								
							
								// cek jika telah sampai halaman akhir
								if (!(($offset/$limit)+1==$halaman) && $halaman!=1)
								{
									// jika bukan halaman akhir maka berikan link NEXT
									$newoffset=$_GET['offset']+$limit;
									echo "<span class='prevnext'><a href=pencarian.php?&offset=$newoffset style=text-decoration:none> Next &rarr;</a></span>";
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
