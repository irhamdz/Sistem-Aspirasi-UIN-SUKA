<?php


 //print_r($jalur); die();
// echo $jalur[0]->PMB_TANGGAL_AWAL_SELEKSI; die();
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
function tanggal($tanggal){
	$tgl=explode("-",$tanggal);
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
	$tampil_tanggal=$tgl[0]." ".$bulan." ".$tgl[2];
	return $tampil_tanggal;
}
?>

<?php

	if(!is_null($data_diri))
	{
		foreach ($data_diri as $diri);
		
	}

	if(!is_null($ruang))
	{
		foreach ($ruang as $druang);
	}

	if(!is_null($pend))
	{
		foreach ($pend as $pd);		
	}
	if(!is_null($jadwal))
	{
		foreach ($jadwal as $jd);
	}
	if(!is_null($lokasi))
	{
		foreach ($lokasi as $lok);		
	}

?>
<style type="text/css">
	#grs{
		border-bottom: 0.5px solid gray;
	}
</style>

<div id="cetak-kartu">
		<div id="header">
				<table align="center">
				<tr>
				<td>

				<div id="layout">
				<div id="logo"><img src="<?php echo base_url('asset/img/logo-uinp.gif'); ?>">
				</div></div>
				</td>
				<td>
				
				<div id="navigation">
				<strong>KEMENTERIAN AGAMA<br>
				UIN Sunan Kalijaga</strong><br>
				Penerimaan Mahasiswa Baru Tahun Akademik 2015/2016<br>
				<sup><em>Jl. Marsda Adisucipto, Yogyakarta 55281 Telp. 0274 519709 email: pps@uin-suka.ac.id</em></sup>
				</div>
				
				</td>
				</tr>
				</table>
		</div>
				<div id="head-tit" align="center">
				<strong>KARTU PESERTA</strong>
				</div>

	<div id="data" align="center">
			<table border="0" width="100%" align="center">
				<tbody>
					<tr>
						<td colspan="3"><strong>Data Peserta</strong><div id="grs"></div></td>
					</tr>			
					<tr>
						<td>Nomor PMB</td>
						<td>: <strong><?php  echo $druang->nomor_peserta; ?></strong></td>
						<td valign="top" rowspan="5"><div class="potiik">
					
						<img src='<?php echo $diri->foto; ?>' width="100" />
						</div></td>
					</tr>
					<tr>
						<td valign="top">Nama</td>
						<td>: <?php  echo $diri->nama_lengkap;?></td><td></td>
					</tr>
						<td>Lulusan</td>
						<td>: <?php  echo $pd->nama_pendidikan; ?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>Nama PT</td>
						<td>: <?php  echo $pd->nama_pt;?></td><td></td>
					</tr>
					<tr>
						<td>Tahun</td>
						<td>: <?php echo $pd->tahun_ijazah; ?></td><td></td>
					</tr>
					<tr>
						<td>IPK</td>
						<td>: <?php  echo $pd->ipk; ?></td><td></td>
					</tr>
					<tr>
						<td colspan="3"><div id="grs"></div></td>
					</tr>
					<tr>
						<td colspan="3">Lokasi Ujian: Ruang <strong><?php echo $lok->nama_ruang; ?> </strong></td>
					</tr>
					<tr>
						<td colspan="3">Gedung <?php echo $lok->nama_gedung; echo " ".$jd->lokasi_ujian; ?></td>
					</tr>
				</tbody>
			</table>
</div>	
<div id="midnav" align="center">
			<table border="0" width="100%" align="center">
			<tbody>
				<tr>
					<td colspan="2" align="center" style="font-size:14px;">
					<strong><?php
				if(!is_null($data_piljur))
				{
					foreach ($data_piljur as $piljur);
					echo $piljur->jalur_masuk;
				}
				
				?>
					</strong>
					</td>
				</tr>
					<?php 
					$i=0; 
					if(!is_null($data_piljur))
					{
						foreach ($data_piljur as $piljur) {
							
							echo "<tr>";
							echo "<td  width='80'>";
							echo "<strong>Pilihan ";echo $i+=1; echo "</strong>";
							echo "</td>";
							echo "<td colspan='2'>";
							echo "<strong>".$piljur->nama_prodi."</strong>";
							echo "</td>";
							echo "</tr>";
						}
					}
					?>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2"><div id="grs"></div></td>
				</tr>
				<tr>
					
					<td colspan="2"> Tanggal Ujian: <br><strong><?php  echo tanggal_hari(date('d-m-Y',strtotime($jd->tanggal_ujian)));?><br>
					Jam <?php echo $jd->jam_mulai_ujian.' - '.$jd->jam_selesai_ujian;?>
					</strong></td>
				</tr>
			</tbody>
		</table>
	</div>
<div class="rbroundbox" >
	<br><br>
	<table border="0" cellpadding="1" cellspacing="2" width="100%" align="center">
	<tbody><tr>
		<td width="170" align="center">Petugas Verifikasi</td>
		<td width="200"></td>

		<td align="center">Yogyakarta, <?php echo tanggal(date('d-m-Y')); ?>
		</td></tr>
		<tr><td></td><td></td><td align="center"><br><br><br><br><br></td></tr>
		<tr><td align="center">( _________________ )</td>
		<td></td>
		<td align="center"><br><br>( <?php  echo $diri->nama_lengkap; ?> )</td></tr>
	</tbody></table>
	 <br><br>
    Perlengkapan yang harus dibawa pada saat ujian:<br><br>
    <i>- KARTU PESERTA dan DATA PESERTA dari sistem PMB ini yang telah dicetak secara warna</i><br>
    <i>- Foto Copy sah Ijazah S1 dan Transkrip Nilai (rangkap dua)</i><br>
    <i>- Rekomendasi dari Dosen atau Guru besar &amp; atasan langsung bagi yang sudah bekerja</i><br>
    <i>- Statement of Purpose maksimal 500 kata</i><br>    <i>- Bukti pembayaran biaya pendaftaran</i><br>
    <i>- Semua berkas dimasukkan dalam map snelhecter warna biru</i><br><i>- Pensil 2B secukupnya, karet penghapus dan peraut pensil</i><br><br>
	<br><br>
</div>

</div>
<form method="POST" target="_blank" action="<?php echo base_url('pendaftaran/fpdf_c/ambil_data'); ?>">
<input type="hidden" name="nomor_pendaftar" value="<?php echo $diri->nomor_pendaftar; ?>">
<input type="submit" class="btn btn-small btn-inverse btn-uin" value="cetak">
</form>

</div>