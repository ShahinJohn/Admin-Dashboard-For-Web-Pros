<?php

$people = array("JOE");
$people[] ="sarah";
$people[] ="steven";
$people[] ="joseph";
$people[] ="tarrrance";
$people['tarrrance'][] ="1";
$people['tarrrance'][] ="2";
$people['tarrrance'][] ="3";
$people['tarrrance'][] ="4";
$people['tarrrance'][] ="5";

print_r($people['tarrrance']);
?>