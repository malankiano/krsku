<?php
///Username untuk login ke mysql
$mysql_user="root";

///Password untuk login ke mysql
$mysql_password="";

///nama database
$mysql_database="krsku";

///nama server / hosting
$mysql_host="localhost";

///query login ke server mysql
$koneksi_db = mysql_connect($mysql_host, $mysql_user, $mysql_password);

///query memilih database
mysql_select_db($mysql_database, $koneksi_db); 
$db = mysql_select_db($mysql_database, $koneksi_db);

define( 'VALIDASI', 1 );
?>