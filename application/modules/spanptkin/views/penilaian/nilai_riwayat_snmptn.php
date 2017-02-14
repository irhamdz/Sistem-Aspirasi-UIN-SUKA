<div id="system-content">	
<div class="content-value">
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
	<div><h3>NILAI AKREDITASI SEKOLAH PER SISWA</h3></div>
		<form method="post" action="" style="text-align:right">
			<input name="nilai" type="hidden" value=""/>
			<button type="submit" class="btn btn-primary" style="font-size:14px">Simpan Nilai Riwayat SNMPTN</button>	
		</form><br>
		<table border="1" class="table table-bordered table-hover">
			<tr>
				<th width="10px"><center>No</center></th>
				<th><center>No Pendaftaran</center></th>
				<th><center>Nama Siswa</center></th>														
				<th><center>Nilai</center></th>														
			</tr>	
			<?php $i=0 ?>
			<?php foreach($nilai as $s):?>
			<tr>
				<td><center><?php echo ++$i ?></center></td>
				<td><?php echo $s->NOMOR_PENDAFTARAN ?></td>
				<td><?php echo $s->NAMA_SISWA ?></td>
				<td style="text-align:right"><?php echo round(str_replace(',','.',$s->NILAI),2); ?></td>
			</tr>
			<?php endforeach ?>
			
		</table>
</div>	
<script>
	$(function(){
		setTimeout('closing_msg()', 4000);
	})

	function closing_msg(){
		$(".msg_alert").slideUp();
	}
</script>
						