<?php #print_r($daftar_peserta_belum_selesai); die();?>
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='40%' align='left'>Nama Peserta</th>
					<th width='20%'>HP / Telpon</th>
					<th width='20%'>AKSI</th>
				</tr>
				<thead>
				<tbody>
			<?php
			$no=1;
			foreach($daftar_peserta_belum_selesai as $value){ 
			if($value->PMB_STATUS_SIMPAN_PENDAFTAR == 2){
				$link="tools-create_kartu_ujian/".$value->PMB_KD_JENIS_PENDAFTAR."/".$value->PMB_PIN_PENDAFTAR.""; 
			}else{
				$link="#"; 
			}
			?>
				<tr>
					<td align='center'><?php echo $no; ?></td>
					<td><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
					<td align='center'><?php echo $value->PMB_TELP_PENDAFTAR; ?></td>
					<td align='center'><a class="btn" href="<?php echo $link; ?>" title="Cetak Kartu Ujian Paksa"><i class="icon-print"></i></a></td>
					
				</tr>
			<?php $no++; 
			} ?>
			</tbody>
		</table>
