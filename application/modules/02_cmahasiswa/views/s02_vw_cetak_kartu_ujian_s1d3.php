<?php
// print_r($jalur); die();
// error_reporting(0);
function tanggal_hari($tanggal){
	$tgl=explode("-",$tanggal);
	$info=date('w', mktime(0,0,0,$tgl[1],$tgl[0],$tgl[2]));
	switch($tgl[1]){
			case '01': $bulan= "Januari"; break;
			case '02': $bulan= "Februari"; break;
			case '03': $bulan= "Maret"; break;
			case '04': $bulan= "April"; break;
			case '05': $bulan= "Mei"; break;
			case '06': $bulan= "Juni"; break;
			case '07': $bulan= "Juli"; break;
			case '08': $bulan= "Agustus"; break;
			case '09': $bulan= "September"; break;
			case '10': $bulan= "Oktober"; break;
			case '11': $bulan= "Nopember"; break;
			case '12': $bulan= "Desember"; break;
		};
		switch($info){
			case '0': $hari= "Minggu"; break;
			case '1': $hari= "Senin"; break;
			case '2': $hari= "Selasa"; break;
			case '3': $hari= "Rabu"; break;
			case '4': $hari= "Kamis"; break;
			case '5': $hari= "Jumat"; break;
			case '6': $hari= "Sabtu"; break;
		};
	$tampil_tanggal=$hari.", ".$tgl[0]." ".$bulan." ".$tgl[2];
	return $tampil_tanggal;
}

// echo asd($jalur[0]->PMB_TANGGAL_AWAL_SELEKSI);
// die();
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="expires" content="mon, 22 jul 2002 11:12:01 gmt">
		<meta http-equiv="cache-control" content="no-cache">
		<title><?php echo $this->config->item('app_name').' '.$this->config->item('app_owner_s'); ?></title>
		<link href="<?php echo base_url('asset/img/favicon.png'); ?>" type="image/x-icon" rel="shortcut icon">
		<link href="<?php echo base_url('asset/css/stylesc.css'); ?>" rel="stylesheet" type="text/css"/>
	</head>
<body>
<div id="layout">
	<div id="header">
		<div id="logo"><img src="<?php echo base_url('asset/img/logo-uinp.gif'); ?>"></div>
		<div id="navigation">
			<strong>KEMENTERIAN AGAMA<br>
			<?php echo $this->config->item('app_owner_s'); ?></strong><br>
			<?php echo $this->config->item('app_name'); ?> Tahun Akademik 2015/2016<br>
			<sup><em>Jl. Marsda Adisucipto, Yogyakarta 55281 Telp. 0274 519709 email: admisi@uin-suka.ac.id</em></sup>
		</div>
	</div>
	<div id="midhead">
		<div id="midlog">
			<div id="head-tit">
				KARTU PESERTA
			</div>
			<table border="0" width="100%">
				<tbody>
					<tr>
						<td colspan="3"><strong>Data Peserta</strong><div id="grs"></div></td>
					</tr>			
					<tr>
						<td>Nomor PMB</td>
						<td>: <strong><?php echo $cetak_kartu_ujian[0]->PMB_NO_UJIAN_PENDAFTAR; ?></strong></td>
						<td valign="top" rowspan="5"><div class="potiik">
						<?php /*
						<img src="<?php echo base_url().'img_pendaftar/'.$this->session->userdata('status').'/'.$cetak_kartu_ujian[0]->PMB_FOTO_PENDAFTAR.''; ?>" width="95">
						*/ ?>
						<img src='<?php echo base_url().'img_pendaftar/'.$this->session->userdata('status').'/'.$this->session->userdata('TAHUN_BAYAR').'/'.$this->session->userdata('gelombang').'/'.$cetak_kartu_ujian[0]->PMB_FOTO_PENDAFTAR.''; ?>' width="95" />
						
						
						
						</div></td>
					</tr>
					<tr>
						<td valign="top">Nama</td>
						<td>: <?php 
						$nama_peserta=$cetak_kartu_ujian[0]->PMB_NAMA_LENGKAP_PENDAFTAR;
						//$nama_peserta=str_replace("#39;", "'", $nama_peserta);

						echo $nama_peserta; ?></td>
						<td></td>
					</tr>
						<td>Sekolah</td>
						<td>: <?php 
						// $kode_sekolah=$cetak_kartu_ujian[0]->PMB_KODE_SEKOLAH;
						// $kd_s=substr($kode_sekolah,4,4);
						// if($kd_s==9999){
							// $nama_sekolah = $cetak_kartu_ujian[0]->PMB_SEKOLAH_LAIN;
							// $nama_sekolah = str_replace("#39;", "'", $nama_sekolah);
							// echo $nama_sekolah;
						// }else{
							// $nama_sekolah = $nama_sekolah_peserta[0]->NAMA_SEKOLAH;
							// echo $nama_sekolah;
						// }
							$nama_sekolah = $cetak_kartu_ujian[0]->PMB_SEKOLAH_LAIN;
							echo $nama_sekolah;
					?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>Jurusan</td>
						<td>: <?php 
							#echo $cetak_kartu_ujian[0]->PMB_JURUSAN_SEKOLAH; 
				$jus=$cetak_kartu_ujian[0]->PMB_JURUSAN_SEKOLAH; 
				switch($jus){
					case 1: 
					case 2: 
					case 3: 
					case 4: 
					case 5: 
					case 6: 
					foreach($jurusan_sekolah as $value){ 
								if($value->PMB_ID_JURUSAN_SEKOLAH==$cetak_kartu_ujian[0]->PMB_JURUSAN_SEKOLAH){
									echo $value->PMB_NAMA_JURUSAN_SEKOLAH;
								}
						}
					break;
					default : 
						echo $jus;
					break;
					}
				
							
							
						#print_r($jurusan_sekolah);
						?></td>
						<td></td>
					</tr>
					<tr>
						<td>Kesehatan</td>
						<td>:<?php 
							$sakit_saya=explode(" ",$cetak_kartu_ujian[0]->PMB_ID_JENIS_KESEHATAN);
							for($a=0; $a<count($sakit_saya); $a++){ 
							if($sakit_saya[$a]==1){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Normal';
							}elseif($sakit_saya[$a]==2){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Daksa';
							}elseif($sakit_saya[$a]==3){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Netra';
							}elseif($sakit_saya[$a]==4){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Rungu';
							}elseif($sakit_saya[$a]==5){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Wicara';
							}elseif($sakit_saya[$a]==6){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Buta Warna Parsial';
							}elseif($sakit_saya[$a]==7){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Buta Warna Total';
							}
							} ?></td>
						<td>
						</td>
					</tr>
					<tr>
						<td colspan="3"><div id="grs"></div></td>
					</tr>
					<tr>
						<td colspan="3">Lokasi Ujian: Ruang <strong><?php echo $cetak_kartu_ujian[0]->PMB_NAMA_RUANG; ?></strong></td>
					</tr>
					<tr>
						<td colspan="3">Gedung <?php echo $cetak_kartu_ujian[0]->PMB_NAMA_GEDUNG; ?></td>
					</tr>
				</tbody>
			</table>
				
	</div>
<div id="midnav">
			<table border="0" width="100%">
			<tbody>
				<tr>
					<td colspan="2" align="center" style="font-size:14px;">
					<strong>
					<?php 
					// print_r($cetak_kartu_ujian); 
					// $jalur=$cetak_kartu_ujian[0]->PMB_JALUR_PENDAFTARAN;
					// switch($jalur){
						// case 20 : echo "MAGISTER (S2) GELOMBANG I"; break;
						// case 21 : echo "MAGISTER (S2) GELOMBANG II"; break;
						// case 10 : echo "Jalur Reguler (S1/D3)"; break;
					// } 
					echo $jalur[0]->PMB_NAMA_JALUR_MASUK;
					?>
					</strong>
					
					<br><?php 
					// echo $jalur[0]->PMB_NAMA_JALUR_MASUK;
					// $jalur=$cetak_kartu_ujian[0]->PMB_KELAS_JURUSAN;
					// switch($jalur){
						// case 1 : echo "Reguler"; break;
						// case 2 : echo "Non Reguler (Akhir Pekan)"; break;
						// default : echo "Kelas Reguler"; break;
					// } 
					?>
					</td>
				</tr>
				<tr>
					<td width="80"><strong>Pilihan I</strong></td><td></td>
				</tr>
				<?php /*
				<tr>
					<td>Kode: <?php echo $cetak_kartu_ujian[0]->PMB_PILJUR_1; ?></td>
					<td></td>
				</tr>
				*/ ?>
				<tr>
					<td colspan="2"><?php   $pil_1=$cetak_kartu_ujian[0]->PMB_PILJUR_1;
						foreach($master_prodi as $value){
							if($pil_1==$value->PMB_ID_PRODI){
								echo $value->PMB_NAMA_PRODI;
							}
						}
					?></td>
				</tr>
				<tr>
					<td><strong>Pilihan II</strong></td>
					<td></td>
				</tr>
				<?php /*
				<tr>
					<td>Kode: <?php echo $cetak_kartu_ujian[0]->PMB_PILJUR_2; ?></td>
					<td></td>
				</tr>
				*/ ?>
				<tr>
					<td colspan="2"><?php   $pil_2=$cetak_kartu_ujian[0]->PMB_PILJUR_2;
						foreach($master_prodi as $value){
							if($pil_2==$value->PMB_ID_PRODI){
								echo $value->PMB_NAMA_PRODI;
							}
						}
		 ?></td>
		 <tr>
					<td><strong>Pilihan III</strong></td>
					<td></td>
				</tr>
			<?php /*
				<tr>
					<td>Kode: <?php echo $cetak_kartu_ujian[0]->PMB_PILJUR_3; ?></td>
					<td></td>
				</tr>
				*/
				?>
				<tr>
					<td colspan="2"><?php  $pil_3=$cetak_kartu_ujian[0]->PMB_PILJUR_3;
						foreach($master_prodi as $value){
							if($pil_3==$value->PMB_ID_PRODI){
								echo $value->PMB_NAMA_PRODI;
							}
						}
		 ?></td>
				</tr>
				<tr>
					<td colspan="2"><div id="grs"></div></td>
				</tr>
				<tr>
					<td colspan="2"> Tanggal Ujian: <br><strong>
					<?php 
						echo tanggal_hari($jalur[0]->PMB_TANGGAL_AWAL_SELEKSI);
						echo " <br /> ";
						echo tanggal_hari($jalur[0]->PMB_TANGGAL_AKHIR_SELEKSI);
					?>
					</strong></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="rbroundbox">
	<br><br>
	<table border="0" cellpadding="1" cellspacing="2" width="100%">
	<tbody><tr>
		<td width="170" align="center">Petugas Verifikasi</td>
		<td width="200"></td>
		<td align="center">Yogyakarta  (<?php 
			$tgl=tanggal_hari(date("d-m-Y"));
			echo $tgl;
?>)
		</td></tr>
		<tr><td></td><td></td><td align="center"><br><br><br><br></td></tr>
		<tr><td align="center">( _________________ )</td>
		<td></td>
		<td align="center"><br><br>( <?php echo $nama_peserta; ?> )</td></tr>
	</tbody></table>
    <br><br>
    Perlengkapan yang harus dibawa pada saat ujian:<br><br>
    <i>- KARTU PESERTA dan DATA PESERTA dari sistem PMB ini yang telah dicetak secara warna</i><br>
    <i>- Foto Copy Ijazah yang telah dilegalisasi atau tanda lulus ASLI</i><br>
    <i>- Pensil 2B secukupnya, karet penghapus dan peraut pensil (jika diperlukan)</i><br>
    <i>- <strong>Papan untuk alas lembar jawab komputer</strong></i><br><br><br>
	<table border="1" cellpadding="1" cellspacing="2" width="100%">
		<tbody>
			<tr>
				<td width="3"></td>
				<td width="110">Waktu</td>
				<td>Materi</td>
				<td align='center'>Peta UIN</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><div id="grs"></div></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><strong><?php echo tanggal_hari($jalur[0]->PMB_TANGGAL_AWAL_SELEKSI); ?></strong></td>
				<td rowspan='7' align='center'><img src='http://uin-suka.ac.id/files/content_images/peta_uin_suka.jpg' width='220' /><br /><font size=1>Sumber : http://uin-suka.ac.id/index.php/page/universitas/27-peta-uin.html</font></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.00  -  08.30</td>
				<td>Verifikasi Data</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.30  -  09.50</td>
				<td>Tes Potensi Akademk (TPA)</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 09.50  -  10.00</td>
				<td>Istirahat (di dalam ruangan)</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 10.00  -  10.50</td>
				<td>Tes Dirasah Islamiyah</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><strong><?php echo tanggal_hari($jalur[0]->PMB_TANGGAL_AKHIR_SELEKSI); ?></strong></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.00 - 08.50</td>
				<td>Tes Bahasa</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.50 - 09.00</td>
				<td>Istirahat (di dalam ruangan)</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 09.00 - 10.00</td>
				<td>Tes Kepribadian</td>
			</tr>
		</tbody>
	</table>	
</div>
</div>

</body></html>