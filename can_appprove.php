<?php
session_start(); //makes $_SESSION available on this page

$can_approve = array('ldevereux','rbest','tclavell','ddouillard','jengel');

if($_SESSION['username'] == 'rcuda') {
$afname = 'Ryan';
$alname = 'Cuda';
}

if($_SESSION['username'] == 'tclavell') {
$afname = 'Troy';
$alname = 'Clavell';
}
if($_SESSION['username'] == 'ldevereux') {
$afname = 'Liz';
$alname = 'Devereux';
}
if($_SESSION['username'] == 'jengel') {
$afname = 'Jade';
$alname = 'Engel';
}
if($_SESSION['username'] == 'ddouillard') {
$afname = 'Doug';
$alname = 'Douillard';
}
if($_SESSION['username'] == 'rbest') {
$afname = 'Rich';
$alname = 'Best';
}

?>