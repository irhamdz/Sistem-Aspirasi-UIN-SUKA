<h2 style="margin-bottom:30px;">Impor Data Mata Pelajaran</h2>
<?php $msg = $this->session->flashdata('message');?>
<?php if(isset($msg) and !empty($msg)):?>
	<div id="information" class="bs-callout bs-callout-error">
		<?php echo $this->session->flashdata('message');?>
	</div>
<?php endif ?>
<form method="post" class=" form-horizontal" action="" enctype="multipart/form-data">
	<hr>
	<div class="form-group form-group-sm">
		<label class="col-sm-2 control-label" for="formGroupInputSmall">Tahun</label>
		<div class="col-sm-3">
			<select name="tahun" id="tahun" class="form-control">
				<?php for($t=date('Y'); $t>=2015; $t--): ?>
					<?php
					
						if($t==$tahun){
							echo "<option value='".$t."' selected>".$t."</option>";
						}else{
							echo "<option value='".$t."'>".$t."</option>";
						} 
					?>	
				<?php endfor ?>
			</select>
		</div>
		<div style="clear:both"></div>
	</div><hr>
	<div class="form-group form-group-sm">
		<label class="col-sm-2 control-label" for="formGroupInputSmall">File</label>
		<div class="col-sm-6">
			<input type="file" name="file" id="file" class="form-control" style="padding:0"/>
		</div>
		<div style="clear:both"></div>
	</div><hr>
	 <div class="form-group form-group-sm">
		<label class="col-sm-2 control-label" for="formGroupInputSmall"></label>
		<div class="col-sm-6">
			<button type="submit" class="btn btn-inverse">Simpan</button>
		</div>
		<div style="clear:both"></div>
	</div>	
</form>
<div id="information" class="bs-callout bs-callout-success">
	Format excel dapat didownload <a href="<?php echo base_url().'media/download/format_upload_data_jurusan.xls'?>" class="btn btn-sm btn-success" style="color:#fff">disini</a>
	<br><br>
	Format upload data siswa terdiri dari 2 kolom:
	<ol>
		<li>Kode Jurusan</li>
		<li>Jurusan</li>
	</ol>
</div>
<script>
	$(function(){
		setTimeout('closing_msg()', 4000);
	})

	function closing_msg(){
		$("bs-callout-error").slideUp();
	}
</script>