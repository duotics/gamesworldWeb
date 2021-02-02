<?php require('../../../init.php');
$idp=null;
$tip=null;
if(isset($_GET['idp'])) $idp=$_GET['idp'];
if(isset($_GET['tip'])) $tip=$_GET['tip'];

$qry=sprintf("SELECT DISTINCT tbl_profile_game.idg, tbl_games.name, tbl_hits.date, tbl_hits.hits 
FROM tbl_profile_game 
INNER JOIN tbl_hits ON tbl_profile_game.idg=tbl_hits.ref
INNER JOIN tbl_games ON tbl_profile_game.idg=tbl_games.idg
WHERE tbl_profile_game.idp=%s AND tbl_hits.sec=%s
GROUP BY tbl_games.name, tbl_hits.date
ORDER BY tbl_hits.id DESC",
SSQL($idp,'int'),
SSQL($tip,"text"),
SSQL("2021-01","text"),
SSQL("2021-12","text"));
//echo $qry;
$RS=mysqli_query($conn,$qry) or die (mysqli_error($conn));
$dRS=mysqli_fetch_assoc($RS);
$tRS=mysqli_num_rows($RS);

$emparray = array();
//$array=[];
if($tRS>0){
    $x=0;
    do{
        $emparray['hits'][$x] = $dRS['hits'];
        $emparray['name'][$x] = $dRS['name']." ".$dRS['date'];
        $x++;
    }while($dRS=mysqli_fetch_assoc($RS));

}
echo (json_encode($emparray));
?>