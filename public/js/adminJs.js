function alloweDelete(name){
    return confirm('Vill du verkligen ta bort ' + name);
}


function showArea() {
	document.getElementById("chapterEditor").style.display = "block";
	document.getElementById("isQuestion").value = "0";
}

function hideArea() {
	document.getElementById("chapterEditor").style.display = "none";
	document.getElementById("isQuestion").value = "1";
}