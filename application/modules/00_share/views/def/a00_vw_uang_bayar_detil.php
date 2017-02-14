	<?php 
	
	$arr_kolom = array('NO_PMB','NM_BANK','KD_TA','KD_SMT','KD_KOMPONEN','NM_KOMPONEN','TOTAL','ID_TAGIHAN','TGL_TRANSAKSI','QTY','TARIF','TOTAL_BAYAR','URUT','KD_GROUP');
	$arr_kolom1 = array('Uraian',
	'Tempat Bayar','Waktu Bayar','Nomor Registrasi','Nominal Bayar','Kode Tagihan',
	'Rincian','Nomor Urut Bayar','Kode Grup','Nominal Bayar');
	
	
	$d10 = explode('#',$data['kd_bayar']);
	$id	= abs((int)$d10[2]);
	$cat = trim(strtolower($d10[1]));
			switch($cat){
				case 'pmb': $arr_k1 = array(0,1,2,3,5,9); break; #array(0,1,2,3,4,5,6,7,8); break;
				case 'spp': $arr_k1 = array(0,1,2,5,6,4); break; #array(1,2,3,4,5,7,8,9,10,11); break;
				case 'spv': $arr_k1 = array(0,1,2,5,6,4); break; #array(1,2,3,4,5,7,8,9,10,11); break;
				case 'lll': $arr_k1 = array(0,1,2,7,4); break; #$arr_k1 = array(1,4,5,8,11,12,13); break;
				default: $catid = 0; redirect($data['url_link'].'/error.html'); break;
			}
	
	?>
	
	<?php if(!empty($data['bayar_'.$cat][$id])): $d = $data['bayar_'.$cat][$id]; #print_r($d); ?>
	<h2>Detil Pembayaran Mahasiswa</h2>
	<table class="table table-bordered table-hover">
	<?php foreach($arr_k1 as $ar1): ?>
	<tr style="<?php 
		if (($ar1 == 6) || ($ar1 == 4) || ($ar1 == 9)){ echo 'background-color:#FFC;'; }
	?>">
	<th style="text-align:left; width:150px;"><?php echo $arr_kolom1[$ar1]; ?></th>
	<td>
	<?php
		switch($ar1){
			case 0: 
				if(isset($d['KD_SMT']) AND (trim($d['KD_SMT']) != '')){
					$smt = sia_search_array($data['smt_123'], 'KD_SMT', 'NM_SMT', $d['KD_SMT']); 
				} else { $smt = '-'; }
				if(isset($d['KD_TA']) AND trim($d['KD_TA']) != ''){
					$ta = sia_search_array($data['ta_123'], 'KD_TA', 'TA', $d['KD_TA']); 
				} else { $ta = '-'; }
				echo $d['NM_KOMPONEN'];
				if ($cat != 'lll'){ echo ' di '.$smt.' TA '.$ta.' untuk prodi '.$d['NM_PRODI']; }
			break;
			case 1: 
				switch(strtolower($d['NM_BANK'])){
					case 'mandiri': echo 'Bank Mandiri'; break;
					case 'bni': echo 'Bank Negara Indonesia (BNI)'; break;
					case 'bri': echo 'Bank Rakyat Indonesia (BRI)'; break;
					case 'bsm': echo 'Bank Syariah Mandiri'; break;
					default: echo $d['NM_BANK']; break;
				}
			break;
			case 2:
				$tgl = date_trans_foracle($d['TGL_TRANSAKSI'], 1, '1 231 111', ' ');
				echo substr($tgl,0,strlen($tgl)-9).', '.substr($tgl,strlen($tgl)-8,8).' WIB';
			break;
			case 3: echo $d['NO_PMB']; break;
			case 4: echo 'Rp'.number_format((int)$d['TOTAL_BAYAR'],0,'.','.'); break;
			case 5: echo $d['ID_TAGIHAN']; break;
			case 6:	echo $d['QTY'].' × Rp'.number_format((int)$d['TARIF'],0,'.','.'); break;
			case 7: echo $d['URUT']; break;
			case 9: echo 'Rp'.number_format((int)$d['TOTAL'],0,'.','.'); break;
		}
	?>
	</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<?php echo form_open(current_url(),array('name' => 'form_sia_cetak', 'target' => '_blank'));
	#echo form_submit('but_cetak', 'cetak sejarah IP','class="btn-uin btn btn-inverse btn btn-small" style="margin-top:0%;"');
	echo form_close();
	?>
	<?php else: echo '<h1>Tidak Ada Data untuk Ditampilkan!</h1>'; ?>	
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
	