<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin" || $_SESSION[sebagai]=="staff")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
	{

	define('FPDF_FONTPATH','libs/fpdf/font/');
	include('libs/fpdf/fpdf.php');
	 
	include('../../config/config.php');

	 $tgl = date('d-M-Y');
	
	 $pdf = new FPDF();
	 
	$pdf->Open();
	$pdf->addPage();
	$pdf->setAutoPageBreak(false);
	$pdf->setFont('Arial','B',12);
	$pdf->Image('logo_politama.jpg',10,10,20);
	$pdf->text(35,18,'DAFTAR HADIR PERKULIAHAN MAHASISWA');
	$pdf->setFont('Arial','',12);
	$pdf->text(35,25,'POLITEKNIK PRATAMA MULIA SURAKARTA');
	
	$pdf->Cell(0, 20, " ", "B");
	
	$pdf->setFont('Arial','',8);
	$pdf->text(10,37,'Kode MK');
	$pdf->text(30,37,": " .$_GET[MKid] );
	$isimata=mysql_fetch_array(mysql_query("select MKNama from matakuliah where MKid='$_GET[MKid]'  "));
	$pdf->text(10,41,'Nama MK');
	$pdf->text(30,41,": " .$isimata[MKNama] );
	$yi = 78;
	$ya = 50;
	$pdf->setFont('Arial','',9);
	
	$pdf->setTextColor(000,000,000);
	$pdf->text(10,45,'Sem/Th Akd');
	$pdf->text(30,45,": " .$_GET[smt]." / ".$_GET[tahun]);
	$isiJurusan=mysql_fetch_array(mysql_query("select JurusanNama from jurusan where JurusanId='$_GET[JurusanId]'"));
	$pdf->text(10,49,'Jurusan');
	$pdf->text(30,49,": " .$isiJurusan[JurusanNama]);
	$yi = 61;
	$ya = 55;
	$pdf->setFont('Arial','',8);
	$pdf->setFillColor(222,222,222);
	$pdf->setXY(10,$ya);
	$pdf->CELL(10,6,'NO',1,0,'C',1);
	$pdf->CELL(20,6,'NIM',1,0,'C',1);
	$pdf->CELL(64,6,'NAMA',1,0,'C',1);
	$pdf->CELL(7,6,'1',1,0,'C',1);
	$pdf->CELL(7,6,'2',1,0,'C',1);
	$pdf->CELL(7,6,'3',1,0,'C',1);
	$pdf->CELL(7,6,'4',1,0,'C',1);
	$pdf->CELL(7,6,'5',1,0,'C',1);
	$pdf->CELL(7,6,'6',1,0,'C',1);
	$pdf->CELL(7,6,'7',1,0,'C',1);
	$pdf->CELL(7,6,'8',1,0,'C',1);
	$pdf->CELL(7,6,'9',1,0,'C',1);
	$pdf->CELL(7,6,'10',1,0,'C',1);
	$pdf->CELL(7,6,'11',1,0,'C',1);
	$pdf->CELL(7,6,'12',1,0,'C',1);
	$pdf->CELL(7,6,'13',1,0,'C',1);
	$pdf->CELL(7,6,'14',1,0,'C',1);
	$ya = $yi + $row;
	$nimuser=$_SESSION[uid];
	
	$sql = mysql_query("select * from krs where MKid='$_GET[MKid]' AND KRSSem='$_GET[smt]' AND KRSThAk='$_GET[tahun]'order by MHSid");
	$i = 1;
	$no = 1;
	$max = 31;
	$row = 6;
	while($data = mysql_fetch_array($sql)){
	$pdf->setXY(10,$ya);
	$pdf->setFont('arial','',9);
	$pdf->setFillColor(255,255,255);
	$pdf->cell(10,6,$no,1,0,'C',1);
	$pdf->cell(20,6,$data[MHSid],1,0,'C',1);
	$isimhs=mysql_fetch_array(mysql_query("select MHSNAMA from mahasiswa where MHSid='$data[MHSid]'  "));
	$pdf->cell(64,6,$isimhs[MHSNAMA],1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	$pdf->cell(7,6,' ',1,0,'L',1);
	
	$ya = $ya+$row;
	$no++;
	$i++;
	
	}
	
	$pdf->output();
	}
}
?>