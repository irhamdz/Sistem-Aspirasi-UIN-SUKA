<?php 
	$crumbs = array(
				array('Training & Sertifikasi' => 'pendaftar'),
				array('Ujian Sertifikasi ICT' => '#'),
				array('Riwayat Ujian Sertifikasi ICT' => 'pendaftar/riwayatsertifikasi'),
			);
//$this->it00_lib_output->output_info_mhs();
$this->it00_lib_output->output_crumbs($crumbs);
?>
<h2>Riwayat Ujian Sertifikasi ICT</h2>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>No.</th>
      <th class="input-large">Periode</th>
      <th>Ruang</th>
      <th>Jam</th>
      <th>Kapasitas</th>
    </tr>
  </thead>
  
  <tbody>
 <?php if(!isset($get_jadwal) or empty($get_jadwal)):
      	echo '<td colspan="5" align="center">Data riwayat jadwal ujian sertifikasi ICT yang pernah diikuti tidak ditemukan.</td>';
      else:
      	$i = 0;
      foreach ($get_jadwal as $key => $value): 
		$i++;
		?>
	<tr>
		<td align="center" rowspan="2"><?php echo $i; ?>.</td>
		<td align="left">&nbsp;<?php echo str_replace('Hari','',$value['PER_NM']).', '.$value['PER_BULAN']; ?></td>
		<td align="center"><?php echo $value['NM_RUANG']; ?></td>
		<td align="center"><?php echo $value['SESI_MULAI']." - ".$value['SESI_SELESAI']; ?></td>
		<td align="center"><?php echo $value['TERISI']."/".$value['RU_KAP']; ?></td>
	</tr>
	<tr>
	<td colspan="6">
		<table class="table table-bordered" style="margin-bottom:10px;margin-top:2px;">
			<tr>
				<td class="input-large"><strong>Nilai Microsoft Word</strong></td>
				<td class="input-medium"><?php echo $value['NIL_W']; ?></td>
				<td><strong>Total Nilai</strong></td>
				<td class="input-medium"><?php echo $value['NIL_ANGKA']; ?></td>
			</tr>
			<tr>
				<td><strong>Nilai Microsoft Excel</strong></td>
				<td><?php echo $value['NIL_E']; ?></td>
				<td><strong>Nilai Huruf</strong></td>
				<td><?php echo $value['NIL_HURUF']; ?></td>
			</tr>
			<tr>
				<td><strong>Nilai Ms. PowerPoint</strong></td>
				<td><?php echo $value['NIL_P']; ?></td>
				<td colspan="2" rowspan="2"></td>
			</tr>
			<tr>
				<td><strong>Nilai Internet</strong></td>
				<td><?php echo $value['NIL_I']; ?></td>
			</tr>
		</table>
	</td>
	</tr>
<?php endforeach;
	endif; ?>
      </tbody>
</table>