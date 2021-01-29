<?php
$folderBase='/'; //Remoto. '/'; Local. '/Folder/' (Folder in www)
$folderCont='gamesworldWeb/'; //Folder if system is in subdirectory; to local "foldername/" | in remote can be empty ""
//$folderCont='';
$serverRoot=$_SERVER['DOCUMENT_ROOT'];
$hostType=$_SERVER['HTTP_HOST']; //Remoto. 'www.'; Local. 'localhost/'
if (isset($_SERVER['HTTPS'])) $protocolS='https';
else $protocolS='http';

define('RAIZ',$serverRoot.$folderBase.$folderCont);
define('RAIZm',RAIZ.'mods/');
define('RAIZf',RAIZ.'frames/');
define('RAIZa',RAIZ.'assets/');
define('RAIZi',RAIZ.'images/');
define('RAIZs',RAIZ.'system/');
define('RAIZd',RAIZ.'data/');
define('RAIZv',RAIZ.'vendor/');

$RAIZ=$protocolS.'://'.$hostType.$folderBase.$folderCont;
$RAIZm=$RAIZ.'mods/';
$RAIZa=$RAIZ.'assets/';
$RAIZv=$RAIZ.'vendor/';
$RAIZs=$RAIZ.'system/';
$RAIZi=$RAIZ.'images/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZd=$RAIZ.'data/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZdb=$RAIZ.'data/db/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ

//echo 'RAIZ: '.RAIZ.'<br>';
//echo '$RAIZ: '.$RAIZ.'<br>';
?>