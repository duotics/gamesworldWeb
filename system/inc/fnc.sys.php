<?php
function minutosTranscurridos($fecha_i,$fecha_f){
	$minutos = (strtotime($fecha_i)-strtotime($fecha_f))/60;
	$minutos = abs($minutos); $minutos = floor($minutos);
return $minutos;
}
function getUserIP(){ //20200405
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }
    return $ip;
}


function is_valid_email($str){
	$LOG=null;
	$res=null;
	$domain=null;
	if ((false !== filter_var($str, FILTER_VALIDATE_EMAIL))){
		$LOG.='<p>Valid Email</p>';
		list($user, $domain) = explode('@', $str);
		$res = checkdnsrr($domain, 'MX');
	}else $LOG.='<p>Invalid Email</p>';
	
	if($res){
		$est=TRUE;
	}else{
		$LOG.='<p>Inexistent domain</p>';
		$est=FALSE;
	}
	$ret['est']=$est;
	$ret['log']=$LOG;
	$ret['val']['domain']=$domain;
	return $ret;
}
/**/
function totRowsTabP($table,$param=NULL){//v.2.0
	Global $conn;
	$qry = sprintf('SELECT COUNT(*) AS TR FROM %s WHERE 1=1 %s',
	SSQL($table,''),
	SSQL($param,''));
	$RS = mysqli_query($conn,stripslashes($qry)) or die(mysqli_error($conn));
	$dRS = mysqli_fetch_assoc($RS);
	return ($dRS['TR']);
}
/**/
function getParamSQLA($params){
	$qryParam=null;
	if($params){
		foreach($params as $val){
			if(!isset($val[3])) $val[3]=' AND ';
			$qryParam.=$val[3].' '.$val[0].' '.$val[1].' "'.$val[2].'"';
		}
	}
	return $qryParam;
}

function containsBots($param){
	$vP=FALSE;
	$vD=FALSE;
	$LOGd=null;
	$LOG=null;
	$listTerms=array('bot','spider','Vagabondo');
	//listTerms = array("viagra","biagra","sex","sexo", "cialis", "psychology", "ReCaptcha","virgin","virginity","cock","fuck","escort", "Music");
		foreach ($listTerms as $letter) {
			$LOGd.='Term. '.$letter.'<br>';
			if (stripos($param,$letter) !== FALSE) {
				$LOGd.='Match prohited terms';
				//$LOG.='Match prohited terms. <br>'.$letter;
				$vP=TRUE;
				break;
			}
	}
	if($vD) $LOG.=$LOGd;
	$ret['est']=$vP;
	$ret['log']=$LOG;
	$ret['logd']=$LOGd;
    return $ret;
}

function containsDescenders($param){
	global $conn;
	$vP=FALSE;
	$vD=FALSE;
	$LOG=null;
	$LOGd=null;
	$qry=('SELECT term FROM tbl_contact_term_block WHERE stat=1');
	$RSlt=mysqli_query($conn,$qry);
	$dRSlt=mysqli_fetch_assoc($RSlt);
	$tRSlt=mysqli_num_rows($RSlt);
	if($tRSlt>0){
		do{
			$listTerms[]=$dRSlt['term'];
		}while($dRSlt=mysqli_fetch_assoc($RSlt));
	}
	//listTerms = array("viagra","biagra","sex","sexo", "cialis", "psychology", "ReCaptcha","virgin","virginity","cock","fuck","escort", "Music");
	foreach ($param as $text){
		$LOGd.='Field. '.$text.'<br>';
		foreach ($listTerms as $letter) {
			if (stripos($text,$letter) !== FALSE) {
				$LOGd.='Match prohited terms';
				//$LOG.='Match prohited terms. <br>'.$letter;
				$vP=TRUE;
				break;
			}
		}
	}
	if($vD) $LOG.=$LOGd;
	$ret['est']=$vP;
	$ret['log']=$LOG;
    return $ret;
}
//
function vrfLinkStr($param){
//cadena origen con los enlaces sin detectar
//filtro los enlaces normales
$cadena_resultante= preg_replace("/((http|https|www)[^\s]+)/", '<a href="$1">$0</a>', $param);
//miro si hay enlaces con solamente www, si es así le añado el http://
$cadena_resultante= preg_replace("/href=\"www/", 'href="http://www', $cadena_resultante);
echo '<h3>Cadena filtrada con enlaces normales:</h3>'.$cadena_resultante;
 
//saco los enlaces de twitter
$cadena_resultante = preg_replace("/(@[^\s]+)/", '<a target=\"_blank\"  href="http://twitter.com/intent/user?screen_name=$1">$0</a>', $cadena_resultante);
$cadena_resultante = preg_replace("/(#[^\s]+)/", '<a target=\"_blank\"  href="http://twitter.com/search?q=$1">$0</a>', $cadena_resultante);
echo '<h3>Cadena filtrada con enlaces de Twitter:</h3>'.$cadena_resultante;
}
/**/
function detRowNP($table,$params){ //v2.0 -> duotics_lib
	Global $conn;
	$lP='';
	if($params){
		foreach($params as $x => $dat) {
			foreach($dat as $y => $xVal){
				$lP.=$xVal['cond'].' '.$xVal['field'].' '.$xVal['comp'].' "'.$xVal['val'].'" ';
		}	}
	}
	$qry = sprintf("SELECT * FROM %s WHERE 1=1 ".$lP,
	SSQL($table, ''));
	$RS = mysqli_query($conn,$qry) or die(mysqli_error($conn));
	$dRS = mysqli_fetch_assoc($RS);
	mysqli_free_result($RS);
	return ($dRS);
}
/**/
function genMenu($refMC,$css=NULL,$vrfUL=TRUE){//v.0.1
	global $conn;
	$ret='';
	$qry=sprintf("SELECT * FROM tbl_menus_items 
	INNER JOIN tbl_menus on tbl_menus_items.men_idc=tbl_menus.id 
	WHERE tbl_menus.ref = %s 
	AND tbl_menus_items.men_padre = %s  
	AND tbl_menus_items.men_stat = %s 
	ORDER BY men_orden ASC",
	SSQL($refMC,'text'),
	SSQL('0','int'),
	SSQL('1','text'));
	//echo $qry;
	$RSmp = mysqli_query($conn,$qry) or die(mysql_error($conn));
	$dRSmp = mysqli_fetch_assoc($RSmp);
	$tRSmp = mysqli_num_rows($RSmp);
	if($tRSmp > 0){
		do{
			$paramsN=NULL;//REINICIAR EL $paramsN siempre ya que si entra a un bucle se almacena y da error
			$paramsN[]=array(
				array("cond"=>"AND","field"=>"idm","comp"=>"=","val"=>$dRSmp['men_id']),
				array("cond"=>"AND","field"=>"lang","comp"=>'=',"val"=>$_SESSION['lang'])
			);
			$detMenuTopLang=detRowNP('tbl_menus_items_txt',$paramsN);
			if($detMenuTopLang){
				$detMenuTopLang_tit=$detMenuTopLang['titv'];
			}else{
				$detMenuTopLang_tit=$dRSmp['men_tit'];
			}
			if(!$detMenuTopLang_tit) $detMenuTopLang_tit='N/D';
			
			//Consulta para Submenus
			$qry2 = sprintf("SELECT * FROM tbl_menus_items 
			INNER JOIN tbl_menus_items_txt ON tbl_menus_items.men_id=tbl_menus_items_txt.idm 
			WHERE tbl_menus_items.men_padre = %s AND tbl_menus_items.men_stat = %s 
			AND tbl_menus_items_txt.lang= %s 
			ORDER BY men_orden ASC",
			SSQL($dRSmp['men_id'],'int'),
			SSQL(1,'int'),
			SSQL($_SESSION['lang'],'text'));
			$RSmi = mysqli_query($conn,$qry2) or die(mysqli_error($conn));
			$dRSmi = mysqli_fetch_assoc($RSmi);
			$tRSmi = mysqli_num_rows($RSmi);
			if($tRSmi>0) $cssSM="dropdown"; 
			else $cssSM="";
			$link_target=NULL;
			if($dRSmp['men_link']){
				//echo '<p>Si Link</p>';
				if($dRSmp['men_link_ext']==1){
					$link = $dRSmp['men_link'];
					$link_target='_blank';
					//echo 'External'.$link.'<hr>';
				}else{
					$link = $GLOBALS['RAIZ'].$dRSmp['men_link'];
					//echo 'Internal'.$link.'<hr>';
				}
			}else{
				$link = "#";
			}
			if($dRSmp['men_precode']) $ret.=$dRSmp['men_precode'];
			$ret.='<li class="nav-item '.$cssSM.' '.$dRSmp['men_css'].'" style="'.$dRSmp['men_sty'].'">'; 
			if($tRSmi > 0){
				$ret.='<a href="'.$link.'" class="dropdown-toggle" target="'.$link_target.'"'; 
				if($tRSmi > 0){ $ret.='data-toggle="dropdown"';
			}
			$ret.='>';
			if($dRSmp['men_icon']) $ret.='<i class="'.$dRSmp['men_icon'].'"></i> ';
			$ret.=$dRSmp['men_id'].$detMenuTopLang_tit.'*';
			//$ret.=$detMenuTopLang_tit;
			if($tRSmi > 0){
				$ret.=' <b class="caret"></b>';
			}
			$ret.='</a>';
			$ret.='<ul class="dropdown-menu">';
			do{
				if($dRSmi['men_link']){ 
					$link = $GLOBALS['RAIZ'].$dRSmi['men_link'];
				}else{
					$link = "#"; 
				}
			if($dRSmi['men_precode']) $ret.=$dRSmi['men_precode'];
			$ret.='<li><a class="nav-link" href="'.$link.'" target="'.$link_target.'">';
			if($dRSmi['men_icon']) $ret.='<i class="'.$dRSmi['men_icon'].'"></i> ';
			//$ret.=$dRSmi['men_id'].$dRSmi['titv'].'</a></li>';
			$ret.=$dRSmi['titv'].'</a></li>';
			if($dRSmi['men_postcode']) $ret.=$dRSmi['men_postcode'];
			}while($dRSmi = mysqli_fetch_assoc($RSmi));
			mysqli_free_result($RSmi);
			$ret.='</ul>';
		}else{
			//Simple Link
			$ret.='<a class="nav-link" href="'.$link.'" target="'.$link_target.'">';
			if($dRSmp['men_icon']) $ret.='<i class="'.$dRSmp['men_icon'].'"></i> ';
			//$ret.=$dRSmp['men_id'].$detMenuTopLang_tit.'</a>';
			$ret.=$detMenuTopLang_tit.'</a>';
		}                             	                    
		$ret.='</li>';
		if($dRSmp['men_postcode']) $ret.=$dRSmp['men_postcode'];
	}while($dRSmp = mysqli_fetch_assoc($RSmp));
	mysqli_free_result($RSmp);
	}else{
		$ret.='<li>No existen menus para <strong>'.$refMC.'</strong></li>';
	}
	//Verifica si solicito UL, si no devolveria solo LI
	if($vrfUL) $ret='<ul class="'.$css.'">'.$ret.'</ul>';
	return $ret;
}
function getRemoteFile($url, $timeout = 10) {
  $ch = curl_init();
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $file_contents = curl_exec($ch);
  curl_close($ch);
  return ($file_contents) ? $file_contents : FALSE;
}

//BEG COOKIES FUNCTION
function setCookieArray($cookieName,$cookieID,$cookieVal,$cookieIDtoVAL=TRUE,$limitItems=100,$cookieTime=NULL){
	$LOG.= $cookieName.' - ';
	if(($cookieName)&&($cookieID)){
		if(array_key_exists($cookieName, $_COOKIE)) {
			$cookie = unserialize($_COOKIE[$cookieName]);
		} else {
			$cookie = array();
		}
		if($cookieIDtoVAL==TRUE) $cookieVal=$cookieID;
		if($cookie[$cookieID] != $cookieVal){
				$Newcookie[$cookieID] = $cookieVal;
				$cookie=$Newcookie+$cookie;
				$salida = array_slice($cookie, 0, $limitItems,true);   // devuelve "a", "b", y "c"
				$cookie = serialize($salida);
				if(!$cookieTime) $cookieTime=86400*30;
				if(setcookie($cookieName, $cookie, time()+$cookieTime,'/')){
					$LOG.='Value. '.$cookieID.' set in Cookie<br>';
				}else $LOG.='Error Value no set in Cookie<br>';
		}else $LOG.='Values for cookie exists, not set*<br>';
	}else $LOG.='No data for Cookie<br>';
	return $LOG;
}
function getCookieArray($cookieName,$limitItems=20){
	$cookieFIN=null;
	if (isset($_COOKIE[$cookieName])){
		$cookie=unserialize($_COOKIE[$cookieName]);
		$cookieFIN = array_slice($cookie, 0, $limitItems,true);
	}
	return $cookieFIN;
}
function delCookie($cookieName){
	unset($_COOKIE[$cookieName]);
	setcookie($cookieName, "", time() - (86400 * 30),'/');
}
//END COOKIES FUNCTION

function sLOG($type=NULL, $msg_m=NULL, $msg_t=NULL, $msg_c=NULL, $msg_i=NULL){//v.2.3
	$LOG=NULL;
	$vrfVL=TRUE; //var para setear $LOG
	if($msg_m){
		$LOG['m']=$msg_m;
		$LOG['t']=$msg_t;
		$LOG['c']=$msg_c;
		$LOG['i']=$msg_i;
	}else {
		if(isset($_SESSION['LOG'])) $LOG=$_SESSION['LOG'];
	}
	
	if($LOG){
		if(!$LOG['c']) $LOG['c']='alert-info';
		switch ($type){
			case 'a':
				$rLog='<div id="log">';
				$rLog.='<div class="alert alert-dismissable '.$LOG['c'].'" style="margin:10px;">';
				$rLog.='<button type="button" class="close" data-dismiss="alert">&times;</button>';
				if(isset($LOG['t'])) $rLog.='<h3>'.$LOG['t'].'</h3>';
				$rLog.=$LOG['m'];
				$rLog.='</div></div>';
			break;
			case 'g':
				$rLog='<script type="text/javascript">
				logGritter("'.$LOG['t'].'","'.$LOG['m'].'","'.$LOG['i'].'");
				</script>';
			break;
			case 's':
				$vrfVL=FALSE;
			break;
			default:
				$rLog='<div>'.$LOG['m'].'</div>';
			break;
		}
		echo $rLog;
	}
	if($vrfVL){//TRUE unset->LOG, FALSE $_SESSION LOG -> $LOG
		unset($_SESSION['LOG']);
	}else{
		$_SESSION['LOG']=$LOG;
	}
}

function vParam($nompar, $pget, $ppost){
	//session_start();
	if(isset($pget)) {$id_ret=$pget;}
	else if (isset($ppost)){$id_ret=$ppost;}
	else $id_ret=$_SESSION[$nompar];
	return $id_ret;
}
//OBTENER IP
function getRealIP(){
   if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            : ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               : "unknown" );
      // los proxys van añadiendo al final de esta cabecera
      // las direcciones ip que van "ocultando". Para localizar la ip real
      // del usuario se comienza a mirar por el principio hasta encontrar
      // una dirección ip que no sea del rango privado. En caso de no
      // encontrarse ninguna se toma como valor el REMOTE_ADDR
      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
      reset($entries);
      while (list(, $entry) = each($entries)){
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list)){
            // http://www.faqs.org/rfcs/rfc1918.html
            $private_ip = array(
                  '/^0\./',
                  '/^127\.0\.0\.1/',
                  '/^192\.168\..*/',
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                  '/^10\..*/');
            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
            if ($client_ip != $found_ip){ $client_ip = $found_ip; break;
            }
         }
      }
   }else{
      $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            : ((!empty($_ENV['REMOTE_ADDR'])) ?
               $_ENV['REMOTE_ADDR']
               : "unknown" );
   }
   return $client_ip;
}

function vImg($ruta,$nombre,$thumb=TRUE,$pthumb='t_',$retHtml=FALSE){//v1.5
	$imgRet['n']=$GLOBALS['RAIZa'].'img/no_image02.jpg';
	$imgRet['t']=$imgRet['n'].'img/t_no_image02.jpg';
	$imgRet['s']=FALSE;//Verify if file exist is default FALSE
	$imgRet['v']=$GLOBALS['RAIZ'].$ruta.$nombre;
	if($nombre){
		//echo '<hr>RAIZ. '.RAIZ.$ruta.$nombre;
		//echo '<hr>$RAIZ. '.$RAIZ.$ruta.$nombre;
		if (file_exists(RAIZ.$ruta.$nombre)){
			$imgRet['s']=TRUE;//FILE EXIST RETURN TRUE AND ALL DATA (link normal, link thumb, file name original)
			$imgRet['f']=$nombre;
			$imgRet['n']=$GLOBALS['RAIZ'].$ruta.$nombre;
			$imgRet['t']=$imgRet['n'];
			if ($thumb==TRUE){
				if (file_exists(RAIZ.$ruta.$pthumb.$nombre)){
					$imgRet['t']=$GLOBALS['RAIZ'].$ruta.$pthumb.$nombre;
				}
			}
		}
	}
	//Direct Return HTML Code *********** TERMINAR ESTE CODIGO
	if($retHtml){
		foreach($retHtml as $key => $valor){
			if($key!='tip') $paramCode=' '.$key.' = '.'"'.$valor.'"';
		}
		switch($retHtml['tip']){
			case 'imgn':
				$imgRet['code']='<img src="'.$imgRet['n'].'" '.$paramCode.'>';
			break;
			case 'imgt':
				$imgRet['code']='<img src="'.$imgRet['t'].'" '.$paramCode.'>';
			break;
			case 'aimg':
				$imgRet['code']='<a href="'.$imgRet['n'].'" '.$paramCode.'><img src="'.$imgRet['t'].'"></a>';
			break;
		}
		
	}
	return $imgRet;
}

function vGreCaptcha($param){
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6LdRnlUUAAAAAAleL9Gs1KHFvPHZysmm1TKj0p65',
		'response' => $param,
		'remoteip' => $_SERVER['REMOTE_ADDR']
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = getRemoteFile($url);
	//$verify = file_get_contents($url, false, $context);
	$captcha_success = json_decode($verify);
	return ($captcha_success['success']);
	
}

function getCurlData($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
	$curlData = curl_exec($curl);
	curl_close($curl);
	return $curlData;
}
if (!function_exists("SSQL")) {//v.2.0 -> duotics_lib
function SSQL($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
  Global $conn;
  if (PHP_VERSION < 6) { $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue; }
  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conn, $theValue) : mysqli_real_escape_string($conn, $theValue);
  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>