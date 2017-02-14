<section id="data_peserta">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="150px">No. Registrasi</th>
				<td><?php echo $data_mhs['PRE_USER']; ?></td>
			</tr>
			<tr>
				<th width="30px">Nama</th>
				<td><?php echo $data_mhs['NAMA_F']; ?></td>
			</tr>
			<tr>
				<th width="30px">Tempat, Tempat Lahir</th>
				<td><?php echo $data_mhs['TMP_LAHIR'].", ".date_trans_foracle($data_mhs['TGL_LAHIR'], 1, '0 231 000',' '); ?></td>
			</tr>
		</thead>
	</table>
</section>

<section id="hist_training">
	<h2>Jadwal Ujian Sertifikasi ICT</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="30px">No.</th>
				<th>Tanggal</th>
				<th>Ruang</th>
				<th>Ms. Word</th>
				<th>Ms. Excel</th>
				<th>Ms. PPT</th>
				<th>Internet</th>
				<th>Total Score</th>
			</tr>
		</thead>
		<tbody>
		<?php if(isset($get_jadwal) or $get_jadwal == true):
			$i = 0;
			foreach($get_jadwal as $key => $value):
			$i++;
		?>
			<tr>
				<td align="center"><?php echo $i; ?></td>
				<td align="center"><?php echo date('d/m/Y',strtotime($value['PER_UJI']))." (".$value['SESI_MULAI'].":00 - ".$value['SESI_SELESAI'].":00 WIB)";?></td>
				<td align="center"><?php echo $value['NM_RUANG']; ?></td>
				<td align="center"><?php echo $value['NIL_W']; ?></td>
				<td align="center"><?php echo $value['NIL_E']; ?></td>
				<td align="center"><?php echo $value['NIL_P']; ?></td>
				<td align="center"><?php echo $value['NIL_I']; ?></td>
				<td align="center"><?php echo $value['NIL_ANGKA']; ?></td>
			</tr>
		<?php endforeach; endif; ?>
		</tbody>
	</table>	
</section>
<script type="text/javascript">
	$(function () {
		$(".aksi").click(function(event) {
			var a = $(this).attr('isi');
			window.open("<?php echo base_url('toec/cetak/form/sertifikat-toec');?>/"+a, '_blank');
		});
		
	})
</script>