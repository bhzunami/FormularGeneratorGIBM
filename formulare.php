<?php
include 'connection.php';
$benutzerName = $_POST['benutzerName_of_formular'];
$passwort = $_POST['passwort_of_formular'];
   $sql = 'SELECT
		name
   FROM
   	formular
   WHERE 
   	userName like "'.$benutzerName.'"
   AND password like "'.$passwort.'"';
   $result = $db->query($sql);
   echo '<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />';
   if (!$result->num_rows) {
		echo '<div id="normal">Benutzername oder Passwort Falsch <br />
	    		<a href="login.php">Back</a></div>';
	} else {
   	$sql2 = 'SELECT
   		id
   	FROM
   		formular
    	WHERE 
    		userName like "'.$benutzerName.'"
    	AND password like "'.$passwort.'"';
    	$result = $db->query($sql2);
    	if (!$result->num_rows) {
	   	echo 'Keine ID';
		} else {
			$count = 0;
	    	while ($row = $result->fetch_assoc()) {
    			$count = $count +1;
        		$id[$count] = $row['id'];
      	 }
		}
		
		$sql4 = 'SELECT DISTINCT
				f.name,    			
    			f.title
    		FROM
    			formular f
	    	WHERE
	    		f.id = '.$id[1];	      
 			$result = $db->query($sql4);	
			if (!$result->num_rows) {
	    		echo 'keine Eintraege';
			}
			echo '<div id="normal"><h1>Formulare von '.$benutzerName.'</h1><br />';
			while ($row = $result->fetch_assoc()) {
				echo 'Titel: <a href="'.$row['name'].'.html">'.$row['name'].'</a><br />';
				echo 'Name: '.$row['title'].'<br />';
			}
			echo '<br />';
     		$sql3 = 'SELECT DISTINCT
				    			
    			w.name,
    			w.feldArt,
    			w.duty,
    			w.werte
    		FROM
    			formular f,
	    		formularWerte w
    		WHERE
	    		w.formularId = '.$id[1];	      
 			$result = $db->query($sql3);	
			if (!$result->num_rows) {
	    		echo 'keine Eintraege';
			}
			echo '<table  BORDER=1>
				<tr>
					<td>Nr</td>
					<td>Feldname</td>
					<td>FeldArt</td>
					<td>Plicht</td>
					<td>Werte</td>				
				</tr>';
			$nr = 0;
			while ($row = $result->fetch_assoc()) {
				$nr = $nr+1;				
				echo'<tr>
					<td>'.$count.'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['feldArt'].'</td>
					<td>'.$row['duty'].'</td>
					<td>'.$row['werte'].'</td>
					</tr>';
			}
			echo '</table></div>';
	}
?>