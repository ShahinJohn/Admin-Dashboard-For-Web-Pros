onmessage = function(message){
    
    importScripts('other.js');
}

function timedCount() {
ohWell("h");
postMessage("hi");
setTimeout("ohWell()",3000);
}

timedCount();


function ohWell(am){
    var formData = new FormData();
	formData.append( "liveupdate", "no" );
	
	var ajax = new XMLHttpRequest();
	ajax.open("POST", "liveparser.php");
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4 && ajax.status == 200)
		{
			postMessage(ajax.responseText);		
		}
	}
	ajax.send(formData);

}