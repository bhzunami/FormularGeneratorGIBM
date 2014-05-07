<?php
session_start();
$withCSS = $_POST['withCSS'];
$text = $_SESSION['text'];
$file = $_SESSION['name_of_formular'];
$title = $_SESSION['title_of_formular'];

$css = '<html>
  <head>
    <title>'.$title.'</title>
    <style type="text/css">
 	*{
	font-family: tahoma, verdana, "sans-serif";
	margin: 0;
	padding: 0;
	font-size: 100%;
}

body{
	background: white;
}

p{
	font-size: 90%;
	margin-top: 1em;
	margin-bottom: 2em;
	color: #333;
}

h1 {
	color: #0099CC;
	font-size: 1.6em;
}

form {
	width: 420px;
	border: 1px solid #EEE;
	padding: 10px;
	margin: 40px auto;
}

.blue {
	color: #0099CC;
	font-weight: bold;
}

body {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#404040;
	background:#fff;
}

#container {padding:20px;}

input, textarea {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#404040;
}
label {
	color:#999;
	cursor:pointer;
	padding-left:2px;
	line-height:16px;
}
#footer {
background-color:#FFFFFF;
border-top:3px solid #57626A;
color:#333333;
font-size:11px;
margin-top:20px;
padding:10px;
text-align:center;
}

.textinput, .textinputHovered {
	height:15px;
	background:url(../images/input_bg.gif) repeat-x left top;
	border:none;
	padding:4px 0;
	vertical-align:middle;
}
.textinputHovered {background-position:left bottom;}
.inputCorner {
	padding-bottom:0;
	vertical-align:middle;
}
#name, #email, #titel, #number {
color: #3592bc;
}
#position {
        width: 420px;
	border: 1px solid #EEE;
	padding: 10px;
        margin: 20px auto;
	text-align:right;

}
#formularSpeichern {
        width: 420px;
	border: 1px solid #EEE;
	padding: 10px;
        margin: 20px auto;
	text-align:right;

}
strong {
	font-size: 1.6em;
}
</style>

	</head>
 	 <body>';
$textN = $css.$text;
if($file == '' ){
	$file = "Formular";
}
header("Pragma: public"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download"); 
header("Content-Type: application/octet-stream"); 
header("Content-Type: application/download"); 
header('Content-Disposition: attachment; filename='.$file.'.html'); 
header("Content-Transfer-Encoding: binary"); 
//header("Content-Length: ".filesize($text));
//readfile($text);
$filename = $file.'.html';
if(file_exists($filename)){
	$filename = "1_".$filename;
}
$datei = fopen($filename, "w+");
if($withCSS == 'withCSS') {
	echo $textN;
	fwrite($datei, $textN);
} else {
	echo $text;
	fwrite($datei, $text);
}

fclose($datei);
?>