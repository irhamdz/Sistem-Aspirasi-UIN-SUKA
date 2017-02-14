<?php
#print_r($cetak_kartu_ujian);
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
			UIN Sunan Kalijaga Yogyakarta</strong><br>
			Penerimaan Mahasiswa Baru Tahun Akademik 2015/2016<br>
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
						<td valign="top" rowspan="5"><div class="potiik"><img src="<?php echo base_url().'img_pendaftar/'.$jenis.'/'.$cetak_kartu_ujian[0]->PMB_TAHUN_PENDAFTARAN.'/'.$cetak_kartu_ujian[0]->PMB_JALUR_PENDAFTARAN.'/'.$cetak_kartu_ujian[0]->PMB_FOTO_PENDAFTAR.''; ?>" width="95"></div></td>
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
					<?php echo $jalur[0]->PMB_NAMA_JALUR_MASUK; ?></strong>
				</td>
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
							foreach($master_prodi as $value){ 
								if($value->PMB_ID_PRODI==$pil_1){
									echo "".$value->PMB_NAMA_PRODI."";
								}
							}
		 ?></td>
				</tr>
		<?php /* if($jalur==40){ ?>
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
							case 60: echo "Studi Islam"; break;
							case 61: echo "Ekonomi Islam"; break;
							case 62: echo "Sejarah Kebudayaan Islam"; break;
							case 63: echo "Kependidikan Islam"; break;
							case 64: echo "Ilmu Hukum dan Pranata Sosial Islam"; break;
							case 65: echo "Studi Politik dan Pemerintahan dalam Islam"; break;
						}
		 ?></td>
				</tr>
		<?php } */ ?>
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
					<td colspan="2"> Tanggal Ujian: <br><strong><?php 
						// echo $jalur[0]->PMB_TANGGAL_AWAL_SELEKSI;
						echo tanggal_hari($jalur[0]->PMB_TANGGAL_AWAL_SELEKSI);
						echo " <br /> ";
						if($jalur[0]->PMB_TANGGAL_AWAL_SELEKSI==$jalur[0]->PMB_TANGGAL_AKHIR_SELEKSI){
							
						}else{
							echo tanggal_hari($jalur[0]->PMB_TANGGAL_AKHIR_SELEKSI);
						}
					?></strong></td>
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
			if($bulan=='05'){
				$bulan="Mei";
			}elseif($bulan=='06'){
				$bulan="Juni";
			}elseif($bulan=='07'){
				$bulan="Juli";
			}elseif($bulan=='08'){
				$bulan="Agustus";
			}elseif($bulan=='09'){
				$bulan="September";
			}elseif($bulan==10){
				$bulan="Oktober";
			}elseif($bulan==11){
				$bulan="November";
			}elseif($bulan==12){
				$bulan="Desember";
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
<i>- Foto Copy sah Ijazah S2 dan Transkrip Nilai (rangkap dua)</i><br>
<i>- Rekomendasi dari Dosen atau Guru besar & atasan langsung bagi yang sudah bekerja</i><br>
<i>- <?php //Statement of Purpose maksimal 500 kata ?>Proposal Disertasi (1 Exs)</i><br>
<i>- Keterangan kemampuan berbahasa Inggris ditunjukkan dengan nilai TOEFL minimal 425</i><br>
<i>- Bukti pembayaran biaya pendaftaran</i><br>
<i>- Semua berkas dimasukkan dalam map snelhecter warna merah</i><br>
  <br><br><i>Jadwal ujian:</i>
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
				<td colspan="2"><strong><?php echo tanggal_hari($jalur[0]->PMB_TANGGAL_AWAL_SELEKSI); ?></strong></td>
				<td rowspan='7' align='center'><img src='http://uin-suka.ac.id/files/content_images/peta_uin_suka.jpg' width='210' /><br /><font size=1>Sumber : http://uin-suka.ac.id/index.php/page/universitas/27-peta-uin.html</font></td>
			</tr>
			<tr>
				<td></td>
				<td colspan=2>Presentasi Proposal</td>
				<td></td>
				
			</tr>
			<?php if($jalur[0]->PMB_TANGGAL_AWAL_SELEKSI!=$jalur[0]->PMB_TANGGAL_AKHIR_SELEKSI){ ?>
			<tr>
				<td></td>
				<td colspan="3"><strong><?php echo tanggal_hari($jalur[0]->PMB_TANGGAL_AKHIR_SELEKSI); ?></strong></td>
			</tr>
			<tr>
				<td></td>
				<td colspan=2>Presentasi Proposal</td>
				<td></td>
			</tr>
			<?php } ?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				
			</tr>
			<tr>
				<td></td>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>	
</div>
</div>

</body></html>