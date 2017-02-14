
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxexpander.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxvalidator.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxcheckbox.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/globalization/globalize.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxcalendar.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxdatetimeinput.js"></script> 
    <script type="text/javascript" src="<?php echo base_url()?>/asset/jqwidgets/jqxmaskedinput.js"></script> 
   


    <script type="text/javascript">
        $(document).ready(function () {
            var theme = getDemoTheme();
         $('#submit-btn').jqxButton({ width: 70, theme: theme });
    
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
			<h2>Dokumen</h2>
		</div>
			<table align="left" class="form-table">
				<tr>
					<td colspan="3"><label class='form-label'>Nama Dokumen :<span class="required">*</span></label</td>
				</tr>
				<tr>
					<td colspan="3"><input placeHolder="Judul" name="judul" type="text" id="judul" style='width: 100%;' class="text-input" /></td>
				</tr>
				<tr>
					<td colspan="3"><label class='form-label'>File :<span class="required">*</span></label</td>
				</tr>
				<tr>
					<td colspan="3"><input placeHolder="file" name="photo" type="file" id="file" style='width: 100%;' class="text-input" /></td>
				</tr>
				<tr>
					<td colspan="3"><br><input type="button" value="Simpan" id="submit-btn" /></td>            
				</tr>
			</table>
	</form>
</div>