function _(id) {
  return document.getElementById(id);
}

function _cName(cName) {
  return document.getElementsByClassName(cName);
}

function isWord(n) {
  var regex = /^[a-zA-Z]+$/;
  if (n.match(regex)) {
    return true;
  } else {
    return false;
  }
}

function isMixed(i) {
  var regex = /^[a-zA-Z0-9]+$/i;
  if (i.match(regex)) {
    return true;
  } else {
    return true;
  }
}

function isPhone(p) {
  var regex = /^\d{10}$/;
  if (p.match(regex)) {
    return true;
  } else {
    return false;
  }
}

function isEmail(e) {
  var regex = /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/;
  if (regex.test(e)) {
    return true;
  } else {
    return false;
  }
}

function toggleError(el) {
  var errors = _cName('error');
  el.classList.remove('error');
  el.removeAttribute('onfocus');
  if (errors.length === 0) {
    _("newCustomerFormMessage").innerHTML = "";
  }
}

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


function toggleAttr(id, Attr) {
  if (Attr == "undefined") {
    Attr == "d-none"
  }
  if (id.match("&")) {
    let toggleList = id.split("&");
    for (let x = 0; x < toggleList.length; x++) {
      _(toggleList[x]).classList.toggle('hidden');
    }
  } else {
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
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function fixSizes() {
  var h = window.innerHeight
    || document.documentElement.clientHeight
    || document.body.clientHeight;

  var w = window.innerWidth
    || document.documentElement.clientWidth
    || document.body.clientWidth;

  switch (true) {
    case (w < 992):
      _("page").style.height = h + "px";
      break;
    case (w > 992):
      _("page").style.height = (h - 56) + "px";
      break;
  }

}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
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


function progressHandler(event) {
  _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
  var percent = (event.loaded / event.total) * 100;
  _("progressBar").value = Math.round(percent);
  _("statusMessage").innerHTML = Math.round(percent) + "% uploaded... please wait";
}

function completeHandler(event) {
  parseResponse(event.target.responseText);
  _("progressBar").value = 100;
}

function errorHandler(event) {
  _("statusMessage").innerHTML = "Upload Failed";
}

function abortHandler(event) {
  _("status").innerHTML = "Upload Aborted";
}
var walkDOM = function (node, func) {
  if (node.tagName !== "SCRIPT" && node.tagName !== undefined) {
    func(node);
  }
  node = node.firstChild;
  while (node) {
    walkDOM(node, func);
    node = node.nextSibling;
  }
  // var str = "";
  // walkDOM(document.body, function(node) {
  // str+=node.tagName+" "+;
  // }); 
};


function dragElement(elmnt) {
  var pos1 = 0,
    pos2 = 0,
    pos3 = 0,
    pos4 = 0;
  if (document.getElementById(elmnt.id + "Header")) {
    // if present, the header is where you move the DIV from:
    document.getElementById(elmnt.id + "Header").onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV:
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}


function sendAware(titl, msg) {
  //       var  aw = _('alert1');
  //        aw.firstChild.innerHTML = msg;
  //       aw.style.height = "100px";
  //       aw.style.width = (window.innerWidth - 100)+"px";
  //       aw.style.marginLeft = "50px";
  //       aw.style.top = "10px";
  //       aw.style.marginTop = "10px";
  //       aw.style.offsetY = "10px";
  //       aw.setAttribute('class','activeAlert');
  //       //setTimeout(function(){ aw.classList.add('d-none')}, 3000);
  $('.modal-title').html(titl);
  $('.modal-body').html(msg);
  $('body').removeClass('show-right');
  $('#myModal').modal(true, true, true, true);

}
var timeclockButton;

function punchTimeClock(butt)
{
    timeclockButton = butt;
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    sendAware("SORRY!", "Geolocation is not supported by this browser.");
  }


  function showPosition(position) {
    var lat = position.coords.latitude;
    var lon = position.coords.longitude;
    var formData = new FormData();
    formData.append("timeclock", Username);
    formData.append("longitude", lon);
    formData.append("latitude", lat);
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "FlatFileDB/Timeclock/timeclockparser.php");
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4 && ajax.status == 200) {
        confirmClockIn(ajax.responseText);
      }
    }
ajax.send(formData);

function confirmClockIn(msgt) {
msgt = msgt.toString();
msgt = msgt.replace(/\s/ig,"");
    
msgt = msgt.split('=');

if (msgt[0].match(/error/)) {
sendAware('UH - OH!', 'Sorry Theres been an error');
}
if (msgt[0].match(/In/)) { sendAware("Thank You", "You have Clocked In at " + msgt[1]+""); }
if (msgt[0].match(/Out/)) { sendAware("Thank You", "You have been Clocked Out at " + msgt[1]+""); }

butt.innerHTML = "&nbsp; Clock "+getOpposite(msgt[0])+"&nbsp;";
_('TCmessage').innerHTML = "You Are Clocked "+msgt[0]+""; 
}
}


  function showError(error) {
    switch (error.code) {
      case error.PERMISSION_DENIED:
        sendAware("Problem", "Please enable location in order to clock in <br> Error Msg:User denied the request for Geolocation");
        break;
      case error.POSITION_UNAVAILABLE:
        sendAware("Problem", "Please enable location in order to clock in <br> Error Msg:Location information is unavailable.");
        break;
      case error.TIMEOUT:
        sendAware("Problem", "Please enable location in order to clock in <br> Error Msg: The request to get user location timed out");
        break;
      case error.UNKNOWN_ERROR:
        sendAware("Problem", "Please enable location in order to clock in <br> Error Msg:An unknown error occurred");
        break;
        default:
          sendAware(error);  
        break;
    }
  }

}
function getOpposite(strt){
let yays = ["yes","1","true","In","","",""];
let nays = ["no","0","false","Out","","",""];
let yayind = yays.indexOf(strt);
let nayind = nays.indexOf(strt);
if(yayind > nayind){ return nays[yayind]; } 
if(nayind > yayind){ return yays[nayind]; } 

}
//function dragElementTouch(elmnt) {
//  var pos1 = 0,
//    pos2 = 0,
//    pos3 = 0,
//    pos4 = 0;
//  if (document.getElementById(elmnt.id + "Header")) {
//    // if present, the header is where you move the DIV from:
//    document.getElementById(elmnt.id + "Header").onTouchdown = dragTouchDown;
//  } else {
//    // otherwise, move the DIV from anywhere inside the DIV:
//    elmnt.onTouchdown = dragTouchDown;
//  }
//
//  function dragTouchDown(e) {
//    e = e || window.event;
//    e.preventDefault();
//    // get the mouse cursor position at startup:
//    pos3 = e.clientX;
//    pos4 = e.clientY;
//    document.onTouchup = closeDragElement;
//    // call a function whenever the cursor moves:
//    document.onmTouchmove = elementDrag;
//  }
//
//  function elementDragTouch(e) {
//    e = e || window.event;
//    e.preventDefault();
//    // calculate the new cursor position:
//    pos1 = pos3 - e.clientX;
//    pos2 = pos4 - e.clientY;
//    pos3 = e.clientX;
//    pos4 = e.clientY;
//    // set the element's new position:
//    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
//    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
//  }
//
//  function closeDragElementTouch() {
//    // stop moving when mouse button is released:
//    document.onToucheup = null;
//    document.onTouchmove = null;
//  }
//}
