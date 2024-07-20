<?php
defined( 'VALIDASI' ) or die( 'Tidak diperkenankan mengakses file ini secara langsung !' );
?>
 <form action="pencarian.php" method="GET" enctype="multipart/form-data">
			<?php
			echo "Pencarian:
			
					<select name='pilihcari' size='1' class='rounded'>					
					<option class='rounded' value='MHSNAMA'>NAMA</option>
					<option class='rounded' value='MHSID'>NIM</option>
					<option class='rounded' value='MHSKOTA'>KOTA</option>
					</select> 
					
					<input name='kunci' type='text' id='kunci' size='15' class='rounded'>
					
					<SELECT NAME='JurusanId' id='JurusanId' class='rounded' onChange = 'this.form.submit()'><OPTION class='rounded' value= '-'>-- Jurusan --</OPTION>";
					////menampilkan nama Jurusan seluruhnya 
					$perintahJurusan="select * from jurusan";
					$hasilJurusan=mysql_query($perintahJurusan);

					while($rowJurusan=mysql_fetch_array($hasilJurusan))
					{
						echo("<OPTION class='rounded' value='$rowJurusan[JurusanId]'>$rowJurusan[JurusanNama]");
					}
					echo(" </OPTION></select>");
					echo "&nbsp;&nbsp;<b>Cari !</b>";
					?>
			
			</form>