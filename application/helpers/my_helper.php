<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function curl_post($fullurl,$fields){
    $jsonnya = json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_FAILONERROR, 0);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, $fullurl);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$jsonnya);
    $returned =  curl_exec($ch);
    
    return(json_decode($returned));
}
function curl_api($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,120);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,$url);
    $result=curl_exec($ch);
    curl_close($ch);
    return $result;
}
function data_breadcrumb($data_breadcrumb){
    $data='<span class="glyphicon glyphicon-dashboard"></span>';
    $x = explode('|', $data_breadcrumb);
    $i=0;       
    $jlh = count($x);
    foreach ($x as $y) {
        $z = explode(',', $x[$i]);
        if($i==$jlh-1){
            $data.=$z[1];
        }
        else{
            $data.="<a href='".base_url().$z[0]."' style='color:#fff'>&nbsp;&nbsp;".$z[1]."</a>";
            $data.='&nbsp;&nbsp;<i class="glyphicon glyphicon-chevron-right"></i>&nbsp;&nbsp;';
        }
        $i++;
    }
    return $data;
}


function buangbr($str){
    $str = str_replace('<br />', '',$str);
    return $str;
}

function selengkapnya($str){
    if(strlen($str)>45){
        $str = substr($str,0,45)."...";
    }else{
        $tot = strlen($str);
        for ($i=$tot; $i <45 ; $i++) { 
            $str.="&nbsp;";
        }
    }
    return $str;
}

function buang_titik($str){
    $str = str_replace('.', '',$str);
    return $str;
}

function pasang_titik($str){
    if($str!=""){
        $str = number_format($str,0,',','.');
    }else{
        $str=0;    
    }
    return $str;
}
function dmyTime($str){
    $str = date("d-m-Y H:i",$str);
    return $str;
}

function ymd1($tgl){
    if(!empty($tgl)){
        $tgl1 = explode("-",$tgl);
        $tgl = @$tgl1[2]."-".@$tgl1[1]."-".@$tgl1[0];
    }
    return $tgl;
}

function dmy1($tgl){
    if(!empty($tgl)){
        $tgl1 = explode("-",$tgl);
        $tgl = @$tgl1[2]."-".@$tgl1[1]."-".@$tgl1[0];
    }
    return $tgl;
}

function dmyY($tgl){
    if(!empty($tgl)){
        $tgl1 = explode("-",$tgl);
        $tgl = @$tgl1[2];
    }
    return $tgl;
}

function ymd2($tgl){
    $tgl2 = explode(" ",$tgl);
    $tgl20 = explode("-",$tgl2[0]);
    $tgl = $tgl20[2]."-".$tgl20[1]."-".$tgl20[0]." ".$tgl2[1];
    return $tgl;
}

function dmy2($tgl){
    $tgl2 = explode(" ",$tgl);
    $tgl20 = explode("-",$tgl2[0]);
    $tgl = @$tgl20[2]."-".@$tgl20[1]."-".@$tgl20[0]." ".@$tgl2[1];
    return $tgl;
}

function cek_select_option($val1,$val2){
    if($val1==$val2){
        return "selected";
    }
    else{
        return "";
    }
}
function buang_tag_html($content) {
   $content = strip_tags($content); 
   return $content;  
}
function generateRandomString($length) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>