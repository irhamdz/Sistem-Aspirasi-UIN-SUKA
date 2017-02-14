<div id="system-content">	
	<div id="content-space">
		<div style="font-weight:bold; margin:10px 0;"><h3>JUMLAH PESERTA PER KABUPATEN </h3></div>
	
			<div class="tab-pane fade in active" id="ptn1">
				<table style="width:600px" class="table table-bordered table-hover">
					<tr>
						<th width="5%" rowspan="2"><center>No</center></th>
						<th width="40%" rowspan="2"><center>Kabupaten</center></th>
						<th width="35%" rowspan="2"><center>Provinsi</center></th>
						<th width="20%" colspan="3"><center>Jumlah Pendaftar</center></th>
					</tr>	
					<tr>
						<th><center>PTN 1</center></th>
						<th><center>PTN 2</center></th>
						<th><center>Jumlah</center></th>
					</tr>	
				<?php $i=0; ?>	
				<?php 
					foreach($kab1 as $p){ 
				?>
					<tr>
					<td><?php echo ++$i ?></td>
					<td><?php echo $p->nama_kabupaten ?></td>
					<td><?php echo $p->nama_provinsi ?></td>
					<td style="text-align:right"><?php echo $p->jumlah1 ?></td>
					<td style="text-align:right"><?php echo $p->jumlah2 ?></td>
					<td style="text-align:right"><?php echo $p->jumlah ?></td>
					</tr>
				<?php } ?>
				</table>	
		</div>	
	</div>
		<script>
		   $(function () {
			  $('#myTab li:eq(1) a').tab('show');
		   });
		</script>		
</div>			


