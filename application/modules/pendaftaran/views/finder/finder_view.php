
	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }



	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	
	</style>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/jquery-ui/css/base/jquery-ui.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/elfinder/css/theme.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/elfinder/css/elfinder.min.css'); ?>" />
	<script type="text/javascript" src="<?php echo base_url('asset/jquery-1.7.2.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('asset/jquery-ui/js/jquery-ui.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('asset/elfinder/js/elfinder.min.js'); ?>"></script>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#elfinder-tag').elfinder({
				url: '<?php echo site_url('admin/finder/elfinder'); ?>',
			}).elfinder('instance');
		});
	</script>


<div id="content-admin">
	<h2>File Manager</h2>
	<br/>
	<div>
		<div id="elfinder-tag"></div>
	</div>

</div>
