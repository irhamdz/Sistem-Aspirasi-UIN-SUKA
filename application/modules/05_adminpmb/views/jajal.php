<link href="<?php echo base_url('asset/style_album_ujian_1.css'); ?>" rel="stylesheet" type="text/css"/>
<?php $kondisi = explode("-",$this->security->xss_clean($this->uri->segment(3))); ?>
<?php 
$n=0;
$n_c=0;
if(count($cetak_album_ujian)>=20){
	$kapasitas=20;
	
}else{ $kapasitas=count($cetak_album_ujian); }
$dari=ceil(count($cetak_album_ujian)/5);
$dari_c=ceil(count($cetak_album_ujian)/20);
foreach($cetak_album_ujian as $value){ 
$no=$value->NO_-1;
if($no%20==0){
$n_c++;
?>
<div id="coverprint">
	<table cellpadding="4" cellspacing="4" width="100%">
		<tbody>
		  <tr><td><div align="center"><img src="<?php echo base_url('asset/logo.jpg'); ?>" width="40"></div></td></tr>
		   <tr>
    <td>&nbsp;</td>
  </tr>
		  <tr><td align="center"><span class="big2"><h1>ALBUM BUKTI HADIR PESERTA UJIAN TULIS</h1></span></td></tr>
		  <tr><td align="center"><h3>TAHUN 2014</h3></td></tr>
		  <tr><td align="center"><h3>UIN SUNAN KALIJAGA</h3></td></tr>
		  <tr><td align="center"><h2>YOGYAKARTA</h2></td></tr>
		  <tr><td>&nbsp;</td></tr>
		  <tr>
			  <td align="center">
				<table class="tabelpesertaborder_cover" align="center" border="0" cellpadding="2" cellspacing="0" width="220px">
					<tbody>
						<tr>
							<td align="center"><h2>KODE RUANG : <?php echo strtoupper($kondisi[6]); ?></h2></td>
						</tr>
					</tbody>
				</table> &nbsp;
				  <br /><br />
				<table class="tabelpesertaborder_cover" border="0" cellpadding="1" cellspacing="0" width="464px">
			  <tbody>
			  <tr align="left">
				<td width="60px"><h3>LOKASI</h3></td>
				<td width="5px">:</td>
				<td><h3><?php echo $kondisi[7]; ?></h3></td>
			  </tr>
			  <tr  align="left">
				<td valign="top"><h3>RUANG </h3></td>
				<td valign="top">:</td>
				<td><h3><?php echo strtoupper($kondisi[6]); ?></h3></td>
			  </tr>
			  <tr  align="left">
				<td valign="top"><h3>ALAMAT</h3></td>
				<td valign="top">:</td>
				<td><h3>JL. MARSDA ADI SUCIPTO, YOGYAKARTA 55281</h3></td>
			  </tr >
			  <tr  align="left">
				<td valign="top"><h3>ALBUM</h3></td>
				<td valign="top">:</td>
				<td><h3><?php echo $n_c."/".$dari_c; ?></h3></td>
			  </tr>
			  <tr  align="left">
				<td valign="top"><h3>NOMOR</h3></td>
				<td valign="top">:</td>
				<td><h3><?php echo $value->PMB_NO_UJIAN_PENDAFTAR; ?> s/d <?php echo $value->PMB_NO_UJIAN_PENDAFTAR+$kapasitas-1; ?></h3></td>
			  </tr>
			  <tr  align="left">
				<td valign="top"><h3>JUMLAH PESERTA</h3></td>
				<td valign="top">:</td>
						<td><h3><?php echo $kapasitas; ?></h3></td>
			  </tr>
			</tbody></table>
			  </td>
			  
		  </tr>
		    <tr><td>&nbsp;</td></tr>  <tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr> 
		</tbody>
	</table>
</div>
<?php
}
if($no%5==0){
?>
<table class="tabelpesertaborder" border="0" cellpadding="2" cellspacing="0" width="420px">
<tbody>
  <tr>
    <td width="30" height="30" align="center">&nbsp; <img src="<?php echo base_url('asset/img/logo-uinp.gif'); ?>" width="20px"></td>
    <td>
	<table>
      <tbody>
		<tr>
			<td colspan="3"><strong>ALBUM BUKTI HADIR PESERTA UJIAN TULIS 2014<br /></strong></td>
        </tr>
		<tr>
			<td width="20">SEKTOR</td>
			<td width="3">:</td>
			<td width="80">UIN SUNAN KALIJAGA YOGYAKARTA</td>
        </tr>
		<tr>
			<td>LOKASI</td>
			<td>:</td>
			<td><?php echo $kondisi[7]; ?></td>
        </tr>
		<tr>
			<td>RUANG</td>
			<td>:</td>
			<td>R. <?php echo $kondisi[6]; ?></td>
        </tr>
    </tbody>
	</table>
	</td>
  </tr>
</tbody></table>
<?php
}
?>


<table class="tabelpesertaborder" border="0" cellpadding="2" cellspacing="0" width="300px">
      <tbody>
		<tr>
			<td style="height:60px !important;" width="40" border="0"><img src="<?php echo base_url('img_pendaftar/s2/'.$value->PMB_FOTO_PENDAFTAR.''); ?>" width="40" border"0"></td>
			<td width="130px"><br /><br />
				<table>
				   <tr>
                <td width="40">NAMA URUT</td>
                <td width="5">:</td>
                <td width="80" align="left"><?php echo $value->NO_; ?></td>
              </tr>
				   <tr>
                <td>NOMOR PESERTA</td>
                <td>:</td>
                <td><?php echo $value->PMB_NO_UJIAN_PENDAFTAR; ?></td>
              </tr>
				<tr>
					<td >NAMA PESERTA</td>
					<td >:</td>
					<td><?php 
					$nama_peserta=str_replace("#39;", "'", $value->PMB_NAMA_LENGKAP_PENDAFTAR);
					echo $nama_peserta; ?></td>
				</tr>
				<tr>
                <td >NAMA PT</td>
                <td >:</td>
                <td ><?php echo $value->PMB_NAMA_PERGURUAN_TINGGI; ?></td>
              </tr>
              <tr>
                <td >TAHUN IJAZAH</td>
                <td >:</td>
                <td ><?php echo $value->PMB_TAHUN_IJAZAH; ?></td>
              </tr>
				</table>
			</td>
			<td width="70">
                        <table class="tabelpesertaborder"  border="0" cellpadding="2" cellspacing="0">
						<tbody>
							<tr>
								<td align="center" width="32">TANDA TANGAN<br /><br /><br /><br /><br /><br />SESI 1</td>
								<td align="center"  width="32">TANDA TANGAN<br /><br /><br /><br /><br /><br />SESI 2</td>
							</tr>
							<tr>
								<td align="center">TANDA TANGAN<br /><br /><br /><br /><br /><br />SESI 3</td>
								<td align="center">TANDA TANGAN<br /><br /><br /><br /><br /><br />SESI 4</td>
							</tr>
						</tbody>
						</table>
            
			</td>
		</tr>
   </tbody>
 </table>
 <?php
 if($no%5==4 or $no==(count($cetak_album_ujian)-1) ){
$n++;
?>
<br /><br />
 <table class="none" cellpadding="2" cellspacing="0" width="240px">
 <tr><td align="right"><i>Halaman <?php echo $n; ?> dari <?php echo $dari;?></i></td></tr></table>
  <br />
 <br />
 <br />
 <?php } 
 
 if($no%20==0){
	$kapasitas=0;
 }
 $kapasitas++;
 
 }?>