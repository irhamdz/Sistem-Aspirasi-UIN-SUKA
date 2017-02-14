	<?php
	function get_kelas($kdkrs, $datakrs){
		for($j = 0; $j < count($datakrs); $j++){
			if($datakrs[$j]['KD_KELAS'] == $kdkrs){ 
			return $datakrs[$j]; break;
			}
		}
	}
	?>
	
	<h2>Presensi <span class="txtasmt"><?php echo sia_search_array($data['ujian_123'], 'KD_J_UJIAN', 'NM_J_UJIAN', $data['i_ujian']); ?></span> 
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
		<th style="width:175px;">Jadwal Ujian</th>
		<th>Peserta</th>
		<th>Status Hadir</th>
		<!--<th>Tgl Update</th>-->
		</tr>
	</thead>
	<tbody>
	<?php $jj = 1; foreach ($data['matkul'] as $d): 
		$hadir = get_kelas($d['KD_KELAS'], $data['hadir']);
		?>
		<tr>
		<td class="tac"><?php echo $jj; ?>.</td>
		<td>
		<?php 
			/* switch(substr($data['url_link'],0,1)){
				case '2': 
					$link = substr($data['url_link'],1).t1_encode($d['KD_KELAS']).'.html'; break;
				case '3': 
					$link = substr($data['url_link'],1).t1_encode($d['KD_KELAS'].'#'.
					$data['mahasiswa'][0]['NIM']).'.html'; break;
				default: $link = 'error.html'; break;
			} */
			#echo anchor($link, $d['NM_MK'],'class="link" title="lihat detil kehadiran di kelas mata kuliah '.$d['NM_MK'].'"'); 
			echo $d['NM_MK'];
		?>
		</td>
		<td class="tac"><?php echo $d['KELAS_PARAREL']; ?></td>
		<td class="tac"><?php echo $d['SKS']; ?></td>
		<td class=""><?php 
			if(trim($d['TGL_F'] != '')){
			$jadwal = date_trans_foracle($d['TGL_F'], 1, '1 231 000', ' '); 
			echo $jadwal.'<br>';
			echo 'Jam '.$d['JAM_MULAI'].' s/d '.$d['JAM_SELESAI'];
			echo ', R:'.$d['NO_RUANG'];
			} else { echo '<p style="text-align:center;">-</p>'; }
		?></td>
		<td class="tac"><?php echo $d['TERISI']; ?></td>
		<td class="tac" style="background-color:#<?php echo sia_trans_status_absen_color($hadir['STATUS_HADIR']); ?>;"><?php echo sia_trans_status_absen($hadir['STATUS_HADIR']); ?></td>
		<?php if(false): ?>
		<td class="tac"><?php $tgl = date_trans_foracle($hadir['LAST_UPDATE_F'], 1, '0 111 000', '/'); 
		echo str_replace('//','-',$tgl);
		?></td>
		<?php endif; ?>
		</tr>
	<?php $jj++; endforeach; ?>
	</tbody>
	</table>