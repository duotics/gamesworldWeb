<?php
$view=FALSE;
if($_REQUEST['game']) $game=$_REQUEST['game'];
if($game){
    $row=detRow('tbl_games','url',$game);
    if($row){
        $view=TRUE;
        /*$qlS=sprintf("SELECT * FROM tbl_profile_game WHERE idg=%s ORDER BY idpg ASC LIMIT 10",
        SSQL($row['idg'],'int'));*/

        $qlS=sprintf("SELECT * FROM tbl_profile_game LEFT JOIN tbl_hits ON tbl_profile_game.idp=tbl_hits.ref WHERE idg=%s AND sec=%s AND date=%s ORDER BY hits DESC LIMIT 20",
        SSQL($row['idg'],'int'),
        SSQL("pr","text"),
        SSQL(getFecActFormat("Y-m"),"text"));

        $RSls = mysqli_query($conn,$qlS) or die(mysqli_error($conn));
        $dRSls = mysqli_fetch_assoc($RSls);
        $tRSls = mysqli_num_rows($RSls);
    }
}
?>