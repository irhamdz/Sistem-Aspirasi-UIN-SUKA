<?php
#print_r($verifikasi);
$stat=$verifikasi[0]->PMB_STATUS_SIMPAN_PENDAFTAR;
switch($stat){
	case 1: $crum="Verifikasi Data"; Break;
	case 2: $crum="Data Sudah TerVerifikasi"; Break;
}
// $crumbs = array(array('Beranda'=>base_url()),array($crum=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
echo "<div id='notif-upsbp'></div>";
?>
<div class="system-content-sia">
<?php switch($stat){
case 1: ?>
<?php echo form_open(''.$this->session->userdata('status').'/data-actionform" id="frm-input');?>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
			<tbody>
				<tr>
					<td colspan='3'><div class="bs-callout bs-callout-info">Nomor PIN Anda : <br />
						<strong><?php echo $this->session->userdata('id_user'); ?></strong><br /><br />
						</div>
						<div class="bs-callout bs-callout-info">
						Jalur Pendaftran : <br />
						<strong>Anda merupakan calon Mahasiswa <?php echo $this->session->userdata('siapa_aku'); echo ' '.$this->config->item('app_owner');?></strong><br /><br />
						</div>
						<?php /*
						<div class="bs-callout bs-callout-info">
						Status Kelengkapan * :
						<?php print_r($status); ?>
						</div>
						*/ ?>
						<div class="bs-callout bs-callout-info"><strong>Infomasi : </strong><br />
						Periksa kembali data isian Anda! jika sudah sesuai, silahkan tekan tombol Cetak untuk memperoleh NOMOR PESERTA! <br />
						Jika Anda telah mencetak Kartu Peserta, Anda <font color="red"><strong>tidak dapat merubah SEMUA data isian yang tersedia</strong></font>.</div>
					</td>
				</tr>
		</table>
<table class="table table-bordered table-hover">
			<tbody>
				<tr>
					<td colspan='3' align='center'><div class='btn-uin btn btn-inverse btn btn-small'>
					
					
							<img height='200' src='<?php echo base_url().'img_pendaftar/'.$this->session->userdata('status').'/'.$verifikasi[0]->PMB_TAHUN_PENDAFTARAN.'/'.$verifikasi[0]->PMB_GELOMBANG_PENDAFTAR.'/'.$verifikasi[0]->PMB_FOTO_PENDAFTAR.''; ?>' />
						
							
							

						</div></td>
				</tr>
				<tr>
					<th colspan='3'><br /><strong>Biodata Pribadi</strong><br /></th>
				</tr>
				<tr>
					<td width=40%>Nama Sesuai Ijazah Terakhir</td>
					<td width=2%>:</td>
					<td><?php
						$nama_pendaftar=$verifikasi[0]->PMB_NAMA_LENGKAP_PENDAFTAR;
						//$nama_pendaftar=str_replace("#39;", "'", $nama_pendaftar);

							echo $nama_pendaftar; ?></td>
				</tr>
				<tr>
					<td >Tempat Lahir</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_TEMPAT_LAHIR_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Tgl. Lahir</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_TGL_LAHIR_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Alamat</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_ALAMAT_LENGKAP_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >No. Telp / HP</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_TELP_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Email</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_EMAIL_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Agama</td>
					<td>:</td>
					<td><?php 
						$agama=$verifikasi[0]->PMB_AGAMA_PENDAFTAR;
						switch($agama){
							case 1: echo "ISLAM"; break;
							case 2: echo "KHATOLIK"; break;
							case 3: echo "PROTESTAN"; break;
							case 4: echo "HINDU"; break;
							case 5: echo "BUDDHA"; break;
							default : echo $verifikasi[0]->PMB_AGAMA_PENDAFTAR; break;
						}
					#echo $verifikasi[0]->PMB_AGAMA_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Jenis Kelamin</td>
					<td>:</td>
					<td><?php 
						$jk=$verifikasi[0]->PMB_JENIS_KELAMIN_PENDAFTAR;
						switch($jk){
							case 0: echo "Laki - Laki"; break;
							case 1: echo "Perempuan"; break;
						}
					#echo $verifikasi[0]->PMB_JENIS_KELAMIN_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Kesehatan</td>
					<td>:</td>
					<td>
					<?php 
							$sakit_saya=explode(" ",$penyakit[0]->PMB_ID_JENIS_KESEHATAN);
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
					<td >Warga Negara</td>
					<td>:</td>
					<td><?php 
					$negara=$verifikasi[0]->PMB_WARGA_NEGARA_PENDAFTAR;
						switch($negara){
							case 0: echo "Warga Negara Indonesia"; break;
							case 1: echo "Warga Negara Asing"; break;
						}
					#echo $verifikasi[0]->PMB_WARGA_NEGARA_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<th colspan='3'><br /><strong>Pendidikan Sebelumnya</strong><br /></th>
				</tr>
				<?php if($this->session->userdata('status') == 'pmb'){
				/*	
					
					?>
				
				<tr>
					<td>Jenis Sekolah</td>
					<td>:</td>
					<td><?php 
					#print_r($jenis_sekolah);
				$js=$verifikasi[0]->PMB_JENIS_SEKOLAH;
				switch($js){
					case 1: 
					case 2: 
					case 3: 
					case 4: 
					case 5: 
					case 6: 
						foreach($jenis_sekolah as $value){ 
								if($value->PMB_ID_JENIS_SEKOLAH==$verifikasi[0]->PMB_JENIS_SEKOLAH){
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
				*/ ?>
				<tr>
					<td >Jurusan Sekolah</td>
					<td>:</td>
					<td><?php
				$jus=$verifikasi[0]->PMB_JURUSAN_SEKOLAH;
				switch($jus){
					case 1: 
					case 2: 
					case 3: 
					case 4: 
					case 5: 
					case 6: 
					foreach($jurusan_sekolah as $value){ 
								if($value->PMB_ID_JURUSAN_SEKOLAH==$verifikasi[0]->PMB_JURUSAN_SEKOLAH){
									echo $value->PMB_NAMA_JURUSAN_SEKOLAH;
								}
						}
					break;
					default : 
						echo $jus;
					break;
					}
				?></td>
				</tr>
				<tr>
					<td >Nama Sekolah</td>
					<td>:</td>
					<td><?php 
						// $kode_sekolah=$verifikasi[0]->PMB_KODE_SEKOLAH;
						// $kd_s=substr($kode_sekolah,4,4);
						// if($kd_s==9999){
							
							// $nama_sekolah = $verifikasi[0]->PMB_SEKOLAH_LAIN;
							// $nama_sekolah=str_replace("#39;", "'", $nama_sekolah);
							// echo $nama_sekolah;
						// }else{
							// $nama_sekolah = $nama_sekolah_peserta[0]->NAMA_SEKOLAH;
							// echo $nama_sekolah;
						// }
						echo $pendidikan_s1d3[0]->PMB_SEKOLAH_LAIN;
			
					?></td>
				</tr>
				<tr>
					<td >Alamat Sekolah</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_ALAMAT_SEKOLAH; ?></td>
				</tr>
				<tr>
					<td >Tahun Lulus</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_TAHUN_LULUS; ?></td>
				</tr>
				<tr>
					<th colspan='3'><br /><strong>PRESTASI - Sertifikat Tahfidz 30 Juz</strong><br /></th>
				</tr>
				<tr>
					<td>Prestasi</td>
					<td>:</td>
					<td><?php #echo #$prestasi; 
					switch($status_prestasi){
						case 'Ada' : echo "<img src='".base_url()."sertifikat_files/pmb/".$TAHUN_DAFTAR."/".$GELOMBANG."/".$this->session->userdata('id_user')."-sertifikat-1.jpg' height='200' />";  break;
						case 'Tidak Ada' : echo $status_prestasi; break;
					}
					?></td>
				</tr>
				<tr>
					<th colspan='3'><br /><strong>DATA IBU</strong><br /></th>
				</tr>
				<tr>
					<td>Nama Ibu</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_NAMA_LENGKAP_IBU; ?></td>
				</tr>
				<tr>
					<td>Alamat Lengkap</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_ALAMAT_LENGKAP_IBU; ?></td>
				</tr>
				<tr>
					<td>No. Telpon Ibu</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_TELP_IBU; ?></td>
				</tr>
				<tr>
					<td>No. Hp Ibu</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_NOHP_IBU; ?></td>
				</tr>
				<tr>
					<th colspan=3><strong>DATA AYAH</strong><br /><br /></th>
				</tr>
				<tr>
					<td>Nama Ayah</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_NAMA_LENGKAP_AYAH; ?></td>
				</tr>
				<tr>
					<td>Alamat Lengkap</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_ALAMAT_LENGKAP_AYAH; ?></td>
				</tr>
				<tr>
					<td>No. Telpon Ayah</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_TELP_AYAH; ?></td>
				</tr>
				<tr>
					<td>No. Hp Ayah</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_NOHP_AYAH; ?></td>
				</tr>
					<tr>
					<td colspan='3'><div class="bs-callout bs-callout-warning">
					<input type="hidden" name="status_verifikasi" value="2"><input type='hidden' name='current_page' value='<?php echo $this->security->xss_clean($this->uri->segment(1)).'/'.$this->security->xss_clean($this->uri->segment(2)); ?>' /><input type="hidden" name="step" value="100"><strong> <font color="#4A991D">Yakinkan kami kembali bahwa <font color="#FF0000">Data</font> di atas adalah benar, karena setelah Anda Verifikasi Data ini, data <font color="#FF0000">tidak dapat dirubah kembali</font>, dan Kebenaran data menjadi tanggung jawab peserta. Jika TIDAK SESUAI dengan dokumen asli, maka dinyatakan <font color="#FF0000">GUGUR</font>.</font><br />
					<input type="checkbox" name="lisensi" value="1"> Ya, Saya Setuju </div></td>
				</tr>	
				<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
				<tr>
					<td align='left'><a href='data-pilihan_jurusan_s1d3' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
					<td></td>
					<td align='right'><?php echo form_submit('pmb1_simpan', '<< Verifikasi Data >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
				</tr>
				<?php }elseif($this->session->userdata('status')=='s2' || $this->session->userdata('status')=='s3'){ ?>
				<tr>
					<td >Lulusan Dari</td>
					<td>:</td>
					<td><?php 
						$lulusan=$verifikasi[0]->PMB_LULUSAN_DARI;
						switch($lulusan){
							case 1: echo "UIN"; break;
							case 2: echo "IAIN"; break;
							case 3: echo "STAIN"; break;
							case 4: echo "PTAIS"; break;
							case 5: echo "PTN"; break;
							case 6: echo "PTS"; break;
							case 7: echo "PT LUAR NEGERI"; break;
							default: echo $verifikasi[0]->PMB_LULUSAN_DARI; break;
						}
					#echo $verifikasi[0]->PMB_LULUSAN_DARI; ?></td>
				</tr>
				<tr>
					<td >Nama Perguruan Tinggi</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_NAMA_PERGURUAN_TINGGI; ?></td>
				</tr>
				<tr>
					<td >Tahun Ijazah</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_TAHUN_IJAZAH; ?></td>
				</tr>
				<tr>
					<td >IPK</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_IPK_CPASCA; ?></td>
				</tr>
				<tr>
					<th colspan='3'><br /><strong>Pekerjaan</strong><br /></th>
				</tr>
				<tr>
					<td >Status Pekerjaan</td>
					<td>:</td>
					<td><?php 
						$status_pekerjaan=$verifikasi[0]->PMB_STATUS_PEKERJAAN;
						switch($status_pekerjaan){
							case 1: echo "Dosen / Guru / Pengajar"; break;
							case 2: echo "Karyawan"; break;
							case 3: echo "Belum Bekerja / Alumni"; break;
							default: echo $verifikasi[0]->PMB_STATUS_PEKERJAAN; break;
						}
					#echo $verifikasi[0]->PMB_STATUS_PEKERJAAN; ?></td>
				</tr>
				<tr>
					<td >Alamat Kantor</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_ALAMAT_KANTOR; ?></td>
				</tr>
				<tr>
					<td >No. Telp./Fax</td>
					<td>:</td>
					<td><?php echo $verifikasi[0]->PMB_TELP_FAX_KANTOR; ?></td>
				</tr>
				<tr>
					<td >Rencana Biaya Studi</td>
					<td>:</td>
					<td><?php 
						$rencana_biaya=$verifikasi[0]->PMB_RENCANA_BIAYA_STUDI;
						switch($rencana_biaya){
							case 1: echo "Ditanggung Sendiri"; break;
							case 2: echo "Beasiswa Instansi Tempat Bekerja"; break;
							case 3: echo "Beasiswa Yayasan"; break;
							case 4: echo "Beasiswa Kemenag"; break;
							default: echo $verifikasi[0]->PMB_RENCANA_BIAYA_STUDI; break;
						}
					#echo $verifikasi[0]->PMB_RENCANA_BIAYA_STUDI; ?></td>
				</tr>
				<tr>
					<th colspan=3><strong><br />Jalur dan Jurusan yang Anda Pilih</strong></th>
				</tr>
				<tr>
					<td width='15%'>Jalur</td>
					<td width='1%'>:</td>
					<td width='70%'><?php echo str_replace('Gelombang 2','Gelombang 3',$jalur[0]->PMB_NAMA_JALUR_MASUK);?></td>
				</tr>
				<tr>
					<td>Kelas</td>
					<td>:</td>
					<td><?php $kelas=$verifikasi[0]->PMB_KELAS_JURUSAN;
						switch($kelas){
							case 1: echo "Reguler"; break;
							case 2: echo "Non Reguler (Akhir Pekan)"; break;
						}
						#echo $verifikasi[0]->PMB_KELAS_JURUSAN; ?></td>
				</tr>
				<?php if($this->session->userdata('status')=='s2'){ ?>
				<tr>
					<td>Pilihan I</td>
					<td>:</td>
					<td><?php   
					
						$pil_1=$verifikasi[0]->PMB_PILJUR_1;
							foreach($master_prodi as $value){ 
								if($value->PMB_ID_PRODI==$pil_1){
									echo "".$value->PMB_NAMA_PRODI."";
								}
							}
						// $pil_1=$verifikasi[0]->PMB_PILJUR_1;
						// switch($pil_1){
							// case 1: echo "Konsentrasi Filsafat Islam"; break;
							// case 2: echo "Konsentrasi Studi al-Qur'an dan al-Hadis"; break;
							// case 3: echo "Konsentrasi Studi Agama dan Resolusi Konflik"; break;
							// case 4: echo "Konsentrasi Ilmu Bahasa Arab"; break;
							// case 5: echo "Konsentrasi Sejarah Kebudayaan Islam"; break;
							// case 6: echo "Konsentrasi Pendidikan Agama Islam"; break;
							// case 7: echo "Konsentrasi Manajemen dan Kebijakan Pendidikan Islam"; break;
							// case 8: echo "Konsentrasi Pemikiran Pendidikan Islam"; break;
							// case 9: echo "Konsentrasi Pendidikan Bahasa Arab"; break;
							// case 10: echo "Konsentrasi Bimbingan dan Konseling Islam"; break;
							// case 11: echo "Konsentrasi Hukum Keluarga"; break;
							// case 12: echo "Konsentrasi Keuangan dan Perbankan Syariah"; break;
							// case 13: echo "Konsentrasi Studi Politik dan Pemerintahan dalam Islam"; break;
							// case 14: echo "Konsentrasi Hukum Bisnis Syariah"; break;
							// case 15: echo "Konsentrasi Pekerjaan Sosial"; break;
							// case 16: echo "Konsentrasi Ilmu Perpustakaan dan Informasi"; break;
							// case 17: echo "Konsentrasi Sains MI"; break;
							// case 18: echo "Konsentrasi Pendidikan Agama Islam MI"; break;
							// case 19: echo "Konsentrasi Pendidikan Guru Raudlatul Athfal"; break;
						// }
						#echo $verifikasi[0]->PMB_PILJUR_1; ?></td>
				</tr>
				<tr>
					<td>Pilihan II</td>
					<td>:</td>
					<td><?php 
						$pil_2=$verifikasi[0]->PMB_PILJUR_2;
							foreach($master_prodi as $value){ 
								if($value->PMB_ID_PRODI==$pil_2){
									echo "".$value->PMB_NAMA_PRODI."";
								}
							}
						// $pil_2=$verifikasi[0]->PMB_PILJUR_2;
						// switch($pil_2){
							// case 1: echo "Konsentrasi Filsafat Islam"; break;
							// case 2: echo "Konsentrasi Studi al-Qur'an dan al-Hadis"; break;
							// case 3: echo "Konsentrasi Studi Agama dan Resolusi Konflik"; break;
							// case 4: echo "Konsentrasi Ilmu Bahasa Arab"; break;
							// case 5: echo "Konsentrasi Sejarah Kebudayaan Islam"; break;
							// case 6: echo "Konsentrasi Pendidikan Agama Islam"; break;
							// case 7: echo "Konsentrasi Manajemen dan Kebijakan Pendidikan Islam"; break;
							// case 8: echo "Konsentrasi Pemikiran Pendidikan Islam"; break;
							// case 9: echo "Konsentrasi Pendidikan Bahasa Arab"; break;
							// case 10: echo "Konsentrasi Bimbingan dan Konseling Islam"; break;
							// case 11: echo "Konsentrasi Hukum Keluarga"; break;
							// case 12: echo "Konsentrasi Keuangan dan Perbankan Syariah"; break;
							// case 13: echo "Konsentrasi Studi Politik dan Pemerintahan dalam Islam"; break;
							// case 14: echo "Konsentrasi Hukum Bisnis Syariah"; break;
							// case 15: echo "Konsentrasi Pekerjaan Sosial"; break;
							// case 16: echo "Konsentrasi Ilmu Perpustakaan dan Informasi"; break;
							// case 17: echo "Konsentrasi Sains MI"; break;
							// case 18: echo "Konsentrasi Pendidikan Agama Islam MI"; break;
							// case 19: echo "Konsentrasi Pendidikan Guru Raudlatul Athfal"; break;
						// }
						#echo $verifikasi[0]->PMB_PILJUR_2; ?>
						
					</td>
				</tr>
				<?php }else{ ?> 
				<tr>
					<td>Pilihan Jurusan</td>
					<td>:</td>
					<td><?php 
						$pil_1=$verifikasi[0]->PMB_PILJUR_1;
							foreach($master_prodi as $value){ 
								if($value->PMB_ID_PRODI==$pil_1){
									echo "".$value->PMB_NAMA_PRODI."";
								}
							} ?>
						
					</td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan='3'><div class="bs-callout bs-callout-warning">
					<input type="hidden" name="status_verifikasi" value="2"><input type='hidden' name='current_page' value='<?php echo $this->security->xss_clean($this->uri->segment(1)).'/'.$this->security->xss_clean($this->uri->segment(2)); ?>' /><input type="hidden" name="step" value="100"><strong> <font color="#4A991D">Yakinkan kami kembali bahwa <font color="#FF0000">Data</font> di atas adalah benar, karena setelah Anda Verifikasi Data ini, data <font color="#FF0000">tidak dapat dirubah kembali</font>, dan Kebenaran data menjadi tanggung jawab peserta. Jika TIDAK SESUAI dengan dokumen asli, maka dinyatakan <font color="#FF0000">GUGUR</font>.</font><br />
					<input type="checkbox" name="lisensi" value="1"> Ya, Saya Setuju </div></td>
				</tr>	
				</tbody>
				</table>
				<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
				<tr>
					<td align='left'><a href='data-pilihan_jurusan' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
					<td></td>
					<td align='right'><?php echo form_submit('pmb1_simpan', '<< Verifikasi Data >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
				</tr>
				<?php } ?>	
		
	</table>
	<script>
$(function() {
$("form#frm-input").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'data-actionform',
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(x) {
        var data = $.parseJSON(x);
        //console.log(data);
		
        $("#notif-upsbp").html(data['pesan']);
		$('html, body').animate({ scrollTop: 0 }, 200);
		if(data['hasil'] == 'sukses'){
			window.setTimeout( function(){
				window.location = '<?php $url_base=base_url().$this->session->userdata('status');  echo "$url_base/data-verifikasi_data"; ?>';
			}, 1000);
		}
    });
 
    return false;
        });
});
</script>
<?php 


break;
case 2: 
	$url=$this->security->xss_clean($this->uri->segment(1));?>
	<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
			<tbody>
				<tr>
					<td><div class="bs-callout bs-callout-info">Nomor PIN Anda : <br />
						<strong><?php echo $this->session->userdata('id_user'); ?></strong><br /><br />
						</div>
						<div class="bs-callout bs-callout-info">
						Jalur Pendaftran : <br />
						<strong>Anda merupakan calon Mahasiswa <?php echo $this->session->userdata('siapa_aku'); echo ' '.$this->config->item('app_owner');?></strong><br /><br />
						</div>
						<div class="bs-callout bs-callout-warning">
						<strong>Silahkan : </strong><br />
					<?php /*	Untuk Cetak Kartu Ujian, Tunggu Konfirmasi Kami Selanjutnya, Terima Kasih. */ ?>
						<a href='data-create_kartu_ujian'><span class='label label-warning' title='Silahkan Cetak Kartu Ujian Anda'>Cetak Kartu Ujian</span></a><br /><br />
						<a href='data-cetak_biodata'><span class='label label-info' title='Silahkan Cetak Biodata Diri Anda'>Cetak Data Pribadi</span></a>&nbsp <br /><br />
						
						<?php 
						$jenis=$this->session->userdata('jenis_penerimaan');
						switch($jenis){
						case 2: ?> 
						<a href='<?php echo base_url().'downloads/pmb.uin-suka.ac.id_pasca_dl_contoh-statement-of-purpose.pdf'?>'><span class='label label-info'>Contoh Statement Of Purpose</span></a>&nbsp <br /><br />	
						
						<a href='<?php echo base_url().'downloads/form-rekomendasi-s2-s3-course.pdf'?>'><span class='label label-info' >Form Rekomendasi s2 s3 course</span></a>&nbsp <?php break; } ?><br /><br />
						</div>
						<div class="bs-callout bs-callout-info">
						<strong>Infomasi : </strong><br />
						Kebenaran data menjadi tanggung jawab peserta. Jika TIDAK SESUAI dengan dokumen asli, maka dinyatakan GUGUR<br /><br />
						Cetak Data Pribadi dan Kartu Peserta Ujian PMB, hanya dapat dilakukan ketika semua data sudah dilengkapi,<br /><br />
						Anda tetap bisa <em>Login</em> ke dalam Sistem PMB ini walaupun sudah mencetak Kartu Peserta Ujian, tetapi tidak dapat merubah data. </font>.</div>
					</td>
					
				</tr>
		</table>
	
	<?php
	break; 
}?>
</div>