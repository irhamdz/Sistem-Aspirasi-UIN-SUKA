<?php $kondisi = explode("-",$this->security->xss_clean($this->uri->segment(3))); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
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
<table border="0" cellpadding="4" cellspacing="4" width="100%">
  <tbody><tr>
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
  <tr>
    <td><div align="center"><img src="<?php echo base_url('asset/img/logo-uinp.gif'); ?>"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><span class="big2">ALBUM BUKTI HADIR PESERTA UJIAN TULIS</span></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><span class="big2">UIN SUNAN KALIJAGA</span></td>
  </tr>
  <tr>
    <td align="center"><span class="big1">YOGYAKARTA</span></td>
  </tr>
  <tr>
    <td align="center"><span class="big1">2014</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
	  <td align="center">
      <table class="sektorlokasiruang" align="center" border="0" cellpadding="0" cellspacing="2" width="90%">
      <tbody><tr>
      <td align="center"><p class="big2">KODE RUANG : <?php echo $kondisi[6]; ?> 	  </p>
      </td>
      </tr>
      </tbody></table>
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table class="sektorlokasiruang" align="center" border="0" cellpadding="0" cellspacing="2" width="90%">
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
        <td><span class="big3"><span class="big3"><?php echo $kondisi[3]; ?></span></td>
      </tr>
      <tr>
        <td valign="top"><span class="big3">NOMOR</span></td>
        <td valign="top">:</td>
                <td><span class="big3"><?php echo $kondisi[4]; ?> s/d <?php echo $kondisi[5]; ?></span></td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>
</div>
<hr>
<?php foreach($cetak_album_ujian as $value){ 
$no=$value->NO_-1;
if($no%5==0){
?>
<div id="headerprint">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
  <tr>
    <td width="100"><div align="center"><img src="<?php echo base_url('asset/img/logo-uinp.gif'); ?>"></div></td>
    <td>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody>
		<tr>
			<td colspan="3"><span class="headerjudul">ALBUM BUKTI HADIR PESERTA UJIAN TERTULIS</span></td>
        </tr>
		<tr>
			<td width=70px><span class="headerlabel"> SEKTOR </span></td>
			<td width=10px>:</td>
			<td><span class="headercontent">UIN SUNAN KALIJAGA YOGYAKARTA</span></td>
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
    </tbody>
	</table>
	</td>
  </tr>
</tbody></table>
</div>
<?php
}
?>
<table class="tabelpesertaborder" border="0" cellpadding="2" cellspacing="2" width="100%">
      <tbody><tr>
        <td width="100"><img src="<?php echo base_url('img_pendaftar/s2/'.$value->PMB_FOTO_PENDAFTAR.''); ?>" width="100">
        <!-- <img src="images/pasfoto_siluet.jpg" width="100" /> --></td>
        <td class="tabelpesertabg"><table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody><tr>
            <td><table border="0" cellpadding="1" cellspacing="0" width="100%">
              <tbody><tr>
                <td valign="top" width="115"><strong>NOMOR URUT</strong></td>
                <td valign="top">:</td>
                <td valign="top"><strong><?php echo $value->NO_; ?></strong></td>
              </tr>
              <tr>
                <td valign="top" width="110"><strong>NOMOR PESERTA</strong></td>
                <td valign="top" width="2">:</td>
                <td valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody><tr>
                      <td><strong><?php echo $value->PMB_NO_UJIAN_PENDAFTAR; ?></strong></td>
                    </tr>
                  </tbody></table></td>
              </tr>
              <tr>
                <td valign="top"><strong>NAMA PESERTA</strong></td>
                <td valign="top">:</td>
                <td valign="top"><strong><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></strong></td>
              </tr>
             <!-- 
              <tr>
                <td><strong>NOMOR IDENTITAS</strong></td>
                <td>:</td>
                <td><strong>
                                  </strong></td>
              </tr> 
              -->
              <tr>
                <td valign="top"><strong>NAMA PT</strong></td>
                <td valign="top">:</td>
                <td valign="top"><strong><?php echo $value->PMB_NAMA_PERGURUAN_TINGGI; ?></strong></td>
              </tr>
              <tr>
                <td valign="top"><strong>TAHUN IJAZAH</strong></td>
                <td valign="top">:</td>
                <td valign="top"><strong><?php echo $value->PMB_TAHUN_IJAZAH; ?></strong></td>
              </tr>
            </tbody></table></td>
            <td width="250">
                        <table class="tabelttd" border="1" cellpadding="0" cellspacing="1" width="100%">
              <tbody><tr>
                <td class="ttd">TANDA TANGAN<br>
                SESI 1</td>
                <td class="ttd">TANDA TANGAN<br>
                  SESI 2</td>
              </tr>
			  <tr>
                <td class="ttd">TANDA TANGAN<br>
                SESI 3</td>
                <td class="ttd">TANDA TANGAN<br>
                  SESI 4</td>
              </tr>
            </tbody></table>
                                                </td>
          </tr>
        </tbody></table></td>
      </tr>
    </tbody></table>
 <?php } ?>
 <?php /*   <div id="infohal"><em>Halaman 12 dari 12 halaman</em></div> */ ?>
<hr>
	    


</body></html>