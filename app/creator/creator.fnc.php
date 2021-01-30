<?php
$qST=sprintf("SELECT * FROM tbl_profile LEFT JOIN tbl_hits ON tbl_profile.idp=tbl_hits.ref WHERE sec=%s AND date=%s ORDER BY hits DESC LIMIT 20",
SSQL("pr","text"),
SSQL(getFecActFormat("Y-m"),"text"));

$RSst = mysqli_query($conn,$qST) or die(mysqli_error($conn));
$dRSst = mysqli_fetch_assoc($RSst);
$tRSst = mysqli_num_rows($RSst);
?>