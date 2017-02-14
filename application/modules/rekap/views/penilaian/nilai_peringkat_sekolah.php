<div id="system-content">	
	<div id="content-space">
		<div style="margin:20px 0;"><h3>NILAI PERINGKAT SEKOLAH</h3></div>
			<form class="form-inline" method="post" action="">
				  <div class="form-group">
					<label for="prodi">Program Studi &nbsp;&nbsp;&nbsp;</label>
					<select name="prodi" id="prodi" class="form-control input-sm">
							<option value="" >PILIH PROGRAM STUDI</option>
							<?php foreach($prodi as $p): ?>
								<?php
									if($p->kode_program_studi==$kode_prodi){
										echo "<option value='".$p->kode_program_studi."' selected>".$p->program_studi."</option>";
									}else{
									echo "<option value='".$p->kode_program_studi."'>".$p->program_studi."</option>";
									}
								?>	
							<?php endforeach ?>
						</select>
				  </div>
			</form>
			<br>
				<?php $a = $this->session->flashdata('message');?>
				<?php if($a!=null):?>
					<div class="msg_alert alert alert-info">
						<?php echo $a[1]?>
					</div>
					
					<script type="text/javascript" charset="utf-8">
						$(function(){
							setTimeout('closing_msg()', 4000)
						})

						function closing_msg(){
							$(".msg_alert").slideUp();
						}
					</script>
				<?php  endif;?>
			<br>
									
		<form action="" method="post" style="text-align:right">
		<input type="hidden" name="action" value="update nilai yudisium"/>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</form>	<br>
		<table border="1" class="table table-bordered table-hover">
			<tr>
				<th width="10px"><center>No</center></th>
				<th><center>No Pendaftaran</center></th>
				<th><center>Nama Siswa</center></th>													
				<th><center>Nilai</center></th>														
			</tr>	
			<?php $i=0 ?>
			<?php foreach($na as $s):?>
			<tr>
				<td><center><?php echo ++$i ?></center></td>
				<td><?php echo $s->nomor_pendaftaran ?></td>
				<td><?php echo $s->nama_siswa ?></td>
				<td style="text-align:center"><?php echo round(str_replace(',','.',$s->nilai),2) ?></td>
			</tr>
			<?php endforeach ?>
			
		</table>
	</div>	
</div>	
	
<script>
$('#prodi').on('change', function() {
  var prodi= this.value; 
  window.location.href="<?php echo site_url('snmptn/penilaian/set_prodi/nilai_peringkat_sekolah')?>/"+prodi;
});</script>						