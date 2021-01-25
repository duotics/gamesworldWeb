<?php
ini_set('allow_url_fopen',1);
/*Verify Category Cont True*/
function verifyCatContHistory($idc){
	$verStat=TRUE;
	$statRepeat=0;
	do{
		$detCat=detRow('tbl_items_cats','cat_id',$idc);
		$idc=$detCat['cat_id_parent'];
		if(($idc==0)||(!$idc))$statRepeat=1;
		if($detCat['cat_status']==0) $verStat=FALSE;
	}while($statRepeat==0);
	return $verStat;
}
/*Breadcrumb Generate*/
function genBrdc($type,$id,$sel=NULL){
	$ret=null;//variable de retorno
	$ret_lil=null;//almacena los hijos <li> de <ul>
	$ret_li='<li class="breadcrumb-item"><a href="'.$GLOBALS['RAIZ'].'">Home</a></li>';//first <li>
	//BREADCRUMB CATALOG
	if(($type=='item')||($type=='cat')){
		if($type=='item'){
			$detI=detRow('tbl_items','item_id',$id);
			$ret_lil='<li class="breadcrumb-item">'.$detI['item_cod'].'</li>';
			$detIC=detRow('tbl_items_type_vs','item_id',$id);
			$id=$detIC['typID'];
		}
		$loop=TRUE;
		$cloop=0;
		$detC_idp=$id;
		do{
			$detC=detRow('tbl_items_type','typID',$detC_idp);
			$detC_id=$detC['typID'];
			$detC_nom=$detC['typNom'];
			$detC_idp=$detC['typIDp'];
			if($detC_id==1) $detC_nom='Products';
			$ret_lil='<li class="breadcrumb-item"><a href="'.$GLOBALS['RAIZ'].'c/'.$detC['typUrl'].'">'.$detC_nom.'</a></li>'.$ret_lil;
			if(($detC_idp==NULL)||($cloop>='100')) $loop=FALSE;
			$cloop++;
		}while($loop==TRUE);
	}
	//BREADCRUMB OTHER
	if($sel)$ret_li.='<li class="breadcrumb-item active">'.$sel.'</li>';
	//CONCAT BREADCRUMB
	$ret='<nav aria-label="breadcrumb">';
	$ret.='<ol class="breadcrumb">';
	$ret.=$ret_li;
	$ret.=$ret_lil;
	$ret.='</ol>';
	$ret.='</nav>';
	return $ret;
}
function fnc_franew($param1){
	$query_RS_datos = "SELECT item_date FROM tbl_items WHERE item_id='".$param1."'";
	$RS_datos = mysqli_query($conn,$query_RS_datos) or die(mysqli_error($conn));
	$row_RS_datos = mysqli_fetch_assoc($RS_datos);
	$totalRows_RS_datos = mysqli_num_rows($RS_datos);
	$fechasys=time(); 
	$datenow=date("Y-m-d", $fechasys);//FECHA SISTEMA
	$dateframe=$row_RS_datos["item_date"]; // FECHA FRAME
	$f1 = explode("-", $datenow);
	$f2 = explode("-", $dateframe);
	$timestamp1 = mktime(0,0,0,$f1[1],$f1[2],$f1[0]); $timestamp2 = mktime(0,0,0,$f2[1],$f2[2],$f2[0]); 
	$segundos_diferencia = $timestamp1 - $timestamp2; 
	//convierto segundos en días 
	$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 
	//obtengo el valor absoulto de los días (quito el posible signo negativo) 
	$dias_diferencia = abs($dias_diferencia); 
	//quito los decimales a los días de diferencia 
	$dias_diferencia = floor($dias_diferencia); 
	if ($dias_diferencia<90) return (TRUE); else return (FALSE);
	mysqli_free_result($RS_datos);
}
function fnc_typlink($lcod, $lnom, $lali, $ldes, $ltyp){
	$link;
	if(($ltyp=="0")||($ltyp=="1"))//link
		$link="<a href='#' onclick='alert(".'"Under Construction"'.")'>".$lnom." <span style='font-size:70%; color:#888;'>[ Under Construction ]</span>"."</a><br />";
	if(($ltyp=="2")||($ltyp=="3")||($ltyp=="4")||($ltyp=="6"))//catalog, html, iframe, adgallery
		$link="<a href='".$RAIZ."category/".$lali."' style='text-decoration:none'>".$lnom."</a><br />";
	if($ltyp=="5")//link
		$link='<a href="'.$ldes.'" target="_blank">'.$lnom.' <i class="icon-resize-full"></i> <span class="muted" style="font-weight:normal">'.$ldes.'</span></a>';
	return $link;
}

function genValBrand($idb,$res=NULL){
$RAIZic=$GLOBALS['RAIZi'].'brand/';
$detB=detRow('tbl_items_brands','id',$idb);
	if($res=='image'){
		$result = '<img src="'.$RAIZic.$detB['img'].'" alt="'.$detCat['nom'].'" style="max-width:100px; max-height:50px;" class="img-thumbnail"/>';
	} else if($res=='text'){ $result = $detB['nom'];
	}else{ $result = 'NULL'; }
return($result);
}

/*************** TYPE GROUP *******************/
function genBtnTypG($det,$paramBrand=NULL,$imgCssMaxHeight='90px', $cssCardH='100'){
	global $conn;
	$ret=null;
	$link_opt=null;
	$det['c_nom_upper']=strtoupper($det['c_nom']);
	if($paramBrand){
		$dBrand=detRow('tbl_items_brands','url',$paramBrand);
		$qbrand=sprintf('AND tbl_items_brands.url=%s',SSQL($paramBrand,'text'));
		$query_RSvi = sprintf("SELECT tbl_items.item_id AS i_id, tbl_items.item_cod AS i_cod, tbl_items.item_aliasurl AS i_url, tbl_items.item_img AS i_img, tbl_items.item_date as i_date, tbl_items.item_status as i_stat, tbl_items_type.typUrl AS c_url, tbl_items_brands.name as b_nom, tbl_items_brands.URL as b_url, tbl_items_brands.img AS b_img FROM tbl_items_type_vs
		LEFT JOIN tbl_items ON tbl_items_type_vs.item_id=tbl_items.item_id
		LEFT JOIN tbl_items_type ON tbl_items_type_vs.typID=tbl_items_type.typID
		LEFT JOIN tbl_items_brands ON tbl_items.brand_id=tbl_items_brands.id
		WHERE tbl_items_type_vs.typID=%s AND tbl_items.item_status=1 AND tbl_items_brands.status=1 ".$qbrand." ORDER BY tbl_items.item_hits DESC LIMIT 1",
							  SSQL($det['c_id'], 'int'));
		$RSvi = mysqli_query($conn,$query_RSvi) or die(mysqli_error($conn));
		$row_RSvi = mysqli_fetch_assoc($RSvi);
		$TR_RSvi = mysqli_num_rows($RSvi);
		$vImg=vImg('data/db/inv_prod/',$row_RSvi['i_img'],TRUE,'_t');
		$sImg='<img src="'.$vImg['n'].'" alt="'.$det['c_nom_upper'].'" class="card-img" style="max-height:'.$imgCssMaxHeight.'"/>';
	}else{
		$vImg=vImg('data/db/inv_types/',$det['c_img'],TRUE,'_t');
		$sImg='<img src="'.$vImg['n'].'" alt="'.$det['c_nom_upper'].'" class="card-img" style="max-height:'.$imgCssMaxHeight.'"/>';
	}
	switch ($det['c_typ']) {//Construct URL
		case 1://Under Construcction
			$link_opt='onclick="alert('."'Under Construction'".')"'; $link_url='#'; break;
		case 2://Catalog
			$link_url=$GLOBALS["RAIZ"].'c/'.$det['c_url'].'/'.$paramBrand; $link_trg='_self'; break;
		case 3://External
			$link_url=$det['c_des']; $link_trg='_blank'; break;
		default: //No View
	}
	$ret=NULL;
	$ret.='<a href="'.$link_url.'" target="'.$link_trg.'" id="c_'.$det['c_id'].'" '.$link_opt.' class="vcat-cat d-block">';
	$ret.='<div class="card card-secondary h-'.$cssCardH.'">';
	$ret.='<div class="card-header text-center">'.$det['c_nom_upper'].'</div>';
	$ret.=$sImg;
	$ret.='</div></a>';
	return $ret;
}

function genBtnTypGC($det,$paramBrand=NULL){
$det_nom=strtoupper($det['c_nom']);
$image=fnc_image_exist($GLOBALS['RAIZ'],'images/types/',$det['c_img']);
$imgcat='<div class="vcat-cat-img" class="text-center">
<img src="'.$image['t'].'" alt="'.$det_nom.'" class="img-responsive"/></div>';
$tV=$det['c_typ'];
//Construct URL
switch ($tV) {
    case 1://Under Construcction
        $link_opt='onclick="alert('."'Under Construction'".')"';
		$link_url='#';
        break;
    case 2://Catalog
        $link_url=$GLOBALS["RAIZ"].'cat_clean.php?c_url='.$det['c_url'].'&'.$paramBrand;
		$link_trg='_self';
        break;
    case 3://External
        $link_url="#";
        break;
    default:
        //No View
}

$btnRet='<a href="'.$link_url.'" target="'.$link_trg.'" id="c_'.$param1.'" '.$link_opt.' class="vcat-cat-cont">';
$btnRet.='<div class="panel panel-default vcat-cat">';
$btnRet.='<div class="panel-heading text-center">'.$det_nom.'</div>';
$btnRet.='<div class="panel-body">';
//$btnRet.='<span class="btn btn-default btn-md btn-block" style="overflow:hidden; font-size:12px">'.$det_nom.'</span>';
$btnRet.=$imgcat;
$btnRet.='</div>';
$btnRet.='</div>';
$btnRet.='</a>';
echo $btnRet;
}

function genBtnItemG($det){
	//echo 'data/db/inv_prod/'.$det['i_img'];
	$i_img=vImg('data/db/inv_prod/',$det['i_img'],TRUE,'t_');
	$dias = (strtotime($GLOBALS['sdate'])-strtotime($det['i_date']))/86400;
	$dias = abs($dias);
	$dias = floor($dias);	
	$link=$GLOBALS["RAIZ"].'p/'.$det['c_url'].'/'.$det['i_url']; 
	$btnRet=NULL;
	$btnRet.='<div class="card h-300 vcat-item">';
	$btnRet.='<a href="'.$link.'" id="i_'.$det['i_id'].'">';
	$btnRet.='<div style="background: url('.$i_img['n'].')" val-ref="'.$i_img['v'].'" class="tempCardImgCat"></div>';
	$btnRet.='<div class="card-body text-center p-1">';
	$btnRet.='<div class="card-text badge badge-light">'.$det['b_nom'].'</div>';//card-text badge badge-light
	$btnRet.='<div class="card-text">';
	$btnRet.=$det['i_nom'];
	$btnRet.='</div>';//card-text
	$btnRet.='</div>';//card-body
	$btnRet.='</a>';//$link
	$btnRet.='</div>';//card cardProd
	return $btnRet;
}

function genBtnBrand($det){
	$ret=null;
	$par_id=null;
	$par_nom=null;
	if(isset($det['i_id'])) $par_id=$det['i_id'];
	if(isset($det['i_nom'])) $par_nom=$det['i_nom'];
	//
	$link=$GLOBALS["RAIZ"].'brand/'.$det['b_url'];
	$b_img=vImg('data/db/inv_brand/',$det['b_img']);
	$ret.='<a href="'.$link.'" class="vcat-cat d-block" id="i_'.$par_id.'">';
	$ret.='<div class="card h-100 card-secondary">';
	$ret.='<div class="card-header text-center d-none d-lg-block">'.$det['b_nom'].'</div>';
	$ret.='<img src="'.$b_img['t'].'" alt="'.$par_nom.'" class="card-img" style="max-height:90px"/>';
	$ret.='</div>';
	$ret.='</a>';
	echo $ret;
}

function genBtnItemGC($det){
$i_img=fnc_image_exist($GLOBALS['RAIZ'],'images/items/',$det['i_img']);
$b_img=fnc_image_exist($GLOBALS['RAIZ'],'images/brand/',$det['b_img']);
$link=$i_img['n'];

$btnRet.='<a href="'.$link.'" class="thumbnail vcat-item fancybox" id="i_'.$det['i_id'].'" rel="gall" title="'.$det['b_nom'].' - '.$det['i_cod'].'">';
$btnRet.='<div class="vcat-item-img text-center">';
$btnRet.='<img src="'.$i_img['t'].'" alt="'.$det['i_cod'].'" class="img-responsive"/>';
$btnRet.='</div>';
$btnRet.='<div class="vcat-item-tit text-center">'.$det['i_cod'].'</div>';
$btnRet.='</a>';
return $btnRet;
}

/*VERIFY NEW BETWEEN DATE*/
function vrfNew($date,$days){
	$datenow=$GLOBALS['sdate'];//FECHA SYS
	$datesel=$date; // FECHA SEL
	$f1 = explode("-", $datenow);
	$f2 = explode("-", $datesel);
	$timestamp1 = mktime(0,0,0,$f1[1],$f1[2],$f1[0]); $timestamp2 = mktime(0,0,0,$f2[1],$f2[2],$f2[0]); 
	$segundos_diferencia = $timestamp1 - $timestamp2; 
	//convierto segundos en días 
	$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 
	//obtengo el valor absoulto de los días (quito el posible signo negativo) 
	$dias_diferencia = abs($dias_diferencia); 
	//quito los decimales a los días de diferencia 
	$dias_diferencia = floor($dias_diferencia); 
	if ($dias_diferencia<=$days) return (TRUE);
	else return (FALSE);
}

function contactInsert($data){
	global $conn;
	$vP=FALSE;
	$vMT=TRUE;
	$vD=FALSE;
	$LOG=null;
	$idm=null;
	$LOGd='BEG FUN CONTACT_INS<br>';
	$IVM=is_valid_email($data["txtMail"]);
	$LOG=$IVM['log'];
	if($IVM['est']){
		//verifico si el dominio no esta bloqueado
		$detDB=detRow('tbl_contact_domain_block','domain',$IVM['val']['domain']);//Detalles de Contacto Existente con email
		if(!$detDB){
			$detM=detRow('tbl_contact_mail','mail',$data["txtMail"]);//Detalles de Contacto Existente con email
			if($detM){//Sel idMail
				$LOGd.= '<p>Si hay Mail</p>';
				$idm=$detM['idMail'];
				if($detM['banned']==1) $vMT=FALSE;
			}else{//INSERT tbl_contact_mail : Mail contacto
				$LOGd.= '<p>No data Mail, INSERT tbl_contact_mail</p>';
				$qryInsM = sprintf("INSERT INTO `tbl_contact_mail` (`mail`) VALUES (%s)",
					SSQL($data["txtMail"], "text"));
				if(mysqli_query($conn,$qryInsM)){
					$LOGd.= '<p>*tbl_contact_mail INSERT TRUE</p>';
					$idm=mysqli_insert_id($conn);

				}else{
					$LOGd.= '<p>*tbl_contact_mail INSERT FALSE</p>';
					$LOG.='<p>Error insert mail in database</p>'.mysqli_error($conn);
				}
			}
		}
	}	
	//SI TENGO ID Mail $idm procedo con almacenamiento	
	if(isset($idm)){
		if($vMT){
			$idr=null;
			if(isset($data['txtRef'])) $idr=$data['txtRef'];
		//Insert contact_data
			$qryInsC = sprintf("INSERT INTO tbl_contact_data 
			(idMail, name, date, phone1, country, message, cfrom, ip, type, id_ref, ContactKnow) 
			VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
				SSQL($idm, "int"),
				SSQL($data['txtName'], "text"),
				SSQL($GLOBALS['sdate'], "text"),
				SSQL($data['txtPhone'], "text"),
				SSQL($data['txtCountry'], "text"),
				SSQL(substr($data["txtMessage"], 0, 1000), "text"),
				SSQL('web', "text"),
				SSQL(getRealIP(), "text"),
				SSQL($data['txtType'], "text"),
				SSQL($idr, "int"),
				SSQL($data['ContactKnow'], "int"));
			if(mysqli_query($conn,$qryInsC)){
				$LOGd.= '<p>*tbl_contact_data INSERT TRUE</p>';
				$idc=mysqli_insert_id($conn);
				$vP=TRUE;
			}else{
				$LOGd.= '<p>*tbl_contact_data INSERT FALSE</p>';
				$LOG.='<p>Error insert contact_data in database</p>'.mysqli_error($conn);
			}
		}else{
			$LOG.= '<p>Mail banned</p>';
		}
	}else{
		$LOG.= '<p>Mail no exists</p>';
	}
	if($vD) $LOG.=$LOGd;
	$ret['log']=$LOG;
	if($vP==TRUE){
		$ret['est']=TRUE;
		$ret['id']=$idc;
	}else{
		$ret['est']=FALSE;
	}
	return($ret);
}
function supportInsert($idc,$data){
	global $conn;
	$LOG=null;
	$LOGd=null;
	//Inserto Soporte
	$vP=FALSE;
	$qryIns = sprintf("INSERT INTO tbl_support (idData, invoice, date, datep, msg, status) VALUES (%s,%s,%s,%s,%s,%s)",
		SSQL($idc, "int"),
		SSQL($data['txtInv'], "text"),
		SSQL($GLOBALS['sdate'], "text"),
		SSQL($data['txtDP'], "text"),
		SSQL($data['txtMessage'], "text"),
		SSQL("1", "int"));
	if(mysqli_query($conn,$qryIns)){
		$ids=mysqli_insert_id($conn);
		$fPS['PN']=$data['txtPN'];
		$fPS['SN']=$data['txtSN'];
		$fPS['MS']=$data['txtMS'];
		$qryInsR=sprintf('INSERT INTO tbl_support_det (idSp,item_id,nom,serial,problem) VALUES (%s,%s,%s,%s,%s)',
		SSQL($ids,'int'),
		SSQL($fPS['IN'],'int'),
		SSQL($fPS['PN'],'text'),
		SSQL($fPS['SN'],'text'),
		SSQL($fPS['MS'],'text'));
		if(mysqli_query($conn,$qryInsR)){
			$vP=TRUE;
		}else{
			$LOG.='<p>Error in insert support detaill</p>'.mysqli_error($conn);
		}
	}
	$ret['log']=$LOG;
	if($vP==TRUE){
		$ret['est']=TRUE;
		$ret['id']=$ids;
	}else{
		$ret['est']=FALSE;
	}
	return $ret;
}

function fsendPhpMailer($data){
	$vP=FALSE;
	$vD=FALSE;
	$LOGd=null;//var to store LOG for debug
	$LOG=null;//var to store LOG
	$LOGd.= '<hr><p>* BEG SEND MAIL</p>';
	$mail = new PHPMailer(true);
	$mail->IsSMTP();//telling the class to use SMTP
	try {
		$mail->Host = 'ssl://smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPAuth = true;
		$mail->Username = 'marketing@mercoframes.net';
		$mail->Password = 'Mkt$1801';
		/*************** MAIL TO COMPANY ****************/
		$mail->AddAddress('ale@mercoframes.net', 'MERCOFRAMES');
		$mail->AddAddress('webmaster@mercoframes.net', 'Webmaster MERCOFRAMES');
		$mail->SetFrom('webmaster@mercoframes.net', 'Mercoframes Optical Corp');
		$mail->Subject = $data['subject'];
		$mail->AltBody = $data['altbody'];
		$mail->MsgHTML($data['msg']);
		$mail->Send();
		/*************** MAIL TO CLIENT *****************/
		$mail->ClearAddresses();
		$mail->AddAddress($data['datMail'], $data['datName']);
  		$mail->SetFrom('webmaster@mercoframes.net', 'Mercoframes Optical Corp');
  		$mail->AddReplyTo('sales@mercoframes.net', 'MERCOFRAMES Optical Corp');
  		$mail->AddReplyTo('webmaster@mercoframes.net', 'Webmaster MERCOFRAMES');
  		$mail->Subject = $data['subjectC'];
		$mail->AltBody = $data['altbodyC'];
		$mail->MsgHTML($data['msgC']);
  		$mail->Send();
		$msgResp='<h4>Thank You, A Representative Will Contact You Soon.</h4>';
		$LOG.=$msgResp;
		$vP=TRUE;
		$LOGd.= '<p>* SEND TRUE</p>';
	} catch (phpmailerException $e) {
	  $e->errorMessage(); //Pretty error messages from PHPMailer
	  $LOG=$e;
	  $LOGd.=$e.'<p>* SEND FAIL</p>';
	} catch (Exception $e) {
	  $e->getMessage(); //Boring error messages from anything else!
	  $LOG=$e;
	  $LOGd.=$e.'<p>* SEND FAIL</p>';
	}
	$LOGd.= '<p>* END SEND MAIL</p>';
	$ret['log']=$LOG;
	$ret['est']=$vP;
	return $ret;
}

function send_email($to, $subject, $msg, $headers=NULL){
	if (mail($to, $subject, $msg, $headers)) return TRUE;
	else return FALSE;
}
function btnBackCat($param1){
	if(!$param1){	
		echo '<a href="'.$GLOBALS['RAIZ'].'"><i class="fas fa-chevron-left fa-fw"></i> Go back to <span class="btn btn-default btn-sm ml-2">Home</span></a>';
	}else if($param1==1){	
		echo '<a href="'.$GLOBALS['RAIZ'].'c/"><i class="fas fa-chevron-left fa-fw"></i> Go back to <span class="btn btn-default btn-sm ml-2">All Products</span></a>';
	}else{
		$detC=detRow('tbl_items_type','typID',$param1);
		echo '<a href="'.$GLOBALS['RAIZ'].'c/'.$detC['typUrl'].'"><i class="fas fa-chevron-left fa-fw"></i> Go back to <span class="btn btn-default btn-sm ml-2">'.$detC["typNom"].'</span></a>';
	}
}

function detArticleCat($param1,$idCat=NULL){
	if (!isset($param1)){
		$query_RS_datos = sprintf("SELECT * FROM tbl_articles WHERE cat_id=%s AND status=1 ORDER BY art_id DESC LIMIT 1",
			SSQL($idCat,'int'));
	} else {
		$query_RS_datos = sprintf("SELECT * FROM tbl_articles WHERE art_id=%s AND cat_id=%s",
			SSQL($param1,'int'),
			SSQL($idCat,'int'));
	}
	$RS_datos = mysqli_query($conn,$query_RS_datos) or die(mysqli_error($conn));
	$row_RS_datos = mysqli_fetch_assoc($RS_datos);
	$totalRows_RS_datos = mysqli_num_rows($RS_datos);
	return ($row_RS_datos);
	mysqli_free_result($RS_datos);
}
function seoGoogleMetas($tittle=NULL,$metades=NULL){
	if ($tittle) echo '<title>'.$tittle.'</title>';
	else echo '<title>Mercoframes Optical Corp</title>';
	if ($metades){
		$metades=strip_tags($metades);
		echo '<meta name="description" content="'.$metades.'">';
	}else echo '<meta name="description" content="'.$tittle.'">';
}

function seoGenTitle($tit,$pTm=NULL,$pTp=FALSE){
	$seoTittle=$tit;
	if($pTm){
		$catTm=dtrademark($pTm,'text');
		$seoTittle.=' - '.$catTm;
	}
	if($pTp){
		$seoTittle.=' - '.$GLOBALS['wTit'];
	}
	return $seoTittle;
}

?>