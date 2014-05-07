<?php
session_start();
include 'connection.php';


//Get Sessions
$name = $_SESSION['name_of_formular'];
$title = $_SESSION['title_of_formular'];
if($title == ''){
	$title = "Formular";	
}
$email = $_SESSION['email_of_formular'];
$inDatabase = $_SESSION['inDatabase'];
$benutzerName = $_SESSION['benutzerName_of_formular'];
$passwort = $_SESSION['passwort_of_formular'];
$inDatabase = $_SESSION['inDatabase'];
$connection = $_SESSION['connection'];

//Get Felder
$nameField = $_POST['nameField'];
$feldArt = $_POST['feldArt'];
$erforderlich = $_POST['erforderlich'];
$nurLesen = $_POST['nurLesen'];
$werte = $_POST['werte'];
$button = false;

if($inDatabase == 'inDatabase'){
			include 'functions/functions_seite2.php';
}

/*
@param int fieldNr
@return String [FieldArt]
*/
function getField($fieldNr){
	switch($fieldNr) {
  	case 1: 
		return "text";
		break;
	case 3: 
		return "password";
		break;
	case 7: 
		return "file";
		break;
	}
	return "text";
} 

// Formluar wird erzeugt und ausgegeben
echo '<head>
    	<title>'.$title.'</title>
    	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
 		</head>
		<div id="position">Schritte : 1 - 2 - <strong>3</strong></div>';
/* Varialble zum abspeichern starten
	Der obere Teil brauchen wir nicht im File das abgespeichert wird.
*/
ob_start();
	echo '<form action="" method="POST">
	<h1>'.$title.'</h1>
	<table border="0" cellpadding="0" cellspacing="4">';
	unset($nameField[0]);
	
	/*Es geht das Array 'FieldName' durch
	Ist kein Name gesetzt wird dieses Element ausgelassen -> Jedes Feld brauche einen Feldnamen
	Danach schaut man auf die FeldArt
	1 Text
	2 TextArea
	3 Password
	4 List
	5 Radio-Button
	6 Checkbox
	7 File Upload
	8 Button for submit
	*/
	foreach($nameField as $i => $field) {
		if($field != "") {
				// SQL
			if($inDatabase == 'inDatabase'){
			//insertGeneralInfo($title ,$name, $benutzerName, $passwort, $email);
			//getId($name, $benutzerName, $passwort);

				include 'functions/functions_seite3.php';
			}
			if($feldArt[$i] == 1 || $feldArt[$i] == 3 || $feldArt[$i] ==7){
				echo '<tr>';
				if($erforderlich[$i] == 1){
					echo '<td align="left">'.$field.'<span class="blue"> *</span>: </br>';
				} else {
					echo '<td align="left">'.$field.': </br>';
				}
				echo	'<input name="'.$field.'" type='.getField($feldArt[$i]).' size="30" maxlength="30">
					</td>
				</tr>';
			}
			else if($feldArt[$i] == 2) {
				echo '<tr>';
					if($erforderlich[$i] == 1) {
						echo '<td align="left">'.$field.'<span class="blue"> *</span>: </br>';
					} else {
						echo '<td align="left">'.$field.': </br>';
					}
					echo '<textarea name='.$field.' cols="50" rows="10" wrap="soft"></textarea>
					</td>
				</tr>';
			}
			else if($feldArt[$i] == 4) {
				$wert = explode(";", $werte[$i]);
				echo '<tr>';
				if($erforderlich[$i] == 1) {
					echo '<td align="Left">'.$field.'<span class="blue"> *</span>: </br>';
				} else {
					echo '<td align="Left">'.$field.': </br>';
				}
				echo '<select name="'.$field.'" size="'.count($wert).'" multiple >';
					for($y=0; $y < count($wert); $y++){
						echo '<option value="'.$wert[$y].'">'.$wert[$y].'</option>';
					}
				echo '</td>
				</tr>';
			}
			else if($feldArt[$i] == 5) {
				$wert = explode(";", $werte[$i]);
				echo '<tr>';
				if($erforderlich[$i] == 1) {
					echo '<td align="Left">'.$field.'<span class="blue"> *</span>: </br>';
				} else {
					echo '<td align="Left">'.$field.': </br>';
				}
				for($y=0; $y < count($wert); $y++){
						echo '<input type="radio" name="'.$field.'" value="'.$wert[$y].'">'.$wert[$y].'</br>';
					}
				echo '</td>
				</tr>';
			}
			 else if($feldArt[$i] == 6) {
				$wert = explode(";", $werte[$i]);
				echo '<tr>';
				if($erforderlich[$i] == 1) {
					echo '<td align="Left">'.$field.'<span class="blue"> *</span>: </br>';
				} else {
					echo '<td align="Left">'.$field.': </br>';
				}
				for($y=0; $y < count($wert); $y++){
							echo '<input type="checkbox" name="'.$field.'" value="'.$wert[$y].'">'.$wert[$y].'</br>';
					}
				echo '</td>
				</tr>';
			}
			else if($feldArt[$i] == 8) {
				$button = true;
				echo '<tr>
					<td>
					<input name="'.$field.'" value="'.$field.'" type="submit" maxlength="80">
					</td>
				</tr>';	
			}			
		}
	}
	echo '</table>';
	if(!$button) {
		echo '<input name="submit" value="Absenden" type="submit" >';
	}
	echo '</form>';
	// Aufzeichnung wird beendet und in die Variable 'html_quelltext' geschoben
	$html_quelltext=ob_get_contents();
	$_SESSION['text'] = $html_quelltext;
	
	// Form für die File anforderung
	echo '<form action="saveFile.php" method="POST">';
	if($inDatabase == 'inDatabase') {
		echo'Das Formular wurde in die Datenbank gespeichert - <a href="login.php">login</a>';
	}
	echo '<input name="save" value="Formular speichern" type="submit" >
			<input type="checkbox" name="withCSS" value="withCSS"> Mit CSS-Style<br>';
	$text = $html_quelltext;
	echo '</form>';
?>