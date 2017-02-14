<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		  <?php 
		if(isset($title)){
			echo "<title>".$title."</title>";
			echo"<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
			echo" <meta content='".$title."' name='description'/>";
		}else{
			echo"<title>PTIPD UIN Sunan Kalijaga</title>";
			echo" <meta content='UIN Sunan Kalijaga' name='description'/>";
		}
		?>
		<link href="http://static.uin-suka.ac.id/images/favicon.png" type="image/x-icon" rel="shortcut icon">
		<link href="http://static.uin-suka.ac.id/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
		<link href="http://static.uin-suka.ac.id/css/style_global.css" rel="stylesheet" type="text/css"/>
		<link href="http://static.uin-suka.ac.id/css/style_layout.css" rel="stylesheet" type="text/css"/>
		<link href="http://static.uin-suka.ac.id/css/docs.css" rel="stylesheet" type="text/css"/>
		
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro">

		<script src="http://static.uin-suka.ac.id/js/jquery-1.8.1.js"></script>
		<link href="http://static.uin-suka.ac.id/css/web_menu.css" rel="stylesheet" type="text/css"/>
		<link href="http://static.uin-suka.ac.id/css/web_style.css" rel="stylesheet" type="text/css"/>

	<!--BREADCRUMB-->
		<link href="http://static.uin-suka.ac.id/css/breadcrumb.css" rel="stylesheet" type="text/css"/>
	<!--=====-->
			
		
		<script src="http://static.uin-suka.ac.id/js/jquery.mCustomScrollbar.init.js"></script>
		<script src="http://static.uin-suka.ac.id/js/jquery.mCustomScrollbar.min.js"></script>
		<script src="http://static.uin-suka.ac.id/js/redactor.min.js"></script>
		
		<link href="http://static.uin-suka.ac.id/css/navigation.css" rel="stylesheet" type="text/css"/>
		
		
	
		
	
	</head>
    <body>
		<div class="app_header-top"></div>
		<div class="app_main">
			<div class="app_header">
				<div class="center">
					<div class="app_uin_id">
						<a href="<?php echo base_url()?>" ></a>
					</div>
					<div class="app_header_right">
						<div style="text-align:right; margin-top:-15px;">
							<div>
								<div class="app_system_id">Pusat Teknologi Informasi Dan Pangkalan Data</div>
							</div>
							<div class="clear5"></div>
							<div>
							<form class="searchform" action="<?php echo site_url('page/search')?>" method="post">
								<input class="searchfield" type="text" name="cari" value="Kata kunci..." onfocus="if (this.value == 'Kata kunci...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Kata kunci...';}" />
								<button class="searchbutton">Cari</button>
							</form>
							</div>
									
							
				<div class="clear"></div>
		
				
				</div>
			</div>
			</div>
					