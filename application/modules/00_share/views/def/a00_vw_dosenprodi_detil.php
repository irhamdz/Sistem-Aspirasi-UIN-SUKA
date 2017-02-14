<?php if(!empty($kelas)): ?>

<h2>Kelas Mata Kuliah yang Diampu Oleh <span class="txtasmt"><?php echo $dosen[0]['NM_DOSEN']; ?></span>
</h2>

<?php 
$t001 = true; $j = -1; $ix = 0; $t000 = $kelas[0]['KD_TA'].$kelas[0]['KD_SMT']; 
foreach ($kelas as $d): ?>

<?php if($t000 == $d['KD_TA'].$d['KD_SMT']): $j++; else: $j = 0; $t001 = true; $t000 = $d['KD_TA'].$d['KD_SMT']; endif; ?>

<?php if ($t001): ?>
<?php if($ix > 0): ?>
</tbody>
</table>
<?php endif; ?>

<h3>Kelas di 
<span class="txtasmt"><?php echo sia_search_array($smt_123, 'KD_SMT', 'NM_SMT', $d['KD_SMT']); ?></span>, 
Tahun Akademik 
<span class="txtasmt"><?php echo sia_search_array($ta_123, 'KD_TA', 'TA', $d['KD_TA']); ?></span>
</h3>
<table class="table table-bordered table-hover">
<thead>
	<tr>
	<th style="width:30px;">No.</th>
	<th>Nama Mata Kuliah</th>
	<th style="width:25px;">SKS</th>
	<th style="width:50px;">Jenis MK</th>
	<th style="width:50px;">Kelas</th>
	<th style="width:200px;">Jadwal Kuliah</th>
	<th style="width:50px;">Peserta</th>
	</tr>
</thead><tbody>
<?php $t001 = false; endif; ?>
	
	<tr style="">
	<td class="tac"><?php echo ($j+1); ?>.</td>
	<td><?php 
		$url1 = str_replace('%LINK%',t1_encode($d['KD_KUR'].'#'.$d['KD_MK']),$url_d2);
		$ttt1 = 'title="lihat detil mata kuliah '.$d['NM_MK'].' ('.$d['KD_MK'].')" class="link-table"';
		echo anchor($url1,$d['NM_MK'],$ttt1);
	?></td>
	<td class="tac" ><?php echo $d['SKS']; ?></td>
	<td class="tac" ><?php echo $d['NM_JENIS_MK']; ?></td>
	<td class="tac" ><?php echo $d['KELAS_PARAREL']; ?></td>
	<td><?php echo sia_shorttolong_hari($d['JADWAL1']); ?></td>
	<td class="tac"><?php echo $d['TERISI']; ?></td>
	</tr>
	
<?php $ix++; endforeach; ?>
</tbody>
</table>

<?php else: echo '<h1>Tidak Ada Data Kelas Mata Kuliah untuk Ditampilkan!</h1>'; ?>
<?php endif; ?>