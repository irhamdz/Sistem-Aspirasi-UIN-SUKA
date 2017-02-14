<?php
// print_r($cetak_biodata); die();
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
			<?php echo $this->config->item('app_owner_s'); ?></strong><br>
			<?php echo $this->config->item('app_name'); ?> Tahun Akademik 2015/2016<br>
			<sup><em>Jl. Marsda Adisucipto, Yogyakarta 55281 Telp. 0274 519709 email: admisi@uin-suka.ac.id</em></sup>
		</div>
	</div>
	<div id="midhead">
			<table border="0" width="100%">
				<tbody>
					<tr>
						<td colspan="2"><strong>Data Peserta</strong><div id="grs"></div></td>
					</tr>			
					<tr>
						<td width="120">Nomor PMB</td>
						<td width="180">: <strong><?php echo $cetak_biodata[0]->PMB_NO_UJIAN_PENDAFTAR; ?></strong></td>
					</tr>
					<tr>
						<td valign="top">Nama</td>
						<td>: <?php 
						$nama_peserta=$cetak_biodata[0]->PMB_NAMA_LENGKAP_PENDAFTAR;
						//$nama_peserta=str_replace("#39;", "'", $nama_peserta);

						echo $nama_peserta;
						 ?></td>
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
						<td valign="top">Sekolah</td>
						<td>: <?php 
							$nama_sekolah = $pendidikan_s1d3[0]->PMB_SEKOLAH_LAIN;
							echo $nama_sekolah;
			
					?></td>
					</tr>
					<tr>
						<td valign="top">Jurusan</td>
						<td>: <?php $jur=$cetak_biodata[0]->PMB_JURUSAN_SEKOLAH; 
								foreach($jurusan_sekolah as $value){
									if($jur==$value->PMB_ID_JURUSAN_SEKOLAH){
										// echo 
										$nama=$value->PMB_NAMA_JURUSAN_SEKOLAH;
									}else{
										$nama=$jur;
										
									}
						}
						echo $nama;
						// print_r($jurusan_sekolah);
						
						?></td>
					</tr>
					<tr>
						<td>Kesehatan</td>
						<td>: <?php 
							$sakit_saya=explode(" ",$cetak_biodata[0]->PMB_ID_JENIS_KESEHATAN);
							for($a=0; $a<count($sakit_saya); $a++){ 
							if($sakit_saya[$a]==1){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Normal<br />';
							}elseif($sakit_saya[$a]==2){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Daksa<br />';
							}elseif($sakit_saya[$a]==3){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Netra<br />';
							}elseif($sakit_saya[$a]==4){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Rungu<br />';
							}elseif($sakit_saya[$a]==5){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Wicara<br />';
							}elseif($sakit_saya[$a]==6){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Buta Warna Parsial<br />';
							}elseif($sakit_saya[$a]==7){
								echo '<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Buta Warna Total<br />';
							}
							} ?></td>
					</tr>
					<tr>
						<td colspan=2><br><strong>Data Orang Tua</strong><div id='grs'></div></td>
					</tr>			
					<tr>
						<td valign="top">Nama Ibu</td>
						<td>: <?php echo $cetak_biodata[0]->PMB_NAMA_LENGKAP_IBU; ?></td>
					</tr>
					<tr>
						<td valign="top">Nama Ayah</td>
						<td>: <?php echo $cetak_biodata[0]->PMB_NAMA_LENGKAP_AYAH; ?></td>
					</tr>
					<tr>
						<td valign='top'>Alamat Orang Tua</td>
						<td>: <?php echo $cetak_biodata[0]->PMB_ALAMAT_LENGKAP_AYAH; ?></td>
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