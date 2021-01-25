<?php
function updHits($table,$fieldHits,$fieldId,$val){//v.1.2
	global $conn;
	$ret=NULL;
	$vP=FALSE;
	$LOG=null;
	$qry=sprintf('UPDATE %s SET %s=%s+1 WHERE %s=%s LIMIT 1',
	SSQL(strip_tags($table),''),
	SSQL(strip_tags($fieldHits),''),
	SSQL(strip_tags($fieldHits),''),
	SSQL(strip_tags($fieldId),''),
	SSQL($val,'text'));
	if(mysqli_query($conn,$qry)){
		$LOG.='Hits updated';
		$vP=TRUE;
	}else{
		$LOG.=mysqli_error($conn);
	}
	$ret['log']=$LOG;
	$ret['est']=$vP;
	return $ret;
}
function updHitsH($paramRef,$paramSec){//v.0.1
	$LOG=null;
	$sdateYM=null;
	$dateYM=null;
	$pHits=null;
	$userAgent=$_SERVER['HTTP_USER_AGENT'];
	$vB=containsBots($userAgent);//Verifico si el HTTP USER AGENT contiene una palabra relacionada a Bots/
	if(!$vB['est']){//Si no contiene una palabra relacionada a Bots Almanacena
	
		global $conn;
		$ret=NULL;
		$vP=FALSE;
		$dateYM=$GLOBALS['sdateYM'];
		$dateTimeNow=$GLOBALS['sdatet'];
		$user_ip = getUserIP();

		$paramsN[]=array(
			array("cond"=>"AND","field"=>"obs","comp"=>"=","val"=>$userAgent),
			array("cond"=>"AND","field"=>"ref","comp"=>"=","val"=>$paramRef),
			array("cond"=>"AND","field"=>"sec","comp"=>"=","val"=>$paramSec),
			array("cond"=>"AND","field"=>"date","comp"=>"=","val"=>$dateYM),
			array("cond"=>"AND","field"=>"ip","comp"=>'=',"val"=>$user_ip)
		);//CONDICIONES CAMPO URL e ID tabla
		$dHitExist=detRowNP('db_hits',$paramsN);
		if($dHitExist){
			$minTrans=minutosTranscurridos($dHitExist['last'],$dateTimeNow);
			if($minTrans>0){
				$pHits=TRUE;
			}
		}else{
			$pHits=TRUE;
		}
		//var_dump($dHitExist);
		if($pHits){
			$qry=sprintf('INSERT INTO db_hits (ref, sec, date, ip, last, obs, hits) VALUES (%s, %s, %s, %s, %s, %s, 1)
			ON DUPLICATE KEY UPDATE hits = hits+1, ip=%s, last=%s, obs=%s',
			SSQL($paramRef,'int'),
			SSQL($paramSec,'text'),
			SSQL($dateYM,'text'),
			SSQL($user_ip,'text'),
			SSQL($dateTimeNow,'text'),
			SSQL($userAgent,'text'),
			//KEY UPDATE
			SSQL($user_ip,'text'),
			SSQL($dateTimeNow,'text'),
			SSQL($userAgent,'text'));
			if(mysqli_query($conn,$qry)){
				$LOG.='Hits updated';
				$vP=TRUE;
			}else{
				$LOG.=mysqli_error($conn);
			}
		}else{
			$LOG.='No Update - too short time betwee visits - '.$dateTimeNow;
		}
	}
	
	$ret['log']=$LOG;
	$ret['est']=$vP;
	return $ret;
}
//EXAMPLE
//Datos de una TABLA / CAMPO / CONDICION
function totRows($table,$field,$param){
	$qry = sprintf("SELECT COUNT(*) as TR FROM %s WHERE %s = %s",
	SSQL($table, ''),
	SSQL($field, ''),
	SSQL($param, "text"));
	$RS = mysqli_query($conn,$qry) or die(mysqli_error($conn)); 
	$dRS = mysqli_fetch_assoc($RS); 
	return ($dRS['TR']); 
	mysqli_free_result($RS);
}
function totRowsTab($table,$field=NULL,$param=NULL,$cond='='){//v.1.1
	Global $conn;
	// $table -> Table database
	// $field -> Campo cond
	if(($field)&&($param)){
		$qryCond=sprintf(' WHERE %s %s %s',
						SSQL($field,''),
						SSQL($cond,''),
						SSQL($param,'text'));
	}
	$qry = sprintf('SELECT COUNT(*) AS TR FROM %s '.$qryCond,
	SSQL($table,''));
	$RS = mysqli_query($conn,$qry) or die(mysqli_error($conn));
	$dRS = mysqli_fetch_assoc($RS);
	return ($dRS['TR']);/*SHow me a integer value (count) of parameters*/
}
/**/
function detRow($table,$field,$param,$foN=NULL, $foF='ASC'){//v2.0
	Global $conn;
	$paramOrd=null;
	if($foN) $paramOrd='ORDER BY '.$foN.' '.$foF;
	$qry = sprintf("SELECT * FROM %s WHERE %s = %s ".$paramOrd.' LIMIT 1',
				   SSQL($table, ''),
				   SSQL($field, ''),
				   SSQL($param, "text"));
	//echo $qry;			   
	$RS = mysqli_query($conn,$qry) or die(mysqli_error($conn)); $dRS = mysqli_fetch_assoc($RS); 
	mysqli_free_result($RS); return ($dRS);
}
/**/
function detRowGSel($table,$fieldID,$fieldVal,$field,$param,$ord=FALSE,$valOrd=NULL,$ascdes='ASC'){//v1.2
	Global $conn;
	if($ord){
		if(!($valOrd)) $orderBy='ORDER BY '.' sVAL '.$ascdes;
		else $orderBy='ORDER BY '.$valOrd.' '.$ascdes;
	}
	$qry = sprintf('SELECT %s as sVAL, %s AS sID FROM %s WHERE %s=%s %s',
	SSQL($fieldVal,''),
	SSQL($fieldID,''),
	SSQL($table,''),
	SSQL($field,''),
	SSQL($param,'text'),
	SSQL($orderBy,''));
	$RS = mysqli_query($conn,$qry) or die(mysqli_error($conn)); 
	return ($RS); mysqli_free_result($RS);
}
/**/
function detRowGSelNP($table,$fieldID,$fieldVal,$params,$ord=FALSE,$valOrd=NULL,$ascdes='ASC'){//v1.0
	global $conn;
	$lP=null;
	if($params){
		foreach($params as $x => $dat) {
			foreach($dat as $y => $xVal){
				$lP.=$xVal['cond'].' '.$xVal['field'].' '.$xVal['comp'];
				if($xVal['val']){
					$lP.=' "'.$xVal['val'].'" ';
				}
			}
		}
	}
	if($ord){
		if(!($valOrd)) $orderBy='ORDER BY '.' sVAL '.$ascdes;
		else $orderBy='ORDER BY '.$valOrd.' '.$ascdes;
	}
	$qry = sprintf('SELECT %s AS sID, %s as sVAL FROM %s WHERE 1=1 '.$lP.' %s',
	SSQL($fieldID,''),
	SSQL($fieldVal,''),
	SSQL($table,''),
	SSQL($orderBy,''));
	$RS = mysqli_query($conn,$qry) or die(mysqli_error($conn)); 
	return ($RS); mysqli_free_result($RS);
}
/**/
function detRowO($table,$field,$param,$fieldo,$order){ 
	$qry = sprintf("SELECT * FROM %s WHERE %s = %s ORDER BY %s %s",
	SSQL($table, ''),
	SSQL($field, ''),
	SSQL($param, "text"),
	SSQL($fieldo, ''),
	SSQL($order, ''));
	$RS = mysqli_query($conn,$qry) or die(mysqli_error($conn)); 
	$row_RS = mysqli_fetch_assoc($RS);
	return ($row_RS); mysqli_free_result($RS);
}
function genSelect($nom=NULL, $RS, $sel=NULL, $class=NULL, $opt=NULL, $id=NULL, $placeHolder=NULL, $showIni=TRUE, $valIni=NULL, $nomIni="Select"){//v.4.0
	if($RS){
	$dRS = mysqli_fetch_assoc($RS);
	$tRS = mysqli_num_rows($RS);
		
	if(!isset($id))$id=$nom;
	if (!$nom) $nom="select";
	echo '<select name="'.$nom.'" id="'.$id.'" class="'.$class.'" data-placeholder="'.$placeHolder.'" '.$opt.'>';
	
	if($showIni==TRUE){
		echo '<option value="'.$valIni.'"';
		if (!$sel) {echo "selected=\"selected\"";}
		echo '>'.$nomIni.'</option>';	
	}
	
	if($tRS>0){
	do {
		$grpAct=$dRS['sGRUP'];
		if(($grpSel!=$grpAct)&&($grpAct)){		
			if($banG==true) echo '</optgroup>'; 
			echo '<optgroup label="'.$dRS['sGRUP'].'">';
			$grpSel=$grpAct;
			$banG=true;
		}
		echo '<option value="'.$dRS['sID'].'"'; 
		if(is_array($sel)){ if(in_array($dRS['sID'],$sel)){ echo 'selected="selected"'; }
		}else{ if (!(strcmp($dRS['sID'], $sel))) {echo 'selected="selected"';} }
		?>
		<?php echo '>'.$dRS['sVAL'].'</option>';
	} while ($dRS = mysqli_fetch_assoc($RS));
	if($banG==true) echo '</optgroup>';
	$rows = mysqli_num_rows($RS);
	if($rows > 0) {
		mysqli_data_seek($RS, 0);
		$dRSe = mysqli_fetch_assoc($RS);
	}
	}
	echo '</select>';
	
	mysqli_free_result($RS);
	}else{
		echo '<span class="label label-danger">Error genSelect : '.$nom.'</span>';
	}
}
function genSelectManual($nom=NULL, $data, $sel=NULL, $class=NULL, $opt=NULL, $id=NULL, $placeHolder=NULL, $showIni=TRUE, $valIni=NULL, $nomIni='Select'){//v.3.2 
	if($data){	
	if(!isset($id))$id=$nom;
	if (!$nom) $nom="select";
	echo '<select name="'.$nom.'" id="'.$id.'" class="'.$class.'" data-placeholder="'.$placeHolder.'" '.$opt.'>';
	
	if($showIni==TRUE){
		echo '<option value=""';
		if (!$sel) {echo "selected=\"selected\"";}
		echo '>'.$valIni.'</option>';	
	}
	foreach($data as $xid => $xval){
		echo '<option value="'.$xval.'"'; 
		if(is_array($sel)){ if(in_array($xval,$sel)) echo 'selected="selected"'; }
		else{ if (!(strcmp($xval, $sel))) echo 'selected="selected"'; }
		echo '>'.$xid.'</option>';
	}
	echo '</select>';
	}else{
		echo '<span class="label label-danger">Error genSelectManual : '.$nom.'</span>';
	}
}
?>