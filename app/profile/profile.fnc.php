<?php
$idp=null;
$view=FALSE;
if(isset($_REQUEST['idp'])) $idp=$_REQUEST['idp'];
if($idp){
    $dP=detRow('tbl_profile','md5(idp)',$idp);
    if($dP){
        $view=TRUE;
        $id=$dP['idp'];
    }
}
?>