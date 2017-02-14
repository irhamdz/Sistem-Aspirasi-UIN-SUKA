<div id="system-content">	
	<div id="content-space">
		<div style="width:450px;">
			<div style="margin:20px 0;"><h3>NILAI AKREDITASI SEKOLAH</h3></div>
			<div id="bas_msg">
				<?php $a = $this->session->flashdata('message');?>
				<?php if($a!=null):?>
					<div class="msg_alert alert alert-info">
						<?php echo $a[1]?>
					</div>
					
				<?php  endif;?>
			</div>
			<form id="basform" method="post" action="">
			<input type="hidden" name="jenis_pembobotan" value="pembobotan akreditasi sekolah" />
				<table class="table">
					<tr>
					<?php 
					foreach($bobot_akreditasi_sekolah as $bas){
						echo"<td>".$bas->LABEL."</td>";
					}
					?>
					</tr>
					<tr>
					<?php 
					$i=0 ;
					$totalbas=0;
					foreach($bobot_akreditasi_sekolah as $bas){
						$totalbas+=$bas->NILAI_AKREDITASI_SEKOLAH;
						++$i;
					?>
						<td><input id="bas<?php echo $i; ?>" class="numeric bas" style="width:40px; margin:0; text-align:right;" type="text" name="bas[<?php echo $bas->AKREDITASI_SEKOLAH ?>]" value="<?php echo $bas->NILAI_AKREDITASI_SEKOLAH ?>" maxlength="3" /></td>
					<?php } ?>
					</tr>
				</table>
				<button type="submit" class="btn btn-primary" style="font-size:14px">Simpan Bobot Akreditasi Sekolah</button>	
			</form>	
		</div>
		
	<div style="margin:20px 0; margin-top:40px;"><h3>NILAI AKREDITASI SEKOLAH PER SISWA</h3></div>
		<table border="1" class="table table-bordered table-hover">
			<tr>
				<th width="10px"><center>No</center></th>
				<th><center>No Pendaftaran</center></th>
				<th><center>Nama Siswa</center></th>
				<th><center>Akreditasi Sekolah</center></th>														
				<th><center>Nilai</center></th>														
			</tr>	
			<?php $i=0 ?>
			<?php foreach($na as $s):?>
			<tr>
				<td><center><?php echo ++$i ?></center></td>
				<td><?php echo $s['NOMOR_PENDAFTARAN'] ?></td>
				<td><?php echo $s['NAMA_SISWA'] ?></td>
				<td style="text-align:center"><?php echo $s['AKREDITASI'] ?></td>
				<td style="text-align:right"><?php echo $s['NILAI_AKREDITASI'] ?></td>
			</tr>
			<?php endforeach ?>
			
		</table>
	</div>	
</div>	
<script>
	$(function(){
		setTimeout('closing_msg()', 4000);
	})

	function closing_msg(){
		$(".msg_alert").slideUp();
	}
</script>
						