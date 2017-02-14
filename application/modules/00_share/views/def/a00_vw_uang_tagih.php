	<?php if(!empty($data['bayar_sort'])): ?>
	<h2>Tagihan Pembayaran</h2>
	<table class="table table-bordered table-hover">
	<thead>
		<tr>
		<th style="width:30px;">No.</th>
		<th>Uraian</th>
		<th>Semester</th>
		<th>TA</th>
		<th>Waktu Bayar</th>
		<th style="width:100px; background-color:#FFC;">Nominal Tagihan</th>
		</tr>
	</thead>
	<tbody>
	<?php $i = 0; $totalb = 0; foreach ($data['bayar_sort'] as $d1): 
		$d10 = explode('#',$d1); $d = $data['bayar_'.$d10[1]][$d10[2]];
		
		switch($data['view_bayar']){
			case 'mhs': case 'wali': 
				$url_detil = str_replace('%LINK%',t1_encode($d1),$data['url_d1']); #$data['url_link'].'/tagih-dtl-'.t1_encode($d1).'.html';
			break;
			case 'dosen': 
				$url_detil = str_replace('%LINK%',t1_encode($data['mahasiswa'][0]['NIM'].'#'.$d1),$data['url_d1']); 
				#$url_detil = 'dosen/tagih-mhsdt-'.t1_encode($data['mahasiswa'][0]['NIM'].'#'.$d1).'.html';
			break;
			default: $url_detil = 'error.html'; break;
		}
		
		if (strlen($d['TGL_EXPIRED']) < 19){ $d['TGL_EXPIRED'].= ':00'; }
		if (strlen($d['TGL_STARTED']) < 19){ $d['TGL_STARTED'].= ':00'; }
		?>
		<tr>
		<td class="tac"><?php echo ($i+1); ?>.</td>
		<td class=""><?php echo anchor($url_detil,$d['NM_KOMPONEN'],'class="link" title="lihat detil tagihan '.$d['NM_KOMPONEN'].' paling lambat tanggal '.$d['TGL_EXPIRED'].'"'); ?></td>
		<td class="tac"><?php 
			if(isset($d['KD_SMT']) AND (trim($d['KD_SMT']) != '')){
				echo str_replace('SEMESTER ','',sia_search_array($data['smt_123'], 'KD_SMT', 'NM_SMT', $d['KD_SMT'])); 
			} else { echo '-'; }
		?></td>
		<td class="tac"><?php 
			if(isset($d['KD_TA']) AND trim($d['KD_TA']) != ''){
				echo sia_search_array($data['ta_123'], 'KD_TA', 'TA', $d['KD_TA']); 
			} else { echo '-'; }
		?></td>
		<td class="tac"><?php echo $d['TGL_STARTED'].' WIB s/d<br>'.$d['TGL_EXPIRED'].' WIB'; ?></td>
		<td class="tar" style="background-color:#FFC;">Rp<?php 
			if($d10[1] != 'pmb'){ $sp1 = '_BAYAR'; } else { $sp1 = ''; } 
			echo number_format((int)$d['TOTAL'.$sp1],0,'.','.'); 
			$totalb += (int)$d['TOTAL'.$sp1];
			?></td>
		</tr>
		<?php if($i == count($data['bayar_sort'])-1): ?>
		<tr>
		<td colspan="5"  style="border-top:1px solid #999;"><strong>Jumlah Seluruh Tagihan</strong></td>
		<td class="tar" style="background-color:#FFC; width:100px; border-top:1px solid #999;" >Rp<?php echo number_format((int)$totalb,0,'.','.'); ?></td>
		</tr>
		<?php endif; ?>
	<?php $i++; endforeach; ?>
	</tbody>
	</table>
	<?php echo form_open(current_url(),array('name' => 'form_sia_cetak', 'target' => '_blank'));
	#echo form_submit('but_cetak', 'cetak sejarah IP','class="btn-uin btn btn-inverse btn btn-small" style="margin-top:0%;"');
	echo form_close();
	?>
	<?php else: echo '<br><h1>Tidak ada data tagihan untuk ditampilkan!</h1>'; ?>	
	<?php endif; ?>
	
	<?php
	
	/*
	
	[PMB]
	<NO_PMB>4120031613</NO_PMB>
	<NM_BANK>BNI</NM_BANK>
	<KD_TA>2012</KD_TA>
	<KD_SMT>1</KD_SMT>
	<NIM>12650001</NIM>
	<NM_MHS>Puguh Jayadi</NM_MHS>
	<NM_PRODI>Teknik Informatika</NM_PRODI>
	<KD_KOMPONEN>101</KD_KOMPONEN>
	<NM_KOMPONEN>Sumbangan Pembinaan Pendidikan</NM_KOMPONEN>
	<TOTAL>600000</TOTAL>
	<ID_TAGIHAN>10447</ID_TAGIHAN>
	<TGL_TRANSAKSI>12/06/2012 08:01</TGL_TRANSAKSI>
	<NM_FAKULTAS>FAKULTAS SAINS DAN TEKNOLOGI</NM_FAKULTAS>
	
	[SPP]
	[NM_BANK] => BNI
    [KD_TA] => 2012
    [KD_SMT] => 2
    [NIM] => 10651025
    [NM_MHS] => SISKA RESTU ANGGRAENY ISKANDAR
    [NM_PRODI] => Teknik Informatika
    [KD_KOMPONEN] => 1019
    [NM_KOMPONEN] => KERJA PRAKTEK (KP)
    [QTY] => 1
    [TARIF] => 60000
    [TOTAL_BAYAR] => 60000
    [ID_TAGIHAN] => 1000055454
    [TGL_TRANSAKSI] => 28/01/2013 09:37
    [NM_FAKULTAS] => FAKULTAS SAINS DAN TEKNOLOGI
	
	
	[SPV]
	[NM_BANK] => BNI
    [KD_TA] => 2012
    [KD_SMT] => 1
    [NIM] => 10651025
    [NM_MHS] => SISKA RESTU ANGGRAENY ISKANDAR
    [NM_PRODI] => Teknik Informatika
    [KD_KOMPONEN] => 199
    [NM_KOMPONEN] => Biaya SKS
    [QTY] => 22
    [TARIF] => 45000
    [TOTAL_BAYAR] => 990000
    [ID_TAGIHAN] => 1000030967
    [TGL_TRANSAKSI] => 11/09/2012 15:06
    [NM_FAKULTAS] => FAKULTAS SAINS DAN TEKNOLOGI
	
	[LLL]
	[NIM] => 10651025
    [TGL_TRANSAKSI] => 03/07/2013 14:49
    [URUT] => 201307031449
    [NM_MHS] => SISKA RESTU ANGGRAENY ISKANDAR
    [KD_GROUP] => 2
    [KD_KOMPONEN] => 102
    [NM_KOMPONEN] => KULIAH KERJA NYATA
    [TOTAL_BAYAR] => 240000
    [NM_BANK] => BSM
	
	[TAGIH SPP]
	[KD_TA] => 2012
    [KD_SMT] => 1
    [NIM] => 10651025
    [NM_MHS] => SISKA RESTU ANGGRAENY ISKANDAR
    [NM_PRODI] => Teknik Informatika
    [KD_KOMPONEN] => 101
    [NM_KOMPONEN] => Sumbangan Pembinaan Pendidikan
    [QTY] => 1
    [TARIF] => 1500000
    [TOTAL_BAYAR] => 1500000
    [ID_TAGIHAN] => 1000010133
    [TGL_STARTED] => 23/08/2012 00:01
    [TGL_EXPIRED] => 31/08/2012 23:48
    [NM_FAKULTAS] => FAKULTAS SAINS DAN TEKNOLOGI
    [STATUS_BAYAR] => L
	
	*/
	
	?>
	