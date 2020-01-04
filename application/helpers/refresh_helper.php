<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function refresh($page){
	echo "<p style='text-align:center'><img style='padding:20px;' src='".base_url()."assets/apps/dist/gif/loading-xxlg.gif'></p>";
	print"<html><head><meta http-equiv='refresh' content='0;URL=$page'></meta></head></html>";
}

?>