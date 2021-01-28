<?php
$view=FALSE;
if($_REQUEST['url']) $url=$_REQUEST['url'];
if($url){
    $row=detRow('tbl_profile','url',$url);
    if($row){
        $view=TRUE;
        $qlN=sprintf("SELECT * FROM tbl_network 
        INNER JOIN tbl_network_tip ON tbl_network.idnt=tbl_network_tip.idnt
        WHERE idp=%s AND tipo=%s  ORDER BY ord ASC",
        SSQL($row['idp'],'int'),
        SSQL('s','text'));
        //echo $qlN;
        $RSln = mysqli_query($conn,$qlN) or die(mysqli_error($conn));
        $dRSln = mysqli_fetch_assoc($RSln);
        $tRSln = mysqli_num_rows($RSln);

        $qlD=sprintf("SELECT * FROM tbl_network 
        INNER JOIN tbl_network_tip ON tbl_network.idnt=tbl_network_tip.idnt
        WHERE idp=%s AND tipo=%s  ORDER BY ord ASC",
        SSQL($row['idp'],'int'),
        SSQL('d','text'));
        $RSld = mysqli_query($conn,$qlD) or die(mysqli_error($conn));
        $dRSld = mysqli_fetch_assoc($RSld);
        $tRSld = mysqli_num_rows($RSld);

        $qlG=sprintf("SELECT * FROM tbl_profile_game WHERE idp=%s",
        SSQL($row['idp'],'int'));
        $RSlg = mysqli_query($conn,$qlG) or die(mysqli_error($conn));
        $dRSlg = mysqli_fetch_assoc($RSlg);
        $tRSlg = mysqli_num_rows($RSlg);

        $qlP=sprintf("SELECT * FROM tbl_post WHERE idp=%s",
        SSQL($row['idp'],'int'));
        $RSlp = mysqli_query($conn,$qlP) or die(mysqli_error($conn));
        $dRSlp = mysqli_fetch_assoc($RSlp);
        $tRSlp = mysqli_num_rows($RSlp);
    }
}
?>