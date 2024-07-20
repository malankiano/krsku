<?php
   include('../../config/config.php');
   $db = new mysqli($mysql_host, $mysql_user ,$mysql_password, $mysql_database);
	
	if(!$db) {
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {

				$query = $db->query("SELECT MKid, MKNama, MKsksT, MKsksP FROM matakuliah WHERE MKNama LIKE '$queryString%'");
				
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->MKid).'\'); fill2(\''.addslashes($result->MKNama).'\'); fill3(\''.addslashes($result->MKsksT).'\'); fill4(\''.addslashes($result->MKsksP).'\');">'.$result->MKNama.'&nbsp;&nbsp;'.$result->MKid.'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
}
?>