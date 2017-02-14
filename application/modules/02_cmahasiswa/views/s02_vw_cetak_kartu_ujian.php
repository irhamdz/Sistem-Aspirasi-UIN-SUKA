<?php
 //print_r($jalur); die();
// echo $jalur[0]->PMB_TANGGAL_AWAL_SELEKSI; die();
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
			<sup><em>Jl. Marsda Adisucipto, Yogyakarta 55281 Telp. 0274 519709 email: pps@uin-suka.ac.id</em></sup>
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
						<img src='<?php echo base_url().'img_pendaftar/'.$this->session->userdata('status').'/'.$this->session->userdata('TAHUN_BAYAR').'/'.$cetak_kartu_ujian[0]->PMB_JALUR_PENDAFTARAN.'/'.$cetak_kartu_ujian[0]->PMB_FOTO_PENDAFTAR.''; ?>' width="95" />
						</div></td>
					</tr>
					<tr>
						<td valign="top">Nama</td>
						<td>: <?php 
						$nama_peserta=$cetak_kartu_ujian[0]->PMB_NAMA_LENGKAP_PENDAFTAR;
						//$nama_peserta=str_replace("#39;", "'", $nama_peserta);

						
						echo $nama_peserta; ?></td><td></td>
					</tr>
						<td>Lulusan</td>
						<td>: <?php 
								$lulusan=$cetak_kartu_ujian[0]->PMB_LULUSAN_DARI;
								switch($lulusan){
									case 1: echo "UIN"; break;
									case 2: echo "IAIN"; break;
									case 3: echo "STAIN"; break;
									case 4: echo "PTAIS"; break;
									case 5: echo "PTN"; break;
									case 6: echo "PTS"; break;
									case 7: echo "PT LUAR NEGERI"; break;
									default: echo $cetak_kartu_ujian[0]->PMB_LULUSAN_DARI; break;
								}?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>Nama PT</td>
						<td>: <?php echo $cetak_kartu_ujian[0]->PMB_NAMA_PERGURUAN_TINGGI; ?></td><td></td>
					</tr>
					<tr>
						<td>Tahun</td>
						<td>: <?php echo $cetak_kartu_ujian[0]->PMB_TAHUN_IJAZAH; ?></td><td></td>
					</tr>
					<tr>
						<td>IPK</td>
						<td>: <?php echo $cetak_kartu_ujian[0]->PMB_IPK_CPASCA; ?></td><td></td>
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
					$GELOMBANG=$cetak_kartu_ujian[0]->PMB_JALUR_PENDAFTARAN;
					switch($GELOMBANG){
						case 20 : echo "MAGISTER (S2) GELOMBANG I"; break;
						case 21 : echo "MAGISTER (S2) GELOMBANG II"; break;
						case 22 : echo "MAGISTER (S2) GELOMBANG III"; break;
					} ?>
					</strong>
					
					<br><?php $KELAS=$cetak_kartu_ujian[0]->PMB_KELAS_JURUSAN;
					switch($KELAS){
						case 1 : echo "Reguler"; break;
						case 2 : echo "Non Reguler (Akhir Pekan)"; break;
					} ?></td>
				</tr>
				<tr>
					<td width="80"><strong>Pilihan I</strong></td><td></td>
				</tr>
				<tr>
					<td COLSPAN="2"> <?php echo $cetak_kartu_ujian[0]->PMB_PILJUR_1; ?></td>
				</tr>
				<tr>
					<td colspan="2"><?php   
						$pil_1=$cetak_kartu_ujian[0]->PMB_PILJUR_1;
							foreach($master_prodi as $value){ 
								if($value->PMB_ID_PRODI==$pil_1){
									echo "".$value->PMB_NAMA_PRODI."";
								}
							}
						// switch($pil_1){
							// case 1: echo "Konsentrasi Filsafat Islam"; break;
							// case 2: echo "Konsentrasi Studi al-Qur'an dan al-Hadis"; break;
							// case 3: echo "Konsentrasi Studi Agama dan Resolusi Konflik"; break;
							// case 4: echo "Konsentrasi Ilmu Bahasa Arab"; break;
							// case 5: echo "Konsentrasi Sejarah Kebudayaan Islam"; break;
							// case 6: echo "Konsentrasi Pendidikan Agama Islam"; break;
							// case 7: echo "Konsentrasi Manajemen dan Kebijakan Pendidikan Islam"; break;
							// case 8: echo "Konsentrasi Pemikiran Pendidikan Islam"; break;
							// case 9: echo "Konsentrasi Pendidikan Bahasa Arab"; break;
							// case 10: echo "Konsentrasi Bimbingan dan Konseling Islam"; break;
							// case 11: echo "Konsentrasi Hukum Keluarga"; break;
							// case 12: echo "Konsentrasi Keuangan dan Perbankan Syariah"; break;
							// case 13: echo "Konsentrasi Studi Politik dan Pemerintahan dalam Islam"; break;
							// case 14: echo "Konsentrasi Hukum Bisnis Syariah"; break;
							// case 15: echo "Konsentrasi Pekerjaan Sosial"; break;
							// case 16: echo "Konsentrasi Ilmu Perpustakaan dan Informasi"; break;
							// case 17: echo "Konsentrasi Sains MI"; break;
							// case 18: echo "Konsentrasi Pendidikan Agama Islam MI"; break;
							// case 19: echo "Konsentrasi Pendidikan Guru Raudlatul Athfal"; break;
						// }
		 ?></td>
				</tr>
				<tr>
					<td><strong>Pilihan II</strong></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><?php echo $cetak_kartu_ujian[0]->PMB_PILJUR_2; ?></td>
				</tr>
				<tr>
					<td colspan="2"><?php  
							$pil_2=$cetak_kartu_ujian[0]->PMB_PILJUR_2;
							foreach($master_prodi as $value){ 
								if($value->PMB_ID_PRODI==$pil_2){
									echo "".$value->PMB_NAMA_PRODI."";
								}
							}
						// switch($pil_2){
							// case 1: echo "Konsentrasi Filsafat Islam"; break;
							// case 2: echo "Konsentrasi Studi al-Qur'an dan al-Hadis"; break;
							// case 3: echo "Konsentrasi Studi Agama dan Resolusi Konflik"; break;
							// case 4: echo "Konsentrasi Ilmu Bahasa Arab"; break;
							// case 5: echo "Konsentrasi Sejarah Kebudayaan Islam"; break;
							// case 6: echo "Konsentrasi Pendidikan Agama Islam"; break;
							// case 7: echo "Konsentrasi Manajemen dan Kebijakan Pendidikan Islam"; break;
							// case 8: echo "Konsentrasi Pemikiran Pendidikan Islam"; break;
							// case 9: echo "Konsentrasi Pendidikan Bahasa Arab"; break;
							// case 10: echo "Konsentrasi Bimbingan dan Konseling Islam"; break;
							// case 11: echo "Konsentrasi Hukum Keluarga"; break;
							// case 12: echo "Konsentrasi Keuangan dan Perbankan Syariah"; break;
							// case 13: echo "Konsentrasi Studi Politik dan Pemerintahan dalam Islam"; break;
							// case 14: echo "Konsentrasi Hukum Bisnis Syariah"; break;
							// case 15: echo "Konsentrasi Pekerjaan Sosial"; break;
							// case 16: echo "Konsentrasi Ilmu Perpustakaan dan Informasi"; break;
							// case 17: echo "Konsentrasi Sains MI"; break;
							// case 18: echo "Konsentrasi Pendidikan Agama Islam MI"; break;
							// case 19: echo "Konsentrasi Pendidikan Guru Raudlatul Athfal"; break;
						// }
		 ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2"><div id="grs"></div></td>
				</tr>
				<tr>
					<td colspan="2"> Tanggal Ujian: <br><strong>
						<?php if($GELOMBANG==22){?>
							Rabu, 26 Agustus 2015
						<?php }else{?>
							Senin, 10 Agustus 2015
							<br>
							Selasa, 11 Agustus 2015
						<?php } ?>
					<?php 
						//echo tanggal_hari($jalur[0]->PMB_TANGGAL_AWAL_SELEKSI);
						
						//echo " <br /> ";
						//echo tanggal_hari($jalur[0]->PMB_TANGGAL_AKHIR_SELEKSI);
					?></strong>
					
					</td>
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
		<td align="center">Yogyakarta, <?php 
			$tgl=date("d");
			$bulan=date("m");
			if($bulan==05){
				$bulan="Mei";
			}elseif($bulan==06){
				$bulan="Juni";
			}elseif($bulan==07){
				$bulan="Juli";
			}elseif($bulan=='08'){
				$bulan="Agustus";
			}
			$tahun=date("Y");
			echo $tgl." ".$bulan." ".$tahun;
?>
		</td></tr>
		<tr><td></td><td></td><td align="center"><br><br><br><br></td></tr>
		<tr><td align="center">( _________________ )</td>
		<td></td>
		<td align="center"><br><br>( <?php echo $nama_peserta; ?> )</td></tr>
	</tbody></table>
    <br><br>
    Perlengkapan yang harus dibawa pada saat ujian:<br><br>
    <i>- KARTU PESERTA dan DATA PESERTA dari sistem PMB ini yang telah dicetak secara warna</i><br>
    <i>- Foto Copy sah Ijazah S1 dan Transkrip Nilai (rangkap dua)</i><br>
    <i>- Rekomendasi dari Dosen atau Guru besar &amp; atasan langsung bagi yang sudah bekerja</i><br>
    <i>- Statement of Purpose maksimal 500 kata</i><br>    <i>- Bukti pembayaran biaya pendaftaran</i><br>
    <i>- Semua berkas dimasukkan dalam map snelhecter warna biru</i><br><i>- Pensil 2B secukupnya, karet penghapus dan peraut pensil</i><br><br><i>Jadwal ujian:</i>
	<br><br>
	<table border="1" cellpadding="1" cellspacing="2" width="100%">
		<tbody>
			<tr>
				<td width="3"></td>
				<td width="110">Waktu</td>
				<td>Materi</td>
				<td align='center'>Peta UIN</td>
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><div id="grs"></div></td>
				
			</tr>
			<?php if( $GELOMBANG ==22){?>
			
			<tr>
				<td></td>
				<td colspan="2"><strong><?php //echo tanggal_hari($jalur[0]->PMB_TANGGAL_AWAL_SELEKSI); ?>Rabu, 26 Agustus 2015</strong></td>
				<td rowspan='7' align='center'><img src='http://uin-suka.ac.id/files/content_images/peta_uin_suka.jpg' width='210' /><br /><font size=1>Sumber : http://uin-suka.ac.id/index.php/page/universitas/27-peta-uin.html</font></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.30  -  08.45</td>
				<td>Verifikasi Data</td>
				
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.45  -  10.15</td>
				<td>Tes Potensi Akademk (TPA)</td>
				
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 10.15  -  10.30</td>
				<td>Istirahat</td>
				
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 10.30  -  12.00</td>
				<td>Bahasa Inggris</td>
				
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 12.00 - 12.45</td>
				<td>ISHOMA</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 12.45 - 14.15</td>
				<td>Bahasa Arab</td>
			</tr>
			
			<?php }else{?>
			<tr>
				<td></td>
				<td colspan="2"><strong><?php //echo tanggal_hari($jalur[0]->PMB_TANGGAL_AWAL_SELEKSI); ?>Senin, 10 Agustus 2015</strong></td>
				<td rowspan='7' align='center'><img src='http://uin-suka.ac.id/files/content_images/peta_uin_suka.jpg' width='210' /><br /><font size=1>Sumber : http://uin-suka.ac.id/index.php/page/universitas/27-peta-uin.html</font></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.30  -  08.45</td>
				<td>Verifikasi Data</td>
				
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.45  -  10.15</td>
				<td>Tes Potensi Akademk (TPA)</td>
				
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 10.15  -  10.45</td>
				<td>Istirahat</td>
				
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 10.45  -  12.15</td>
				<td>Bahasa Inggris</td>
				
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><strong><?php //echo tanggal_hari($jalur[0]->PMB_TANGGAL_AKHIR_SELEKSI); ?>Selasa, 11 Agustus 2015</strong></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.30 - 10.00</td>
				<td>Bahasa Arab</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>	
</div>
</div>

</body></html>