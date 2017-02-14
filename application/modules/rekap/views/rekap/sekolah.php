		
		<div id="system-content">	
			<div id="content-space">
				<div style="font-weight:bold; margin:10px 0;"><h3>JUMLAH PESERTA PER SEKOLAH</h3></div>
				<table style="width:500px" class="table table-bordered table-hover">
					<tr>
						<th width="70%"><center>Sekolah</center></th>
						<th width="30%"><center>Jumlah Pendaftar</center></th>
					</tr>	
				<?php $i=0; ?>	
				<?php 
					foreach($sekolah as $s){ 
					
				?>
					<tr>
					<td><?php echo $s['NAMA_SEKOLAH'] ?></td>
					<td style="text-align:right"><?php echo $s['JUMLAH'] ?></td>
					</tr>
				<?php } ?>
				</table>	
			</div>	
			
		</div>