		<div style="font-weight:bold; margin:10px 0;"><h3>JUMLAH PESERTA PER PROVINSI </h3></div>
	
				<table style="width:500px" class="table table-bordered table-hover">
					<tr>
						<th width="5%" rowspan="2"><center>No</center></th>
						<th width="65%" rowspan="2"><center>Provinsi</center></th>
						<th width="30%" colspan="3"><center>Jumlah Pendaftar</center></th>
					</tr>	
					<tr>
						<th><center>PTN 1</center></th>
						<th><center>PTN 2</center></th>
						<th><center>Jumlah</center></th>
					</tr>	
				<?php $i=0; ?>	
				<?php 
					foreach($prov1 as $p){ 
									?>
					<tr>
					<td><?php echo ++$i ?></td>
					<td><?php echo $p->nama_provinsi ?></td>
					<td style="text-align:right"><?php echo $p->jumlah1 ?></td>
					<td style="text-align:right"><?php echo $p->jumlah2 ?></td>
					<td style="text-align:right"><?php echo $p->jumlah ?></td>
					</tr>
				<?php } ?>
				</table>	
			</div>	
		<script>
		   $(function () {
			  $('#myTab li:eq(1) a').tab('show');
		   });
		</script>	