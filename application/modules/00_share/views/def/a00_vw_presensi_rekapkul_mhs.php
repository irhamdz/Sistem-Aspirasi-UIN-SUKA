	<h2>Presensi Kuliah 
	<span class="txtasmt"><?php echo sia_search_array($data['smt_123'], 'KD_SMT', 'NM_SMT', $data['i_smt']); ?></span>, 
	Tahun Akademik 
	<span class="txtasmt"><?php echo sia_search_array($data['ta_123'], 'KD_TA', 'TA', $data['i_ta']); ?></span>
	</h2>
	<table class="table table-bordered table-hover">
	<thead>
		<tr>
		<th style="width:30px;">No.</th>
		<th>Nama Mata Kuliah</th>
		<th>Kelas</th>
		<th>SKS</th>
		<th style="width:175px;">Jadwal Kuliah</th>
		<th>Peserta</th>
		<th>Kuliah</th>
		<th>Hadir</th>
		<th>Ijin</th>
		<th>% Hadir</th>
		<th>Update</th>
		</tr>
	</thead>
	<tbody>
	<?php $jj = 1; foreach ($data['matkul'] as $d): ?>
	<?php if ((float)$d['PROSEN'] < 75) { $span = 'style="background-color:#DFDFDF;"'; } else { $span = ''; } ?>
		<tr <?php echo $span; ?>>
		<td class="tac"><?php echo $jj; ?>.</td>
		<td>
		<?php #echo $data['url_link'];
			switch(substr($data['url_link'],0,1)){
				case 'd': 
					$link = str_replace('%LINK%',t1_encode($d['KD_KELAS'].'#'.$data['mahasiswa'][0]['NIM']),$data['url_d1']); break;
				case 'm':
					$link = str_replace('%LINK%',t1_encode($d['KD_KELAS']),$data['url_d1']); break;
				
				default: $link = ''; break;
			}
			if($link != ''){
			echo anchor($link, $d['NM_MK'],'class="link" title="lihat detil kehadiran di kelas mata kuliah '.$d['NM_MK'].'"'); } else { echo $d['NM_MK']; }
		?>
		</td>
		<td class="tac"><?php echo $d['KELAS_PARAREL']; ?></td>
		<td class="tac"><?php echo $d['SKS']; ?></td>
		<td class=""><?php echo sia_shorttolong_hari($d['JADWAL1']); ?></td>
		<td class="tac"><?php echo $d['TERISI']; ?></td>
		<td class="tac"><?php echo $d['JUM_KULIAH']; ?></td>
		<td class="tac"><?php echo $d['JUM_HADIR']; ?></td>
		<td class="tac"><?php echo $d['JUM_IZIN']; ?></td>
		<td class="tac">
		<?php 
			if ((float)$d['PROSEN'] < 75) { $span = 'style="color:#C00; font-weight:bold;"'; } else { $span = ''; }
			echo '<span '.$span.'>'.number_format((float)$d['PROSEN'], 2, ',', '').'</span>';
		?>
		</td>
		<td class="tac"><?php if ($d['TGL_UPDATE'] != ''){ echo $d['TGL_UPDATE'].' WIB'; } ?></td>
		</tr>
	<?php $jj++; endforeach; ?>
	</tbody>
	</table>