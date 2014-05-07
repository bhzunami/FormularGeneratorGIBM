<?php
$sql = 'INSERT INTO
		formularWerte(formularId, name, feldArt, duty, werte)
	VALUES
		(?, ?, ?, ?, ?)';
$stmt = $db->prepare($sql);
if (!$stmt) {
	die ('Es konnte kein SQL-Query vorbereitet werden: '.$db->error);
}
$stmt->bind_param('isiis', $id, $field, $feldArt[$i], $erforderlich[$i],$werte[$i] );
if (!$stmt->execute()) {
	die ('Query konnte nicht ausgeführt werden: '.$stmt->error);
}
?>