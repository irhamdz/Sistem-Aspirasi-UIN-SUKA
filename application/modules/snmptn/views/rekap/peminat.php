
		<div style="font-weight:bold; margin:10px 0;"><h3>JUMLAH PEMINAT PROGRAM STUDI </h3></div>
					<table style="width:600px" class="table table-bordered table-hover">
						<tr>
							<th width="4%"><center>No</center></th>
							<th width="60%"><center>Program Studi</center></th>
							<th width="12%"><center>Pilihan 1</center></th>
							<th width="12%"><center>Pilihan 2</center></th>
							<th width="12%"><center>Pilihan 3</center></th>
							<th width="12%"><center>Pilihan 4</center></th>
							<th width="12%"><center>Jumlah</center></th>
						</tr>	
					<?php $i=0; ?>	
					<?php 
				//	print_r($peminat1);
						foreach($peminat1 as $prodi=>$pilihan){ 
						
					
					?>
						<tr>
						<td><?php echo ++$i ?></td>
						<td><?php echo $prodi ?></td>
						<?php $jp=0; ?>
						<?php 
						
							print_r($pilihan);
						foreach($pilihan as $p){
							$jp+= $p->jumlah;
						?>
							<td style="text-align:right"><?php echo $p->jumlah ?></td>
						<?php } ?>

					
						<td style="text-align:right"><?php echo $jp ?></td>
						</tr>
					<?php } ?>
					</table>	
		
</div>



