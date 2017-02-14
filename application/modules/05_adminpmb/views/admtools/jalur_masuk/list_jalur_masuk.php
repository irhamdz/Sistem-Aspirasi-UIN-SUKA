<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='20%' align='left'>Nama Jalur Masuk</th>
					<th width='30%' align='center'>Tanggal Mulai Daftar</th>
					<th width='30%' align='center'>Tanggal Akhir Daftar</th>
					<th width='30%' align='center'>Tanggal Awal Seleksi</th>
					<th width='30%' align='center'>Tanggal Akhir Seleksi</th>
					<th width='30%' align='center'>Pengumuman</th>
					<th width='10%' colspan='2'>#</th>
				</tr>
				<thead>
				<tbody>
			<?php
			$no=1;
			foreach($status_jalur_masuk as $value){ 
				if($value->PMB_STATUS_JALUR_MASUK==1){
					$status="up";
					$title="non-Aktif-kan";
				}elseif($value->PMB_STATUS_JALUR_MASUK==0){
					$status="down";
					$title="Aktifkan";
				}
			
			?>
				<tr>
					<td align='center'><?php echo $no; ?></td>
					<td align='center'><?php echo $value->PMB_NAMA_JALUR_MASUK; ?></td>
					<td align='center'><?php echo $value->PMB_TANGGAL_MULAI_DAFTAR; ?></td>
					<td align='center'><?php echo $value->PMB_TANGGAL_AKHIR_DAFTAR; ?></td>
					<td align='center'><?php echo $value->PMB_TANGGAL_AWAL_SELEKSI; ?></td>
					<td align='center'><?php echo $value->PMB_TANGGAL_AKHIR_SELEKSI; ?></td>
					<td align='center'><?php echo $value->PMB_PENGUMUMAN_SELEKSI; ?></td>
					<td align='center'>
					<form method='POST' id='edit_jalur' >
					<input type="hidden" name="kelola" value="edit_jalur" />
					<button type='submit' class='btn btn-small' ><i class='icon-edit'></i> Ubah</button>
					</form>
					</td>
					<td align='center'>
					<form method='POST' id='ubah_status' >
					<input type="hidden" name="kelola" value="ubah_status" />
					<input type="hidden" name="status" value="<?php echo $value->PMB_STATUS_JALUR_MASUK; ?>" />
					<button type='submit' class='btn btn-small' ><i class='icon-thumbs-<?php echo $status; ?>'></i> <?php echo $title;?></button>
					</form></td>
				</tr>
			<?php $no++; 
			} ?>
			</tbody>
		</table>