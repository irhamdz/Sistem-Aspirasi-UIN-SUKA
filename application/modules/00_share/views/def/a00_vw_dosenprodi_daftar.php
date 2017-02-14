	<?php if(!empty($dosen)): ?>
	<h2><?php
		switch ($data['e_kode']){
		case 'asal': $t001 = 'Dosen Program Studi '; break;
		case 'ajar': $t001 = 'Dosen yang Mengajar di Program Studi '; break;
		default: $t001 = ''; break;
		} echo $t001; unset($t001);
	?>   
	<span class="txtasmt"><?php echo $this->session->userdata('mhs_nm_prodi'); ?></span>
	</h2>
	
	<table class="table table-bordered table-hover">
	<thead>
		<tr>
		<th style="width:30px;">No.</th>
		<th style="width:150px;">NIP</th>
		<th>Nama Dosen</th>
		<th style="width:120px;">Status</th>
		
		</tr>
	</thead><tbody>
		
	<?php $i1 = 0;
		foreach ($dosen as $d): ?> 
	<?php
		$is_lb = 0;	//0 = dosen pns
		if(trim($d['NIP']) == ''){ $nip = $d['KD_DOSEN']; } else { $nip = $d['NIP']; }
		if(strlen(trim($nip)) == 18){ $nip1 = sia_nip_staff($nip); } 
		else { $nip1 = preg_replace("/[^0-9A-Z]/", "", strtoupper($nip)); }
		$is_lb = !sia_cek_dosenpns($nip);	
		
		if(($is_lb && ($i_y1 == 1)) || (!$is_lb && ($i_y1 == 0)) || ($i_y1 == 2)): $i1++;
		#if(true): $i1++;
	?>
		<tr style="">
		<td class="tac"><?php echo $i1; ?>.</td>
		<td><?php 
						
			$url1 = str_replace('%LINK%',t1_encode($d['KD_DOSEN']),$url_d1);
			$ttt1 = 'title="lihat daftar kelas yang diampu oleh dosen '.$d['NM_DOSEN'].'" class="link-table"';
			echo anchor($url1,$nip1,$ttt1); ?></td>
		<td><?php echo $d['NM_DOSEN']; ?></td>
		<td class="tac"><?php 
			$s1 = 'Dosen Luar Biasa';
			$s0 = 'Dosen Tetap PNS';
			
			if($is_lb == 0){ echo $s0; } else { echo $s1; }
		?></td>
		</tr>

	<?php endif; endforeach; ?>
	
	</tbody>
	</table>
	
	<?php else: echo '<br><h1>Tidak Ada Data Dosen Prodi untuk Ditampilkan!</h1>'; ?>
	<?php endif; ?>
