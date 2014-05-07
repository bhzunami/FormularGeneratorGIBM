<?php
include 'connection.php';
//Alte Sessions löschen!
$_SESSION=array();

// Neue Session anlegen
session_start();

/*Variabeln aus Formular holen
 name -> Name des Formular
 title -> Titel des Formular
 count -> Wieviele Felder 
 inDatabase - Soll es in die Datenbank geschrieben werden ja =>  Wert =='inDatabase'
 benutzerNamen -> Benutzernamen -> für Login später 'login.php
 passwort -> Passwort
 email -> E-Mail Adresse
*/
$name = $_POST['name_of_formular'];
$title = $_POST['title_of_formular'];
$count = $_POST['count_of_formular'];
$inDatabase = $_POST['inDatabase'];
$benutzerName = $_POST['benutzerName_of_formular'];
$passwort = $_POST['passwort_of_formular'];
$email = $_POST['email_of_formular'];

if($inDatabase == 'inDatabase') {
	  $sql = 'SELECT DISTINCT
		userName
   FROM
   	formular';
   $result = $db->query($sql);
   if (!$result->num_rows) {
		echo ' ';
	} else {
	  	while ($row = $result->fetch_assoc()) {
	  		if ($benutzerName == $row['userName']) {
        		header("Location: start2.html");
        	}
      }
    }
}

if($inDatabase == 'inDatabase'){
	if($benutzerName == '') { 
		header("Location: start2.html"); 
	}
	if($passwort == '' ) {
		echo '<div id="warning">Kein Passwort -> Dein Account ist nicht geschützt!</div>';
	}
}
if($name == ''){
	echo'<div id="warning">Formular hat keinen Namen -> Default[\'Formular\'] wird eingefügt.</div>';
}
if($title == ''){
	echo'<div id="warning">Formular hat keinen Titel -> Default[\'Formular\'] wird eingefügt.</div>';
	$title = "Formular";
}

$_SESSION['name_of_formular'] = $name;
$_SESSION['title_of_formular'] = $title;
$_SESSION['email_of_formular'] = $email;
$_SESSION['benutzerName_of_formular'] = $benutzerName;
$_SESSION['passwort_of_formular'] = $passwort;
$_SESSION['inDatabase'] = $inDatabase;

//Mehr als 100 Felder sind zuviel!
if ($count > 100) {
	$count = 100;
	echo '<div id="normal">Du hast mehr als 100 Felder! Es werden nur 100 angezeigt.</div>';
}
?>
<script type="text/javascript" src="js/field.js"></script>
<script language="JavaScript" type="text/javascript">
    var counter = 0;
    function init() {
        document.getElementById('moreFields').onclick = moreFields;
    <?php
        for ($i = 0; $i < $count - 1; $i++) {
            echo
            "moreFields();\n";
        }
    ?>
        moreFields();
    }
    window.onload = init;
</script>
<!--Ausgabe der Felder -->
<?php
echo '<head>
    		<title>Formular Generator - Schritt 2</title>
    		<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
  		</head>

  		<body> 
		<div id="position">Schritte : 1 - <strong>2</strong> - 3</div>
		<form action="seite3.php" method="post">
			<h1>Felder für "'.$title.'"</h1>'; ?>
   		<div id="readroot" style="display: none">
        	<table border="0" cellpadding="0" cellspacing="4">
         	<tr>
            	<td align="left">Feldname</td>
               <td align="left">Feldart</td>
               <td align="left">Pflicht</td>
            </tr>
            <tr>
            	<td align="top"><input name="nameField[]" type="text" size="30" maxlength="30"></td>
               <td><select name="feldArt[]">
               	<option value="1">Text</option>
                  <option value="2">Text Area</option>
                  <option value="3">Passwort</option>
                  <option value="4">List</option>
                  <option value="5">Radio Button</option>
                  <option value="6">Checkbox</option>
                  <option value="7">Upload</option>
                  <option value="8">Button</option>
                	</select>
               </td>
               <td><select name="erforderlich[]">
                  <option value="1">Ja</option>
                  <option value="2">Nein</option>
               	</select>
               </td>
            </tr>
			</table>
         <table>
         	<tr>
            	<td align="left">Werte</td>
            </tr>
            <tr>
               <td><textarea name="werte[]" cols="28" rows="5" wrap="soft"></textarea></td>
               <td align="left" valign="top"><img src="images/warning.jpg" width="20" 
	 					height="20" onmouseover="einblenden('help')" alt="Info" onmouseout="ausblenden('help')" />
	 					Einzelne Werte mit ";" trennen.
	 				</td>
            </tr>
        	</table>
        	<input type="button" value="Lösche Feld"
               onclick="this.parentNode.parentNode.removeChild(this.parentNode);"/><br/>
        	<br/>
        	<hr>
        	<br/>
    	</div>
    	<span id="writeroot"></span>
	   <input type="button" id="moreFields" value="1 Feld hinzufügen"/>

   	<input type="submit" name="next" value="Formular generieren" />
   </form>
   </body>
</html>

