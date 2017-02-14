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
		<link href="<?php echo base_url('asset/style_album_ujian.css'); ?>" rel="stylesheet" type="text/css"/>
	</head>
<body id="print">
<div id="coverprint">
	<table  border="0"cellpadding="4" cellspacing="4" width="100%">
		<tbody>
		<tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
		  <tr><td><div align="center"><img src="<?php echo base_url('asset/img/logo-uinp.gif'); ?>"></div></td></tr>
		   <tr>
    <td>&nbsp;</td>
  </tr>
		  <tr><td align="center"><span class="big2">ALBUM BUKTI HADIR PESERTA UJIAN TULIS</span></td></tr>
		   <tr>
    <td>&nbsp;</td>
  </tr>
		  <tr><td align="center"><span class="big2">TAHUN 2014</span></td></tr>
		  <tr><td align="center"><span class="big1">UIN SUNAN KALIJAGA</span></td></tr>
		  <tr><td align="center"><span class="big1">YOGYAKARTA</span></td></tr>
		  <tr><td>&nbsp;</td></tr>
		  <tr><td>&nbsp;</td></tr>
		  <tr><td>&nbsp;</td></tr>
		  <tr>
			  <td align="center">
				<table class="sektorlokasiruang" align="center" border="0" cellpadding="0" cellspacing="0" width="90%">
					<tbody>
						<tr>
							<td align="center"><p class="big2">KODE RUANG : <?php echo $kondisi[6]; ?></p></td>
						</tr>
					</tbody>
				</table> &nbsp;
				  <br /><br />
				<table class="sektorlokasiruang" align="center" border="0" cellpadding="0" cellspacing="0" width="90%">
			  <tbody>
			  <tr>
				<td valign="top"><span class="big3">LOKASI </span></td>
				<td valign="top">:</td>
				<td><span class="big3"> &nbsp;<?php echo $kondisi[7]; ?></span></td>
			  </tr>
			  <tr>
				<td valign="top"><span class="big3">RUANG </span></td>
				<td valign="top">:</td>
				<td><span class="big3"> &nbsp;R. <?php echo $kondisi[6]; ?></span></td>
			  </tr>
			  <tr>
				<td valign="top"><span class="big3">ALAMAT</span></td>
				<td valign="top">:</td>
				<td><span class="big3"> &nbsp;JL. MARSDA ADI SUCIPTO, YOGYAKARTA 55281</span></td>
			  </tr>
			  <tr>
				<td valign="top"><span class="big3">KAPASITAS</span></td>
				<td valign="top">:</td>
				<td><span class="big3"> &nbsp;<?php echo $kondisi[2]; ?></span></td>
			  </tr>
			  <tr>
				<td valign="top"><span class="big3">JUMLAH PESERTA</span></td>
				<td valign="top">:</td>
				<td><span class="big3"> &nbsp;<?php echo $kondisi[3]; ?></span></td>
			  </tr>
			  <tr>
				<td valign="top"><span class="big3">NOMOR</span></td>
				<td valign="top">:</td>
						<td><span class="big3"> &nbsp;<?php echo $kondisi[4]; ?> s/d <?php echo $kondisi[5]; ?></span></td>
			  </tr>
			</tbody></table>
			  </td>
			  
		  </tr>
		    <tr><td>&nbsp;</td></tr>  <tr><td>&nbsp;</td></tr>
		</tbody>
	</table>
</div>
</body>
</html>