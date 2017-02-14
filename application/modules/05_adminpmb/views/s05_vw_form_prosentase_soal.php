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
		var soal=$('#soal option:selected').val();
		var jalur_masuk=$('#jalur_masuk option:selected').val();
		//var tes = $('#tes').val();
		//console.log(soal);
		$.ajax({
			url: "<?php echo base_url() ?>adminpmb/admtools-soal/prosentase",
			data: {'0':soal,'1':jalur_masuk},
			//processData: false,
			//contentType: false,
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
		/*$.post("<?php echo base_url() ?>adminpmb/tools-soal/prosentase", {'0':soal}, function(res){
				$("#prev_load").html(res);	
			}, 'text').beforeSend = function(){
				$("#prev_load").html(	'<div id="separate"></div>'+
										'<center><img src="<?php echo base_url(); ?>asset/img/loading.gif"></center>'+
										'<div id="separate"></div>'+
										'<center><font size="2px">Harap menunggu</font></center>')};*/
	}
</script>
<h2>Kelola Nilai Tes</h2>
<?php
/* $crumbs = array(array('Beranda'=>base_url()),array('Nilai Tes' => ''));
$this->s00_lib_output->output_crumbs($crumbs); */
?>
<div class='bs-callout bs-callout-warning'><p>
	<ul>		
		<li>Hitung Salah Benar</li> 
	</ul>
</p></div>
<div class="form-horizontal">
	<div id="separate"></div>
	<div class="control-group">	
	<label class="control-label" for="inputEmail">Pilih Jalur Masuk</label>
		<div class="col-xs-4">
			<select name='jalur_masuk' id="jalur_masuk" class="form-control input-sm">
				<?php
				foreach($jalur_masuk as $value){
					echo"<option value='".$value->PMB_KODE_JALUR_MASUK."'>".$value->PMB_NAMA_JALUR_MASUK."</option>";
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
		<label class="control-label"></label>
		<div class="col-xs-4">
			<button class="btn btn-inverse btn-uin" onclick="prev_nilai(); return false;">Hitung Salah Benar</button>
		</div>
	</div>
</div>
<!--/form-->
<div id="prev_load"></div>
