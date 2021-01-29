<?php 
$str=null;
$tRSss=null;
$tRSsg=null;
$tRt=null;
if(isset($_REQUEST['str'])) $str=$_REQUEST['str'];
if($str){
    $qSS=sprintf("SELECT * FROM tbl_profile WHERE name LIKE %s OR url LIKE %s OR rname LIKE %s",
    SSQL('%'.$str.'%','text'),
    SSQL('%'.$str.'%','text'),
    SSQL('%'.$str.'%','text'));
    $RSss = mysqli_query($conn,$qSS) or die(mysqli_error($conn));
    $dRSss = mysqli_fetch_assoc($RSss);
    $tRSss = mysqli_num_rows($RSss);

    $qSG=sprintf("SELECT * FROM tbl_games WHERE url LIKE %s OR name LIKE %s",
    SSQL('%'.$str.'%','text'),
    SSQL('%'.$str.'%','text'));
    $RSsg = mysqli_query($conn,$qSG) or die(mysqli_error($conn));
    $dRSsg = mysqli_fetch_assoc($RSsg);
    $tRSsg = mysqli_num_rows($RSsg);

    $tRt=$tRSss+$tRSsg;
}
?>