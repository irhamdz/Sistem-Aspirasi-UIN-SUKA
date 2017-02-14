<?php
$url_base=base_url().$this->session->userdata('status');
$data=$piljur[0]->PMB_STATUS_SIMPAN_PILJUR;
switch($data){
	case 1: $crumb="Ubah Jalur Dan Jurusan"; Break;
	case 2: $crumb="Jalur Dan Jurusan"; Break;
	
}
// $crumbs = array(array('Beranda'=>base_url()),array($crumb=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
echo "<div id='notif-upsbp'></div>";
?><div class="system-content-sia">
<?php
#$this->load->view('02_cmahasiswa/02_vw_step_by_step');
#$data=$piljur[0]->PMB_STATUS_SIMPAN_PILJUR;
#ECHO $piljur[0]->PMB_JALUR_PENDAFTARAN;

switch($data){
	case 1:
		//posisi edit piljur
#$this->load->view('02_cmahasiswa/02_vw_step_by_step'); 
echo form_open(''.$this->session->userdata('status').'/data-actionform" id="frm-input'); 
?><div class="bs-callout bs-callout-info">
<strong>Infomasi : </strong><br />
				Pilihan Jurusan -> <font color="red"><strong>Tidak Boleh Sama</font></strong></div>
<div class="bs-callout bs-callout-warning">Lihat Syarat Khusus Pemilihan Jurusan <a href='http://admisi.uin-suka.ac.id/downloads/konsentrasi_s2_uin_suka_2015.jpg'><strong>[klik disini]</strong></a>.</div>
<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tr>
		<td colspan=2><strong>Pilihan Jalur dan Jurusan</strong><br /><br /></td>
	</tr>
	<tr>
		<td>Jalur</td>
		<td><div class="col-xs-7"><select name='pmb2_jalur' class="form-control input-sm">
				<option value=''>&nbsp; Pilih &nbsp;</option>
					<?php
				foreach($master_jalur as $value){ 
								if($value->PMB_KODE_JALUR_MASUK==$piljur[0]->PMB_JALUR_PENDAFTARAN){
									echo "<option value=".$value->PMB_KODE_JALUR_MASUK." selected>".$value->PMB_NAMA_JALUR_MASUK."</option>";
								}
							}
		?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td>Kelas</td>
		<td><div class="col-xs-7"><select name='pmb2_kelas' class="form-control input-sm">
		<?php
					$kelas=$piljur[0]->PMB_KELAS_JURUSAN;
					switch($kelas){
							case 1 : 
							echo "<option value=''>&nbsp; -- Pilih -- &nbsp;</option>
									<option value='1' selected>&nbsp; Reguler &nbsp;</option>
									<option value='2'>&nbsp; Non Reguler (Akhir Pekan) &nbsp;</option>"; break;
							case 2 :
							echo "<option value=''>&nbsp; -- Pilih -- &nbsp;</option>
									<option value='1' >&nbsp; Reguler &nbsp;</option>
									<option value='2' selected>&nbsp; Non Reguler (Akhir Pekan) &nbsp;</option>"; break;
					} ?>
				
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td>Pilihan I</td>
		<td><div class="col-xs-7"><select name='pmb2_pilihan_1' class="form-control input-sm">
			<?php echo $piljur[0]->PMB_PILJUR_1;
				foreach($master_prodi as $value){ 
								if($value->PMB_ID_PRODI==$piljur[0]->PMB_PILJUR_1){
									echo "<option value=".$value->PMB_ID_PRODI." selected>".$value->PMB_NAMA_PRODI."</option>";
								}else{
									echo "<option value=".$value->PMB_ID_PRODI.">".$value->PMB_NAMA_PRODI."</option>";
								}
							}
							
		?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td>Pilihan II</td>
		<td><div class="col-xs-7"><select name='pmb2_pilihan_2' class="form-control input-sm">
		<?php 
				foreach($master_prodi as $value){ 
								if($value->PMB_ID_PRODI==$piljur[0]->PMB_PILJUR_2){
									echo "<option value=".$value->PMB_ID_PRODI." selected>".$value->PMB_NAMA_PRODI."</option>";
								}else{
									echo "<option value=".$value->PMB_ID_PRODI.">".$value->PMB_NAMA_PRODI."</option>";
								}
							}
							
		?>
			</select></div> *)<?php #echo $piljur[0]->PMB_PILJUR_2; ?>
		</td>
	</tr>
	<tr>
			<td colspan='2'><input type='hidden' name='current_page' value='<?php echo $this->security->xss_clean($this->uri->segment(1)).'/'.$this->security->xss_clean($this->uri->segment(2)); ?>' /><input type="hidden" name="step" value="21"></td>
		</tr>
	<tr>
			<td align='left'><a href='data-pekerjaan' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td align='right'><?php echo form_submit('pmb2_simpan', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
	</tr>
</table>
	<?php echo form_close();
$url_base=base_url().$this->session->userdata('status'); 	?>
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
				window.location = '<?php echo "$url_base/data-verifikasi_data"; ?>';
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
	  #print_r($piljur);
?>
		<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
			<tbody>
				<tr>
					<td>Nomor PIN Anda : <br />
						<strong><?php echo $this->session->userdata('id_user'); ?></strong><br /><br />
					
						Jalur Pendaftran : <br />
						<strong>Anda merupakan calon Mahasiswa <?php echo $this->session->userdata('siapa_aku'); echo ' '.$this->config->item('app_owner');?></strong><br /><br />
				
						Status Kelengkapan * :
						<?php print_r($status); ?>
					</td>
					
				</tr>
		</table><hr /><br />
	<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tr>
		<td colspan=3><strong>Jalur dan Jurusan yang Anda Pilih</strong><br /><br /></td>
	</tr>
	<tr>
		<td width='15%'>Jalur</td>
		<td width='1%'>:</td>
		<td width='70%'><?php 
						$jurusan=$piljur[0]->PMB_JALUR_PENDAFTARAN;
						switch($jurusan){
							case 21: echo "Magister (S2) Gelombang II"; break;
						}
		#echo $piljur[0]->PMB_JALUR_PENDAFTARAN; ?></td>
	</tr>
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td><?php $kelas=$piljur[0]->PMB_KELAS_JURUSAN;
						switch($kelas){
							case 1: echo "Reguler"; break;
							case 2: echo "Non Reguler (Akhir Pekan)"; break;
						}
		#echo $piljur[0]->PMB_KELAS_JURUSAN; ?></td>
	</tr>
	<tr>
		<td>Pilihan I</td>
		<td>:</td>
		<td><?php   $pil_1=$piljur[0]->PMB_PILJUR_1;
						switch($pil_1){
							case 1: echo "Konsentrasi Filsafat Islam"; break;
							case 2: echo "Konsentrasi Studi al-Qur'an dan al-Hadis"; break;
							case 3: echo "Konsentrasi Studi Agama dan Resolusi Konflik"; break;
							case 4: echo "Konsentrasi Ilmu Bahasa Arab"; break;
							case 5: echo "Konsentrasi Sejarah Kebudayaan Islam"; break;
							case 6: echo "Konsentrasi Pendidikan Agama Islam"; break;
							case 7: echo "Konsentrasi Manajemen dan Kebijakan Pendidikan Islam"; break;
							case 8: echo "Konsentrasi Pemikiran Pendidikan Islam"; break;
							case 9: echo "Konsentrasi Pendidikan Bahasa Arab"; break;
							case 10: echo "Konsentrasi Bimbingan dan Konseling Islam"; break;
							case 11: echo "Konsentrasi Hukum Keluarga"; break;
							case 12: echo "Konsentrasi Keuangan dan Perbankan Syariah"; break;
							case 13: echo "Konsentrasi Studi Politik dan Pemerintahan dalam Islam"; break;
							case 14: echo "Konsentrasi Hukum Bisnis Syariah"; break;
							case 15: echo "Konsentrasi Pekerjaan Sosial"; break;
							case 16: echo "Konsentrasi Ilmu Perpustakaan dan Informasi"; break;
							case 17: echo "Konsentrasi Sains MI"; break;
							case 18: echo "Konsentrasi Pendidikan Agama Islam MI"; break;
							case 19: echo "Konsentrasi Pendidikan Guru Raudlatul Athfal"; break;
						}
		#echo $piljur[0]->PMB_PILJUR_1; ?></td>
	</tr>
	<tr>
		<td>Pilihan II</td>
		<td>:</td>
		<td><?php 
					$pil_2=$piljur[0]->PMB_PILJUR_2;
						switch($pil_2){
							case 1: echo "Konsentrasi Filsafat Islam"; break;
							case 2: echo "Konsentrasi Studi al-Qur'an dan al-Hadis"; break;
							case 3: echo "Konsentrasi Studi Agama dan Resolusi Konflik"; break;
							case 4: echo "Konsentrasi Ilmu Bahasa Arab"; break;
							case 5: echo "Konsentrasi Sejarah Kebudayaan Islam"; break;
							case 6: echo "Konsentrasi Pendidikan Agama Islam"; break;
							case 7: echo "Konsentrasi Manajemen dan Kebijakan Pendidikan Islam"; break;
							case 8: echo "Konsentrasi Pemikiran Pendidikan Islam"; break;
							case 9: echo "Konsentrasi Pendidikan Bahasa Arab"; break;
							case 10: echo "Konsentrasi Bimbingan dan Konseling Islam"; break;
							case 11: echo "Konsentrasi Hukum Keluarga"; break;
							case 12: echo "Konsentrasi Keuangan dan Perbankan Syariah"; break;
							case 13: echo "Konsentrasi Studi Politik dan Pemerintahan dalam Islam"; break;
							case 14: echo "Konsentrasi Hukum Bisnis Syariah"; break;
							case 15: echo "Konsentrasi Pekerjaan Sosial"; break;
							case 16: echo "Konsentrasi Ilmu Perpustakaan dan Informasi"; break;
							case 17: echo "Konsentrasi Sains MI"; break;
							case 18: echo "Konsentrasi Pendidikan Agama Islam MI"; break;
							case 19: echo "Konsentrasi Pendidikan Guru Raudlatul Athfal"; break;
						}
		#echo $piljur[0]->PMB_PILJUR_2; ?></td>
	</tr>
</table>

<?php
	  break; 
	  
}?>
</div>
