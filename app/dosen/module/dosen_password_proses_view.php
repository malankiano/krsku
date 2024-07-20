<?php
error_reporting(E_ALL ^ E_NOTICE); 
if (!isset($_SESSION)) {
    session_start();
}
if($_SESSION[sebagai]=="admin" || $_SESSION[sebagai]=="staff")
{
	if(!empty($_SESSION['namauser']) || !empty($_SESSION['pwd']))
	{ 
		echo "Berikut ini adalah Username dan Password untuk <b>$_GET[nama]</b> :";
		echo "<table>";
		echo "<tr>";
		echo"<td width=150px><b>Username </b></td>";
		echo"<td>: $_GET[uname]</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td width=150px><b>Password </b></td>";
		echo"<td>: $_GET[pword]</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo"<td width=150px><b>Email </b></td>";
		echo"<td>: $_GET[email]</td>";
		echo "</tr>";	
		echo "</table>";	
		echo "Untuk keamanan data pemilik Akun harus segera mengganti password";
			
	} 
	// jika gagal login
	else 
	{ 
		header("Location: ../index.php");
	}
}
else
{
	echo "<center><blink><font color='red'><b>Anda tidak berhak mengkases halaman ini</b></font></blink></center>";
}
?>