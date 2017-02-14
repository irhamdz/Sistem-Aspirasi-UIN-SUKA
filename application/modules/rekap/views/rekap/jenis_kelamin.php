		<div style="font-weight:bold; margin:10px 0;"><h3>Jumlah Pendaftar Berdasarkan Jenis Kelamin</h3></div>
				<table style="width:450px" class="table table-bordered table-hover">
					<tr>
						<th width="40%" rowspan='2'><center>PTN</center></th>
						<th width="60%" colspan='2'><center>Jenis Kelamin</center></th>
					</tr>	
				<?php $i=0; ?>	
					<tr>
						<?php foreach($jenis_kelamin as $jk):?>
						<td><?php echo $jk->jenis_kelamin ?></td>
						<?php endforeach ?>
					</tr>
					<tr><td >PTN 1</td>
						<?php foreach($jenis_kelamin1 as $jk1):?>
						<td><?php echo $jk1->jumlah ?></td>
						<?php endforeach ?>
					</tr>
					<tr>
						<td >PTN 2</td>
						<?php if(!empty($jenis_kelamin2)):?>
						<?php foreach($jenis_kelamin2 as $jk2):?>
						<td><?php echo $jk2->jumlah ?></td>
						<?php endforeach ?>
						<?php endif ?>
					</tr>
					<tr>
						<td >Jumlah</td>
						<?php foreach($jenis_kelamin as $jk):?>
						<td><?php echo $jk->jumlah ?></td>
						<?php endforeach ?>
					</tr>
				</table>	
		