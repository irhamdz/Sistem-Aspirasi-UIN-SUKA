<?php
error_reporting(0);
$crumbs = array(array('Beranda'=>base_url()),array('Detail Pendaftar' => ''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
#echo $data_pendaftar[0]->PMB_NO_UJIAN_PENDAFTAR;
$jenis_pendaftar ="pmb";
?>
<div class="system-content-sia">
<form action='#' method='POST' >
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th colspan='3' align='right'><strong>Masukkan PIN Pendaftar : </strong><input type='text' name='cari_pendaftar' class="required" />
			<?php echo form_submit('cari', 'Cari', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></th>
		</tr>
	<thead>
</table>
</form>
<?php if($_POST['cari']=='Cari'){
	redirect(''.base_url().'adminpmb/laporan-detail_calon_mahasiswa_s1d3/'.$_POST['cari_pendaftar'].'');
}
if(empty($detail_calon_mahasiswa[0])){
	echo "<div class='bs-callout bs-callout-error'>Belum Cetak Kartu Ujian</div>";
}else{
?>
<table class="table table-bordered table-hover">
				<thead>
				<tr>
					<th colspan=3><strong>Biodata Pribadi</strong></th>
				</tr>
				<thead>
				<tbody>
				<tr>
					<td colspan='3' align='center'><div class='btn-uin btn btn-inverse btn btn-small'>
							<img height='200' src='<?php echo base_url().'img_pendaftar/'.$jenis_pendaftar.'/'.$detail_calon_mahasiswa[0]->PMB_FOTO_PENDAFTAR.''; ?>' />
						</div></td>
				</tr>
				<tr>
				<tr>
					<td width='180px'>Nomor PIN</td>
					<td width='9px'>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_PIN_PENDAFTAR; ?></td>
					</tr>
				<tr>
				<tr>
					<td width='180px'>Nama Sesuai Ijazah Terakhir</td>
					<td width='9px'>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
					</tr>
				<tr>
					<td >Tempat Lahir</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_TEMPAT_LAHIR_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td>Tgl. Lahir</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_TGL_LAHIR_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_ALAMAT_LENGKAP_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >No. Telp / HP</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_TELP_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_EMAIL_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Agama</td>
					<td>:</td>
					<td><?php 
						$agama=$detail_calon_mahasiswa[0]->PMB_AGAMA_PENDAFTAR;
						switch($agama){
							case 1: echo "ISLAM"; break;
							case 2: echo "KHATOLIK"; break;
							case 3: echo "PROTESTAN"; break;
							case 4: echo "HINDU"; break;
							case 5: echo "BUDDHA"; break;
							default : echo $detail_calon_mahasiswa[0]->PMB_AGAMA_PENDAFTAR; break;
						}?>
					</td>
				</tr>
				<tr>
					<td >Jenis Kelamin</td>
					<td>:</td>
					<td><?php 
						$jk=$detail_calon_mahasiswa[0]->PMB_JENIS_KELAMIN_PENDAFTAR;
						switch($jk){
							case 0: echo "Laki - Laki"; break;
							case 1: echo "Perempuan"; break;
						} ?>
					</td>
				</tr>
				<tr>
					<td >Kesehatan</td>
					<td>:</td>
					<td><?php 
							$sakit_saya=explode(" ",$detail_calon_mahasiswa[0]->PMB_ID_JENIS_KESEHATAN);
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
							} ?>
					</td>
				</tr>
				<tr>
					<td>Warga Negara</td>
					<td>:</td>
					<td><?php 
					$negara=$detail_calon_mahasiswa[0]->PMB_WARGA_NEGARA_PENDAFTAR;
						switch($negara){
							case 0: echo "Warga Negara Indonesia"; break;
							case 1: echo "Warga Negara Asing"; break;
						} ?>
					</td>
				</tr>					
				</tbody>
</table>
<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th colspan=3><strong>Pendidikan Sebelumnya</strong></th>
				</tr>
			<thead>
			<tbody>
				<tr>
					<td width='180px'>Jenis Sekolah</td>
					<td width='9px'>:</td>
					<td><?php 
					#print_r($jenis_sekolah);
				$js=$detail_calon_mahasiswa[0]->PMB_JENIS_SEKOLAH;
				switch($js){
					case 1: 
					case 2: 
					case 3: 
					case 4: 
					case 5: 
					case 6: 
						foreach($jenis_sekolah as $value){ 
								if($value->PMB_ID_JENIS_SEKOLAH==$detail_calon_mahasiswa[0]->PMB_JENIS_SEKOLAH){
									echo $value->PMB_NAMA_JENIS_SEKOLAH;
								}
						}
					break;
					default : 
						echo $js;
					break;
					}
					?></td>
				</tr>
				<tr>
					<td >Jurusan Sekolah</td>
					<td>:</td>
					<td><?php
					
							#echo $cetak_kartu_ujian[0]->PMB_JURUSAN_SEKOLAH; 
				$jus=$detail_calon_mahasiswa[0]->PMB_JURUSAN_SEKOLAH; 
				switch($jus){
					case 1: 
					case 2: 
					case 3: 
					case 4: 
					case 5: 
					case 6: 
					foreach($jurusan_sekolah as $value){ 
								if($value->PMB_ID_JURUSAN_SEKOLAH==$detail_calon_mahasiswa[0]->PMB_JURUSAN_SEKOLAH){
									echo $value->PMB_NAMA_JURUSAN_SEKOLAH;
								}
						}
					break;
					default : 
						echo $jus;
					break;
					}
				
							
							
						#print_r($jurusan_sekolah);
						?>
				</td>
				</tr>
				<tr>
					<td >Nama Sekolah</td>
					<td>:</td>
					<td><?php 
						$kode_sekolah=$detail_calon_mahasiswa[0]->PMB_KODE_SEKOLAH;
						$kd_s=substr($kode_sekolah,4,4);
						if($kd_s==9999){
							$nama_sekolah = $detail_calon_mahasiswa[0]->PMB_SEKOLAH_LAIN;
							$nama_sekolah=str_replace("#39;", "'", $nama_sekolah);
							echo $nama_sekolah;
						}else{
							$nama_sekolah = $detail_calon_mahasiswa[0]->NAMA_SEKOLAH;
							echo $nama_sekolah;
						}
			
					?></td>
				</tr>
				<tr>
					<td >Alamat Sekolah</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_ALAMAT_SEKOLAH; ?></td>
				</tr>
				<tr>
					<td >Tahun Lulus</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_TAHUN_LULUS; ?></td>
				</tr>
			</tbody>
</table>
<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th colspan=3><strong>Pilihan Jurusan</strong></th>
				</tr>
			<thead>
			<tbody>
				<tr>
					<td width='180px'>Jalur / Gelombang</td>
					<td width='9px'>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_NAMA_JALUR_MASUK; ?></td>
				</tr>
				<tr>
				<tr>
					<td>Pilihan I</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PRODI_PIL1; ?></td>
				</tr>
				<tr>
					<td>Pilihan II</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PRODI_PIL2; ?></td>
				</tr>
				<tr>
					<td>Pilihan II</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PRODI_PIL3; ?></td>
				</tr>
			</tbody>
</table>
<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th colspan=3><strong>Data Kartu Ujian</strong></th>
				</tr>
			<thead>
			<tbody>
				<tr>
					<td width='180px'>Nama Gedung</td>
					<td width='9px'>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_NAMA_GEDUNG; ?></td>
				</tr>
				<tr>
				<tr>
					<td>No. Ruang</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_NAMA_RUANG; ?></td>
				</tr>
				<tr>
					<td>No. Ujian</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_NO_UJIAN_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td>Tanggal Ujian</td>
					<td>:</td>
					<td><?php echo $detail_calon_mahasiswa[0]->PMB_TANGGAL_AWAL_SELEKSI; ?> s/d <?php echo $detail_calon_mahasiswa[0]->PMB_TANGGAL_AKHIR_SELEKSI; ?></td>
				</tr>
			</tbody>
</table>
<?php } ?>
</div>