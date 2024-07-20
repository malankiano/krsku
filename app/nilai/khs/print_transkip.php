<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin" || $_SESSION[sebagai]=="mhs")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
	{

	define('FPDF_FONTPATH','libs/fpdf/font/');
	include('libs/fpdf/fpdf.php');
	 
	include('../../../config/config.php');

	 $tgl = date('d-M-Y');
	
	 $pdf = new FPDF();
	 
	$pdf->Open();
$pdf->addPage();
$pdf->setAutoPageBreak(false);
$pdf->setFont('Arial','B',12);
$pdf->Image('logo_politama.jpg',10,23,20);
$pdf->text(35,30,'POLITEKNIK PRATAMA MULIA SURAKARTA');
$pdf->setFont('Arial','',8);
$pdf->text(35,36,'Jl. Haryo Panular No. 18A Telp. 02171-712637 Surakarta');
$pdf->text(35,40,'http://www.politama.ac.id email: poltek@politama.ac.id');
$pdf->Cell(0, 33, " ", "B");
$pdf->setFont('Arial','',10);
$pdf->text(75,52,'TRANSKIP NILAI AKADEMIK');
$pdf->setFont('Arial','',9);
$pdf->text(10,60,'NIM / Nama');
$nimmhs=$_SESSION[uid];
$pdf->text(30,60,": " .$nimmhs." / ".$_SESSION[namauser]);
$yi = 78;
$ya = 50;
$pdf->setFont('Arial','',9);

$pdf->setTextColor(000,000,000);
$isiJurusan=mysql_fetch_array(mysql_query("select JurusanNama from jurusan where JurusanId='$_GET[JurusanId]'"));

$pdf->text(10,66,"Jurusan          : " .$isiJurusan[JurusanNama]);
$yi = 78;
$ya = 72;
$pdf->setFont('Arial','',9);
$pdf->setFillColor(222,222,222);
$pdf->setXY(10,$ya);
$pdf->CELL(10,6,'NO',1,0,'C',1);
$pdf->CELL(25,6,'KODE MK',1,0,'C',1);
$pdf->CELL(80,6,'NAMA MATA KULIAH',1,0,'C',1);
$pdf->CELL(10,6,'SMT',1,0,'C',1);
$pdf->CELL(25,6,'SKS',1,0,'C',1);
$pdf->CELL(10,6,'NILAI',1,0,'C',1);
$pdf->CELL(15,6,'BOBOT',1,0,'C',1);
$ya = $yi + $row;
$nimuser=$_SESSION[uid];
						if($_GET[smt]=='Ganjil') 
							{
							$semester = "1";
							} else {
							$semester = "2";
							}
$sql = mysql_query("select idperkul, MHSid, MKid, KRSSem, KRSThAk, tanggal, jam, status, MIN(nilai) nilaimax from krs where MHSid='$nimuser' AND status='Y' GROUP BY  MKid,MHSid");
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
$pdf->cell(80,6,$isimata[MKNama],1,0,'L',1);

$isiformkrs_jum=mysql_fetch_array(mysql_query("select MKsksT + MKsksP as jumlah_sks, smt from formkrs where MKid='$data[MKid]' "));
$pdf->CELL(10,6,$isiformkrs_jum[smt],1,0,'C',1);
$pdf->CELL(25,6,$isiformkrs_jum[jumlah_sks],1,0,'C',1);
if (!empty($data[nilaimax]))
				{
				$biji=$data[nilaimax];
				}
				else
				{
				$biji=X;
				}
$pdf->CELL(10,6,$biji,1,0,'C',1);
								if ($data[nilaimax]=='A')
								{
								$bobot = $isiformkrs_jum[jumlah_sks]*4;
								}
								elseif ($data[nilaimax]=='B')
								{
								$bobot = $isiformkrs_jum[jumlah_sks]*3;
								}
								elseif ($data[nilaimax]=='C')
								{
								$bobot = $isiformkrs_jum[jumlah_sks]*2;
								}
								elseif ($data[nilaimax]=='D')
								{
								$bobot = $isiformkrs_jum[jumlah_sks]*1;
								}
								else
								{
								$bobot = 0;
								}
$pdf->CELL(15,6,$bobot,1,0,'C',1);
$ya = $ya+$row;
$no++;
$i++;
$dm[kode] = $data[kdprog];
$jum = $jum + $isiformkrs_jum[jumlah_sks];
$jumbot = $jumbot + $bobot;
$ipk = $jumbot/$jum;
}
$bulatipk=round($ipk,2);
$pdf->text(10,$ya+8,"INDEKS PRESTASI:  ".$bulatipk);
$pdf->text(120,$ya+14,"Surakarta , ".$tgl);
$pdf->text(120,$ya+18,"Pembimbing Akademik");
//menampilkan nama Pembimbing Akademik dari table dosen
$isiPA=mysql_fetch_array(mysql_query("select MHSPA from mahasiswa where MHSID='$_SESSION[uid]'  "));
$isidosen=mysql_fetch_array(mysql_query("select DosenNama from dosen where DosenId='$isiPA[MHSPA]'  "));

$pdf->text(120,$ya+38,$isidosen[DosenNama]);
$pdf->output();
	}
}
?>