<script type="text/javascript">
	// Run capabilities test
	enhance({
		loadScripts: [
			//'<?php echo base_url(); ?>asset/js/jquery.js',
			//'<?php echo base_url(); ?>asset/js/jQuery.fileinput.js',
			'<?php echo base_url(); ?>asset/js/file-upload.js'
		],
		loadStyles: ['<?php echo base_url(); ?>asset/css/enhanced.css']	
	});
	
	function prev_nilai(){
		var fd = new FormData();
		fd.append( 'userfile', userfile.files[0] );
		fd.append( 'jalur', $('#jalur_masuk option:selected').val() );
		fd.append( 'soal', $('#soal option:selected').val() );

		$.ajax({
			url: "<?php echo base_url() ?>adminpmb/admtools-moco_dat/upload",
			data: fd, 
			processData: false,
			contentType: false,
			type: 'POST',
			beforeSend: function(){
				$("#prev_load").html(	'<div id="separate"></div>'+
										'<center><img src="<?php echo base_url(); ?>asset/img/loading.gif"></center>'+
										'<div id="separate"></div>'+
										'<center><font size="2px">Harap menunggu</font></center>');
			},
			success: function(html){
				$("#prev_load").html(html);	
			}
		});
	}
</script>
<h2>Kelola LJK</h2>
<?php
/* $crumbs = array(array('Beranda'=>base_url()),array('Data LJK' => ''));
$this->s00_lib_output->output_crumbs($crumbs); */
?>
<div class='bs-callout bs-callout-warning'><p>
	<ul>		
		<li>Upload file(.dat) hasil SCAN LKJ dengan menekan tombol <b>Upload</b></li> 
	</ul>
</p></div>
<!--form accept-charset="utf-8" method="POST" action="<?php echo base_url(); ?>kkn/kkn_admin/nilai_bt_preview" class="form-horizontal" enctype="multipart/form-data" name="filUpload"-->
<div class="form-horizontal">
	<div id="separate"></div>
	<div class="control-group">	
	<label class="control-label" for="inputEmail">Pilih Jalur Masuk</label>
		<div class="col-xs-4">
			<select name='jalur_masuk' id="jalur_masuk" class="form-control input-sm">
				<?php
				foreach($jalur_masuk as $value){
					echo"<option value='".$value->PMB_KODE_JALUR_MASUK."|".$value->PMB_KODE_JENIS_PENERIMAAN."'>".$value->PMB_NAMA_JALUR_MASUK."</option>";
				}
				?>
			</select>
		</div>	
	</div>
	
	<div class="control-group">	
	<label class="control-label" for="inputEmail">Pilih Kode Soal</label>
		<div class="col-xs-4">
			<select name='kode' id="soal" class="form-control input-sm">
				<?php
				foreach($master_soal as $value){
					echo"<option value='".$value->PMB_KODE_MASTER_SOAL."'>".$value->PMB_NAMA_MASTER_SOAL."</option>";
				}
				?>
			</select>
		</div>	
	</div>
	
	<div class="control-group">	
		<label class="control-label" for="inputEmail">Masukkan Hasil SCAN LJK</label>
		<div class="col-xs-6">
			<div id="input-file">
				<input type='file' name='userfile' id='userfile' />			
			</div>
		</div>
	</div>	
	<div class="control-group">
		<label class="control-label"></label>
		<div class="col-xs-6">
			<button class="btn btn-inverse btn-uin" onclick="prev_nilai(); return false;">Upload LJK</button>
		</div>
	</div>
</div>
<!--/form-->
<div id="prev_load"></div>