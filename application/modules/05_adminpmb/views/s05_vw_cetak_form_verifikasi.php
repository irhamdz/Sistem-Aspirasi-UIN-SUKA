<?php #print_r($cetak_verifikasi_ujian); 
$kondisi = explode("-",$this->security->xss_clean($this->uri->segment(3)));
#print_r($kondisi);
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
		<link href="<?php echo base_url('asset/cetak_form_verifikasi.css'); ?>" rel="stylesheet" type="text/css"/>
	</head>
<body id="print">
<br /><br />
<?php 
$n=0;
$dari=ceil(count($cetak_verifikasi_ujian)/10);
foreach($cetak_verifikasi_ujian as $value){ 
$no=$value->NO_-1;
if($no%10==0){
?>
<div id="headerprint">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr>
				<td width="100"><div align="center"><img src="<?php echo base_url('asset/img/logo-uinp.gif'); ?>" align="middle"></div></td>
				<td><table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
							<tr>
								<td colspan="3"><span class="headerjudul">FORM VERIFIKASI PESERTA UJIAN TULIS MAGISTER (S2) GELOMBANG II 2014</span><br>
												<span class="headerlabel">UIN SUNAN KALIJAGA YOGYAKARTA</span>
								</td>
							</tr>
							<tr>
								<td><span class="headerlabel"> LOKASI </span></td>
								<td>:</td>
								<td><span class="headercontent"><?php echo $kondisi[7]; ?></span></td>
							</tr>
							<tr>
								<td><span class="headerlabel">RUANG </span></td>
								<td>:</td>
								<td><span class="headercontent">R. <?php echo $kondisi[6]; ?></span></td>
							</tr>
							<tr>
								<td width="70"><span class="headerlabel">KAPASITAS </span></td>
								<td width="10">:</td>
								<td><span class="headercontent"><?php echo $kondisi[2]; ?></span></td>
							</tr>
						</tbody>
					</table>
				</td>
		  </tr>
		</tbody>
	</table>
</div>
<div class="tabstat">
	<table border="0" width="100%" cellspacing="0" id="jadw">
		<tbody>
			<tr>
				<td width="30" align="center">No</td>
				<td width="70" align="center">No PMB</td>
				<td align="center">Nama</td>
				<td width="100" align="center">Data Diri &amp;<br>Kartu Peserta</td>
				<td width="100" align="center">Ijazah /<br> SK Lulus</td>
				<td width="100" align="center">Transkrip<br>3(Alumni) &amp; 2.75(Bekerja)</td>
				<td width="100" align="center">Rekomendasi<br>2 Dosen/Atasan</td>
				<td width="100" align="center">Statement of<br>Purpose</td>
				<td width="100" align="center">Bukti<br>Pembayaran</td>
			</tr>
		</tbody>
	</table>
</div>
<?php } ?>
<div class="tabstat">
	<table border="0" width="100%" cellspacing="0" id="jadw">
		<tbody>
			<tr>
				<td width="30" align="center"><?php echo $value->NO_; ?></td>
				<td width="70" align="center"><?php echo $value->PMB_NO_UJIAN_PENDAFTAR; ?></td>
				<td align="center"></td>
				<td width="100" align="center"></td>
				<td width="100" align="center"></td>
				<td width="100" align="center"></td>
				<td width="100" align="center"></td>
				<td width="100" align="center"></td>
				<td width="100" align="center"></td>
			</tr>

		</tbody>
	</table>
</div>
 <?php
 if($no%10==9 or $no==(count($cetak_verifikasi_ujian)-1) ){
$n++;
?>
<div id="infohal"><i>Halaman <?php echo $n; ?> dari <?php echo $dari;?></i></div><br><br>	
	<table border="0" cellpadding="1" cellspacing="2" width="100%">
		<tbody><tr>
			<td width="170" align="center"></td>
			<td width="350"></td>
			<td align="center">Yogyakarta, 13-08-2014<br>Petugas Verifikasi</td></tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><br><br><br><br></td>
			</tr>
			<tr>
				<td align="center"></td>
				<td></td>
				<td align="center">( _________________ )</td>
			</tr>
		</tbody>
	</table>
	<hr />
<?php } 
} ?>
</body>
</html>