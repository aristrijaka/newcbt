<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*function set_date($data=""){
	
	$CI =& get_instance();
	$CI->lang->load('calendar');
	$CI->lang->load('date');
	
	$time=time();
	
	$data	= str_replace( date("l",$time), $CI->lang->line('cal_'.strtolower(date("l",$time))), $data);
	$data	= str_replace( date("D",$time), $CI->lang->line('cal_'.strtolower(date("D",$time))), $data);
	$data	= str_replace( date("F",$time), $CI->lang->line('cal_'.strtolower(date("F",$time))), $data);
	$data	= str_replace( date("M",$time), $CI->lang->line('cal_'.strtolower(date("M",$time))), $data);
	$name = array('year','month','week','day','hour','minute','second',);
	foreach($name as $n => $lang_eng){
		$data = str_replace( $lang_eng.'s', $CI->lang->line('date_'.strtolower($lang_eng)), $data);
		$data = str_replace( $lang_eng, $CI->lang->line('date_'.strtolower($lang_eng)), $data);
		$data = str_replace( strtoupper($lang_eng.'s'), strtoupper($CI->lang->line('date_'.strtolower($lang_eng))), $data);
		$data = str_replace( strtoupper($lang_eng), strtoupper($CI->lang->line('date_'.strtolower($lang_eng))), $data);
		$data = str_replace( ucfirst($lang_eng.'s'), $CI->lang->line('date_'.strtolower($lang_eng)), $data);
		$data = str_replace( ucfirst($lang_eng), $CI->lang->line('date_'.strtolower($lang_eng)), $data);
	}
	return $data;
}*/

function format_date($data,$format=''){
	if($format==''){
		$CI =& get_instance();
		$CI->config->load('config');
		$format=$CI->config->item('log_date_format');
	}
	$data=str_replace('-',' ',$data);
	$data=str_replace('/',' ',$data);
	
	$arrcell=explode(' ',$data);
		if(strlen($arrcell[0])==4){
			$tanggal=$arrcell[2]; 
			$bulan=$arrcell[1]; 
			$tahun=$arrcell[0]; 
		}else{
			$tanggal=$arrcell[0]; 
			$bulan=$arrcell[1]; 
			$tahun=$arrcell[2];
		}
				
	if($tahun=='0000'){
		return false;
	}else{
		if(empty($arrcell[3])){ $arrcell[3]='8:8:8'; }
		$time=explode(":",$arrcell[3]);
		$mktm=mktime($time[0],$time[1],$time[2],$bulan,$tanggal,$tahun);
		return set_date(date($format,$mktm));
	}
}



/*function toYmd($data){
	if($data==''){
		return false;	
	}
	$mode='';
	if(filter_var($data,FILTER_VALIDATE_FLOAT )){
		
		return date('Y-m-d H:i:s',$data);
		
	}elseif(preg_match('[-]',$data)){
		$data=str_replace('-',' ',$data);
	}elseif(preg_match('[/]',$data)){	
		$data=str_replace('/',' ',$data);
	}else{
		return false;	
	}
	$set=explode(' ',$data);
	
	if(count($set)>=3){
		if(strlen($set[0])==4){
			#'Ymd';
			$tgl=$set[0].'-'.$set[1].'-'.$set[2];
			if(!empty($set[3])){ $tgl.=' '.$set[3]; }
			if(!empty($set[4])){ $tgl.=' '.$set[4]; }
			return $tgl;
		}elseif(strlen($set[2])==4){
			#'dmY';
			$tgl=$set[2].'-'.$set[1].'-'.$set[0];
			if(!empty($set[3])){ $tgl.=' '.$set[3]; }
			if(!empty($set[4])){ $tgl.=' '.$set[4]; }
			return $tgl;
		}else{
			return false;
		}
	}else{
		return false;	
	}
	
}

function toDmy($data){
	if($data==''){
		return false;
	}
	$mode='';
	if(filter_var($data,FILTER_VALIDATE_FLOAT )){

		return date('d-m-Y H:i:s',$data);

	}elseif(preg_match('[-]',$data)){
		$data=str_replace('-',' ',$data);
	}elseif(preg_match('[/]',$data)){
		$data=str_replace('/',' ',$data);
	}else{
		return false;
	}
	$set=explode(' ',$data);
	if(count($set)>=3){
		if(strlen($set[0])==4){
			#'dari Ymd';
			$tgl=$set[2].'-'.$set[1].'-'.$set[0];
			if(!empty($set[3])){ $tgl.=' '.$set[3]; }
			if(!empty($set[4])){ $tgl.=' '.$set[4]; }
			return $tgl;
		}elseif(strlen($set[2])==4){
			#'dari dmY';
			$tgl=$set[0].'-'.$set[1].'-'.$set[2];
			if(!empty($set[3])){ $tgl.=' '.$set[3]; }
			if(!empty($set[4])){ $tgl.=' '.$set[4]; }
			return $tgl;
		}else{
			return false;
		}
	}else{
		return false;
	}

}
*/  
