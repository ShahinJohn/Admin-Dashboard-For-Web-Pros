function _(id){
	return document.getElementById(id);
}
function _cName(cName){
	return document.getElementsByClassName(cName);
}
function isAlpha(n){
	var regex = /^[a-zA-Z]+$/;
	if(n.match(regex))
	{
		return true;
	}else{
		return false;
	}
}
function isAlNum(i){
	var regex = /^[a-zA-Z0-9]+$/i;
	if(i.match(regex))
	{
		return true;
	}else{
		return true;
	}
}
function isPhone(p)
{
	var regex = /^\d{10}$/;
	if(p.match(regex))
	{
		return true;
	}else{
		return false;
	}
}
function isEmail(e){
	var regex = /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/;
		if(regex.test(e)){
			return true;
		}else{
			return false;
		}
	}
	
	function toggleError(el){
		var errors = _cName('error');
		el.classList.remove('error');
		el.removeAttribute('onfocus');
		if(errors.length === 0){
			_("newCustomerFormMessage").innerHTML = "";
		}
	}
	function toggleHidden(id){
		if(id.match("&")){
			var toggleList = id.split("&");
			for(x=0;x<toggleList.length;x++){
				
				_(toggleList[x]).classList.toggle('hidden');
			}
		}else{
			_(id).classList.toggle('hidden');
		}
	}

	let buttonsArray = [
	"<button type='button' onClick=\"toggleHidden('formContainer&customers-table')\">+NEW CUSTOMER</button>",
	"<button type='button' id='newCustomerFormSubmit' onClick='addCustomer()'>Add Customer</button>",
	"<button type='button' id='newCustomerFormCancel' onClick=\"toggleHidden('formContainer&customers-table')\">Cancel</button>",
	"<button type='button' onClick=\"\">+NEW MESSAGE</button>",
	"<button type='button' id='newInventoryFormElementSubmit' onClick='addNewItem()'>Add New Item</button>",
	"<button type='button' id='newInventoryFormElementCancel' onClick=\"toggleHidden('formContainer&Inventory-table')\">Cancel</button>",
	]
	function setCookie(cname, cvalue, exdays) {
		const d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		let expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	function getCookie(cname) {
		let name = cname + "=";
		let ca = document.cookie.split(';');
		for(let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) === 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
	function parseMessage(lastUpdate){
		
		lastUpdate = lastUpdate.slice(0, -1); 
		var updated = lastUpdate.split("&");
		for(i = 0; i< updated.length; i++)
		
		{
			let live = updated[i].split("=");
			var userLive = live[0].trim();
			var statusLive = live[1].trim();
			//overkill from frustration
			userLive = userLive.toString();
			var U = users.indexOf(userLive);
			try{
				if(document.getElementById(users[U])){ document.getElementById(users[U]).setAttribute('data-live', statusLive);}
			}catch(error){
				console.log(error);
			}
		}
		if(getCookie('hasMail')){  
			if(_('chat-table')){ getChat(); document.cookie = "hasMail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";}}
	}
	var w;
	function startWorker() {
		if (typeof(Worker) !== "undefined") {
			if (typeof(w) == "undefined") {
				w = new Worker("js/live.js");
			}
			w.onmessage = function(event) {
				parseMessage(event.data);
			};
		} else {
			document.getElementById("banner-right").innerHTML = "Sorry! No Web Worker support.";
		}
	}

	function addNewItem(){
		var J = 0;
		var formdata = new FormData();
		formdata.append("submit", "");
		formdata.append("category", _('Icategory').value);
		formdata.append("name", _('Iname').value);
		formdata.append("brand", _('Ibrand').value);
		formdata.append("unit", _('Iunit').value);
		formdata.append("quantity", _('Iquantity').value);
		formdata.append("cost", _('Icost').value);
		formdata.append("pricing", _('Iprice').value);
		formdata.append("image", _("Iimage").files[0]);
		formdata.append("description", _('Idescription').value);
		formdata.append("sku", _('Isku').value);
		formdata.append("supplier", _('Isupplier').value);
		
		let inputData = [ _('Icategory'), _('Iname'), _('Iprice'), _("Iimage").files[0], _('Idescription').value];
		if(inputData.includes(undefined)){ J++;	}
		for(var i=0;i<inputData.length;i++){
			if(inputData[i] === "") {  
				J++;
			}}
		
_("newInventoryFormMessage").innerHTML = "dang";
		
		if(J === 0){
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandler, false);
			ajax.addEventListener("load", completeHandler, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			ajax.open("POST", "FlatFileDB/Products/productsparser.php");
			ajax.send(formdata);
		}else{	_("newInventoryFormMessage").innerHTML += "Please Fix Your Form Input";
		    
		}
return true;		
	}


	function progressHandler(event){
		_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
		var percent = (event.loaded / event.total) * 100;
		_("progressBar").value = Math.round(percent);
		_("statusMessage").innerHTML = Math.round(percent)+"% uploaded... please wait";
	}
	function completeHandler(event){
		parseResponse(event.target.responseText);
		_("progressBar").value = 100;
	}
	function errorHandler(event){
		_("statusMessage").innerHTML = "Upload Failed";
	}




	// var str = "";
	// var walkDOM = function (node,func) {
	// if(node.tagName !== "SCRIPT" && node.tagName !== undefined ){ func(node); }                
	// node = node.firstChild;
	// while(node) {
	// walkDOM(node,func);
	// node = node.nextSibling;
	// }
	// };
	// walkDOM(document.body, function(node) {
	// str+=node.tagName+" "+;
	// });
	// alert(str);
