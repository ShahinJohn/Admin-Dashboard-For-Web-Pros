








function timedCount(response) {

onmessage = function(message){

var formData = new FormData();
formData.append("liveupdate", "need_user");
var ajax = new XMLHttpRequest();
ajax.open("POST", "http://localhost/FlatFileDB/Chat/chatparser.php");
ajax.onreadystatechange = function () 
{
if (ajax.readyState == 4 && ajax.status == 200) 
{
   postMessage(i);
}
}
ajax.send(formData);

}
   
setTimeout("timedCount()",3000);
}
timedCount();
// JavaScript Document  
