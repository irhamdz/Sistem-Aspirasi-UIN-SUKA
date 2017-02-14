<?php
#print_r($cetak_album_ujian);
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
		
		<link href="<?php echo base_url('asset/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css"/>
	</head>
<body id="print">
<div id="coverprint">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		  <tr><td><div align="center"><img src="<?php echo base_url('asset/img/logo-uinp.gif'); ?>"></div></td></tr>
		  <tr><td>&nbsp;</td></tr>
		  <tr><td align="center"><h2>ALBUM BUKTI HADIR PESERTA UJIAN TERTULIS JALUR REGULER</h2></td></tr>
		  <tr><td align="center">&nbsp;</td></tr>
		  <tr><td align="center"><h2>TAHUN 2014</h2></td></tr>
		  <tr><td align="center"><h1>UIN SUNAN KALIJAGA</h1></td></tr>
		  <tr><td align="center"><h1>YOGYAKARTA</h1></td></tr>
		  <tr><td>&nbsp;</td></tr>
		  <tr>
			  <td align="center">
				<table class="sektorlokasiruang" align="center" border="1" cellpadding="0" cellspacing="2" width="90%">
					<tbody>
						<tr>
							<td align="center"><h3>KODE RUANG : <?php echo $kondisi[6]; ?> </h3></td>
						</tr>
					</tbody>
				</table> &nbsp;
				<table class="sektorlokasiruang" align="center" border="1" cellpadding="0" cellspacing="2" width="90%">
			  <tbody>
			  <tr>
				<td valign="top"><span class="big3">LOKASI </span></td>
				<td valign="top">:</td>
				<td><span class="big3"><?php echo $kondisi[7]; ?></span></td>
			  </tr>
			  <tr>
				<td valign="top"><span class="big3">RUANG </span></td>
				<td valign="top">:</td>
				<td><span class="big3">R. <?php echo $kondisi[6]; ?></span></td>
			  </tr>
			  <tr>
				<td valign="top"><span class="big3">ALAMAT</span></td>
				<td valign="top">:</td>
				<td><span class="big3">JL. MARSDA ADI SUCIPTO, YOGYAKARTA 55281</span></td>
			  </tr>
			  <tr>
				<td valign="top"><span class="big3">KAPASITAS</span></td>
				<td valign="top">:</td>
				<td><span class="big3"><?php echo $kondisi[2]; ?></span></td>
			  </tr>
			  <tr>
				<td valign="top"><span class="big3">JUMLAH PESERTA</span></td>
				<td valign="top">:</td>
				<td><span class="big3"><?php echo $kondisi[3]; ?></span></td>
			  </tr>
			  <tr>
				<td valign="top"><span class="big3">NOMOR</span></td>
				<td valign="top">:</td>
						<td><span class="big3"><?php echo $kondisi[4]; ?> s/d <?php echo $kondisi[5]; ?></span></td>
			  </tr>
			</tbody></table>
			  </td>
			  
		  </tr>
		    <tr><td>&nbsp;</td></tr>  <tr><td>&nbsp;</td></tr>
		  <tr>
			<td>
			<?php foreach($cetak_album_ujian as $value){ ?>
			<table class="sektorlokasiruang" align="center" border="1" cellpadding="0" cellspacing="0" width="90%">
						<tr>
							<td align="center" height='200' width='130px'><img src="<?php echo base_url('img_pendaftar/s2/'.$value->PMB_FOTO_PENDAFTAR.''); ?>" width='100px'></td>
							
							<td align="left" width=65%>
								<table cellpadding="0" cellspacing="0">
									<tr>
										<td align="left"><font size='1px'>&nbsp;&nbsp;NOMOR URUT</font></td>
										<td align="center" width='30px'><font size='1px'>:</font></td>
										<td align="left"><font size='1px'><?php echo $value->NO_; ?></font></td>
									</tr>
									<tr>
										<td align="left"><font size='1px'>&nbsp;&nbsp;NOMOR PESERTA</td>
										<td align="center"><font size='1px'>:</font></td>
										<td align="left"><font size='1px'><?php echo $value->PMB_NO_UJIAN_PENDAFTAR; ?></font></td>
									</tr>
									<tr>
										<td align="left"><font size='1px'>&nbsp;&nbsp;NAMA PESERTA</font></td>
										<td align="center"><font size='1px'>:</font></td>
										<td align="left"><font size='1px'><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></font></td>
									</tr>
									<tr>
										<td align="left"><font size='1px'>&nbsp;&nbsp;NAMA PT</font></td>
										<td align="center"><font size='1px'>:</font></td>
										<td align="left"><font size='1px'><?php echo $value->PMB_NAMA_PERGURUAN_TINGGI; ?></font></td>
									</tr>
									<tr>
										<td align="left"><font size='1px'>&nbsp;&nbsp;TAHUN IJAZAH</td>
										<td align="center"><font size='1px'>:</td>
										<td align="left"><font size='1px'><?php echo $value->PMB_TAHUN_IJAZAH; ?></td>
									</tr>
									<tr>
										<td align="left"><font size='1px'>&nbsp;&nbsp;IPK</font></td>
										<td align="center"><font size='1px'>:</font></td>
										<td align="left"><font size='1px'><?php echo $value->PMB_IPK_CPASCA; ?></font></td>
									</tr>
								</table>
							
							</td>
							<td align="center">
								<table border=1>
									<tr>
										<td></td>
										<td><font size='1px'>09.00 - 11.30</font></td>
										<td><font size='1px'>12.30 - 14.30</font></td>
									</tr>
									<tr>
										<td height='50' ><font size='1px'>03/07</font></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td><font size='1px'>18.30 - 11.30</font></td>
										<td></td>
									</tr>
									<tr>
										<td height='50'><font size='1px'>04 / 07</font></td>
										<td></td>
										<td></td>
									</tr>
								</table>
							
							</td>
						</tr>
				</table>&nbsp; <?php } ?>
				</td>
		  </tr>
		</tbody>
	</table>
</div>
</body>
</html>