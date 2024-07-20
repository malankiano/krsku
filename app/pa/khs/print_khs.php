<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin" || $_SESSION[sebagai]=="pa")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
	{

	define('FPDF_FONTPATH','../libs/fpdf/font/');
	include('../libs/fpdf/fpdf.php');
	 
	include('../../../config/config.php');
	 $tgl = date('d-M-Y');
	
	 $pdf = new FPDF();
	$pdf->Open();
	$pdf->addPage();
	$pdf->setAutoPageBreak(false);
	$pdf->setFont('Arial','B',12);
	$pdf->Image('../logo_politama.jpg',10,23,20);
	$pdf->text(35,30,'POLITEKNIK PRATAMA MULIA SURAKARTA');
	$pdf->setFont('Arial','',8);
	$pdf->text(35,36,'Jl. Haryo Panular No. 18A Telp. 02171-712637 Surakarta');
	$pdf->text(35,40,'http://www.politama.ac.id email: poltek@politama.ac.id');
	$pdf->Cell(0, 33, " ", "B");
	$pdf->setFont('Arial','',10);
	$pdf->text(75,52,'FORM PENGAMBILAN MATA KULIAH / KRS');
	$pdf->setFont('Arial','',8);
	$pdf->text(10,60,'NIM / Nama');
	$nimmhs=$_GET[MHSid];
	$isinamamhs=mysql_fetch_array(mysql_query("select MHSPA,MHSNAMA,JurusanId from mahasiswa where MHSID='$nimmhs'  "));
	$isiJurusan=mysql_fetch_array(mysql_query("select JurusanNama from jurusan where JurusanId='$isinamamhs[JurusanId]'  "));
	
	$pdf->text(30,60,": " .$nimmhs." / ".$isinamamhs[MHSNAMA]);
	$pdf->text(10,66,'Sem/Th Akd');
	$pdf->text(30,66,": " .$_GET[smt]." / ".$_GET[tahun]);
	$pdf->setFont('Arial','B',8);
	$pdf->text(110,66,"Jurusan : " .$isiJurusan[JurusanNama]);
	$yi = 78;
	$ya = 72;
	$pdf->setFont('Arial','',9);
	$pdf->setFillColor(222,222,222);
	$pdf->setXY(10,$ya);
	$pdf->CELL(10,6,'NO',1,0,'C',1);
	$pdf->CELL(25,6,'KODE MK',1,0,'C',1);
	$pdf->CELL(105,6,'NAMA MATA KULIAH',1,0,'C',1);
	$pdf->CELL(25,6,'SEMESTER',1,0,'C',1);
	$pdf->CELL(25,6,'SKS',1,0,'C',1);
	$ya = $yi + $row;
	$nimuser=$_GET[MHSid];
						if($_GET[smt]=='Ganjil') 
							{
							$semester = "1";
							} else {
							$semester = "2";
								}
	$sql = mysql_query("select * from krs where MHSid='$nimuser' AND KRSSem='$semester' AND KRSThAk='$_GET[tahun]' AND status='Y' order by MKid");
	$i = 1;
	$no = 1;
	$max = 31;
	$row = 6;
	while($data = mysql_fetch_array($sql)){
	$pdf->setXY(10,$ya);
	$pdf->setFont('arial','',9);
	$pdf->setFillColor(255,255,255);
	$pdf->cell(10,6,$no,1,0,'C',1);
	$pdf->cell(25,6,$data[MKid],1,0,'C',1);
	$isimata=mysql_fetch_array(mysql_query("select MKNama from matakuliah where MKid='$data[MKid]'  "));
	$pdf->cell(105,6,$isimata[MKNama],1,0,'L',1);
	
	$isiformkrs_jum=mysql_fetch_array(mysql_query("select MKsksT + MKsksP as jumlah_sks, smt from formkrs where MKid='$data[MKid]' and tahun='$_GET[tahun]'"));
	$pdf->CELL(25,6,$isiformkrs_jum[smt],1,0,'C',1);
	$pdf->CELL(25,6,$isiformkrs_jum[jumlah_sks],1,0,'C',1);
	$ya = $ya+$row;
	$no++;
	$i++;
	$dm[kode] = $data[kdprog];
	$jum = $jum + $isiformkrs_jum[jumlah_sks];
	}
	$pdf->text(10,$ya+8,"JUMLAH SKS SEMESTER INI:  ".$jum);
	$pdf->text(120,$ya+14,"Surakarta , ".$tgl);
	$pdf->text(120,$ya+18,"Pembimbing Akademik");
	//menampilkan nama Pembimbing Akademik dari table dosen
	$isiPA=mysql_fetch_array(mysql_query("select MHSPA from mahasiswa where MHSID='$nimuser'  "));
	$isidosen=mysql_fetch_array(mysql_query("select DosenNama from dosen where DosenId='$isiPA[MHSPA]'  "));
	
	$pdf->text(120,$ya+38,$isidosen[DosenNama]);
	$pdf->output();
	}
}
?>