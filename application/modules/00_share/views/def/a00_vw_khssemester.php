	<h2>KHS 
	<span class="txtasmt"><?php echo sia_search_array($data['smt_123'], 'KD_SMT', 'NM_SMT', $data['i_smt']); ?></span>, 
	Tahun Akademik 
	<span class="txtasmt"><?php echo sia_search_array($data['ta_123'], 'KD_TA', 'TA', $data['i_ta']); ?></span>
	</h2>
	<table class="table table-bordered table-hover">
	<thead>
		<tr>
		<th style="width:30px;">No.</th>
		<th>Nama Mata Kuliah</th>
		<th>SKS</th>
		<th>Jenis MK</th>
		<th>Nilai Kehadiran</th>
		<th>Nilai Partisipasi</th>
		<th>Nilai Sikap</th>
		<th>Nilai Tugas</th>
		<th>Nilai UTS</th>
		<th>Nilai UAS</th>
		<th>Nilai Akhir</th>
		<th>Bobot</th>
		
		</tr>
	</thead>
	<tbody>
	<?php $jj = 1; foreach ($data['matkul'] as $d): ?>
		<tr>
		<td class="tac"><?php echo $jj; ?>.</td>
		<td><?php echo $d['NM_MK']; ?></td>
		<td class="tac"><?php echo $d['SKS']; ?></td>
		<td class="tac"><?php echo $d['NM_JENIS_MK']; ?></td>
		<td class="tac"><?php echo $d['BOBOT_NILAI_HDR']; ?></td>
		<td class="tac"><?php echo $d['BOBOT_NILAI_PAR']; ?></td>
		<td class="tac"><?php echo $d['BOBOT_NILAI_SKP']; ?></td>
		<td class="tac"><?php echo $d['BOBOT_NILAI_TUGAS']; ?></td>
		<td class="tac"><?php echo $d['BOBOT_NILAI_MID']; ?></td>
		<td class="tac"><?php echo $d['BOBOT_NILAI_UAS']; ?></td>
		<td class="tac"><?php echo $d['NILAI']; ?></td>
		<td class="tac"><?php echo number_format((float)$d['BOBOT_NILAI'], 2, '.', '');?></td>
		</tr>
	<?php $jj++; endforeach; ?>
	</tbody>
	</table>
	
	<table class="table-snippet">
	<tbody>
	<tr><td class="snippet-label">Jumlah Mata Kuliah</td><td>: <?php echo count($data['matkul']); ?></td></tr>
	<tr><td class="snippet-label">Jumlah SKS</td><td>: <?php echo $data['akm']['sks']; ?></td></tr>
	<tr><td class="snippet-label">Nilai IP</td><td>: <?php echo  number_format((float)$data['akm']['ip'], 2, '.', '');?></td></tr>
	</tbody>
	</table>