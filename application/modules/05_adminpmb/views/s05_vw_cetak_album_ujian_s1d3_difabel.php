<link href="<?php echo base_url('asset/style_album_ujian_1.css'); ?>" rel="stylesheet" type="text/css"/>
<?php $kondisi = explode("-",$this->security->xss_clean($this->uri->segment(3))); ?>

<?php 
$n=0;
$dari=ceil(count($cetak_album_ujian)/5);
foreach($cetak_album_ujian as $value){ 
$no=$value->NO_-1;

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
			<td colspan="3"><strong>ALBUM BUKTI HADIR PESERTA DIFABEL UJIAN TULIS 2014<br /></strong></td>
        </tr>
		<tr>
			<td width="20">SEKTOR</td>
			<td width="3">:</td>
			<td width="80">UIN SUNAN KALIJAGA YOGYAKARTA</td>
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
			<td style="height:60px !important;" width="40" border="0"><img src="<?php echo base_url('img_pendaftar/pmb/'.$value->PMB_FOTO_PENDAFTAR.''); ?>" width="40" border"0"></td>
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
					// $nama_peserta=str_replace("#39;", "'", $value->PMB_NAMA_LENGKAP_PENDAFTAR);
					$nama_peserta=$value->PMB_NAMA_LENGKAP_PENDAFTAR;
					echo $nama_peserta; ?></td>
				</tr>
				 <tr>
                <td>NO. TELP</td>
                <td>:</td>
                <td><?php echo $value->PMB_TELP_PENDAFTAR; ?></td>
              </tr>
				<tr>
                <td >KEBUTUHAN KHUSUS</td>
                <td >:</td>
                <td ><?php 
							$sakit_saya=explode(" ",$value->PMB_ID_JENIS_KESEHATAN);
							for($a=0; $a<count($sakit_saya); $a++){ 
							if($sakit_saya[$a]==1){
								echo 'Normal<br />';
							}elseif($sakit_saya[$a]==2){
								echo 'Tuna Daksa<br />';
							}elseif($sakit_saya[$a]==3){
								echo 'Tuna Netra<br />';
							}elseif($sakit_saya[$a]==4){
								echo 'Tuna Rungu<br />';
							}elseif($sakit_saya[$a]==5){
								echo 'Tuna Wicara<br />';
							}elseif($sakit_saya[$a]==6){
								echo 'Buta Warna Parsial<br />';
							}elseif($sakit_saya[$a]==7){
								echo 'Buta Warna Total<br />';
							}
							}
						?></td>
              </tr>
              <tr>
                <td >ASAL SEKOLAH</td>
                <td >:</td>
                <td ><?php
					$kode_sekolah=substr($value->NAMA_SEKOLAH, 4,4);
					$sekolah_lain=str_replace("#39;", "'", $value->PMB_SEKOLAH_LAIN);
					$nama_sekolah=str_replace("#39;", "'", $value->NAMA_SEKOLAH);
					if($kode_sekolah==9999){
						echo $sekolah_lain;
					}else{
						if($nama_sekolah=='SMTA LAIN-LAIN,'){
							echo $sekolah_lain;
						}else{
							echo $nama_sekolah;
						}
					}
					
				 ?></td>
              </tr>
			  <tr>
                <td>GEDUNG</td>
                <td >:</td>
                <td ><?php echo $value->PMB_NAMA_GEDUNG; ?></td>
              </tr>
			  <tr>
                <td >RUANG</td>
                <td >:</td>
                <td ><?php echo $value->PMB_NAMA_RUANG; ?></td>
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
 
}?>