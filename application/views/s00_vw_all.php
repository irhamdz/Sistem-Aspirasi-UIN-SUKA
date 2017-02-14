<?php
error_reporting(0);
	//$app_category = $in_data['app_category'];
	$pieces = explode('/', $content);
	//$data_=$						
	if(!isset($data_['app_category'])){
		$pieces = explode('/', $content);
		if (isset($pieces[0])) { $data_['app_category'] = $pieces[0]; } #.'/'.$pieces[1]; $pieces[0].'/'.$pieces[1];
		if (isset($pieces[1])) { $data_['app_subcategory'] = $pieces[1]; }
		#$data_['submenu_02mhs_2013'] = $CI->sb_menu2->pack_menu();
	}
	$data['data']['app_category']=$data_['app_category'];
	$data['data']['app_subcategory']=$data_['app_subcategory'];
	#print_r($data); die();
	$data['content']=$content;
	$data['in_data']=$data_;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="expires" content="mon, 22 jul 2032 11:12:01 gmt">
		<meta http-equiv="cache-control" content="no-cache">
		<title><?php if(!empty($artikel)):$this->load->view('titles',$data);endif;?><?php echo $this->config->item('app_name').' '.$this->config->item('app_owner_s'); ?></title>
		<link href="http://static.uin-suka.ac.id/images/favicon.png" type="image/x-icon" rel="shortcut icon">
		<link href="http://static.uin-suka.ac.id/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
		<link href="http://admisi.uin-suka.ac.id/asset/css/style_global.css" rel="stylesheet" type="text/css"/>
		<link href="http://static.uin-suka.ac.id/css/style_layout.css" rel="stylesheet" type="text/css"/>
		<link href="http://static.uin-suka.ac.id/css/docs.css" rel="stylesheet" type="text/css"/>
	<!--	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro">-->
		<script src="http://static.uin-suka.ac.id/js/jquery-1.8.1.js"></script>
		<link href="http://static.uin-suka.ac.id/css/breadcrumb.css" rel="stylesheet" type="text/css"/>
		
		<link href="http://static.uin-suka.ac.id/plugins/bootstrap/css/bootstrap_2.css" rel="stylesheet" type="text/css"/> 
		
		<script src="http://static.uin-suka.ac.id/js/jquery.mCustomScrollbar.init.js"></script>
		<script src="http://static.uin-suka.ac.id/js/jquery.mCustomScrollbar.min.js"></script>
		<script src="http://static.uin-suka.ac.id/js/redactor.min.js"></script>
		
		<link href="http://static.uin-suka.ac.id/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
		<link href="http://static.uin-suka.ac.id/css/jquery.jqplot.min.css" rel="stylesheet" type="text/css"/>
		<link href="http://static.uin-suka.ac.id/css/redactor.css" rel="stylesheet" type="text/css"/>
		<link href="http://static.uin-suka.ac.id/css/navigation.css" rel="stylesheet" type="text/css"/>
	
		
		
		<script src="http://static.uin-suka.ac.id/plugins/dynatree/jquery/jquery-ui.custom.js" type="text/javascript"></script>
		<script src="http://static.uin-suka.ac.id/plugins/dynatree/jquery/jquery.cookie.js" type="text/javascript"></script>
		<script src="http://static.uin-suka.ac.id/plugins/dynatree/jquery/jquery.cookie.js" type="text/javascript"></script>
		<link href="http://static.uin-suka.ac.id/plugins/dynatree/src/skin-vista/ui.dynatree.css" rel="stylesheet" type="text/css">
		<script src="http://static.uin-suka.ac.id/plugins/dynatree/src/jquery.dynatree.js" type="text/javascript"></script>
		
		
		
		<link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-datetimepicker.min2.css" rel="stylesheet" type="text/css">
		<link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min2.css" rel="stylesheet" type="text/css">
		
		<script src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-datetimepicker.min2.js" type="text/javascript"></script>
		<script src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.min2.js" type="text/javascript"></script>
		
		<script>
			function isNumberKey(evt){
				var charCode = (evt.which) ? evt.which : event.keyCode
				if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;
				return true;
			}
		</script>
		<style>
		.reg-info {
			font-size: 11px;
			line-height: 15px;
			margin-bottom: 10px;
			color: #777777;
			}
			
			
		.ac_results ul {
			width: 100%;
			list-style-position: outside;
			list-style: none;
			padding: 0;
			margin: 0;
		}
		.ac_results li {
			margin: 0px;		
			cursor: default;
			display: block;
			font: menu;		
			overflow: hidden;
			display:block;
			padding: 3px 5px;
			cursor:pointer;
		}
		.ac_results li a{
			display:block;
			padding: 3px 5px;
		}
		.ac_results li:hover{
			background:#dedede;
		}
		.ac_results li.nope{
			cursor:auto;
		}
		.ac_results li.nope:hover{
			background:none;
		}
				
		.suggestionsBox {
			border: 1px solid #cccccc;
			position: absolute;
			z-index: 5;
			width: 250px;
			padding: 0px;
			background: #FFFFFF;
			margin-top: -5px;
			color: #333;
			-moz-border-radius: 5px;
			border-radius: 5px;
		}
		</style>
		<?php //Masdaru ?>
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||
		   function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-27090148-2', 'uin-suka.ac.id');
			ga('send', 'pageview');
		</script>
	
<!--
<link href="http://static.uin-suka.ac.id/css/style.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/css/style.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/css/style_sp_post.css" rel="stylesheet" type="text/css"/>

<link href="http://static.uin-suka.ac.id/css/dynatree/dynatree.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/css/jquery.jqplot.min.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/css/redactor.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/css/css_ui.css" rel="stylesheet" type="text/css"/>

<!--<link href="http://static.uin-suka.ac.id/css/jquery-ui.css" rel="stylesheet" type="text/css"/>-->
			
<!--		
<link href="http://static.uin-suka.ac.id/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/css/progtracker.css" rel="stylesheet" type="text/css"/>

		<script>var $site_url = 'http://registrasi.uin-suka.ac.id//';</script>

<script src="http://static.uin-suka.ac.id/js/js_ui.js"></script>
<script src="http://static.uin-suka.ac.id/js/enhance.js"></script>
<script src="http://static.uin-suka.ac.id/js/jQuery.fileinput.js"></script>
<!-- custom scrollbars plugin -->
<!--	
<script src="http://static.uin-suka.ac.id/js/jquery.mCustomScrollbar.min.js"></script>
<script src="http://static.uin-suka.ac.id/js/jquery.mCustomScrollbar.init.js"></script>
<script src="http://static.uin-suka.ac.id/js/redactor.min.js"></script>
<script src="http://static.uin-suka.ac.id/js/bootstrap-datetimepicker.min.js"></script>
<script src="http://static.uin-suka.ac.id/js/bootstrap-timepicker.min.js"></script>
-->			
	</head>
    <body>
		<div class="app_header-top"></div>
		<div class="app_main">
			<div class="app_header">
				<div class="center">
					<div class="app_uin_id">
						<a href="<?php echo site_url(); ?>" ></a>
					</div>
					<div class="app_header_right">
						<div class="app_system_id"><?php echo $this->config->item('app_name'); ?></div>
						<div class="app_univ_id"><?php echo $this->config->item('app_owner_s'); ?></div>
						<?php if($this->session->userdata('status') != ''): ?>
								<div class="sia-basic_header-app-id-fct"><?php echo $this->session->userdata('siapa_aku');?></div>
						<?php endif; ?>		
					</div>
					<div class="clear"></div>
				</div>
			</div><?php $this->load->view('content',$data);?>
			<div class="clear5"></div>
<?php
$foot=json_decode(file_get_contents("http://uin-suka.ac.id/index.php/service/footer2"));
	$identity= json_decode(file_get_contents("http://uin-suka.ac.id/index.php/service/identity2"));
	// $foot=json_decode(file_get_contents("http://uin-suka.ac.id/index.php/service/footer"));
	// $identity= json_decode(file_get_contents("http://uin-suka.ac.id/index.php/service/identity"));
	echo $identity->content;
echo $foot->content;
?>
</div>
	</body>
</html>