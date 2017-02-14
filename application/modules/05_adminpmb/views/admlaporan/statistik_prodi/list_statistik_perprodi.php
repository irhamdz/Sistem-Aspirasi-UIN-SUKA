<div class="system-content-sia">
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='40%' align='left'>Nama Prodi</th>
					<th width='10%'>Pilihan 1</th>
					<th width='10%'>Pilihan 2</th>
					<th width='10%'>Pilihan 3</th>
				</tr>
				<thead>
				<tbody>
			<?php 
			$jumlah_pil_1=0;
			$jumlah_pil_2=0;
			$jumlah_pil_3=0;
			foreach($statistik_peminat_perprodi as $value){
			$pilihan_1=$value->PILIHAN_1;
			$pilihan_2=$value->PILIHAN_2;
			$pilihan_3=$value->PILIHAN_3;
					if($pilihan_1==''){
						$pilihan_1='Belum Ada';
					}
					if($pilihan_2==''){
						$pilihan_2='Belum Ada';
					}
					if($pilihan_3==''){
						$pilihan_3='Belum Ada';
					}
						
					
					$jumlah_pil_1=$jumlah_pil_1+$pilihan_1;
					$jumlah_pil_2=$jumlah_pil_2+$pilihan_2;
					$jumlah_pil_3=$jumlah_pil_3+$pilihan_3;
					
					?>
				<tr>
					<td align='center'><?php echo $value->NO_; ?></td>
					<td><?php echo $value->PMB_NAMA_PRODI; ?></td>
					<td align='center'><?php echo $pilihan_1; ?></td>
					<td align='center'><?php echo $pilihan_2; ?></td>
					<td align='center'><?php echo $pilihan_3; ?></td>
				</tr>
			<?php  } ?>
				<tr>
					<td colspan=2 align='right'><b>Jumlah</b></td>
					<td align='center'><b><?php echo $jumlah_pil_1; ?></b></td>
					<td align='center'><b><?php echo $jumlah_pil_2; ?></b></td>
					<td align='center'><b><?php echo $jumlah_pil_3; ?></b></td>
				</tr>
			</tbody>
		</table>
</div>