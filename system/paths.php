<?php
$folderBase='/'; //Remoto. '/'; Local. '/Folder/' (Folder in www)
$folderCont=''; //Folder if system is in subdirectory; to local "foldername/" | in remote can be empty ""
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

//$remoteHost='https://mercoframes.com/';
//$RAIZr=$remoteHost;
$RAIZ=$protocolS.'://'.$hostType.$folderBase.$folderCont;
$RAIZm=$RAIZ.'mods/';
$RAIZa=$RAIZ.'assets/';
$RAIZs=$RAIZ.'system/';
$RAIZi=$RAIZ.'images/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZd=$RAIZ.'data/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZdb=$RAIZ.'data/db/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZdit=$RAIZ.'data/db/inv_types/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZidb=$RAIZi.'db/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZidbP=$RAIZi.'items/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZidbC=$RAIZi.'cats/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZidbF=$RAIZi.'frame/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZidbT=$RAIZi.'types/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZidbF_s=$RAIZidbF.'small/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZidbF_b=$RAIZidbF.'big/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ
$RAIZidbF_f=$RAIZidbF.'full/';//Use Temporal $RAIZr to load remote images to local view - > in remote change by $RAIZ

//echo 'RAIZ: '.RAIZ.'<br>';
//echo '$RAIZ: '.$RAIZ.'<br>';
?>