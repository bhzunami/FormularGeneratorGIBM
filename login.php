<?php
echo '<html>
  		<head>
    		<title>Formular Generator</title>
    		<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
  		</head>

  		<body><link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
			<form action="formulare.php" method="post">
      		<h1>Login </h1>
      		<br />
      		<table border="0" cellpadding="0" cellspacing="4">
					<tr>
			  			<td align="left">Benutzername:</td>
			  			<td><input name="benutzerName_of_formular" type="text" size="30" maxlength="30"></td>
					</tr>
					<tr>
					</tr>
					<tr>
			  			<td align="left">Passwort:</td>
			  			<td><input name="passwort_of_formular" type="password" size="30" maxlength="30"></td>
					</tr>
					<tr>
					</tr>
					<tr>
						<td></td>
	 		 			<td align="right"><input type="submit" name="Login" maxlength="80" value="Login" /></td>
					</tr>
   			</table>
    		</form>
    	</body>
    </html>';
?>