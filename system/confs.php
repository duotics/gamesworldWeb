<?php
$wTit='GamesWorld';

date_default_timezone_set('America/New_York');
setlocale(LC_ALL,"US");
$sdateYM=date('Y-m');
$sdate=date('Y-m-d');
$sdatet=date('Y-m-d H:i:s');

if(isset($_SESSION['urlc']))$_SESSION['urlp']=$_SESSION['urlc'];
if(isset($_SESSION['urlcB']))$_SESSION['urlpB']=$_SESSION['urlcB'];
$_SESSION['urlc']=basename($_SERVER['SCRIPT_FILENAME']);//URL clean Current;
$_SESSION['urlcB']=$_SERVER["REQUEST_URI"];
if(isset($_SESSION['urlp'])) $url['p']=$_SESSION['urlp'];
if(isset($_SESSION['urlpB'])) $url['pB']=$_SESSION['urlpB'];
if(isset($_SESSION['urlc'])) $url['c']=$_SESSION['urlc'];
if(isset($_SESSION['urlcB'])) $url['cB']=$_SESSION['urlcB'];
?>