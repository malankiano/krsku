<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin"  )
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
		$('#MKid').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 50);
	}
	
	function fill2(thisValue) {
		$('#MKNama').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 50);
	}
	
	function fill3(thisValue) {
		$('#MKsksT').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 50);
	}
	
	function fill4(thisValue) {
		$('#MKsksP').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 50);
	}
	
	
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
				<li class="active"><a href="index.php"><img src="img/browse.png" alt="Depan" align="left">&nbsp; <b>Home</b></a></li>
	
		  </div>
		  <div class="content">	   
			  <div class="mainbar">
				<div class="article">
				<?php //menampilkan nama Jurusan dari table jurusan
					$isiJurusan=mysql_fetch_array(mysql_query("select JurusanNama from jurusan where JurusanId='$_GET[JurusanId]'  "));
				?>
					<h3><span>Kelola Formulir KRS ( <?php echo "SMT: $_GET[smt] TH AKD: $_GET[tahun] Jurusan: $isiJurusan[JurusanNama]"; ?> ) </span></h3>
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
					if($_GET[proses]=='Simpan')
		{
	
		   if(!empty($_GET[MKid]) || !empty($_GET[MKNama]))
			{
				$simpan=mysql_query("insert into formkrs values('','$_GET[smt]', '$_GET[tahun]', '$_GET[JurusanId]', '$_GET[MKid]', '$_GET[MKsksT]', '$_GET[MKsksP]')") or die (mysql_error());
				$MKid="";
			} 
			else 
			{
				echo "<h3>Konfirmasi Penyimpanan data</h3>";
				echo "<font color=red>";
				echo "<h4>Data tidak tersimpan, Data Kurang Lengkap  ...";
				echo "</h4>";
				echo"</font>";
			}
		}
					//formulir input mata kuliah
						echo "
						<form  name='formkrs' method='get'>
						<table border=0 cellpadding='5'>
						<tr bgcolor='#480d44' >
						<td><b><font color=#fffff>Kode MK</font></b></td>
						<td><b><font color=#fffff>Nama Mata Kuliah</font></b></td>
						<td><b><font color=#fffff>SKS Teori</b></font></td>
						<td><b><font color=#fffff>SKS Praktek</b></font></td>
						</tr>
						<tr>
						<td>
						<input type=hidden id='smt' name='smt' value='$_GET[smt]'>
						<input type=hidden id='tahun' name='tahun' value='$_GET[tahun]'>
						<input type=hidden id='JurusanId' name='JurusanId' value='$_GET[JurusanId]'>
						<input type='text' class=rounded_grey readonly='readonly' onBlur='fil1();' id='MKid' name='MKid'></td>
						<td><input type ='text' size='40' class=rounded autocomplete='off' onKeyUp='suggest(this.value);' onBlur='fill2();' id='MKNama' name='MKNama'></td>
						<td><input type ='text' class=rounded_grey readonly='readonly' onBlur='fill3();' id='MKsksT' name='MKsksT'></td>
						<td><input type ='text' class=rounded_grey readonly='readonly onBlur='fill4();' id='MKsksP' name='MKsksP'></td>
						<div class='suggestionsBox' id='suggestions' style='display: none;'> <img src='arrow.png' style='position: relative; top: -12px; left: 30px;' alt='upArrow' />
					   <div class='suggestionList' id='suggestionsList'> &nbsp; </div>
						</tr>
						</table>
	
						<input type=submit class=rounded name=proses value=Simpan>
						</form>";					
						
					
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
							echo "<p>Halaman ini digunakan untuk mengelola Form KRS. Sampai saat ini terdapat $numrow  mata kuliah yang diinputkan</p>";
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
								echo "<a href=input_form.php?p=module/formkrs_proses&aksi=konfirmasi&id=$isiresult[idformkrs]&smt=$_GET[smt]&tahun=$_GET[tahun]&JurusanId=$_GET[JurusanId]><img src='img/b_drop.png' alt='Hapus'></a>";
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
