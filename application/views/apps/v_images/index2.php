<!DOCTYPE html>
<html>
<head>
	<title><?php echo config_item('app_client1'); ?> | <?php echo config_item('app_name'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo config_item('asset_url'); ?>assets/web/css/bootstrap.css" rel="stylesheet" media="screen">
	<script src="<?php echo config_item('asset_url'); ?>assets/web/js/jquery.min.js"></script>
	<script src="<?php echo config_item('asset_url'); ?>assets/web/js/bootstrap.js"></script>
	<script>
		/* Script written by Adam Khoury @ DevelopPHP.com */
		/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
		function _(el){
			return document.getElementById(el);
		}
		function uploadFile(){
			var file = _("file1").files[0];
			if(_("resize1").checked){
				resize=1;
			}else{
				resize=0;
			}
				//alert(file.name+" | "+file.size+" | "+file.type);
				if(file.type=="image/png" || file.type=="image/jpeg"){	
					var formdata = new FormData();
					formdata.append("file1", file);
					formdata.append("resize1", resize);
					var ajax = new XMLHttpRequest();
					ajax.upload.addEventListener("progress", progressHandler, false);
					ajax.addEventListener("load", completeHandler, false);
					ajax.addEventListener("error", errorHandler, false);
					ajax.addEventListener("abort", abortHandler, false);
					ajax.open("POST", "<?php echo base_url(); ?>apps/c_images/upload/?direktori=<?php echo $dataC['direktori'];?>&resize="+resize);
					ajax.send(formdata);
				}else{
					alert('extensi tidak didukung');
				}
			}
			function progressHandler(event){
				_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
				var percent = (event.loaded / event.total) * 100;
				_("progressBar").value = Math.round(percent);
				_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
			}
			function completeHandler(event){
				console.log(event);
				_("status").innerHTML = event.target.responseText;
				_("progressBar").value = 0;
				fin();
			}
			function errorHandler(event){
				console.log(event);
				_("status").innerHTML = "Upload Failed";
			}
			function abortHandler(event){
				console.log(event);
				_("status").innerHTML = "Upload Aborted";
			}
			function fin() {
				document.location = document.location;
			}

	        // Helper function to get parameters from the query string.
	        function getUrlParam( paramName ) {
	        	var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
	        	var match = window.location.search.match( reParam );

	        	return ( match && match.length > 1 ) ? match[1] : null;
	        }
	        // Simulate user action of selecting a file to be returned to CKEditor.
	        function returnFileUrl(url_file) {

	        	var funcNum = getUrlParam( 'CKEditorFuncNum' );
	        	var fileUrl = url_file;
	        	window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
	        	window.close();
	        }


	        function btnCreateFolder() {
	        	document.form1.op.value="create";
	        }
	        function btnHapusFolder(str) {
	        	//alert(str);
	        	document.form1.op.value="hapusfolder";
	        	document.form1.fd.value=str;
	        	cekSubmit();
	        }
	        function btnHapusFile(str) {
	        	document.form1.op.value="hapusfile";
	        	document.form1.fd.value=str;
	        	cekSubmit();
	        }
	        function cekSubmit() {
	        	var op = document.form1.op.value;
	        	if(op=='create'){
	        		return true;
	        	}
	        	else if(op=='hapusfile'){
	        		if (confirm("Anda Yakin?")) {
	        			document.form1.submit();
	        		}
	        	}
	        	else if(op=='hapusfolder'){
	        		if (confirm("Anda Yakin?")) {
	        			document.form1.submit();
	        		}
	        	}
	        	return false;
	        }
	    </script>
	</head>
	<body>
		<div class="container-fluid">
			<h3 style="margin: 0;text-align: center;">Images Album</h3>
			<div class="row">
				<div class="col-sm-2">
					<h4>Folder</h4>
					<form action="?" name="form1" method="GET" onsubmit="return cekSubmit();">
						<input type="hidden" name="op" value="">
						<input type="hidden" name="direktori" value="<?php echo $dataC['direktori'];?>">
						<input type="hidden" name="CKEditor" value="<?php echo $dataC['CKEditor'];?>">
						<input type="hidden" name="CKEditorFuncNum" value="<?php echo $dataC['CKEditorFuncNum'];?>">
						<input type="hidden" name="langCode" value="<?php echo $dataC['langCode'];?>">
						<input type="text" name="fd" class="form-control">
						<input style="margin: 5px 0;" class="btn btn-sm btn-info btn-block" type="submit" name="" value="Create Folder" onclick="btnCreateFolder();">
					</form>
					<?php 
					$fd = $this->input->get("fd");
					$op = $this->input->get("op");
					if($op=="create"){
						if (!file_exists('uploads/source/'.$fd)) {
							mkdir('uploads/source/'.$fd, 0777, true);
						}
						if (!file_exists('uploads/thumbs/'.$fd)) {
							mkdir('uploads/thumbs/'.$fd, 0777, true);
						}
					}else if($op=="hapusfolder"){
						if (file_exists('uploads/thumbs/'.$fd)) {
							DelFolder('uploads/thumbs/'.$fd."/");
							rmdir('uploads/thumbs/'.$fd);
						}
						if (file_exists('uploads/source/'.$fd)) {
							DelFolder('uploads/source/'.$fd."/");
							rmdir('uploads/source/'.$fd);
						}
					}else if($op=="hapusfile"){
						$dir1 = "uploads/source/".$fd;
						$dir2 = "uploads/thumbs/".$fd;
						if (file_exists($dir1)) {
							unlink($dir1);
						}
						if (file_exists($dir2)) {
							unlink($dir2);
						}

					}

					function DelFolder($dir){
						if($handle = opendir($dir)){ 
							while(($file = readdir($handle)) != false) {
								if($file=="." OR $file==".."){
								}
								else {
									if(strpos($file,'.')==true) {
										unlink($dir.$file);
									}
								}
							}
						}
					}
					?>
					<table border="0" class="table">
						<?php 
						echo "<tr><td colspan='2'><a class='".cek_active('',$dataC['direktori'])."' href='".base_url()."apps/c_images/?&CKEditor=".$dataC['CKEditor']."&CKEditorFuncNum=".$dataC['CKEditorFuncNum']."&langCode=".$dataC['langCode']."'>Home</a></td></tr>";
						function daftar_dir($dir,$dataC){
							if(is_dir($dir)){
								if($handle = opendir($dir)){ 
									while(($file = readdir($handle)) != false) {
										if($file=="." OR $file==".."){
										}
										else {
											if(strpos($file,'.')==false) {
												echo "<tr><td><a class='".cek_active($file,$dataC['direktori'])."' href='".base_url()."apps/c_images/?direktori=".$file."&CKEditor=".$dataC['CKEditor']."&CKEditorFuncNum=".$dataC['CKEditorFuncNum']."&langCode=".$dataC['langCode']."'>".$file."</a></td>";
												?><td class="text-right"><a class='btn btn-xs btn-danger' href='#' onclick='btnHapusFolder("<?php echo $file;?>");'><span class='glyphicon glyphicon-remove'></span></a></td></tr><?php
											}
										}
									}
								}
							}
						}
						daftar_dir("uploads/thumbs/",$dataC);
						?>
					</table>
				</div>
				<div class="col-sm-10">
					<h4>Images</h4>
					<form id="slide_form" enctype="multipart/form-data" method="post">
						<table border="0">
							<tr style="background:#ddd;">
								<td style="padding: 4px;"><input class="" type="file" name="file1" id="file1"></td>
								<td style="padding: 4px;"><input class="" type="checkbox" name="resize1" id="resize1" value="1" checked>resize</td>
								<td style="padding: 4px;"><input class="btn btn-sm btn-info" type="button" value="Upload File" onclick="uploadFile()"></td>
							</tr>
							<tr>
								<td style="padding: 4px 0;" colspan="3">
									<progress id="progressBar" value="0" max="100" style="width:100%;"></progress>
									<h3 id="status"></h3>
									<p id="loaded_n_total"></p>
								</td>
							</tr>
						</table>
					</form>
					<?php 
					function daftar_file($dir,$dataC){
						$direktori = $dataC['direktori'];
						if(is_dir($dir)){
							if($handle = opendir($dir)){ 
								while(($file = readdir($handle)) != false) {
									if($file=="." OR $file==".."){
									}
									else {
										if(strpos($file,'.')==true) {
											?>
											<div style="width:180px; overflow:hidden;  height:140px; float:left;border:1px solid #ddd; margin:3px;">
												<div style="padding: 2px 2px 4px 2px; background: #ddd;">
													<a href="#" onclick="btnHapusFile('<?php echo $direktori."/".$file; ?>');" style="float: right;" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
													<?php
													echo substr($file,8,15);
													?>				
												</div>
												<div>
													<img style="width:100%; overflow:hidden; height:100%; margin:0 auto; text-align:center" onclick="returnFileUrl('<?php echo config_item('asset_url').$dir.$file ?>');" src="<?php echo config_item('asset_url').$dir.$file ?>" class="img-responsive" style="margin:5px; cursor:hover">
												</div>
											</div>
											<?php
										}
									}
								} 
								closedir($handle); 
							} 
						} 
					}
					//daftar_file("uploads/thumbs/");
					daftar_file("uploads/thumbs/".$dataC['direktori']."/",$dataC);
					?>
				</div>
			</div>
		</div>
	</body>
	</html>