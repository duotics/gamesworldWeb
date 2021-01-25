<?php
# Type="MYSQL"
# HTTP="true"
defined('_JEXEC') or die('Restricted access');//comprueba si la constante esta definida

$hostname_conn = "localhost";//localhost /mercoframes.com
$database_conn = "gameswor_web";// merco_web
$username_conn = "gameswor_usr0";//root / merco_web1
$password_conn = "[uIo{sZHDAKnfHk1CD";//rootroot / wn=0FsL8aT[*5^f1[t
/*
$hostname_conn = "mercoframes.com:3306";//localhost /mercoframes.com
$database_conn = "merco_web";// merco_web
$username_conn = "merco_web1";//root / merco_web1
$password_conn = "wn=0FsL8aT[*5^f1[t";//rootroot / wn=0FsL8aT[*5^f1[t
*/
/*
$hostname_conn = "localhost";//localhost /mercoframes.com
$database_conn = "merco_web";// merco_web
$username_conn = "merco_web1";//root / merco_web1
$password_conn = "wn=0FsL8aT[*5^f1[t";//rootroot / wn=0FsL8aT[*5^f1[t
*/
if(!isset($conn)){
	$conn = mysqli_connect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysqli_error($conn),E_USER_ERROR);
	mysqli_select_db($conn, $database_conn);
	mysqli_query($conn, "SET NAMES 'utf8'"); 
}
?>