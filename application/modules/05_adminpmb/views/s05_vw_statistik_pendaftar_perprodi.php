<?php
$crumbs = array(array('Beranda'=>base_url()),array('Statistik Pendaftar Per Prodi' => ''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='40%' align='left'>Nama Prodi</th>
					<th width='10%'>Pilihan 1</th>
					<th width='10%'>Pilihan 2</th>
				</tr>
				<thead>
				<tbody>
			<?php 
			$jumlah_pil_1=0;
			$jumlah_pil_2=0;
			foreach($statistik_perprodi as $value){
			
					if($value->PILIHAN_2==''){
						$pilihan_2="Belum Ada";
					}else{
							$pilihan_2=$value->PILIHAN_2;
							
					}
					
					if($value->PILIHAN_1==''){
						$pilihan_1="Belum Ada";
					}else{
							$pilihan_1=$value->PILIHAN_1;
					}
					$jumlah_pil_1=$jumlah_pil_1+$pilihan_1;
					$jumlah_pil_2=$jumlah_pil_2+$pilihan_2;
					
					?>
				<tr>
					<td align='center'><?php echo $value->NO_; ?></td>
					<td><?php echo $value->PMB_NAMA_PRODI; ?></td>
					<td align='center'><?php echo $pilihan_1; ?></td>
					<td align='center'><?php echo $pilihan_2; ?></td>
				</tr>
			<?php  } ?>
				<tr>
					<td colspan=2 align='right'><b>Jumlah</b></td>
					<td align='center'><b><?php echo $jumlah_pil_1; ?></b></td>
					<td align='center'><b><?php echo $jumlah_pil_2; ?></b></td>
				</tr>
			</tbody>
		</table>
</div>