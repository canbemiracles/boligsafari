// script to display 'to be uploaded files'
	var selDiv = "";
	document.addEventListener("DOMContentLoaded", init, false);
	function init() {
		document.querySelector('#files').addEventListener('change', handleFileSelect, false);
		selDiv = document.querySelector("#selectedFiles");
	}
	function handleFileSelect(e) {
		if(!e.target.files) return;
		selDiv.innerHTML = "";
		var files = e.target.files;
		for(var i=0; i<files.length; i++) {
			var f = files[i];
			nSize = Math.round(f.size/1024).toFixed(2);
			nSize2 = Math.round(f.size/1048576).toFixed(2);
			if(nSize2 == 0) { nSize2 = "Less than 1"; }
			selDiv.innerHTML +=f.name + " - <strong style='color:#000;'>" + nSize + " KB </strong>" + " or " + nSize2 + " MB " + "<br/>";
		}
	}