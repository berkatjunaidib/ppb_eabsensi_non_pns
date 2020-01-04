<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function datalog($aksi_akses,$keterangan){
    $userID = @$_SESSION['arrayLogin']['userID'];
    $userName = @$_SESSION['arrayLogin']['userName'];
    $ur = $_SERVER['REQUEST_URI'];
    $uri = explode('apps', $ur);
    $data = array(
        'userName' => $userID."_".$userName,
        'accessIP' => getenv("REMOTE_ADDR"),
        'accessTime' => time(),
        'accessUrl' => substr($uri[1],0,50),
        'accessAction' => $aksi_akses,
        'accessDescription' => $keterangan
    );
    return $data;
}
?>