<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='20%' align='left'>PIN</th>
					<th width='10%' align='left'>NO PMB</th>
					<th width='30%' align='left'>Nama Peserta</th>
					<th width='10%'>HP / Telpon</th>
					<th width='10%' colspan='2'>CETAK</th>
				</tr>
				<thead>
				<tbody>
			<?php
			$no=1;
			foreach($peserta as $value){ ?>
				<tr>
					<td align='center'><?php echo $no; ?></td>
					<td><?php echo $value->PMB_PIN_PENDAFTAR; ?></td>
					<td><?php echo $value->PMB_NO_UJIAN_PENDAFTAR; ?></td>
					<td><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
					<td align='center'><?php echo $value->PMB_TELP_PENDAFTAR; ?></td>
					<td align='center'><a class="btn" title="Cetak Kartu Peserta" href="admtools-kartu_ujian/cetak/<?php echo $value->PMB_KD_JENIS_PENDAFTAR; ?>/<?php echo $value->PMB_PIN_PENDAFTAR; ?>/<?php echo $value->PMB_TAHUN_PENDAFTARAN; ?>" target="blank"><i class="icon-print"></i></a></td>
					<td align='center'><a class="btn" title="Cetak Biodata Peserta" href="admtools-kartu_ujian/cetakbiodata/<?php echo $value->PMB_KD_JENIS_PENDAFTAR; ?>/<?php echo $value->PMB_PIN_PENDAFTAR; ?>" target="blank"><i class="icon-print"></i></a></td>
				</tr>
			<?php $no++; 
			} ?>
			</tbody>
		</table>
