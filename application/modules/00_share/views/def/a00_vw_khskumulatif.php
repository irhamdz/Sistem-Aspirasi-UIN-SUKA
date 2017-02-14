	<table class="table table-bordered table-hover">
	<thead>
		<tr>
		<th style="width:30px;">No.</th>
		<th>Kode Kurikulum</th>
		<th>Kode Mata Kuliah</th>
		<th>Nama Mata Kuliah</th>
		<th>SKS</th>
		<th>Jenis MK</th>
		
		<th>X Ulang</th>
		<th>Nilai</th>
		<th>Bobot</th>
		<th>Semester Paket</th>
		</tr>
	</thead>
	<tbody>
	<?php $jj = 1; foreach ($data['matkul'] as $d): ?>
		<tr>
		<td class="tac"><?php echo $jj; ?>.</td>
		<td class="tac"><?php echo $d['KD_KUR']; ?></td>
		<td class="tac"><?php echo $d['KD_MK']; ?></td>
		<td><?php echo $d['NM_MK']; ?></td>
		<td class="tac"><?php echo $d['SKS']; ?></td>
		<td class="tac"><?php echo $d['NM_JENIS_MK']; ?></td>
		
		<td class="tac"><?php if ((int)$d['CACAH_AMBIL'] > 1) { echo (int)$d['CACAH_AMBIL'] - 1; } else { echo '-'; } ?></td>
		<td class="tac"><?php echo $d['NILAI']; ?></td>
		<td class="tac"><?php echo number_format((float)$d['BOBOT_NILAI'], 2, '.', '');?></td>
		<td class="tac"><?php echo $d['SEMESTER_PAKET']; ?></td>
		</tr>
	<?php $jj++; endforeach; ?>
	</tbody>
	</table>
	
	<table class="table-snippet">
	<tbody>
	<tr><td class="snippet-label">Jumlah Mata Kuliah</td><td>: <?php echo count($data['matkul']); ?></td></tr>
	<tr><td class="snippet-label">Jumlah SKS</td><td>: <?php echo $data['nilai'][0]['SKS']; ?></td></tr>
	<tr><td class="snippet-label">Nilai IP</td><td>: <?php echo  number_format((float)$data['nilai'][0]['IPK'], 2, '.', '');?></td></tr>
	</tbody>
	</table>