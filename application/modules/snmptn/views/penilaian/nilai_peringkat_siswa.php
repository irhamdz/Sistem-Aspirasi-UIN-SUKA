<div id="system-content">	

	<div style="margin:20px 0;"><h3>NILAI PERINGKAT SISWA</h3></div>
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
		<table border="1" class="table table-bordered table-hover">
			<tr>
				<th width="10px"><center>No</center></th>
				<th><center>No Pendaftaran</center></th>
				<th><center>Nama Siswa</center></th>													
				<th><center>Nilai</center></th>														
			</tr>	
			<?php $i=0 ?>
			<?php foreach($siswa as $s):?>
			<tr>
				<td><center><?php echo ++$i ?></center></td>
				<td><?php echo $s['NOMOR_PENDAFTARAN'] ?></td>
				<td><?php echo $s['NAMA_SISWA'] ?></td>
				<td style="text-align:right"><?php echo round($s['NILAI'],2) ?></td>
			</tr>
			<?php endforeach ?>
			
		</table>
		<form action="" method="post">
		<input type="hidden" name="action" value="update nilai yudisium"/>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</form>
	</div>	
</div>		
						