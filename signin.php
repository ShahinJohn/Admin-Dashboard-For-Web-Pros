<?php
session_start();
$_SESSION[ 'username' ] = "GUEST";
$_SESSION[ 'privilege' ] = 1;
if ( $_SESSION[ "username" ] != "GUEST" && $_SESSION[ 'privilege' ] != 1 ) {
  header( 'location: /logout.php' );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title> The Great Timez </title>
<link href="assets/css/all.min.css" rel="stylesheet">
<link href="assets/css/ionicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/bracket.css">
<script src="FlatFileDB/myFiles/boilerplate.js"></script> 
<script>
function checkForCookies(){
  let user = getCookie("username");
  if (user != "") {
	  _('floatingInput').value = user;
	  _('floatingPassword').value = getCookie("password");
      _("remember-me").checked=true;
  } 
}
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
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
function getInvalid(){
	var badUser = _('floatingInput').value;
	var badPass = _('floatingPassword').value;
	return badUser+badPass;
}
function attemptSignIn()
{
	if(getInvalid()==getCookie('invalid')){_("message").innerHTML = "Try Something Else"; }else{
	if(_("remember-me").checked==true){
		setCookie("username", _('floatingInput').value, 365)
		setCookie("password", _('floatingPassword').value, 365)		
	}
	function parseResponse(response)
	{
		switch(response.trim()){
			case "success":
			document.location = 'index.php';
			break;
			case "Invalid Credentials":
			setCookie("invalid", getInvalid() )
			default:
			_("message").innerHTML = response;
			break;
		}
	}

	
	var formData = new FormData();
	formData.append( "username", _('floatingInput').value );
	formData.append( "password", _('floatingPassword').value );
	
	var ajax = new XMLHttpRequest();
	ajax.open("POST", "FlatFileDB/Includes/parser.php");
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4 && ajax.status == 200)
		{
			parseResponse(ajax.responseText);		
		}
	}
	ajax.send(formData);
}}
	</script>
</head>

<body>
<div class="row no-gutters flex-row-reverse ht-100v">
  <div class="col-md-6 bg-gray-200 d-flex align-items-center justify-content-center">
    <div class="login-wrapper wd-250 wd-xl-350 mg-y-30">
      <h4 class="tx-inverse tx-center">Sign In</h4>
      <p class="tx-center mg-b-60">Welcome back my friend! Please sign in.</p>
      <div class="form-group">
        <input id="floatingInput" type="text" class="form-control" placeholder="Enter your username">
      </div>
      <!-- form-group -->
      <div class="form-group">
        <input id="floatingPassword" type="password" class="form-control" placeholder="Enter your password">
        <a href="" class="tx-12 d-block mg-t-10">Forgot password?</a> </div>
        <div class="form-group text-right">
        <label class="form-check d-inline"><input id="remember-me" class="form-check d-inline" type="checkbox"><span>Remember Me</span></label>
        </div>
      <!-- form-group -->
      <button type="button" class="btn btn-success btn-block" onClick="attemptSignIn()">Sign In</button>
      <div class="mg-t-60 tx-center">Not yet a member? <a href="#">Sign Up</a> </div>      <div id="message" class="mg-t-60 tx-center"> </div>
    </div>
    <!-- login-wrapper --> 
  </div>
  <!-- col -->
  <div class="col-md-6 bg-primary d-flex align-items-center justify-content-center">
    <div class="wd-250 wd-xl-450 mg-y-30">
      <div class="signin-logo tx-28 tx-bold tx-white"><span class="tx-normal">[</span> THE Great <span class="tx-white-8">TIMEz</span> <span class="tx-normal">]</span></div>
      <div class="tx-white-8 mg-b-60">Got Weed?</div>
      <h5 class="tx-white">Why Us?</h5>
      <p class="tx-white-6 mg-b-60">Ever jus' Know?</p>
      <a href="https://thegreattimes.com" class="btn btn-outline-white pd-x-25 tx-uppercase tx-12 tx-spacing-2 tx-medium">Purchase Now</a> </div>
    <!-- wd-500 --> 
  </div>
</div>
<!-- row --> 

<script src="assets/js/jquery.min.js"></script> 
<script src="assets/js/datepicker.js"></script> 
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script>
window.onload = function() {
    checkForCookies();
};

window.onresize = function() {

};
</script>?>