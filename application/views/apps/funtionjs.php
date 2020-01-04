<script language="JavaScript">

	var loading = "<p class='text-center'><img style='padding:25px;' src='<?php echo base_url(); ?>assets/apps/dist/gif/loading-lg.gif'></p>";
	var loading_tabel = "<tr><td colspan='20' style='background-color:#fff;'><img style='padding:25px 0;' src='<?php echo base_url(); ?>assets/apps/dist/gif/loading-text.gif'></td></tr>";
	
	
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();

	function loadJabatan(){
		$("#id_jabatan").html("<option value=''>Loading...</option>");
		var id_jenis_jabatan = $("#id_jenis_jabatan").val();
		var id_opd = $("#id_opd").val();
		$.ajax({
			url		: "<?php echo base_url(); ?>apps/c_auto_complete/loadJabatan/?id_jenis_jabatan="+id_jenis_jabatan+"&id_opd="+id_opd,
			cache	: false,
			success	: function(data){
				$("#id_jabatan").html(data);
			}
		});
	}

	function loadDesa2(){
		$("#pem_Desa").html("<option value=''>Loading...</option>");
		var pem_Kecamatan = $("#pem_Kecamatan").val();
		$.ajax({
			url		: "<?php echo base_url(); ?>apps/c_auto_complete/loadDesa/?kecamatan_id="+pem_Kecamatan,
			cache	: false,
			success	: function(data){
				$("#pem_Desa").html(data);
			}
		});
	}

	function titik(v){
		$(v).priceFormat({
			limit: 15,
			centsLimit: 0,
			allowNegative: true,
			prefix: '',
			centsSeparator: ',',
			thousandsSeparator: '.'
		});
	}


	function eksekusi_post_data(method,data) {
		Pace.restart();
		eksekusi_loading();
		var url1 = method;
		//$(".uri").html(url1);
		$.post(url1,data,function(e){
			$("#page_content").html(e);
			func_all();
		});
	}

	function eksekusi_post_notif(method,data,callback){
		eksekusi_loading();
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "POST",
			data: data,
			success: function(e){
				var json = $.parseJSON(e);
				notify(json.tipe,json.msg);
				callback();
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_get_data(method,data) {
		Pace.restart();
		eksekusi_loading();
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "GET",
			data: data,
			success: function(e){
				$("#page_content").html(e);
				func_all();
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_get_notif(method,data,callback){
		eksekusi_loading();
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "GET",
			data: data,
			success: function(e){
				var json = $.parseJSON(e);
				notify(json.tipe,json.msg);
				callback();
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_get(method){
		Pace.restart();
		eksekusi_loading();
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "GET",
			success: function(e){
				$("#page_content").html(e);
				func_all();
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_get_sub(method){
		Pace.restart();
		eksekusi_loading2();
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "GET",
			success: function(e){
				$("#page_content-2").html(e);
				func_all();
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_modal(method){
		$('.modal').modal('show');
		$(".modal-body").html('Loading...');
		var url1 = method;
		//$(".uri").html(url1);
		$.ajax({
			url: url1,
			type: "GET",
			success: function(e){
				$(".modal-body").html(e);
			},
			error: function (jqXHR, exception) {
				getErrorMessage(jqXHR, exception);
			}
		});
	}

	function eksekusi_url(method){
		Pace.restart();
		window.location=method;
	}

	function eksekusi_loading(){
		$("html,body").animate({scrollTop: 0}, 500);
		$("#page_content").html('<p class="text-left"><img style="margin:20px;" src="<?php echo base_url(); ?>assets/apps/dist/gif/load-v2.gif"></p>');
	}

	function eksekusi_loading2(){
		$("#page_content-2").html('<p class="text-left"><img style="margin:20px;" src="<?php echo base_url(); ?>assets/apps/dist/gif/load-v2.gif"></p>');
	}

	function notify(tipe,msg) {
		$.notify({
			title: '<strong>Information</strong>',
			icon: 'glyphicon glyphicon-bullhorn',
			message: '<p class="text-center">'+msg+'</p>'
		},{
			type: tipe,
			animate: {
				enter: 'animated fadeInUp',
				exit: 'animated fadeOutRight'
			},
			placement: {
				from: "bottom",
				align: "right"
			},
			offset: 10,
			spacing: 10,
			z_index: 1031,
			//timer:6000,
		});
	}

	function getErrorMessage(jqXHR, exception) {
		var msg = '';
		if (jqXHR.status === 0) {
			msg = 'Not connect.\n Verify Network.';
		} else if (jqXHR.status == 404) {
			msg = 'Requested page not found. [404]';
		} else if (jqXHR.status == 500) {
			msg = 'Internal Server Error [500].';
		} else if (exception === 'parsererror') {
			msg = 'Requested JSON parse failed.';
		} else if (exception === 'timeout') {
			msg = 'Time out error.';
		} else if (exception === 'abort') {
			msg = 'Ajax request aborted.';
		} else {
			msg = 'Uncaught Error.\n' + jqXHR.responseText;
		}
		$("#page_content").html(msg);
	}

	function func_all() {
		$(document).ready(function($){

			titik(".titik_js");

			

			$(".tgl").datepicker({
				buttonText: "Calender",
				showButtonPanel: true,
				minDate: "-100Y", maxDate: "0",
				changeMonth: true,
				changeYear: true,
				dateFormat:'dd-mm-yy'
			});

			$(".tanggal").datepicker({
				showOn: "button",
				buttonImage: "<?php echo base_url(); ?>assets/apps/dist/img/calender.png",
				buttonImageOnly: true,
				buttonText: "Calender",
				showButtonPanel: true,
				//minDate: "-100Y", maxDate: "0",
				yearRange: "-99:+1",
				changeMonth: true,
				changeYear: true,
				dateFormat:'dd-mm-yy'
			});

			$(".bulan_tahun").datepicker({
				showOn: "button",
				buttonImage: "<?php echo base_url(); ?>assets/apps/dist/img/calender.png",
				buttonImageOnly: true,
				buttonText: "Calender",
				showButtonPanel: true,
				minDate: "-100Y", maxDate: "0",
				changeMonth: true,
				changeYear: true,
				dateFormat:'mm-yy'
			});

			$('#pegawai_auto').autocomplete({
				source: function(request, response) {
					$.getJSON("<?php echo base_url(); ?>apps/c_pegawai/pegawai_auto",{term: request.term,status_user: $('#status_user').val()},response);
				},
				minLength:1,
				select: function(event,ui){
					$("#id_pegawai").val(ui.item.id_pegawai);
					$("#nip").val(ui.item.nip);
				}
			});
			
			$('#nama_opd').autocomplete({
				source: function(request, response) {
					$.getJSON("<?php echo base_url().'apps/c_master_jabatan/opd_auto'?>",{term: request.term,nama_opd: $('#nama_opd').val()},response);
				},
				minLength:1,
				select: function(event,ui){
					$("#nama_opd").val(ui.item.nama_opd);
					$("#id_opd").val(ui.item.id_opd);
				}
			});
			
			$('#nama_jenis_jabatan').autocomplete({
				source: function(request, response) {
					$.getJSON("<?php echo base_url().'apps/c_master_jabatan/jenis_jabatan_auto'?>",{term: request.term,nama_jenis_jabatan: $('#nama_jenis_jabatan').val()},response);
				},
				minLength:1,
				select: function(event,ui){
					$("#nama_jenis_jabatan").val(ui.item.nama_jenis_jabatan);
					$("#id_jenis_jabatan").val(ui.item.id_jenis_jabatan);
				}
			});

			$('.pegawai_auto').autocomplete({
				source: function(request, response) {
					$.getJSON("<?php echo base_url(); ?>apps/c_auto_complete/pegawaiAutocomplete",{term: request.term,status_user: $('#status_user').val()},response);
				},
				minLength:1,
				select: function(event,ui){
					$(".id_pegawai").val(ui.item.id_pegawai);
				}
			});

		});
	}

	$(document).ready(function($){
		//load_badge_notif();
	});

	function load_badge_notif(){
		load_badge_notif5();
		load_badge_notif6();
		load_badge_notif7();
		/*load_badge_notif8();
		load_badge_notif9();
		load_badge_notif10();*/
	}

	function load_badge_notif5(){
		$.ajax({
			url		: "<?php echo base_url(); ?>apps/c_proses_aduan/count?status_aduan=1",
			success	: function(data){
				$("#badge_notif5").html(data);
			}
		});
	}
	function load_badge_notif6(){
		$.ajax({
			url		: "<?php echo base_url(); ?>apps/c_proses_aduan/count?status_aduan=2",
			success	: function(data){
				$("#badge_notif6").html(data);
			}
		});
	}
	function load_badge_notif7(){
		$.ajax({
			url		: "<?php echo base_url(); ?>apps/c_proses_aduan/count?status_aduan=3",
			success	: function(data){
				$("#badge_notif7").html(data);
			}
		});
	}
	function load_badge_notif8(){
		$.ajax({
			url		: "<?php echo base_url(); ?>apps/c_proses_aduan/count?status_aduan=4",
			success	: function(data){
				$("#badge_notif8").html(data);
			}
		});
	}
	function load_badge_notif9(){
		$.ajax({
			url		: "<?php echo base_url(); ?>apps/c_proses_aduan/count?status_aduan=5",
			success	: function(data){
				$("#badge_notif9").html(data);
			}
		});
	}
	function load_badge_notif10(){
		$.ajax({
			url		: "<?php echo base_url(); ?>apps/c_proses_aduan/count?status_aduan=6",
			success	: function(data){
				$("#badge_notif10").html(data);
			}
		});
	}
</script>