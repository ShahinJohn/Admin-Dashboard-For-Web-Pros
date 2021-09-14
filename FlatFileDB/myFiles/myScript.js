function parseMessage(lastUpdate) {
  lastUpdate = lastUpdate.slice(0, -1);
  var updated = lastUpdate.split("&");
  for (let i = 0; i < updated.length; i++)

  {
    let live = updated[i].split("=");
    var userLive = live[0].trim();
    var statusLive = live[1].trim();
    //overkill from frustration
    userLive = userLive.toString();
    if (!users) {
      var users = "users";
    }
    var U = users.indexOf(userLive);
    try {
      if (document.getElementById(users[U])) {
        document.getElementById(users[U]).setAttribute('data-live', statusLive);
      }
    } catch (error) {
      console.log(error);
    }
  }
  if (getCookie('hasMail')) {
    if (_('chat-table')) {
      getChat();
      document.cookie = "hasMail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
  }
}

function addNewItem() {
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
  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  ajax.addEventListener("error", errorHandler, false);
  ajax.addEventListener("abort", abortHandler, false);
  ajax.open("POST", "FlatFileDB/Products/productsparser.php");
  ajax.send(formdata);
  return true;
}

function pageControl(that) {
  if (typeof that == "string") {
    that = _(that);
  }
  var active = document.querySelector(".active");
  pageBody.innerHTML = "";
  active.classList.toggle('active');
  that.classList.toggle('active');
  setCookie("bookmark", that.id, 365);

  switch (that.id) {
    case "dashboard-anchor":
      banner.innerHTML = "Dashboard";
      mbhead.innerHTML = "Welcome, " + Username;
      break;
    case "customers-anchor":
      banner.innerHTML = "Customers";
      mbhead.innerHTML = "all customers"
      rightBanner.innerHTML = buttonsArray[0];
      searchbar.setAttribute("onkeyup", "getCustomers(this.value)");
      buildCustomers();
      getCustomers();
      break;
    case "menu-anchor":
      banner.innerHTML = "Menu";
      mbhead.innerHTML = "Please Make Your Selection...";
      buildMenu();
      break;
    case "inventory-anchor":
      banner.innerHTML = "Inventory";
      mbhead.innerHTML = "Add and Track Inventory";
      rightBanner.innerHTML = "<button type='button' onClick=\"toggleHidden('inventoryFormContainer&inventory-table-container')\">+Add New Item</button> <button>Adjust Stock Level</button><button>Edit Item</button>";
      searchbar.setAttribute("onkeyup", "getInventory(this.value)");
      buildInventory();
      getInventory();
      break;
    case "chat-anchor":
      banner.innerHTML = "Chat";
      mbhead.innerHTML = "Now Chatting With:" + messageTo;
      rightBanner.innerHTML = "<button id='everyone' class='liveUser' data-live='live' onclick='changeTo(this)' disabled>Everyone</button>";
      getUsers();
      searchbar.setAttribute("onkeyup", "getChat(this.value)");
      buildChat()
      getChat();
      break;
    case "settings-anchor":
      banner.innerHTML = "Settings";
      mbhead.innerHTML = "Adjust Settings";
      break;
    default:

      break;
  }
}

function buildMenu() {
  var formData = new FormData();
  formData.append("select_table", "menu");
  var ajax = new XMLHttpRequest();
  ajax.open("POST", "FlatFileDB/Products/productsparser.php");
  ajax.onreadystatechange = function () {
    if (ajax.readyState == 4 && ajax.status == 200) {
      _("main-body").innerHTML = ajax.responseText;
    }
  }
  ajax.send(formData);
}

function getInventory(search) {
  if (typeof search === 'string' && search !== "") {
    _("main-body-heading").innerHTML = "Searching for \"" + search + "\"";
  }
  var tbodyRef = _("inventory-table").getElementsByTagName('tbody')[0];

  var formData = new FormData();
  formData.append("select_table", "inventory");
  formData.append("search", search);
  var ajax = new XMLHttpRequest();
  ajax.open("POST", "FlatFileDB/Products/productsparser.php");
  ajax.onreadystatechange = function () {
    if (ajax.readyState == 4 && ajax.status == 200) {
      tbodyRef.innerHTML = ajax.responseText;
    }
  }
  ajax.send(formData);

}

function buildInventory() {
  var pageBody = _("main-body");
  var container = document.createElement('div');
  container.setAttribute('id', 'inventory-table-container');
  pageBody.appendChild(container);
  var headings = ["Item Category", "Item Name", "Item Brand", "Item Unit", "Quantity", "Item Cost", "Item Price", "Item Image", "Item Description", "SKU", "Supplier"];
  var tbl = document.createElement('table');
  tbl.style.width = '100%';
  tbl.setAttribute('border', '1');
  tbl.setAttribute('id', 'inventory-table');
  tbl.setAttribute('class', 'table table-striped table-hover');
  var capt = document.createElement('caption');
  let text = document.createTextNode("inventory-table");
  capt.appendChild(text);
  tbl.appendChild(capt);
  let colgroup = document.createElement('colgroup');

  for (let x = 0; x < headings.length; x++) {
    let col = document.createElement('col');
    //col.setAttribute('width', '40%');
    colgroup.appendChild(col);
  }
  tbl.appendChild(colgroup);
  var thead = tbl.createTHead();
  var row = thead.insertRow(0);
  for (let x = 0; x < headings.length; x++) {
    let th = document.createElement("th");
    let text = document.createTextNode(headings[x]);
    th.appendChild(text);
    row.appendChild(th);
  }
  var tbdy = document.createElement('tbody');
  tbl.appendChild(tbdy);
  container.appendChild(tbl)

  pageBody.innerHTML += `
	<div id="inventoryFormContainer" class="hidden">
	<div class="formsplit">
	<label for="Icategory">Item Category:</label>
	<select class="newInventoryFormElement" id="Icategory">
	<option value="Flower">Flower</option>
	<option value="Pre-Roll">Pre-Roll</option>
	<option value="Edible">Edible</option>
	<option value="Concentrate">Concentrate</option>
	<option value="Merchandise">Merchandise</option>
	</select><br>	
	<label for="Iname">Name:</label>
	<input type="text" id="Iname" value="" class="newInventoryFormElement" autocomplete="off"><br>
	<label for="Ibrand">Brand:</label>
	<input type="text" id="Ibrand" value="" class="newInventoryFormElement" autocomplete="off"><br>
	
	<label for="Iunit">Unit Type:</label>
	<select class="newInventoryFormElement" id="Iunit">
	<option value="Weight">weight</option>
	<option value="Each">each</option>
	</select>
	<label for="Iquantity"  >Quantity:</label>
	<input type="number" id="Iquantity" value="" class="newInventoryFormElement" maxlength="10" autocomplete="off"><br><br>
	<label for="Icost">Cost:</label>
	<input type="number" id="Icost" value="" class="newInventoryFormElement"maxlength="10" autocomplete="off"><br><br>
	<label for="Iprice"  >Pricing:</label>
	<input type="number" id="Iprice" value="" class="newInventoryFormElement" maxlength="10" autocomplete="off"><br><br>
	</div>
	<div class="formsplit">		
	
	
	<progress id="progressBar" value="0" max="100" style="width:300px;"></progress>

	<h3 id="statusMessage"></h3>
	<p id="loaded_n_total"></p>
	
	<label for="Iimage">Choose image to upload</label>
	<input type="file" id="Iimage" name="Iimage" accept=".jpg, .jpeg, .png" class="newInventoryFormElement"> <br>   
	
	<label for="Idescription"  >Item Description</label>
	<textarea id="Idescription" class="newInventoryFormElement"></textarea><br><br>
	<label for="Isku">SKU:</label>
	<input type="text" id="Isku" value="" class="newInventoryFormElement" autocomplete="off"><br>
	<label for="Isupplier">Supplier:</label>
	<input type="text" id="Isupplier" value="" class="newInventoryFormElement" autocomplete="off"><br>
	${buttonsArray[4]}${buttonsArray[5]}
	<span id="newInventoryFormMessage"></span>
	</div></div>
	`;
  getInventory();
}

function buildChat() {
  var pageBody = _("main-body");
  var container = document.createElement('div');
  container.setAttribute('id', 'chat-table-container');
  pageBody.appendChild(container);
  var headings = ["Them", " ", "You", "Time"];
  var tbl = document.createElement('table');
  tbl.style.width = '70%';
  tbl.setAttribute('id', 'chat-table');
  //tbl.setAttribute('class', 'table table-striped table-hover');
  var capt = document.createElement('caption');
  let text = document.createTextNode("");
  capt.appendChild(text);
  tbl.appendChild(capt);
  let colgroup = document.createElement('colgroup');
  let col = document.createElement('col');
  col.setAttribute('width', '20%');
  colgroup.appendChild(col);
  col = document.createElement('col');
  col.setAttribute('width', '10%');
  colgroup.appendChild(col);
  col = document.createElement('col');
  col.setAttribute('width', '20%');
  colgroup.appendChild(col);
  col = document.createElement('col');
  col.setAttribute('width', '5%');
  colgroup.appendChild(col);
  tbl.appendChild(colgroup);
  var thead = tbl.createTHead();
  var row = thead.insertRow(0);
  for (x = 0; x < headings.length; x++) {
    let th = document.createElement("th");
    let text = document.createTextNode(headings[x]);
    th.appendChild(text);
    row.appendChild(th);
  }
  var tbdy = document.createElement('tbody');
  tbl.appendChild(tbdy);
  container.appendChild(tbl);
  _('form-container').innerHTML = "<div id='chat-message-box' ><Textarea id='chat-message-textarea' cols='30' rows='5'></Textarea><button id='chat-send-button' onclick='sendMessagesendMessage()'>send</button></div>"
  //var compStyles = window.getComputedStyle(body);
  //var width = compStyles.getPropertyValue('width');
  // _('chat-message-box').style.width = width;
  // _('chat-table-container').style.width = width;

}
var messageTo = "everyone";

function sendsdasd() {
  let message = _('chat-message-textarea').value;
  if (message.length > 0) {
    var formData = new FormData();
    formData.append("new_message", "");
    formData.append("sender", Username);
    formData.append("reciever", messageTo);
    formData.append("message", message);

    var ajax = new XMLHttpRequest();
    ajax.open("POST", "FlatFileDB/Chat/chatparser.php");
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4 && ajax.status == 200) {
        parseChatResponse(ajax.responseText);
      }
    }
    ajax.send(formData);
  }
}

function changeTo(that) {
  let chatButtons = _cName('liveUser');
  for (i = 0; i < chatButtons.length; i++) {
    if (chatButtons[i].disabled == true) {
      chatButtons[i].disabled = false;
    }
  }
  that.disabled = true;
  messageTo = that.id;
  _("main-body-heading").innerHTML = "Now Chatting With: " + that.id;
  getChat();
}

function getChat(search) {
  if (typeof search === 'string' && search !== "") {
    _("main-body-heading").innerHTML = "Searching for \"" + search + "\"";
  }
  var tbodyRef = _("chat-table").getElementsByTagName('tbody')[0];
  var formData = new FormData();
  formData.append("select_table", "user_chat");
  formData.append("search", search);
  formData.append("chat_with", messageTo);
  var ajax = new XMLHttpRequest();
  ajax.open("POST", "FlatFileDB/Chat/chatparser.php");
  ajax.onreadystatechange = function () {
    if (ajax.readyState == 4 && ajax.status == 200) {
      tbodyRef.innerHTML = ajax.responseText;
    }
  }
  ajax.send(formData);
  var element = document.getElementById('chat-table-container');
  element.scrollTop = element.scrollHeight;
}

function parseChatResponse(response) {
  var response = response.trim();
  if (response.match("&")) {
    var multi = response.split("&");
    response = multi[0];
  }

  switch (response) {
    case "Message Sent":
      getChat();
      _('chat-message-textarea').value = "";
      break;
    default:

      break;
  }
}

function getUsers() {
  var rightBanner = _("banner-right");
  for (var x = 0; x < users.length; x++) {
    if (users[x] != Username) {
      var butt = document.createElement("button");
      butt.setAttribute("id", users[x]);
      butt.setAttribute("data-live", 'away');
      butt.setAttribute("class", 'liveUser');
      butt.setAttribute("onclick", 'changeTo(this)');
      butt.innerHTML = users[x];
      rightBanner.appendChild(butt);
    }
  }
}

function buildCustomers() {
  var pageBody = _("mbodymain");
  var headings = ["id", "First", "Last", "Phone", "Email"];
  var tContainer = document.createElement('div');
  tContainer.setAttribute('id', 'tableCont');
  pageBody.appendChild(tContainer);
  var tbl = document.createElement('table');
  tbl.style.width = '100%';
  tbl.setAttribute('border', '1');
  tbl.setAttribute('id', 'customers-table');
  tbl.setAttribute('class', 'table table-striped table-hover keepWidth');
  var thead = tbl.createTHead();
  var row = thead.insertRow(0);
  for (let x = 0; x < headings.length; x++) {
    let th = document.createElement("th");
    let text = document.createTextNode(headings[x]);
    th.appendChild(text);
    row.appendChild(th);
  }
  var tbdy = document.createElement('tbody');
  tContainer.appendChild(tbl);
  tbl.appendChild(tbdy);
getCustomers();
}


function getCustomers(search) {
//  if (typeof search === 'string' && search !== "") {
//    _("main-body-heading").innerHTML = "Searching for \"" + search + "\"";
//  } else {
//    _("main-body-heading").innerHTML = "All Customers";
//  }
  var tbodyRef = _("customers-table").getElementsByTagName('tbody')[0];
  var formData = new FormData();
  formData.append("select_table", "customers");
  formData.append("search", search);
  var ajax = new XMLHttpRequest();
  ajax.open("POST", "FlatFileDB/Includes/parser.php");
  ajax.onreadystatechange = function () {
    if (ajax.readyState == 4 && ajax.status == 200) {
      tbodyRef.innerHTML = ajax.responseText;
    }
  }
  ajax.send(formData);
afterTable();
}

function afterTable(){
//    
//$('#customers-table').DataTable( {
//    fixedHeader: {
//        footer: true
//    }
//} );  
}

function addCustomer() {
  var errors = _cName('error');

  var fname = _('fname');
  var lname = _('lname');
  var phone = _('phone');
  var email = _('email');

  var formData = new FormData();
  formData.append("fname", fname.value);
  formData.append("lname", lname.value);
  formData.append("phone", phone.value);
  formData.append("email", email.value);

  for (var pair of formData.entries()) {
    switch (pair[0]) {
      case "fname":
        if (pair[1].length <= 2) {
          fname.setAttribute("class", "error");
          fname.setAttribute("onfocus", "toggleError(this)");
        }
        break;
      case "lname":
        if (pair[1].length <= 2) {
          lname.setAttribute("class", "error");
          lname.setAttribute("onfocus", "toggleError(this)");
        }
        break;
      case "phone":
        if (!isPhone(pair[1])) {
          phone.setAttribute("class", "error");
          phone.setAttribute("onfocus", "toggleError(this)");
        }
        break;

    }

  }
  if (errors.length > 0) {
    _('newCustomerFormMessage').innerHTML = "Please Fix Errors"
  } else {
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "FlatFileDB/Includes/parser.php");
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4 && ajax.status == 200) {
        parseResponse(ajax.responseText);
      }
    }
    ajax.send(formData);
  }
}

function parseResponse(response) {
//  var response = response.trim();
//  if (response.match("&")) {
// }   var multi = response.split("&");
//    response = multi[0];
  
  switch (response) {
    case "success":
      document.location = 'index.php';
      break;
    case "added":
      pageControl(4);
      break;
    case "logged-out":
      document.location = 'login.php';
      break;
    case "removed":
      getWaitingList();
      break;
    case "New Customer Added":
      newCustomerAdded(multi[1]);
      break;
    case "Customer Already Exists":
      _("newCustomerFormMessage").innerHTML = response;
      break;
    case "Inventory Added Image Uploaded":
      _("newInventoryFormMessage").innerHTML = response;
      break;
    default:

      break;
  }

}

function newCustomerAdded() {
  var formElements = _cName("newCustomerFormElement");
  for (var x = 0; x < formElements.length; x++) {
    formElements[x].disabled = true;
    //formElements[x].value = " ";
  }

  _("newCustomerFormMessage").innerHTML = "congratulations you added a new customer";


}

function addToWaitingList(custid) {
  if (typeof custid == "object") {
    custid = custid.parentNode.parentNode.id;
  }
  var formData = new FormData();
  formData.append("waiting_list", custid);
  var ajax = new XMLHttpRequest();
  ajax.open("POST", "FlatFileDB/Includes/parser.php");
  ajax.onreadystatechange = function () {
    if (ajax.readyState == 4 && ajax.status == 200) {
      parseResponse(ajax.responseText);
    }
  }
  ajax.send(formData);
}




function addNewUserNow() {
    var errod = document.getElementsByClassName('errored');
    
      for (i = 0; i < errod.length; i++) {
    
    errod[i].classList.remove("is-invalid");
  }
  var errorMessage = 0;
  var uname = _('uname');
  var pword = _('pword');
  var email = _('email');

  if(!isWord(uname.value)) { errorMessage++; uname.classList.add("is-invalid");
    _('usernameErrorMessage').innerHTML = "Please fix the username, Letters only";
  }

  if (Users.indexOf(uname.value) > -1) { errorMessage++; uname.classList.add("is-invalid");
    _('usernameErrorMessage').innerHTML = "Username Already In Use";
  }

  if (pword.value.length < 5) {errorMessage++; pword.classList.add("is-invalid");
    _('passwordErrorMessage').innerHTML = "Please choose a longer password";
  }

  var ele = document.getElementsByName('privilegeLevel');

  for (i = 0; i < ele.length; i++) {
    if (ele[i].checked)
    var privilegeRadio = ele[i].value;
  }


  if (!privilegeRadio) {errorMessage++;_('privilegeErrorMessage').classList.add("is-invalid");
    _('privilegeErrorMessage').innerHTML = "Please select one";
  }

  var formData = new FormData();
  formData.append("uname", uname.value);
  formData.append("pword", pword.value);
  formData.append("privilege", privilegeRadio);
    
if(errorMessage == 0){
  _('uname').setAttribute("disabled","true");
   _('pword').setAttribute("disabled","true");;
  _('addUserButton').setAttribute("disabled","true");;   
 _('passwordGenerator').setAttribute("disabled","true");;      
      for (i = 0; i < ele.length; i++) {
     ele[i].disabled = true;}
    
    sendAware("Everything Look Good?","press the ok button to confirm adding this User");
    _("modaBotton").setAttribute("onclick","confirmedSubmission()");
    }
    
     function confirmedSubmission(){
        
  var ajax = new XMLHttpRequest();
  ajax.open("POST", "FlatFileDB/Includes/parser.php");
  ajax.onreadystatechange = function () {
    if (ajax.readyState == 4 && ajax.status == 200) {
      AddedUserParser(ajax.responseText);
    }
  }
  ajax.send(formData);
}  
    

    
function AddedUserParser(fid){
}
    
}









