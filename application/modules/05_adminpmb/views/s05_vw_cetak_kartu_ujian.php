<?php
#print_r($cetak_kartu_ujian);
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
			UIN Sunan Kalijaga Yogyakarta</strong><br>
			Penerimaan Mahasiswa Baru Tahun Akademik 2014/2015<br>
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
						<td valign="top" rowspan="5"><div class="potiik"><img src="<?php echo base_url().'img_pendaftar/'.$jenis.'/'.$cetak_kartu_ujian[0]->PMB_FOTO_PENDAFTAR.''; ?>" width="95"></div></td>
					</tr>
					<tr>
						<td valign="top">Nama</td>
						<td>: <?php 
						$nama_peserta=$cetak_kartu_ujian[0]->PMB_NAMA_LENGKAP_PENDAFTAR;
						$nama_peserta=str_replace("#39;", "'", $nama_peserta);

						
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
					<?php $jalur=$cetak_kartu_ujian[0]->PMB_JALUR_PENDAFTARAN;
					switch($jalur){
						case 20 : echo "MAGISTER (S2) GELOMBANG I"; break;
						case 21 : echo "MAGISTER (S2) GELOMBANG II"; break;
					} ?></strong>
					
					<br><?php $jalur=$cetak_kartu_ujian[0]->PMB_KELAS_JURUSAN;
					switch($jalur){
						case 1 : echo "Reguler"; break;
						case 2 : echo "Non Reguler (Akhir Pekan)"; break;
					} ?></td>
				</tr>
				<tr>
					<td width="80"><strong>Pilihan I</strong></td><td></td>
				</tr>
				<tr>
					<td>Kode: <?php echo $cetak_kartu_ujian[0]->PMB_PILJUR_1; ?></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><?php   
						$pil_1=$cetak_kartu_ujian[0]->PMB_PILJUR_1;
						switch($pil_1){
							case 1: echo "Konsentrasi Filsafat Islam"; break;
							case 2: echo "Konsentrasi Studi al-Qur'an dan al-Hadis"; break;
							case 3: echo "Konsentrasi Studi Agama dan Resolusi Konflik"; break;
							case 4: echo "Konsentrasi Ilmu Bahasa Arab"; break;
							case 5: echo "Konsentrasi Sejarah Kebudayaan Islam"; break;
							case 6: echo "Konsentrasi Pendidikan Agama Islam"; break;
							case 7: echo "Konsentrasi Manajemen dan Kebijakan Pendidikan Islam"; break;
							case 8: echo "Konsentrasi Pemikiran Pendidikan Islam"; break;
							case 9: echo "Konsentrasi Pendidikan Bahasa Arab"; break;
							case 10: echo "Konsentrasi Bimbingan dan Konseling Islam"; break;
							case 11: echo "Konsentrasi Hukum Keluarga"; break;
							case 12: echo "Konsentrasi Keuangan dan Perbankan Syariah"; break;
							case 13: echo "Konsentrasi Studi Politik dan Pemerintahan dalam Islam"; break;
							case 14: echo "Konsentrasi Hukum Bisnis Syariah"; break;
							case 15: echo "Konsentrasi Pekerjaan Sosial"; break;
							case 16: echo "Konsentrasi Ilmu Perpustakaan dan Informasi"; break;
							case 17: echo "Konsentrasi Sains MI"; break;
							case 18: echo "Konsentrasi Pendidikan Agama Islam MI"; break;
							case 19: echo "Konsentrasi Pendidikan Guru Raudlatul Athfal"; break;
						}
		 ?></td>
				</tr>
				<tr>
					<td><strong>Pilihan II</strong></td>
					<td></td>
				</tr>
				<tr>
					<td>Kode: <?php echo $cetak_kartu_ujian[0]->PMB_PILJUR_2; ?></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><?php   $pil_2=$cetak_kartu_ujian[0]->PMB_PILJUR_2;
						switch($pil_2){
							case 1: echo "Konsentrasi Filsafat Islam"; break;
							case 2: echo "Konsentrasi Studi al-Qur'an dan al-Hadis"; break;
							case 3: echo "Konsentrasi Studi Agama dan Resolusi Konflik"; break;
							case 4: echo "Konsentrasi Ilmu Bahasa Arab"; break;
							case 5: echo "Konsentrasi Sejarah Kebudayaan Islam"; break;
							case 6: echo "Konsentrasi Pendidikan Agama Islam"; break;
							case 7: echo "Konsentrasi Manajemen dan Kebijakan Pendidikan Islam"; break;
							case 8: echo "Konsentrasi Pemikiran Pendidikan Islam"; break;
							case 9: echo "Konsentrasi Pendidikan Bahasa Arab"; break;
							case 10: echo "Konsentrasi Bimbingan dan Konseling Islam"; break;
							case 11: echo "Konsentrasi Hukum Keluarga"; break;
							case 12: echo "Konsentrasi Keuangan dan Perbankan Syariah"; break;
							case 13: echo "Konsentrasi Studi Politik dan Pemerintahan dalam Islam"; break;
							case 14: echo "Konsentrasi Hukum Bisnis Syariah"; break;
							case 15: echo "Konsentrasi Pekerjaan Sosial"; break;
							case 16: echo "Konsentrasi Ilmu Perpustakaan dan Informasi"; break;
							case 17: echo "Konsentrasi Sains MI"; break;
							case 18: echo "Konsentrasi Pendidikan Agama Islam MI"; break;
							case 19: echo "Konsentrasi Pendidikan Guru Raudlatul Athfal"; break;
						}
		 ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2"><div id="grs"></div></td>
				</tr>
				<tr>
					<td colspan="2"> Tanggal Ujian: <br><strong>18 - 19 Juni 2014</strong></td>
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
			<tr>
				<td></td>
				<td colspan="2"><strong>Rabu, 13 Agustus 2014</strong></td>
				<td rowspan='7' align='center'><img src='http://uin-suka.ac.id/files/content_images/peta_uin_suka.jpg' width='210' /><br /><font size=1>Sumber : http://uin-suka.ac.id/index.php/page/universitas/27-peta-uin.html</font></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.30  -  08.45</td>
				<td>Verifikasi Data</td>
				
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.45  -  10.30</td>
				<td>Tes Potensi Akademk (TPA)</td>
				
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 10.30  -  11.00</td>
				<td>Istirahat</td>
				
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 11.00  -  12.30</td>
				<td>Bahasa Inggris</td>
				
			</tr>
			<tr>
				<td></td>
				<td colspan="3"><strong>Kamis, 14 Agustus 2014</strong></td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp; 08.30 - 10.00</td>
				<td>Bahasa Arab</td>
			</tr>
		</tbody>
	</table>	
</div>
</div>

</body></html>