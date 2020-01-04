<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function upload_file($name_field){
	$sourcePath = $_FILES[$name_field]['tmp_name'];
	if($sourcePath!=""){
		$path = $_FILES[$name_field]['name'];
		$fileType = $_FILES[$name_field]["type"];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$fName = $name_field."_".time();
		$fileName = $fName.'.'.$ext;
		$targetPath = "uploads/".$fileName;
		move_uploaded_file($sourcePath,$targetPath);
		if($ext=="jpg" || $ext=="jpeg"){
			resize($fileName,$fileType,180);
		}
		return $fileName;
	}else{
		return "";
	}
}

function resize($fupload_name,$fileType,$img_size){
	$vdir_upload = "uploads/"; // Direktori penyimpanan Foto
	$vfile_upload = $vdir_upload . $fupload_name;

	$im_src1 = func_imagecreate($vfile_upload,$fileType);

	$src_width1 = imageSX($im_src1);
	$src_height1 = imageSY($im_src1);
	//Set ukuran small 60 pixel gambar hasil perubahan
	$dst_width1 = $img_size;
	$dst_height1 = ($dst_width1/$src_width1)*$src_height1;
	//proses perubahan ukuran
	$im1 = imagecreatetruecolor($dst_width1,$dst_height1);
	imagecopyresampled($im1, $im_src1, 0, 0, 0, 0, $dst_width1, $dst_height1, $src_width1, $src_height1);
	imagejpeg($im1,$vdir_upload.$fupload_name);
	imagedestroy($im_src1);
	imagedestroy($im1);
}

function func_imagecreate($vfile_upload,$fileType){
	if($fileType=="image/png"){
		return imagecreatefrompng($vfile_upload);
	}else if($fileType=="image/jpeg"){
		return imagecreatefromjpeg($vfile_upload);
	}
}