	<?php if($data['tipe_krs'] == 'output'){ $col = 8; } else { $col = 9; } ?>
	
	<?php sia_comment($data['krs_info']); if(!empty($data['lembar_krs']) && ($data['kd_krs'] != '')): ?>
	
	<h2>Data Isian KRS 
	<span class="txtasmt"><?php echo sia_search_array($data['smt_123'], 'KD_SMT', 'NM_SMT', $data['lembar_krs'][0]['KD_SMT']); ?></span>, 
	Tahun Akademik 
	<span class="txtasmt"><?php echo sia_search_array($data['ta_123'], 'KD_TA', 'TA', $data['lembar_krs'][0]['KD_TA']); ?></span>
	</h2>
	
	<?php if(!empty($data['mk_ips'])){ $mar1 = 0; } else { $mar1 = 5; } ?>
	
	<h3>IP dan SKS Mahasiswa</h3>
	<table class="table-bordered table-user" style="margin-bottom:<?php echo $mar1; ?>%;">
	<tbody>
	<?php if(false): ?><tr><td class="snippet-label2">Dosen PA</td><td colspan="5">: <?php echo $data['ambil_sks'][0]['NM_DOSEN']; ?></td></tr><?php endif; ?>
	<tr>
		<td class="snippet-label2">IPK</td><td>: <?php echo $data['krs_info']['data'][':ipk']; ?></td>
		<td class="snippet-label2">SKS Kumulatif</td><td>: <?php echo $data['krs_info']['data'][':sks_kum']; ?></td>
		<td class="snippet-label2">SKS Ambil</td><td>: <?php echo $data['krs_info']['data'][':ambil_jatah2']; ?></td>
	</tr>
	<tr>
		<td class="snippet-label2">IP Semester Lalu</td><td>: <?php echo $data['krs_info']['data'][':ip']; ?></td>
		<td class="snippet-label2">Jatah SKS</td><td>: <?php echo $data['krs_info']['data'][':sks_jatah2']; ?></td>
		<td class="snippet-label2">Sisa SKS</td><td>: <?php echo ((int)$data['krs_info']['data'][':sks_jatah2'] - (int)$data['krs_info']['data'][':ambil_jatah2']); ?></td>
	</tr>
	</tbody>
	</table>
	
	<?php if(!empty($data['mk_ips'])): 
	$ips1 = count($data['mk_ips']);
	$ips2 = 0; foreach($data['mk_ips'] as $ips){ $ips2 += intval($ips['SKS']); }
	?>
	<div class="bs-callout bs-callout-on-progress">
	<p>IP semester lalu Anda masih merupakan IP sementara karena nilai dari <?php echo $ips1; ?> mata kuliah yang Anda ambil di semester lalu berikut belum tersedia.</p>
	<ol style="margin: 2% 0 2% 3%;">
	<?php foreach($data['mk_ips'] as $ips): ?>
	<li><?php echo $ips['NM_MK']; ?> (<?php echo $ips['KD_MK']; ?>) <?php echo $ips['SKS']; ?> SKS</li>
	<?php endforeach; ?>
	</ol>
	<p>Oleh sebab itu, jatah SKS yang Anda peroleh kemungkinan dapat berubah.</p>
	</div>
	<?php endif; ?>
	
	<h3>Daftar Kelas Mata Kuliah yang Diambil</h3>
	<table class="table table-bordered table-hover">
	<thead>
		<tr>
		<th style="width:30px;">No.</th>
		<th style="width:90px;">Kode MK</th>
		<th>Nama MK</th>
		<th>Kelas</th>
		<th>SKS</th>
		<?php if(1<1): ?><th>SMT<br>Paket</th><?php endif; ?>
		<th>Jadwal</th>
		
		<th style="width:50px;">Jenis MK</th>
		<th style="width:150px;">Nama Dosen Pengampu</th>
		
		<?php if($data['tipe_krs'] == 'input'):
		echo '<th>Aksi</td>';
		endif; ?>
		</tr>
	</thead>
	<tbody>
	<?php if(!empty($data['mhs_krs'])): ?>
	<?php $jj = 1; foreach ($data['mhs_krs'] as $d): #print_r($d);
		$style = '';
		#if ($d['PWALI_STATUS_AMBIL'] == '2'){ $style = "background-color: #A7DDD6;"; }
	?>
		<tr style="<?php echo $style; ?>">
		<td class="tac"><?php echo $jj; ?>.</td>
		<td><?php 
		$url1 = str_replace('%LINK%',t1_encode($d['KD_KUR'].'#'.$d['KD_MK']),$data['url_d1']);
		$ttt1 = 'title="lihat detil mata kuliah '.$d['NM_MK'].' ('.$d['KD_MK'].')" class="link"';
		echo anchor($url1,$d['KD_MK'],$ttt1);
		#echo $d['KD_MK']; ?></td>
		<td><?php echo $d['NM_MK']; ?></td>
		<td class="tac"><?php echo $d['KELAS_PARAREL']; ?></td>
		<td class="tac"><?php echo $d['SKS']; ?></td>
		<?php if(1<1): ?><td class="tac"><?php echo $d['SEMESTER_PAKET']; ?></td><?php endif; ?>
		<td class=""><?php echo sia_shorttolong_hari($d['JADWAL1']); ?></td>
		<td class="tac"><?php echo $d['NM_JENIS_MK']; ?></td>
		<td class=""><?php echo str_replace('(','<br>(',sia_daftar_timajar($d['TIM_AJAR'])); ?></td>
		<?php if($data['tipe_krs'] == 'input'):
		$t2 = 'hapus mata kuliah '.$d['NM_MK'].' ('.$d['KELAS_PARAREL']. ') dari KRS';
		
		$url1 = str_replace('%LINK%',t1_encode('hhh11#'.$d['KD_KELAS']),$data['url_a1']);
		$ttt1 = 'title="hapus kelas mata kuliah '.$d['NM_MK'].' '.$d['KELAS_PARAREL'].' dari KRS" class="btn btn-small"';
				
		echo '<td>'.anchor($url1,'<i class="icon-trash"></i> hapus',$ttt1).'</td>';
		endif; ?>
		</tr>
	<?php $jj++; endforeach; ?>
	<?php else: ?>
		<tr><td colspan="<?php echo $col; ?>" class="tac">Belum Ada Data Isian KRS</td></tr>
	<?php endif; ?>
	</tbody>
	</table>
		
	<?php if(!empty($data['mhs_krs'])): ?>
	<h3>Catatan dari Dosen Penasihat Akademik</h3>
	<table class="table table-bordered table-hover">
	<thead>
		<tr>
		<th style="width:30px;">No.</th>
		<th style="width:200px;">Nama MK</th>
		<th>Catatan</th>
		</tr>
	</thead>
	<tbody>
	<?php $jj = 1; foreach ($data['cat_krs'] as $d): #print_r($d); 
		$style = '';
		#if ($d['PWALI_STATUS_AMBIL'] == '2'){ $style = "background-color: #A7DDD6;"; }
	?>
		<tr style="<?php echo $style; ?>">
		<td class="tac"><?php echo $jj; ?>.</td>
		<td style="width:200px;"><?php echo $d['NM_MK']; ?></td>
		<td class=""><?php echo $d['KETERANGAN']; ?></td>
		</tr>
	<?php $jj++; endforeach; ?>
	<tr><td colspan="3"><strong>Catatan Umum:</strong><br>
	<?php if(!empty($data['catatan'])){ echo $data['catatan'][0]['CATATAN_CLOB']; } ?>
	</td></tr>
	</tbody>
	</table>
	<?php endif; ?>
	
	<?php if(!empty($data['log_detail'])): ?>
	<h3>Keterangan Kelas Mata Kuliah</h3>
		<table class="table table-bordered table-hover" style="margin: 0px 0 30px 0;" >
		<thead>
		<tr>
		<th style="width:30px;">No.</th>
		<th style="width:200px;">Nama MK</th>
		<th>Kelas</th>
		<th>Status</th>
		<th style="width:150px;">Tanggal</th>
		</tr>
		</thead>
		<tbody>
		<?php $j1 = 1; foreach ($data['log_detail'] as $d): ?>
		<tr>
			<td class="tac"><?php echo $j1; ?>.</td>
			<td class=""><?php echo $d['NM_MK']; ?></td>
			<td class="tac"><?php echo $d['KELAS_PARAREL']; ?></td>
			<td class=""><?php echo $d['LOG_STATUS_F']; ?></td>
			<td class="tac"><?php echo date_trans_foracle($d['LOG_TANGGAL_F'],1,'0 111 111','/'); ?> WIB</td>
		</tr>
		<?php $j1++; endforeach; ?>
		</tbody>
		</table>
	<?php endif; ?>
	
	<?php else: echo '<h1>Tidak Ada Data KRS untuk Ditampilkan!</h1>';?>
	<?php endif; ?>