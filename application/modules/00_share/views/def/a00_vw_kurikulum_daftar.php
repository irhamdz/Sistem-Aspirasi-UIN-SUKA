	<?php 
		function mk_highlight($tran = array(), $kd_kur = '', $kd_mk = ''){
			$hasil = '';
			foreach($tran as $tr){
				if($tr['KD_KUR'].$tr['KD_MK'] == $kd_kur.$kd_mk){
					if($tr['NILAI'] != ''){ $hasil = 'background-color: #A7DDD6;'; }
					else { $hasil = 'background-color: #CCF;'; }
					break;
				}
			}
			return $hasil;
		}
		
		$arr_kur = array(); 
		foreach($kursemua as $kur){ $arr_kur[$kur['KD_KUR']] = $kur['NM_KUR']; } #sia_comment($data['kurdaftar']);
	?>
	
	<?php
		if($url_link != 'informasi'):
		echo form_open(current_url(),array('name' => 'form_sia'));
	?>
		<?php echo form_close(); endif; ?>
	
	<?php if(!empty($kurdaftar)): ?>
	<h2>Daftar Mata Kuliah  
	<span class="txtasmt"><?php echo $kurpilih[0]['NM_KUR']; ?> (<?php echo $kurpilih[0]['STATUS']; ?>)</span>
	</h2>
	
	<?php if($url_link == 'mahasiswa'): ?>
	<strong>Keterangan:</strong>
	<table style="margin: 5px 0 30px 0;">
		<tr>
		<td style=""><span style="display:block; background-color: #FFF; width:20px; height:20px; border:1px solid #666;"></td>
		<td style="">&nbsp; : Mata kuliah yang belum pernah diambil</td>
		</tr>
		<tr><td colspan="2" style="height:10px;"></td></tr>
		<tr>
		<td style=""><span style="display:block; background-color: #A7DDD6; width:20px; height:20px; border:1px solid #666;"></td>
		<td style="">&nbsp; : Mata kuliah yang telah diambil dan nilainya sudah ada</td>
		</tr>
		<tr><td colspan="2" style="height:10px;"></td></tr>
		<tr>
		<td style=""><span style="display:block; background-color: #CCF; width:20px; height:20px; border:1px solid #666;"></td>
		<td style="">&nbsp; : Mata kuliah yang telah diambil namun nilainya belum ada</td>
		</tr>
	</table>
	<?php endif; ?>
	
	<?php $p_smt = ''; $n_smt = ''; $j = 1; 
	foreach ($kurdaftar as $d): 
	$p_smt = $n_smt; $n_smt = $d['SEMESTER_PAKET']; 
	?>
	
	<?php if($p_smt != $n_smt): ?>
	<?php if($p_smt != ''): $j = 1; ?>
	</tbody>
	</table>
	<?php endif; ?>
	<h3>Semester Paket <?php echo $d['SEMESTER_PAKET']; ?></h3>
	<table class="table table-bordered table-hover">
	<thead>
		<tr>
		<th style="width:30px;">No.</th>
		<th style="width:90px;">Kode MK</th>
		<th>Nama Mata Kuliah</th>
		<th style="width:30px;">SKS</th>
		<?php if($url_link == 'mahasiswa'): ?>
		<th style="width:50px;">Bisa Ambil</th>
		<?php endif; ?>
		<th style="width:50px;">Jenis MK</th>
		
		</tr>
	</thead><tbody>
	<?php endif; ?>
		
		<?php if($url_link == 'mahasiswa'): ?>
		<tr style="<?php echo mk_highlight($transkrip, $d['KD_KUR'], $d['KD_MK']); ?>">
		<?php else: ?>
		<tr>
		<?php endif; ?>
		
		<td class="tac"><?php echo $j; ?></td>
		<td><?php 
			$url1 = str_replace('%LINK%',t1_encode($d['KD_KUR'].'#'.$d['KD_MK']),$url_d1);
			$ttt1 = 'title="lihat detil mata kuliah '.$d['NM_MK'].' ('.$d['KD_MK'].')" class="link-table"';
			#echo $d['KD_MK'];
			echo anchor($url1,$d['KD_MK'],$ttt1); ?></td>
		<td><?php echo $d['NM_MK']; ?></td>
		<td class="tac"><?php echo $d['SKS_MK']; ?></td>
		<?php if($url_link == 'mahasiswa'): ?>
		<td class="tac">
		<?php
			if($prasya[$d['KD_MK']]['data'][':hasil1'] == 'OK'){
				echo '<span class="badge badge-success"><i class="icon-white icon-ok"></i></span>';
			} else {
				echo '<span class="badge badge-important"><i class="icon-white icon-remove"></i></span>';
			}
			#sia_comment($sya_ambil);
		?>
		</td>
		<?php endif; ?>
		<td class="tac"><?php echo $d['NM_JENIS_MK']; ?></td>
		</tr>
	<?php $j++; ?>

	<?php endforeach; ?>
	
	</tbody>
	</table>
	
	<?php #$this->load->view('00_share/def/a00_vw_khskumulatif',array('data' => $data)); ?>

	<?php echo form_open(current_url(),array('name' => 'form_sia_cetak', 'target' => '_blank'));
	#echo form_submit('but_cetak', 'cetak mata kuliah kurikulum prodi','class="btn-uin btn btn-inverse btn btn-small" style="margin-top:3%;"');
	echo form_close();
	?>
	<?php else: echo '<h1>Tidak Ada Data Kurikulum Prodi untuk Ditampilkan!</h1>'; ?>
	<?php endif; ?>