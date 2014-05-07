function einblenden(elementname) {
 	document.getElementById(elementname).style.display='block';
}
function ausblenden(elementname) {
	document.getElementById(elementname).style.display='none';
}   
function moreFields() {
    counter++;
    var newFields = document.getElementById('readroot').cloneNode(true);
    newFields.id = '';
    newFields.style.display = 'block';
    var newField = newFields.childNodes;
    var insertHere = document.getElementById('writeroot');
    insertHere.parentNode.insertBefore(newFields, insertHere);
}