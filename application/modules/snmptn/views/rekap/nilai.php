<div id="system-content">	
		<div style="font-weight:bold; margin:10px 0;"><h3>NILAI PESERTA PER PROGRAM STUDI </h3></div>
	
		
				<table  class="table table-bordered table-hover">
					<tr>
						<th width="5" rowspan="2"><center>No</center></th>
						<th width="64%" rowspan="2"><center>Program Studi</center></th>
						<th width="12%" colspan="4"><center>Pilihan 1</center></th>
						<th width="12%" colspan="4"><center>Pilihan 2</center></th>
					</tr>	
					<tr>
						<th><center>Rerata</center></th>
						<th><center>SD</center></th>
						<th><center>Maks</center></th>
						<th><center>Min</center></th>
						<th><center>Rerata</center></th>
						<th><center>SD</center></th>
						<th><center>Maks</center></th>
						<th><center>Min</center></th>
					</tr>
				<?php $i=0; ?>	
				<?php 
				foreach($nilai as $prodi=>$pilihan){ 
					
				?>
					<tr>
					<td><?php echo ++$i ?></td>
					<td><?php echo $prodi ?></td>
					<td style="text-align:right"><?php echo round(str_replace(',','.',$pilihan[0]->rerata),2) ?></td>
					<td style="text-align:right"><?php echo round(str_replace(',','.',$pilihan[0]->sd),2) ?></td>
					<td style="text-align:right"><?php echo round(str_replace(',','.',$pilihan[0]->maksimal),2) ?></td>
					<td style="text-align:right"><?php echo round(str_replace(',','.',$pilihan[0]->minimal),2) ?></td>
					<td style="text-align:right"><?php echo round(str_replace(',','.',$pilihan[1]->rerata),2) ?></td>
					<td style="text-align:right"><?php echo round(str_replace(',','.',$pilihan[1]->sd),2) ?></td>
					<td style="text-align:right"><?php echo round(str_replace(',','.',$pilihan[1]->maksimal),2) ?></td>
					<td style="text-align:right"><?php echo round(str_replace(',','.',$pilihan[1]->minimal),2) ?></td>
					</tr>
					
				<?php } ?>
				</table>	
</div>			


