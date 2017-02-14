	<?php
		$nama = '';
		if($this->session->userdata('app') == 'dosen'){ $nama = '<span class="txtasmt">'.$data['presmh'][0]['NAMA'].'</span> '; }
	?>
	<h2>Presensi Mahasiswa <?php echo $nama; ?>pada Kuliah
	<span class="txtasmt"><?php echo $data['kelas'][0]['NM_MK'].' '.$data['kelas'][0]['KELAS_PARAREL']; ?></span> 
	</h2>
	<table class="table table-bordered table-hover">
	<thead>
		<tr>
		<th>Pertemuan ke</th>
		<th>Tgl Kuliah</th>
		<th>Status Hadir</th>
		<th>Catatan</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($data['presmh'] as $d): ?>
		<tr>
		<td class="tac" style="width:100px;"><?php echo $d['KULIAH_KE']; ?></td>
		<td class="tac" style="width:200px;"><?php echo date_trans_foracle($d['TGL_KUL1'],1,'1 231 000',' '); ?></td>
		<td class="tac" style="width:100px; background-color:#<?php echo sia_trans_status_absen_color($d['STATUS_HADIR']); ?>;"><?php echo sia_trans_status_absen($d['STATUS_HADIR']); ?></td>
		<td class="tac"><?php echo $d['CATATAN']; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>	
	