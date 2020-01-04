<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo config_item('app_client1'); ?> | <?php echo config_item('app_client2'); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/apps/favicon.ico" />
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/apps/plugins/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	-->	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/apps/dist/css/adminlte.min.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/apps/plugins/morris/morris.css">
	<!-- jquery-ui -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/apps/plugins/jquery-ui/jquery-ui.css"/>

	<!-- Google Font: Source Sans Pro -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
-->	<!-- Font Awesome -->
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	--><!-- Ionicons -->
	<!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	--><!-- Theme style -->
	<!-- Google Font: Source Sans Pro -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
		--><style type="text/css">
		.form-group legend,.form-group label{
			margin: 0;
			padding: 0;
		} 
		.nav-tabs{
			border-bottom: 8px solid #fff;
		}
		.nav-tabs li.nav-item a.nav-link{
			background-color: #fff;
			margin: 1px;
			border-top: 4px solid #d4edd9;
			border-left: 1px solid #d4edd9;
			border-right: 1px solid #d4edd9;
		}
		.nav-tabs li.nav-item:hover a.nav-link{
			border-top: 4px solid #28a745;
			border-left: 1px solid #28a745;
			border-right: 1px solid #28a745;
			border-bottom: none;
		}
		.nav-tabs li.nav-item a.active{
			border-top: 4px solid #28a745;
			border-left: 1px solid #28a745;
			border-right: 1px solid #28a745;
		}

		.table{
			margin: 0;
			padding:0;
		}
		.table th{
			background-color: #eee;
			padding: 5px 5px;
			border-top: 2px solid #ccc;
			text-transform: capitalize;
		}
		.table td{
			padding: 2px 5px;
		}

		.table thead.thead2 th{
			padding: 2px;
		}
		.btn{
			text-transform: capitalize;
		}
		.tanggal{
			width: 110px;
			float: left;
		}
		.table-responsive{
			border-bottom: 1px solid #ddd;
			margin-bottom: 20px;
		}
		.line-h{
			margin-top: 15px;
			border-bottom: 5px solid #aaa;
		}

		#cssmenu > ul > li > ul > li > a.active{
			background-color: rgba(255,255,255,.2);
			color: #fff;
		}
		input[data-readonly] {
			pointer-events: none;
		}
		.img-thumbnail2{
			width: 100%;
			height: 150px;
			object-fit: cover;
			overflow: hidden;
		}

		.ui-autocomplete-loading{

			background: white url("../assets/apps/dist/gif/load.gif") right center no-repeat;

		}
		.table-drh{
			border-collapse: collapse;
		}
		.table-drh, th, td {
			border-top: 1px solid #ddd;
		}
		.row .form-control{
			margin: 2px;
		}
	</style>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">