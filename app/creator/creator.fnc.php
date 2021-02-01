<?php
$param['c']=null;
$param['g']=null;
$param['s']=null;
$idc=null;
$idg=null;
$ids='top';
if(isset($_REQUEST['idc'])&&($_REQUEST['idc']!="all")&&($_REQUEST['idc']!="")){
    $param['c']=' AND tbl_country.iso="'.$_REQUEST['idc'].'"';
    $idc=$_REQUEST['idc'];
}
if(isset($_REQUEST['idg'])&&($_REQUEST['idg']!="all")&&($_REQUEST['idg']!="")){
    $param['g']=' AND tbl_games.url="'.$_REQUEST['idg'].'"';
    $idg=$_REQUEST['idg'];
}
if(isset($_REQUEST['s'])){
    $ids=$_REQUEST['s'];
    switch($_REQUEST['s']){
        case 'new':
            $param['s']="ORDER BY tbl_profile.idp DESC ";
        break;
        case 'az':
            $param['s']="ORDER BY tbl_profile.name ASC ";
        break;
        case 'za':
            $param['s']="ORDER BY tbl_profile.name DESC ";
        break;
        case 'min':
            $param['s']="ORDER BY hits ASC ";
        break;
        default:
        $param['s']="ORDER BY hits DESC ";
    }
}else{
    $param['s']="ORDER BY hits DESC ";
}

$qST=sprintf("SELECT DISTINCT tbl_profile.idp, tbl_profile.name, tbl_profile.url, tbl_profile.logo, tbl_country.idc, tbl_country.iso 
FROM tbl_profile 
LEFT JOIN tbl_hits ON tbl_profile.idp=tbl_hits.ref 
LEFT JOIN tbl_country ON tbl_profile.idc = tbl_country.idc 
LEFT JOIN tbl_profile_game ON tbl_profile.idp = tbl_profile_game.idp 
LEFT JOIN tbl_games ON tbl_profile_game.idg = tbl_games.idg 
WHERE sec=%s ".$param['c']." ".$param['g']." ".$param['s'].
" LIMIT 20",
SSQL("pr","text"),
SSQL(getFecActFormat("Y-m"),"text"));
$RSst = mysqli_query($conn,$qST) or die(mysqli_error($conn));
$dRSst = mysqli_fetch_assoc($RSst);
$tRSst = mysqli_num_rows($RSst);

$qLP=sprintf("select DISTINCT LCASE(tbl_country.iso) as sID, tbl_country.nicename as sVAL 
FROM tbl_country INNER JOIN tbl_profile 
ON tbl_country.idc = tbl_profile.idc
ORDER BY nicename ASC");
$RSlp = mysqli_query($conn,$qLP) or die(mysqli_error($conn));

$qLG=sprintf("select DISTINCT tbl_games.url as sID, tbl_games.name as sVAL 
FROM tbl_games INNER JOIN tbl_profile_game 
ON tbl_games.idg = tbl_profile_game.idg
ORDER BY name ASC");
$RSlg = mysqli_query($conn,$qLG) or die(mysqli_error($conn));
?>