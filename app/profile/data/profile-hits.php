<?php require('../../../init.php');
$idp=null;
$tip=null;
if(isset($_GET['idp'])) $idp=$_GET['idp'];
if(isset($_GET['tip'])) $tip=$_GET['tip'];

$qry=sprintf("SELECT date, hits FROM tbl_hits WHERE ref=%s and sec=%s AND date>=%s AND date<=%s ORDER BY date ASC",
SSQL($idp,'int'),
SSQL($tip,"text"),
SSQL("2021-01","text"),
SSQL("2021-12","text"));
$RS=mysqli_query($conn,$qry) or die (mysqli_error($conn));
$dRS=mysqli_fetch_assoc($RS);
$tRS=mysqli_num_rows($RS);

$emparray = array();
if($tRS>0){
    $x=0;
    do{
        $emparray['hits'][$x] = $dRS['hits'];
        $emparray['date'][$x] = $dRS['date'];
        $x++;
    }while($dRS=mysqli_fetch_assoc($RS));

}
echo (json_encode($emparray));
?>