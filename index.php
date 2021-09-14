<?php
session_start();
date_default_timezone_set( "America/Los_Angeles" );

if ( isset( $_SESSION[ 'username' ] ) && $_SESSION[ 'username' ] !== "GUEST" && isset( $_SESSION[ 'privilege' ] ) && $_SESSION[ 'privilege' ] !== 1 ) {
  $uname = $_SESSION[ 'username' ];
  $rand = mt_rand( 10, 100 );
  include( 'FlatFileDB/Includes/admin_login.php' );
  $sql = "SELECT * FROM users";
  $result = $conn->query( $sql );
  $roleArray = Array( "Guest", "Security", "Employee", "Manager", "Secretary", "Owner", "Admin" );
  $Users = "";
  $timeclock = "";
  $lastlogin = "";
  $livelist = "";
  while ( $row = mysqli_fetch_array( $result ) ) {
    $livelist .= '
<a href="#" id="' . $row[ 1 ] . 'link" class="contact-list-link ">
<div class="d-flex">
<div class="pos-relative">
<img src="assets/media/avatar.png" alt="">
<div id="' . $row[ 1 ] . 'status" class="contact-status-indicator"> </div>
</div>
<div class="contact-person">
<p>  ' . $row[ 1 ] . '  </p>
<span id="' . $row[ 1 ] . 'text" ></span>
</div>
</div>
</a>';

    if ( $row[ 1 ] != $uname ) {
      $Users .= "'$row[1]',";
    } else {
      $timeclock = $row[ 5 ];
      $lastlogin = $row[ 4 ];
    }
  }


  //$sqls = "SELECT * FROM timeclock WHERE name = $uname";
  //$results = $conn -> query($sqls);
  //$rows = mysqli_fetch_array( $results );
  //print_r($rows);exit();

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title> The Great Timez </title>
<link href="assets/css/all.min.css" rel="stylesheet">
<link href="assets/css/ionicons.min.css" rel="stylesheet">
<link href="FlatFileDB/myFiles/myStyle.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/bracket.css">
<link id="darkmode" rel="stylesheet" href="assets/css/bracket.dark.css">
<script src="FlatFileDB/myFiles/boilerplate.js"></script> 
<script src="FlatFileDB/myFiles/objectliterals.js"></script> 
<script src="FlatFileDB/myFiles/myScript.js"></script>
</head>
<script>
<?php 
$punchtimes = explode(",",$timeclock);
array_pop($punchtimes);      
$count = count($punchtimes);$count++;$count++;
$punch = Array("In","Out","Clocked In","Clocked Out","Clock In","Clock Out");
if($count%2 == 0){ $inorout = 0; }else{ $inorout = 1; }

echo 'const Username = "'.$uname.'";';
echo 'var timeClock = "'.$punch[$inorout].'";';
?>

</script>

<body class="collapsed-menu">
<div class="br-logo"> <a href="#" style="font-size:.8em"><span>[</span> Admin Panel<i> </i><span>]</span></a> </div>
<div class="br-sideleft sideleft-scrollbar">
  <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
  <ul class="br-sideleft-menu">
    <li class="br-menu-item"> <a href="index.html" class="br-menu-link"> <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i> <span class="menu-item-label">Dashboard</span> </a> </li>
    <li class="br-menu-item"> <a href="#" onClick="changePage('mailbox.html')" class="br-menu-link"> <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i> <span class="menu-item-label">Mailbox</span> </a> </li>
    <li class="br-menu-item"> <a href="#" class="br-menu-link with-sub"> <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i> <span class="menu-item-label">Cards &amp; Widgets</span> </a>
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="card-dashboard.html" class="sub-link">Dashboard</a></li>
        <li class="sub-item"><a href="card-social.html" class="sub-link">Blog &amp; Social Media</a></li>
        <li class="sub-item"><a href="card-listing.html" class="sub-link">Shop &amp; Listing</a></li>
      </ul>
    </li>
    <li class="br-menu-item"> <a href="#" class="br-menu-link with-sub"> <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i> <span class="menu-item-label">UI Elements</span> </a><!-- br-menu-link -->
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="accordion.html" class="sub-link">Accordion</a></li>
        <li class="sub-item"><a href="alerts.html" class="sub-link">Alerts</a></li>
        <li class="sub-item"><a href="calendars.html" class="sub-link">Buttons</a></li>
        <li class="sub-item"><a href="cards.html" class="sub-link">Cards</a></li>
        <li class="sub-item"><a href="carousel.html" class="sub-link">Carousel</a></li>
        <li class="sub-item"><a href="dropdowns.html" class="sub-link">Dropdowns</a></li>
        <li class="sub-item"><a href="icons.html" class="sub-link">Icons</a></li>
        <li class="sub-item"><a href="images.html" class="sub-link">Images</a></li>
        <li class="sub-item"><a href="list.html" class="sub-link">Lists</a></li>
        <li class="sub-item"><a href="modal.html" class="sub-link">Modal</a></li>
        <li class="sub-item"><a href="media.html" class="sub-link">Media Object</a></li>
        <li class="sub-item"><a href="pagination.html" class="sub-link">Pagination</a></li>
        <li class="sub-item"><a href="popups.html" class="sub-link">Tooltip &amp; Popover</a></li>
        <li class="sub-item"><a href="progress.html" class="sub-link">Progress</a></li>
        <li class="sub-item"><a href="spinners.html" class="sub-link">Spinners</a></li>
        <li class="sub-item"><a href="typography.html" class="sub-link">Typography</a></li>
      </ul>
    </li>
    <!-- br-menu-item -->
    <li class="br-menu-item"> <a href="#" class="br-menu-link with-sub"> <i class="menu-item-icon ion-ios-redo-outline tx-24"></i> <span class="menu-item-label">Navigation</span> </a> 
      <!-- br-menu-link -->
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="navigation.html" class="sub-link">Basic Nav</a></li>
        <li class="sub-item"><a href="navigation-layouts.html" class="sub-link">Nav Layouts</a></li>
        <li class="sub-item"><a href="navigation-effects.html" class="sub-link">Nav Effects</a></li>
      </ul>
    </li>
    <!-- br-menu-item -->
    <li class="br-menu-item"> <a href="#" class="br-menu-link with-sub"> <i class="menu-item-icon ion-ios-pie-outline tx-20"></i> <span class="menu-item-label">Charts</span> </a><!-- br-menu-link -->
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="chart-morris.html" class="sub-link">Morris Charts</a></li>
        <li class="sub-item"><a href="chart-flot.html" class="sub-link">Flot Charts</a></li>
        <li class="sub-item"><a href="chart-chartjs.html" class="sub-link">Chart JS</a></li>
        <li class="sub-item"><a href="chart-echarts.html" class="sub-link">ECharts</a></li>
        <li class="sub-item"><a href="chart-rickshaw.html" class="sub-link">Rickshaw</a></li>
        <li class="sub-item"><a href="chart-chartist.html" class="sub-link">Chartist</a></li>
        <li class="sub-item"><a href="chart-sparkline.html" class="sub-link">Sparkline</a></li>
        <li class="sub-item"><a href="chart-peity.html" class="sub-link">Peity</a></li>
      </ul>
    </li>
    <!-- br-menu-item -->
    <li class="br-menu-item"> <a href="#" class="br-menu-link with-sub"> <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i> <span class="menu-item-label">Forms</span> </a><!-- br-menu-link -->
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="form-elements.html" class="sub-link">Form Elements</a></li>
        <li class="sub-item"><a href="form-layouts.html" class="sub-link">Form Layouts</a></li>
        <li class="sub-item"><a href="form-validation.html" class="sub-link">Form Validation</a></li>
        <li class="sub-item"><a href="form-wizards.html" class="sub-link">Form Wizards</a></li>
        <li class="sub-item"><a href="form-editor-code.html" class="sub-link">Code Editor</a></li>
        <li class="sub-item"><a href="form-editor-text.html" class="sub-link">Text Editor</a></li>
      </ul>
    </li>
    <!-- br-menu-item -->
    <li class="br-menu-item"> <a href="#" class="br-menu-link with-sub"> <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i> <span class="menu-item-label">Tables</span> </a><!-- br-menu-link -->
      <ul class="br-menu-sub nav flex-column">
        <li class="sub-item"><a href="table-basic.html" class="sub-link">Basic Table</a></li>
        <li class="sub-item"><a href="table-datatable.html" class="sub-link">Data Table</a></li>
      </ul>
    </li>
    <!-- br-menu-item -->
    <li class="br-menu-item"> <a href="#" class="br-menu-link with-sub"> <i class="menu-item-icon icon ion-ios-navigate-outline tx-24"></i> <span class="menu-item-label">Maps</span> </a><!-- br-menu-link -->
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="map-google.html" class="sub-link">Google Maps</a></li>
        <li class="sub-item"><a href="map-leaflet.html" class="sub-link">Leaflet Maps</a></li>
        <li class="sub-item"><a href="map-vector.html" class="sub-link">Vector Maps</a></li>
      </ul>
    </li>
    <!-- br-menu-item -->
    <li class="br-menu-item"> <a href="#" class="br-menu-link with-sub"> <i class="menu-item-icon icon ion-ios-color-filter-outline tx-24"></i> <span class="menu-item-label">Skins</span> </a><!-- br-menu-link -->
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="skin-select2.html" class="sub-link">Select2</a></li>
        <li class="sub-item"><a href="skin-rangeslider.html" class="sub-link">Ion RangeSlider</a></li>
        <li class="sub-item"><a href="skin-input-form.html" class="sub-link">Textbox Form</a></li>
        <li class="sub-item"><a href="skin-file-browser.html" class="sub-link">File Browser</a></li>
        <li class="sub-item"><a href="skin-datepicker.html" class="sub-link">Datepicker</a></li>
        <li class="sub-item"><a href="skin-template.html" class="sub-link">Template</a></li>
      </ul>
    </li>
    <!-- br-menu-item -->
    <li class="br-menu-item"> <a href="#" class="br-menu-link with-sub"> <i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i> <span class="menu-item-label">Utilities</span> </a><!-- br-menu-link -->
      <ul class="br-menu-sub">
        <li class="sub-item"><a href="background.html" class="sub-link">Background</a></li>
        <li class="sub-item"><a href="border.html" class="sub-link">Border</a></li>
        <li class="sub-item"><a href="height.html" class="sub-link">Height</a></li>
        <li class="sub-item"><a href="margin.html" class="sub-link">Margin</a></li>
        <li class="sub-item"><a href="padding.html" class="sub-link">Padding</a></li>
        <li class="sub-item"><a href="position.html" class="sub-link">Position</a></li>
        <li class="sub-item"><a href="typography-util.html" class="sub-link">Typography</a></li>
        <li class="sub-item"><a href="width.html" class="sub-link">Width</a></li>
      </ul>
    </li>
    <!-- br-menu-item -->
    <li class="br-menu-item"> <a href="pages.html" class="br-menu-link"> <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i> <span class="menu-item-label">Apps &amp; Pages</span> </a><!-- br-menu-link --> 
    </li>
    <!-- br-menu-item -->
    <li class="br-menu-item"> <a href="layouts.html" class="br-menu-link"> <i class="menu-item-icon icon ion-ios-book-outline tx-22"></i> <span class="menu-item-label">Layouts</span> </a><!-- br-menu-link --> 
    </li>
    <!-- br-menu-item -->
    <li class="br-menu-item"> <a href="sitemap.html" class="br-menu-link"> <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i> <span class="menu-item-label">Sitemap</span> </a><!-- br-menu-link --> 
    </li>
    <!-- br-menu-item -->
  </ul>
  <!-- br-sideleft-menu -->
  
  <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Information Summary</label>
  <div class="info-list">
    <div class="info-list-item">
      <div>
        <p class="info-list-label">Memory Usage</p>
        <h5 class="info-list-amount">32.3%</h5>
      </div>
      <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span> </div>
    <!-- info-list-item -->
    
    <div class="info-list-item">
      <div>
        <p class="info-list-label">CPU Usage</p>
        <h5 class="info-list-amount">140.05</h5>
      </div>
      <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span> </div>
    <!-- info-list-item -->
    
    <div class="info-list-item">
      <div>
        <p class="info-list-label">Disk Usage</p>
        <h5 class="info-list-amount">82.02%</h5>
      </div>
      <span class="peity-bar" data-peity='{ "fill": ["#8E4246"], "height": 35, "width": 60 }'>1,2,1,3,2,10,4,12,7</span> </div>
    <!-- info-list-item -->
    
    <div class="info-list-item">
      <div>
        <p class="info-list-label">Daily Traffic</p>
        <h5 class="info-list-amount">62,201</h5>
      </div>
      <span class="peity-bar" data-peity='{ "fill": ["#9C7846"], "height": 35, "width": 60 }'>3,12,7,9,2,3,4,5,2</span> </div>
    <!-- info-list-item --> 
  </div>
  <!-- info-list --> 
  <br>
</div>
<!-- br-sideleft --> 
<!-- ########## END: LEFT PANEL ########## --> 

<!-- ########## START: HEAD PANEL ########## -->
<div class="br-header">
  <div class="br-header-left">
    <div class="navicon-left hidden-md-down"> <a id="btnLeftMenu" href="#"> <i class="icon ion-navicon-round"></i> </a> </div>
    <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    <div class="input-group hidden-xs-down wd-170 transition">
      <input id="searchbox" type="text" class="form-control" placeholder="Search">
      <span class="input-group-btn">
      <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
      </span> </div>
    <!-- input-group --> 
  </div>
  <!-- br-header-left -->
  <div class="br-header-right">
    <nav class="nav">
      <div class="dropdown"> <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown"> <i class="icon ion-ios-email-outline tx-24"></i> <span class="badge badge-light"> 0 </span> 
        <!-- end: if statement --> 
        </a>
        <div class="dropdown-menu dropdown-menu-header">
          <div class="dropdown-menu-label">
            <label>Messages</label>
            <a href="">+ Add New Message</a> </div>
          <!-- d-flex -->
          
          <div class="media-list">
            <div class="dropdown-footer"> <a href=""><i class="fa fa-angle-down"></i> Show All Messages</a> </div>
          </div>
          <!-- media-list --> 
        </div>
        <!-- dropdown-menu --> 
      </div>
      <!-- dropdown -->
      <div class="dropdown"> <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown"> <i class="icon ion-ios-bell-outline tx-24"></i> 
        <!-- start: if statement --> 
        <span class="badge badge-light"> 0 </span> 
        <!-- end: if statement --> 
        </a>
        <div class="dropdown-menu dropdown-menu-header">
          <div class="dropdown-menu-label">
            <label>Notifications</label>
            <a href="">Mark All as Read</a> </div>
          <!-- d-flex -->
          
          <div class="media-list"> 
            <!-- loop starts here -->
            <div class="dropdown-footer"> <a href=""><i class="fa fa-angle-down"></i> Show All Notifications</a> </div>
          </div>
          <!-- media-list --> 
        </div>
        <!-- dropdown-menu --> 
      </div>
      <!-- dropdown -->
      <div class="dropdown"> <a href="" class="nav-link nav-link-profile" data-toggle="dropdown"> <span class="logged-name hidden-md-down"><?php echo $uname; ?></span> <img src="assets/media/avatar.png" class="wd-32 rounded-circle" alt=""> <span class="square-10 bg-success"></span> </a>
        <div class="dropdown-menu dropdown-menu-header wd-250">
          <div class="tx-center"> <a href=""><img src="assets/media/avatar.png" class="wd-80 rounded-circle" alt=""></a>
            <h6 class="logged-fullname"><?php echo $uname; ?></h6>
            <p>TGT Employee</p>
          </div>
          <hr>
          <div class="tx-center"> <span class="profile-earning-label">Total Sales This Year</span>
            <h3 class="profile-earning-amount">$13,230 <i class="icon ion-ios-arrow-thin-up tx-success"></i></h3>
            <span class="profile-earning-text">Based on list price.</span> </div>
          <hr>
          <ul class="list-unstyled user-profile-nav">
            <li>Last Login: <?php echo date("m/d/y H:i:s", $lastlogin); ?></li>
            <li><a href=""><i class="icon ion-ios-person"></i> Edit Profile</a></li>
            <li><a href=""><i class="icon ion-ios-download"></i> Downloads</a></li>
            <li><a href=""><i class="icon ion-ios-star"></i> Favorites</a></li>
            <li><a href=""><i class="icon ion-ios-folder"></i> Collections</a></li>
            <li><a href="logout.php"><i class="icon ion-power"></i> Sign Out</a></li>
          </ul>
        </div>
        <!-- dropdown-menu --> 
      </div>
      <!-- dropdown --> 
    </nav>
    <div class="navicon-right"> <a id="btnRightMenu" href="" class="pos-relative"><i class="icon ion-ios-gear-outline "> </i> 
      <!-- start: if statement --> 
      <!-- end: if statement --> 
      </a> </div>
    <!-- navicon-right --> 
  </div>
  <!-- br-header-right --> 
</div>
<!-- br-header --> 
<!-- ########## END: HEAD PANEL ########## --> 

<!-- ########## START: RIGHT PANEL ########## -->
<div class="br-sideright">
  <ul class="nav nav-tabs sidebar-tabs" role="tablist">
    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" role="tab" href="#calendar"> <i class="icon ion-ios-clock-outline tx-24"></i></a> </li>
    <li class="nav-item"> <a class="nav-link " data-toggle="tab" role="tab" href="#contacts"><i class="icon ion-ios-contact-outline tx-24"></i></a> </li>
    <li class="nav-item"> <a class="nav-link" data-toggle="tab" role="tab" href="#attachments"><i class="icon ion-ios-folder-outline tx-22"></i></a> </li>
    <li class="nav-item"> <a class="nav-link" data-toggle="tab" role="tab" href="#settings"><i class="icon ion-ios-chatboxes-outline tx-24"></i></a> </li>
  </ul>
  <!-- sidebar-tabs --> 
  <script>
                      </script> 
  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane pos-absolute a-0 mg-t-60 schedule-scrollbar active" id="calendar" role="tabpanel">
      <label class="sidebar-label pd-x-25 mg-t-25">Time &amp; Date</label>
      <div class="pd-x-25">
        <h2 id="brTime" class="br-time"></h2>
        <h6 id="brDate" class="br-date"></h6>
      </div>
      <label class="sidebar-label pd-x-25 mg-t-25">Events Calendar</label>
      <div class="datepicker sidebar-datepicker"></div>
      <label id="TCmessage" class="sidebar-label pd-x-25 mg-t-25">You are <?php echo $punch[$inorout+1]; ?></label>
      <div class="pd-x-25 text-center">
        <button type="button" onClick="punchTimeClock(this)" class="btn btn<?php if($inorout == 1){echo("-outline");} ?>-success btn-block inactive">&nbsp;Clock <?php echo $punch[$inorout]; ?>&nbsp;</button>
        <label class="sidebar-label pd-x-25 mg-t-25">Timesheet Today</label>
        <?php
        $Ohundred = mktime( 0, 0, 0, date( "m" ), date( "d" ), date( "Y" ) );
        foreach ( $punchtimes as $p ) {
          if ( $p > $Ohundred ) {
            $timeat = date( 'm/d/Y H:i', $p );
            echo $timeat . "<br>";
          }
        }

        ?>
      </div>
    </div>
    <!-- #time clock  -->
    
    <div class="tab-pane pos-absolute a-0 mg-t-60 contact-scrollbar " id="contacts" role="tabpanel">
      <label class="sidebar-label pd-x-25 mg-t-25">Online Contacts</label>
      <div id="liveUsers" class="contact-list pd-x-10"> </div>
      <!-- contact-list -->
      
      <label class="sidebar-label pd-x-25 mg-t-25">Offline Contacts</label>
      <div id="offlineUsers" class="contact-list pd-x-10"> 
        <!-- contact-list-link -->
        
        <?php
        echo $livelist;

        echo "<script>const Users = [" . $Users . "'" . $uname . "'];</script>";

        ?>
      </div>
      <!-- contact-list --> 
      
    </div>
    <!-- #contacts -->
    <div class="tab-pane pos-absolute a-0 mg-t-60 attachment-scrollbar" id="attachments" role="tabpanel">
      <label class="sidebar-label pd-x-25 mg-t-25">Recent Attachments</label>
      <div class="media-file-list">
        <div class="media">
          <div class="pd-10 bg-gray-500 bg-mojito wd-50 ht-60 tx-center d-flex align-items-center justify-content-center"> <i class="far fa-file-image tx-28 tx-white"></i> </div>
          <div class="media-body">
            <p class="mg-b-0 tx-13">IMG_43445</p>
            <p class="mg-b-0 tx-12 op-5">JPG Image</p>
            <p class="mg-b-0 tx-12 op-5">1.2mb</p>
          </div>
          <!-- media-body --> 
          <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a> </div>
        <!-- media --> 
        
      </div>
      <!-- media-list --> 
    </div>
    <!-- #history -->
    <div class="tab-pane pos-absolute a-0 mg-t-60 settings-scrollbar" id="settings" role="tabpanel">
      <label class="sidebar-label pd-x-25 mg-t-25">Quick Settings</label>
      <div class="sidebar-settings-item">
        <h6 class="tx-13 tx-normal">Dark Mode</h6>
        <p class="op-5 tx-13">Toggle Bewteen Dark and Light Mode</p>
        <div class="br-switchbutton">
          <input type="hidden" name="switch1" value="false">
          <span></span> </div>
        <!-- br-switchbutton --> 
      </div>
      <div class="sidebar-settings-item">
        <h6 class="tx-13 tx-normal">2 Steps Verification</h6>
        <p class="op-5 tx-13">Sign in using a two step verification by sending a verification code to your phone.</p>
        <div class="br-switchbutton">
          <input type="hidden" name="switch2" value="false">
          <span></span> </div>
        <!-- br-switchbutton --> 
      </div>
      <div class="sidebar-settings-item">
        <h6 class="tx-13 tx-normal">Location Services</h6>
        <p class="op-5 tx-13">Allowing us to access your location</p>
        <div class="br-switchbutton">
          <input type="hidden" name="switch3" value="false">
          <span></span> </div>
        <!-- br-switchbutton --> 
      </div>
      <div class="sidebar-settings-item">
        <h6 class="tx-13 tx-normal">Newsletter Subscription</h6>
        <p class="op-5 tx-13">Enables you to send us news and updates send straight to your email.</p>
        <div class="br-switchbutton ">
          <input type="hidden" name="switch4" value="false">
          <span></span> </div>
        <!-- br-switchbutton --> 
        
      </div>
      <div class="sidebar-settings-item">
        <h6 class="tx-13 tx-normal">Your email</h6>
        <div class="pos-relative">
          <input type="email" name="email" class="form-control" value="">
        </div>
      </div>
      <div class="pd-y-20 pd-x-25">
        <h6 class="tx-13 tx-normal tx-white mg-b-20">More Settings</h6>
        <a href="" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">Account Settings</a> <a href="" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">Privacy Settings</a> </div>
    </div>
    <!-- #quick settings --> 
  </div>
  <!-- tab-content --> 
</div>
<!-- br-sideright --> 
<!-- ########## END: RIGHT PANEL ########## ---> 

<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel ">
  <div class="br-pageheader">
    <nav id="temp" class="navbar pd-0 mg-0 tx-12 container">
      <div class="btn-group col-3" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Employees </button>
          <div class="dropdown-menu bg-light" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="#"> View Activity </a> <a class="dropdown-item" id="addorremoveusers" href="#"> Add/Remove Users </a> </div>
        </div>
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Customers </button>
          <div class="dropdown-menu bg-light" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="#" onClick="buildCustomers()"> Customer View </a> <a class="dropdown-item" href="#"> Customer Add </a> </div>
        </div>
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Inventory </button>
          <div class="dropdown-menu bg-light" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="#"> Adjust Stock </a> <a class="dropdown-item" href="#"> View Menu </a> </div>
        </div>
      </div>
    </nav>
  </div>
  <!-- br-pageheader -->
  <div class="br-pagetitle"> </div>
  <!-- d-flex -->
  <div id="mbodymain" class="br-pagebody container  bg-grandeur">
      
      
    <form id="addUserForm" class="form-horizontal col-8 bg-light py-3" autocomplete="off" onsubmit="return false; preventDefault();">
      <!-- Form Name -->
      <button id="addUserFormClose" type="button" class="btn-close float-right" aria-label="Close">X</button>
      <legend>Add A New User</legend>
      <!-- Prepended text-->
      <div class="form-group">
        <label class="col-md-12 control-label sr-only" for="prependedtext" >Username</label>
        <div class="col-md-12">
          <div class="input-group">
            <input id="uname" class="form-control" placeholder="Username" type="text" required="true" autocomplete=off>
          </div>
          <p class="help-block" id="usernameErrorMessage">Pick A Username</p>
        </div>
      </div>
      
      <!-- Password input-->
      <div class="form-group">
        <label class="col-md-12 control-label sr-only" for="passwordinput">Password Input</label>
        <div class="col-md-12">
          <input id="pword" name="password" type="password" placeholder="placeholder" class="form-control input-md" required="" autocomplete="off" >
          <span class="help-block" id="passwordErrorMessage">Choose a password</span> </div>
      </div>
      
      <!-- Button -->
      <div class="form-group">
        <label class="col-md-12 control-label sr-only" for="passwordGenerator">Password Generator</label>
        <div class="col-md-12">
          <button id="passwordGenerator" name="passwordGenerator" class="btn btn-primary" onclick="preventDefault()">Generate Password</button>
        </div>
      </div>
      
      <!-- Prepended checkbox --> 
      
      <!-- Multiple Radios (inline) -->
      <div class="form-group">
        <label class="col-md-12 control-label" for="privilegeLevel">Privileges</label>
        <span id="privilegeErrorMessage"></span>
        <div class="col-md-12">
          <label class="radio-inline" for="privilegeLevel-0">
            <input type="radio" name="privilegeLevel" id="privilegeLevel-0" value="1" checked="checked">
            New Hire </label>
          <label class="radio-inline" for="privilegeLevel-1">
            <input type="radio" name="privilegeLevel" id="privilegeLevel-1" value="2" autocomplete="off">
            Employee </label>
          <label class="radio-inline" for="privilegeLevel-2">
            <input type="radio" name="privilegeLevel" id="privilegeLevel-2" value="3">
            Manager </label>
          <label class="radio-inline" for="privilegeLevel-3">
            <input type="radio" name="privilegeLevel" id="privilegeLevel-3" value="4" autocomplete="off">
            Secretary </label>
          <label class="radio-inline" for="privilegeLevel-4">
            <input type="radio" name="privilegeLevel" id="privilegeLevel-4" value="5" autocomplete="off">
            Owner </label>
          <label class="radio-inline" for="privilegeLevel-5">
            <input type="radio" name="privilegeLevel" id="privilegeLevel-5" value="6" autocomplete="off">
            Other </label>
        </div>
      </div>
      <button id="addUserButton"  onclick="addNewUserNow()" name="addUserButton" class="btn btn-primary btn-block">Add User</button>
      </fieldset>
    </form>
    
    <!-- br-section-wrapper --> 
  </div>
  <!-- br-pagebody --> 
</div>
<!-- br-mainpanel --> 
<!-- ########## END: MAIN PANEL ########## --> 

<script src="assets/js/jquery.min.js"></script> 
<script src="assets/js/jquery.steps.min.js"></script> 
<script src="assets/js/jquery.peity.min.js"></script> 
<script src="assets/js/datepicker.js"></script> 
<script src="assets/js/highlight.pack.min.js"></script> 

<script src="assets/js/perfect-scrollbar.min.js"></script> 
<script src="assets/js/bootstrap.bundle.min.js"></script> 
<script src="assets/js/bracket.js"></script>
<div class="br-logo pt-1" style="display:block !important; position: fixed !important; left: calc(50% - 100px) !important; top:0px !important;"> <a href="#" style="font-size:.8em"> <span>[</span> THE Great <i> TIMEZ </i> <span>]</span> </a> </div>
<div id="alert1" class="d-none" role="alert" style="z-index: 10000 !important;"></div>
<div id="myModal" class="modal" class="" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title"> </h5>
      <button id="modaBotton" type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
    </div>
    <div class="modal-body">
      <p> </p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
    </div>
  </div>
</div>
</div>
<p></p>
</body>
</html>
<script>
function toBool(figu){
 var yarray = ['yes','1','true','on','','','',''];
 var narray = ['no','0','false','off','','','','','']; 
let yays = yarray.indexOf(figu);
let nays = narray.indexOf(figu);
if(yays > nays){ return true; } 
if(nays > yays){ return false; }     
}
window.addEventListener("DOMContentLoaded", function(){
    
const matches = document.querySelectorAll("div.br-switchbutton"); 

matches[0].addEventListener('click', dmode);
dmode();

    function dmode(togvar){
    if(matches[0].classList.contains("checked")){
    _("darkmode").setAttribute("href",""); 
    document.body.classList.remove("darkmode");
    matches[0].classList.remove("checked");
    localStorage.setItem("darkmode","off")
    }else{
    _("darkmode").setAttribute("href","assets/css/bracket.dark.css"); 
    document.body.classList.add("darkmode");
    matches[0].classList.add("checked");
    localStorage.setItem("darkmode","on")
    }}


$( "#addorremoveusers" ).click(function() {
  $( '#addUserForm' ).slideDown();
});
    

$( "#addUserFormClose" ).click(function() {
  $( '#addUserForm' ).slideUp();
});
        
function getAgo(uni){
    let nownow = new Date();
    return nownow;
}
function goLive()
    {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function()
        {
            parseLive(this.responseText);
        }
        xmlhttp.open("GET", "FlatFileDB/Chat/chatparser.php?liveupdate=yes");
        xmlhttp.send();
        
        function parseLive(rt)
        {
            let tex=rt.trim();
                if(rt.match(/&/ig)){
                    tex=rt.split("&")
                };
            
            
           if(typeof tex == "object"){
            
        for(let i=0;i<tex.length;i++)
        {
           let sl =  tex[i].split("=");
             let ll = document.getElementById(sl[0]+'link');
             let lt = document.getElementById(sl[0]+'text');
                document.getElementById("liveUsers").appendChild(ll);
               if(!ll.classList.contains('LIVE')){ll.classList.add('LIVE');  }
                lt.innerHTML = "seen "+getAgo(sl[1])+"";
        }
       
           }else{
           
           
           
            let sl =  tex.split("=");
             let ll = document.getElementById(sl[0]+'link');
             let lt = document.getElementById(sl[0]+'text');
                lt.innerHTML = "seen "+getAgo(sl[1])+"";  
              document.getElementById("liveUsers").appendChild(ll);
               if(!ll.classList.contains('LIVE')){ll.classList.add('LIVE');  }    
                    
   

                   
           
           
           
           
           }
            

        }
    }
setInterval(function(){ goLive(); },2000);
    
});
    
</script>
<?php }else{ header('location: /signin.php'); } ?>