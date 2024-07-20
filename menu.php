<?php
defined( 'VALIDASI' ) or die( 'Tidak diperkenankan mengakses file ini secara langsung !' );
?>
 <div class="gadget">
          <div class="clr"></div>
          <ul class="sb_menu">
			<?php
				// Jika login sebagai admin
				 if($_SESSION['sebagai']=="admin" )
				  {
						///////MENAMPILKAN MENU HALAMAN ADMIN/////////////////
						echo "<li><a class='open-dialog'  href=./app/prodi/index.php><img src='images/ico/dosen.png' align='left'>Jurusan</a></li>";
						echo "<li><a class='open-dialog'  href=./app/dosen/index.php><img src='images/ico/pa.png' align='left'>Dosen</a></li>";
						echo "<li><a class='open-dialog'  href=./app/mahasiswa/index.php><img src='images/ico/mhs.png' align='left'> Mahasiswa</a></li>";
						echo "<li><a class='open-dialog'  href=./app/matkul/index.php><img src='images/ico/makul.png' align='left'> Mata Kuliah</a></li>";
						echo "<li><a class='open-dialog'  href=./app/krs/index.php><img src='images/ico/krs.png' align='left'> Formulir KRS</a></li>";
						echo "<li><a class='open-dialog'  href=./app/ambilkrs/kelola/index.php><img src='images/ico/krs.png' align='left'>Kelola KRS Mahasiswa</a></li>";	
						echo "<li><a class='open-dialog'  href=./app/perkuliahan/index.php><img src='images/ico/mhs.png' align='left'> Peserta Kuliah</a></li>";
						echo "<li><a class='open-dialog'  href=./app/user/index.php><img src='images/ico/pa.png' align='left'>User Staff</a></li>";
						echo "<li><a class='open-dialog'  href=./app/nilai/index.php><img src='images/ico/krs.png' align='left'> Input Nilai</a></li>";
				  }
				 // Jika login sebagai staff 
				 if($_SESSION['sebagai']=="staff" )
				  {
						echo "<li><a class='open-dialog'  href=./app/mahasiswa/index.php><img src='images/ico/mhs.png' align='left'> Mahasiswa</a></li>";
						echo "<li><a class='open-dialog'  href=./app/ambilkrs/kelola/index.php><img src='images/ico/krs.png' align='left'>Kelola KRS Mahasiswa</a></li>";	
						echo "<li><a class='open-dialog'  href=./app/perkuliahan/index.php><img src='images/ico/mhs.png' align='left'> Peserta Kuliah</a></li>";
						echo "<li><a class='open-dialog'  href=./app/nilai/index.php><img src='images/ico/krs.png' align='left'> Input Nilai</a></li>";
				  }
				  
				 // Jika login sebagai Mahasiswa 
				 if($_SESSION['sebagai']=="mhs" )
				  {
						echo "<li><a class='open-dialog'  href=./app/ambilkrs/index.php><img src='images/ico/krs.png' align='left'>INPUT KRS</a></li>";			
						echo "<li><a class='open-dialog'  href=./app/nilai/khs/index.php><img src='images/ico/khs.png' align='left'>LIHAT KHS</a></li>";
						echo "<li><a class='open-dialog'  href=./app/nilai/khs/transkip.php><img src='images/ico/khs.png' align='left'>TRANSKIP NILAI</a></li>";
				  }	
				 // Jika login sebagai Penasehat Akademik
				 if($_SESSION['sebagai']=="pa" )
				  {
				  		echo "<li><a class='open-dialog'  href=./app/pa/mahasiswa.php><img src='images/ico/krs.png' align='left'>MAHASISWA BIMBINGAN</a></li>";
						echo "<li><a class='open-dialog'  href=./app/pa/krs/index.php><img src='images/ico/krs.png' align='left'>LIHAT KRS</a></li>";			
						echo "<li><a class='open-dialog'  href=./app/pa/khs/index.php><img src='images/ico/khs.png' align='left'>LIHAT KHS</a></li>";
				  }			  
			?>
          </ul>
</div>