<?php

$qGT=sprintf("SELECT DISTINCT tbl_games.idg, tbl_games.name, tbl_games.img, tbl_games.url FROM tbl_games LEFT JOIN tbl_hits ON tbl_games.idg=tbl_hits.ref WHERE sec=%s ORDER BY hits DESC LIMIT 20",
SSQL("gm","text"));
//PROBLEM WITH DATE HITS BEFORE QRY HAS
//$qGT=sprintf("SELECT * FROM tbl_games LEFT JOIN tbl_hits ON tbl_games.idg=tbl_hits.ref WHERE sec=%s AND date=%s ORDER BY hits DESC LIMIT 20",
//SSQL("gm","text"),
//SSQL(getFecActFormat("Y-m"),"text"));

$RSgt = mysqli_query($conn,$qGT) or die(mysqli_error($conn));
$dRSgt = mysqli_fetch_assoc($RSgt);
$tRSgt = mysqli_num_rows($RSgt);

?>