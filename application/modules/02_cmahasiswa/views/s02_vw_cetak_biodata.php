<?php
#print_r($cetak_biodata);
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
			<table border="0" width="100%">
				<tbody>
					<tr>
						<td colspan="2"><strong>Data Peserta</strong><div id="grs"></div></td>
					</tr>			
					<tr>
						<td width="80">Nomor PMB</td>
						<td width="230">: <strong><?php echo $cetak_biodata[0]->PMB_NO_UJIAN_PENDAFTAR; ?></strong></td>
					</tr>
					<tr>
						<td valign="top">Nama</td>
						<td>: <?php
						$nama_peserta=$cetak_biodata[0]->PMB_NAMA_LENGKAP_PENDAFTAR;
						//$nama_peserta=str_replace("#39;", "'", $nama_peserta);

						echo $nama_peserta; ?></td>
					</tr>
					<tr>
						<td>Tempat, Tgl. Lahir</td>
						<td>: <?php echo $cetak_biodata[0]->PMB_TEMPAT_LAHIR_PENDAFTAR; ?>, <?php echo $cetak_biodata[0]->PMB_TGL_LAHIR_PENDAFTAR; ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>: <?php echo $cetak_biodata[0]->PMB_ALAMAT_LENGKAP_PENDAFTAR; ?></td>
					</tr>
					<tr>
						<td>No. Telp. / HP</td>
						<td>: <?php echo $cetak_biodata[0]->PMB_TELP_PENDAFTAR; ?></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: <?php
								#echo $cetak_biodata[0]->PMB_JENIS_KELAMIN_PENDAFTAR;
								$jk=$cetak_biodata[0]->PMB_JENIS_KELAMIN_PENDAFTAR;
								switch($jk){
								case 0: echo "Laki - Laki"; break;
								case 1: echo "Perempuan"; break;
								}
							?>
						</td>
					</tr>
					<tr>
						<td>Warga Negara</td>
						<td>: <?php 
								$negara=$cetak_biodata[0]->PMB_WARGA_NEGARA_PENDAFTAR;
								switch($negara){
									case 0: echo "Warga Negara Indonesia"; break;
									case 1: echo "Warga Negara Asing"; break;
								} ?>
						</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
						</tr>
					<tr>
						<td>Lulusan Dari</td>
						<td>: <?php 
								$lulusan=$cetak_biodata[0]->PMB_LULUSAN_DARI;
								switch($lulusan){
									case 1: echo "UIN"; break;
									case 2: echo "IAIN"; break;
									case 3: echo "STAIN"; break;
									case 4: echo "PTAIS"; break;
									case 5: echo "PTN"; break;
									case 6: echo "PTS"; break;
									case 7: echo "PT LUAR NEGERI"; break;
									default: echo $cetak_biodata[0]->PMB_LULUSAN_DARI; break;
								}?>
						</td>
					</tr>
					<tr>
						<td>Nama Perguruan Tinggi</td>
						<td>: <?php echo $cetak_biodata[0]->PMB_NAMA_PERGURUAN_TINGGI; ?></td>
					</tr>
					<tr>
						<td>Tahun Ijazah</td>
						<td>: <?php echo $cetak_biodata[0]->PMB_TAHUN_IJAZAH; ?></td>
					</tr>
					<tr>
						<td>IPK</td>
						<td>: <?php echo $cetak_biodata[0]->PMB_IPK_CPASCA; ?></td>
					</tr>
					<tr>
						<td>Status Pekerjaan</td>
						<td>: <?php 
								$status_pekerjaan=$cetak_biodata[0]->PMB_STATUS_PEKERJAAN;
								switch($status_pekerjaan){
									case 1: echo "Dosen / Guru / Pengajar"; break;
									case 2: echo "Karyawan"; break;
									case 3: echo "Belum Bekerja / Alumni"; break;
									default: echo $cetak_biodata[0]->PMB_STATUS_PEKERJAAN; break;
								}?>
						</td>
					</tr>
					<tr>
						<td>Alamat Kantor</td>
						<td>: <?php echo $cetak_biodata[0]->PMB_ALAMAT_KANTOR; ?></td>
					</tr>
					<tr>
						<td>No. Telpon / Fax Kantor</td>
						<td>: <?php echo $cetak_biodata[0]->PMB_TELP_FAX_KANTOR; ?></td>
					</tr>
					<tr>
						<td>Rencana Biaya Studi</td>
						<td>: <?php 
						$rencana_biaya=$cetak_biodata[0]->PMB_RENCANA_BIAYA_STUDI;
						switch($rencana_biaya){
							case 1: echo "Ditanggung Sendiri"; break;
							case 2: echo "Beasiswa Instansi Tempat Bekerja"; break;
							case 3: echo "Beasiswa Yayasan"; break;
							case 4: echo "Beasiswa Kemenag"; break;
							default: echo $cetak_biodata[0]->PMB_RENCANA_BIAYA_STUDI; break;
						}?></td>
					</tr>
				</tbody>
			</table>
	</div>
	<div class="rbroundbox">
		<br><br>
	<table border="0" cellpadding="1" cellspacing="2" width="100%">
	<tbody><tr>
		</tr><tr><td align="left" colspan="3">Saya menyatakan bahwa data tersebut adalah BENAR.</td></tr>
		<tr><td width="170" align="center"></td>
		<td width="200"></td>
		<td align="center">Yogyakarta, <?php 
			$tgl=date("d");
			$bulan=date("m");
			if($bulan==05){
				$bulan="Mei";
			}
			$tahun=date("Y");
			echo $tgl." ".$bulan." ".$tahun; ?></td></tr>
		<tr><td></td><td></td><td align="center"><br><br><br><br></td></tr>
		<tr><td align="center"></td>
		<td></td>
		<td align="center"><br><br>( <?php echo $nama_peserta; ?> )</td></tr>
	</tbody></table>
	</div>

</body></html>