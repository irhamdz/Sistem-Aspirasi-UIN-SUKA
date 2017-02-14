
<?php foreach($page as $p){} ?>
    <script type="text/javascript" src="<?php echo base_url()?>/asset/scripts/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxexpander.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxvalidator.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxbuttons.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxcheckbox.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/globalization/globalize.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxcalendar.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxdatetimeinput.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxmaskedinput.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/scripts/gettheme.js"></script> 
    <style type="text/css">
   
       .text-input
        {
            height: 24px;
            width: 150px;
        }
        .form-table
        {
			width:600px;
            margin-bottom: 10px;
			table-layout:fixed;
        }
        .form-table td, 
        .form-table tr
        {
            margin: 0px;
            border-spacing: 0px;
            border-collapse: collapse;
            font-family: Verdana;
        }
        h3 
        {
            display: inline-block;
            margin: 0px;
        }
		.required
		{
			vertical-align: baseline;
			color: red;
			font-size: 10px;
		}
		.form-label
		{
			vertical-align: baseline;
			font-weight: bold;
			font-size: 13px;
			margin-top: 10px;
		}
    </style>
</head>

    <script type="text/javascript">
        $(document).ready(function () {
            var theme = getDemoTheme();
         $('#submit-btn').jqxButton({ width: 70, theme: theme });
       
            $('.text-input').addClass('jqx-input');
            $('.text-input').addClass('jqx-rc-all');
            if (theme.length > 0) {
                $('.text-input').addClass('jqx-input-' + theme);
                $('.text-input').addClass('jqx-widget-content-' + theme);
                $('.text-input').addClass('jqx-rc-all-' + theme);
            }
    
            // initialize validator.
            $('#form').jqxValidator({
		     rules: [
                    { input: '#judul', message: 'Judul harus diisi!', action: 'keyup, blur', rule: 'required' },
                    ]
            });

            // validate form.
            $("#submit-btn").click(function () {
                var validationResult = function (isValid) {
                    if (isValid) {
                        $("#form").submit();
                    }
                }
                $('#form').jqxValidator('validate', validationResult);
            });

            $("#form").on('validationSuccess', function () {
                $("#form-iframe").fadeIn('fast');
            });
        });
    </script>

<div>  
    <form class="form" id="form" target="form-iframe"  method="post" action="" style="font-size: 13px; font-family: Verdana; " enctype="multipart/form-data">
		<div>
			<h2>Dokumen Akademik</h2>
		</div>
			<table align="left" class="form-table">
				<tr>
					<td colspan="3"><label class='form-label'>Nama Dokumen :<span class="required">*</span></label></td>
				</tr>
				<tr>
					<td colspan="3"><input placeHolder="E-mail" name="judul" type="text" id="judul" value="<?php echo $p->nama ?>"style='width: 100%;' class="text-input" /></td>
				</tr>
				<tr>
					<td colspan="3"><label class='form-label'>File Lama: </label><?php echo $p->file_data ?></td>
				</tr>
				<tr>
					<td colspan="3"><label class='form-label'>File :<span class="required">*</span></label></td>
				</tr>
				<tr>
					<td colspan="3"><input placeHolder="file" name="photo" type="file" id="file" style='width: 100%;' class="text-input" /></td>
				</tr><tr>
					<td colspan="3"><br></td>
				</tr>
				<tr>
					<td colspan="3"><input type="submit" id="submit-btn" value="Simpan"/></td>            
				</tr>
			</table>
	</form>
</div>