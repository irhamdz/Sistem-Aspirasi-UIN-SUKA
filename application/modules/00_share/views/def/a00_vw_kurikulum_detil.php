<?php
	function is_value_blank($txt = ''){ if (trim($txt) == '') { return '-'; } else { return $txt; }}
?>	

<h2>Mata Kuliah <?php echo $matkul[0]['NM_MK']; ?> <span class="txtasmt">(<?php echo $matkul[0]['KD_MK']; ?>)</span></h2>

<h3>A. Informasi Umum</h3>
<table class="table table-bordered table-hover">
<tbody>
	<tr><td style="width: 150px; font-weight:bold;">Nama Asing</td>
	<td style=""><em><?php echo is_value_blank($matkul[0]['NM_MK_ASING']); ?></em></td></tr>
	<?php if($data['url_link'] == 'informasi'): ?>
	<tr><td style="width: 150px; font-weight:bold;">Program Studi</td>
	<td style=""><?php echo is_value_blank($matkul[0]['NM_PRODI']); ?></td></tr>
	<?php endif; ?>
	<tr><td style="width: 150px; font-weight:bold;">Kurikulum</td>
	<td style=""><?php 
		$tahun = (int)preg_replace("/[^0-9]/", "", $matkul[0]['NM_KUR']);
		if($tahun < 1000){
		echo $matkul[0]['NM_KUR'].' (TAHUN '.$matkul[0]['TH_KUR'].')'; 
		} else {
		echo $matkul[0]['NM_KUR'];
		}
	?></td></tr>
	
	<tr><td style="width: 150px; font-weight:bold;">Muatan MK</td>
	<td style=""><?php echo is_value_blank($matkul[0]['MUATAN_MK_F']); ?></td></tr>	
	<tr><td style="width: 150px; font-weight:bold;">Kelompok MK</td>
	<td style=""><?php echo is_value_blank($matkul[0]['NM_KEL_MK']); ?></td></tr>	
</tbody>

<table class="table table-bordered table-hover">
<tbody>
	<tr><td style="width: 150px; font-weight:bold;">Jenis MK</td>
	<td style=""><?php echo is_value_blank($matkul[0]['JENIS_MK_F']); ?></td></tr>
	<tr><td style="width: 150px; font-weight:bold;">Jumlah SKS</td>
	<td style=""><?php echo $matkul[0]['SKS']; ?></td></tr>	
	<tr><td style="width: 150px; font-weight:bold;">Semester Paket</td>
	<td style=""><?php echo $matkul['SEMESTER_PAKET']; ?></td></tr>	
	
	<?php if(false): ?>
	<tr><td style="width: 150px; font-weight:bold;">Batas Mengulang</td>
	<td style=""><?php 
		if((int)$matkul[0]['MAX_MENGULANG'] > 0){
			echo $matkul[0]['MAX_MENGULANG'].' kali';
		} else {
			echo 'TIDAK DIPERBOLEHKAN MENGULANG';
		} ?></td></tr>
	<?php endif; ?>
</tbody>	
</table>

<strong>Bahasan:</strong><br>
<?php echo is_value_blank($matkul[0]['BAHASAN']); ?>
<br><br>
<strong>Kompetensi:</strong><br>
<?php echo is_value_blank($matkul[0]['KOMPETENSI']); ?>	
<br><br>
<h3>B. Mata Kuliah Prasyarat</h3>
<?php if(!empty($prasya)): ?>
<table class="table table-bordered table-hover">
<thead>
	<tr>
	<th style="width:30px;">No.</th>
	<th style="width:100px;">Kode MK</th>
	<th>Nama Mata Kuliah</th>
	<th style="width:30px;">Jenis MK</th>
	<?php if($url_link == 'mahasiswa'): ?>
	<th style="width:150px;" colspan="2">Syarat</th>
	<?php else: ?>
	<th style="width:75px;">Syarat</th>
	<?php endif; ?>
	</tr>
</thead><tbody>
<?php
?>
<?php foreach($prasya as $d): ?>
	<tr>
	<td class="tac"><?php echo $d['NO_']; ?>.</td>
	<td><?php 
		$url1 = str_replace('%LINK%',t1_encode($d['KD_KUR'].'#'.$d['KD_MK_PRASYARAT']),$url_d1);
		$ttt1 = 'title="lihat detil mata kuliah '.$d['NM_MK'].' ('.$d['KD_MK_PRASYARAT'].')" class="link-table"';
		echo anchor($url1,$d['KD_MK_PRASYARAT'],$ttt1); ?></td>
	<td><?php echo $d['NM_MK']; ?></td>
	<td class="tac"><?php echo $d['NM_JENIS_MK']; ?></td>
	<td class="tac" style="width:100px;"><?php 
		switch($d['NM_SYARAT']){
			case 'AMBIL': echo 'PERNAH '.$d['NM_SYARAT']; break;
			case 'LULUS': echo 'SUDAH '.$d['NM_SYARAT']; break;
		}			
	?></td>
	<?php if($url_link == 'mahasiswa'): ?>
	<td class="tac" style="width:50px;">
	<?php 
		if($d['CEK_SYARAT'] == 'OK'){
			echo '<span class="badge badge-success"><i class="icon-white icon-ok"></i></span>';
		} else {
			echo '<span class="badge badge-important"><i class="icon-white icon-remove"></i></span>';
		}
		#sia_comment($sya_ambil);
	?>
	</td>
	<?php endif; ?>
	</tr>
<?php endforeach; ?>
</tbody></table>
<?php else: ?>
Mata Kuliah ini tidak memerlukan prasyarat ambil atau lulus.<br><br>
<?php endif; ?>

<h3>C. Mata Kuliah Setara</h3>
<?php if(!empty($setara)): ?>
<table class="table table-bordered table-hover">
<thead>
	<tr>
	<th style="width:30px;">No.</th>
	<th style="width:200px;">Kurikulum Lama</th>
	<th style="width:125px;">Kode MK Lama</th>
	<th>Nama Mata Kuliah Lama</th>
	
	</tr>
</thead><tbody>
<?php
?>
<?php foreach($setara as $d): ?>
	<tr>
	<td class="tac"><?php echo $d['NO_']; ?>.</td>
	<td class=""><?php
		$tahun = (int)preg_replace("/[^0-9]/", "", $setara[0]['NM_KUR_LAMA']);
		if($tahun < 1000){
		echo $setara[0]['NM_KUR_LAMA'].' (TAHUN '.$setara[0]['TH_KUR_LAMA'].')'; 
		} else {
		echo $setara[0]['NM_KUR_LAMA'];
		}
	?></td>
	<td class=""><?php
		$url1 = str_replace('%LINK%',t1_encode($d['KD_KUR_LAMA'].'#'.$d['KD_MK_LAMA']),$url_d1);
		$ttt1 = 'title="lihat detil mata kuliah '.$d['NM_MK_LAMA'].' ('.$d['KD_MK_LAMA'].')" class="link-table"';
		echo anchor($url1,$d['KD_MK_LAMA'],$ttt1);
	?></td>
	<td class=""><?php echo $d['NM_MK_LAMA']; ?></td>
	
<?php endforeach; ?>
</tbody></table>
<?php else: ?>
Mata Kuliah ini tidak memiliki kesetaraan dengan mata kuliah di kurikulum terdahulu.<br><br>
<?php endif; ?>


<h3>D. Daftar Kelas Mata Kuliah</h3>
<?php if(!empty($kelas)): ?>
<table class="table table-bordered table-hover">
<thead>
	<tr>
	<th style="width:30px;">No.</th>
	<th style="width:75px;">TA</th>
	<th style="width:150px;">Semester</th>
	<th style="width:30px;">Kelas</th>
	<th>Dosen Pengampu</th>
	
	</tr>
</thead><tbody>
<?php
?>
<?php foreach($kelas as $d): ?>
	<tr>
	<td class="tac"><?php echo $d['NO_']; ?>.</td>
	<td class="tac"><?php echo $d['TA']; ?></td>
	<td class="tac"><?php echo $d['NM_SMT']; ?></td>
	<td class="tac"><?php echo $d['KELAS_PARAREL']; ?></td>
	<td class=""><?php echo sia_daftar_timajar($d['TIM_AJAR'],false,false,$url_d2); ?></td>
	</tr>
<?php endforeach; ?>
</tbody></table>
<?php else: ?>
Mata Kuliah ini belum pernah ditawarkan.
<?php endif; ?>