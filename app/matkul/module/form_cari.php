<?php
defined( 'VALIDASI' ) or die( 'Tidak diperkenankan mengakses file ini secara langsung !' );
?>
 <form action="pencarian.php" method="GET" enctype="multipart/form-data">
			<?php
			echo "Pencarian:
			
					<select name='pilihcari' size='1' class='rounded'>					
					<option class='rounded' value='MKNama'>Nama</option>
					<option class='rounded' value='MKid'>Kode</option>
					</select> 
					
					<input name='kunci' type='text' id='kunci' size='15' class='rounded'>
					
					<input type='submit' class='rounded' name='Submit' value='Cari !'>";
			?>
			</form>