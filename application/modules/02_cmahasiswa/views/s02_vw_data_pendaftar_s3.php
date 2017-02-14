<?php
$url_base=base_url().$this->session->userdata('status');
$data=$pendaftar[0]->PMB_STATUS_SIMPAN_PENDAFTAR;
switch($data){
	case 1: $crumb="Ubah Data Pribadi"; Break;
	case 2: $crumb="Data Pribadi"; Break;
	
}
// $crumbs = array(array('Beranda'=>base_url()),array($crumb=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
echo "<div id='notif-upsbp'></div>";
echo form_open_multipart(''.$this->session->userdata('status').'/data-actionform" id="frm-input'); 
?>
<div class="system-content-sia">
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
			<tbody>
				<tr>
					<td>
						<div class="bs-callout bs-callout-info"><strong>Infomasi : </strong><br />
				Foto -> <strong>Laki-laki</strong> -> Latar Belakang <font color="blue"><strong>Biru</strong></font>,<br /> 
				Foto -> <strong>Perempuan</strong> -> Latar Belakang <font color="red"><strong>Merah</font></strong>.<br /> 
				File -> TYPE = JPG, Ukuran = Minimal 50 KB, Maksimal 1 M</font> </div>
				<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div> 
					</td>
				</tr>
		</table>
<?php 
#$this->load->view('02_cmahasiswa/02_vw_step_by_step');
switch($data){
	case 1: 
		//posisi edit
		#print_r($pendaftar); 
		#print_r($pendidikan); 
		#print_r($pekerjaan);
		#print_r($jenis_kesehatan);		
		#print_r($penyakit);
		#print_r($master_agama);
		#print_r($master_lulusan);
		#print_r($master_pekerjaan);
		$nama_pendaftar=$pendaftar[0]->PMB_NAMA_LENGKAP_PENDAFTAR;
		$nama_pendaftar=str_replace("#39;", "'", $nama_pendaftar);
	?>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='2'><strong>Biodata Pribadi</strong><br /></td>
		</tr>
		<tr>
			<td>Nama Sesuai Ijazah Terakhir</td>
			<td><div class="col-xs-7"><input type='text' name='pmb1_nama_lengkap' class="form-control input-sm" value="<?php echo $nama_pendaftar; ?>" /></div> *)</td>
		</tr>
		<tr>
			<td >Tempat Lahir</td>
			<td><div class="col-xs-7"><input type='text' name='pmb1_tempat_lahir' class="form-control input-sm" value="<?php echo $pendaftar[0]->PMB_TEMPAT_LAHIR_PENDAFTAR; ?>" /></div> *)</td>
		</tr>
		<tr>
			<td >Tgl. Lahir</td>
			<td>
					<div class="col-xs-7">
					<div class='input-group date' id='datetimepicker1'><div id="tgl" class="input-append">
					<input type="text" class="form-control input-sm" style="width:200px" name="pmb1_tgl_lahir" value='<?php echo $pendaftar[0]->PMB_TGL_LAHIR_PENDAFTAR; ?>'>
					<span class="add-on"><i data-time-icon="icon-timeq" data-date-icon="icon-calendar"></i></span> 
					</div></div></div> *)</td>
		</tr>
		<tr>
			<td width=200>Alamat</td>
			<td><div class="col-xs-7"><textarea style="width:400px;height:100px" name='pmb1_alamat' class="form-control input-sm"><?php echo $pendaftar[0]->PMB_ALAMAT_LENGKAP_PENDAFTAR; ?></textarea></div> *)
			<div class="col-xs-12"><div class="reg-info"> Format Pengisian : Alamat Rumah / Nama Jalan, RT, RW, Kelurahan, Kecamatan, Kabupaten, Propinsi, Negara, Kodepos</div></div></td>
		</tr>
		<tr>
			<td >No. Telp / HP</td>
			<td><div class="col-xs-7"><input type='text' name='pmb1_nohp' class="form-control input-sm" value="<?php echo $pendaftar[0]->PMB_TELP_PENDAFTAR; ?>" /></div> *)</td>
		</tr>
		<tr>
			<td>Email</td>
			<td><div class="col-xs-7"><input type='text' name='pmb1_email' class="form-control input-sm" value="<?php echo $pendaftar[0]->PMB_EMAIL_PENDAFTAR; ?>" /></div> *)</td>
		</tr>
		<tr>
			<td >Agama</td>
			<td><div class="col-xs-7"><select name='pmb1_agama' id='agama' class="form-control input-sm">
					<option value=''>Pilih</option>
				<?php 
				$agama_saya=$pendaftar[0]->PMB_AGAMA_PENDAFTAR;
				switch($agama_saya){
					case 1: 
					case 2: 
					case 3: 
					case 4: 
					case 5: 
							foreach($master_agama as $value){ 
								if($value->PMB_ID_AGAMA==$agama_saya){
									echo "<option value=".$value->PMB_ID_AGAMA." selected>".$value->PMB_NAMA_AGAMA."</option>";
								}else{
									echo "<option value=".$value->PMB_ID_AGAMA.">".$value->PMB_NAMA_AGAMA."</option>";
								}
							}
					break;
					default : 
						foreach($master_agama as $value){ 	
							echo "<option value=".$value->PMB_ID_AGAMA.">".$value->PMB_NAMA_AGAMA."</option>";
						}
						echo "<option value='$agama_saya' selected>$agama_saya</option>";
					break;
				}
				  ?>
				 <option value='agama_lain'>Lainnya</option></select></div><br /><br />
				 
				<div class="col-xs-7"><input type="text" id="pmb1_agama" name="agama_lain" value="" style="display: none;"></div> *)
			</td>
		</tr>
			<tr>
			<td >Jenis Kelamin</td>
			
			<td><?php
					$jk=$pendaftar[0]->PMB_JENIS_KELAMIN_PENDAFTAR;
					switch($jk){
							case 1 : 
							echo "<div class='radio'><label><input type='radio' name='pmb1_jenis_kelamin' value='0' />Laki - Laki &nbsp </label></div><div class='radio'><label><input type='radio' name='pmb1_jenis_kelamin' value='1' checked />Perempuan</label></div>"; break;
							default :
							echo "<div class='radio'><label><input type='radio' name='pmb1_jenis_kelamin' value='0' checked />Laki - Laki</label></div><div class='radio'><label><input type='radio' name='pmb1_jenis_kelamin' value='1'  />Perempuan</label></div>"; break;
					} ?> </label></div>
			</td>
		</tr>
		<tr>
			<td >Kesehatan</td>
			<td><div class="col-xs-12">Status Kesehatan Anda saat ini :<hr />
				<?php 
				$sakit_saya=explode(" ",$penyakit[0]->PMB_ID_JENIS_KESEHATAN);
				for($a=0; $a<count($sakit_saya); $a++){ 
					if($sakit_saya[$a]==1){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="1"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Normal<br />';
					}elseif($sakit_saya[$a]==2){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="2"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Daksa<br />';
					}elseif($sakit_saya[$a]==3){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="3"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Netra<br />';
					}elseif($sakit_saya[$a]==4){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="4"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Rungu<br />';
					}elseif($sakit_saya[$a]==5){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="5"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Wicara<br />';
					}elseif($sakit_saya[$a]==6){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="6"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Buta Warna Parsial<br />';
					}elseif($sakit_saya[$a]==7){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="7"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Buta Warna Total<br />';
					}
				}
				
				
						echo '<br />Beri Tanda Centang untuk merubah Status Kesehatan :<hr />';
						foreach($jenis_kesehatan as $value){ 
					 ?><div class='checkbox'><label><input type="checkbox" name="pmb1_kesehatan_baru[]" value="<?php echo $value->PMB_ID_JENIS_KESEHATAN; ?>">
					 <?php echo $value->PMB_NAMA_JENIS_KESEHATAN; ?></label></div>
					 <?php }
				 ?> </div>
				 </td>
		</tr>
		<tr>
			<td >Warga Negara</td>
			<td><div class="col-xs-7"><select name='pmb1_warga_negara' class="form-control input-sm">
					<option value=''>Pilih</option>
					<?php 
					$negara=$pendaftar[0]->PMB_WARGA_NEGARA_PENDAFTAR;
						switch($negara){
							case 1: echo "<option value='0'>Warga Negara Indonesia</option>
										  <option value='1' selected>Warga Negara Asing</option>"; break;
							default: echo "<option value='0' selected>Warga Negara Indonesia</option>
										  <option value='1'>Warga Negara Asing</option>"; break;
						}
						?>
					
				</select> </td>
		</tr>
		<tr>
			<td >Foto</td>
			<td><div class="col-xs-12"><div class='btn-uin btn btn-inverse btn btn-small'>
							<img height='200' src='<?php echo base_url().'img_pendaftar/'.$this->session->userdata('status').'/'.$pendaftar[0]->PMB_FOTO_PENDAFTAR.''; ?>' />
						</div><input type='hidden' name='pmb1_foto_lama' value="<?php echo $pendaftar[0]->PMB_FOTO_PENDAFTAR; ?>" /><br /><br />
						<a href='<?php echo $url_base."/data-ubah_foto" ?>'><strong>Ganti Foto</strong><a/></div></td>
		</tr>
		<tr> <?php if(1>10): ?>
			<td >Ganti Foto</td>
			<td><input type='file' name='userfile' /></td>
		</tr> <?php endif; ?>
		<tr>
			<td colspan='2'><input type='hidden' name='current_page' value='<?php echo $this->security->xss_clean($this->uri->segment(1)).'/'.$this->security->xss_clean($this->uri->segment(2)); ?>' /><input type="hidden" name="step" value="11">
			</td>
		</tr>	
		<tr>
			<td></td>
			<td align='right'><?php echo form_submit('pmb1_simpan', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
		</tr>
	</tbody>
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
				window.location = '<?php echo "$url_base/data-pendidikan_sebelumnya"; ?>';
			}, 1000);
		}
    });
 
    return false;
        });
});
</script>
		<script type="text/javascript">
	$(function() {
		$('#tgl').datetimepicker({
			language: 'en',
			format: 'dd-MM-yyyy',
			pick12HourFormat: false
		});
	});
	</script>
	<script type="text/javascript">
	$(function() {
		$('#tgl').datetimepicker({
			language: 'en',
			format: 'dd-MM-yyyy',
			pick12HourFormat: false
		});
	$('#agama').on('change',function(){
			var agama=$('#agama option:selected').val();
			if(agama=="agama_lain"){
				$('#pmb1_agama').show();
				$('#pmb1_agama').focus();
			}else{
				$('#pmb1_agama').hide();
			
			}
	
	});
		
	});
	</script>
<?php
	break;
	case 2: 
		#print_r($pendaftar); 
		#print_r($pendidikan); 
		#print_r($pekerjaan);
		#print_r($jenis_kesehatan);		
		#print_r($penyakit);		
		
		#echo form_open(''.$this->session->userdata('status').'/data-actionform');?>
		<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
			<tbody>
				<tr>
					<td colspan='3'><strong>Biodata Pribadi</strong><br /></td>
				</tr>
				<tr>
					<td width=40%>Nama Sesuai Ijazah Terakhir</td>
					<td width=2%>:</td>
					<td><?php echo $pendaftar[0]->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Tempat Lahir</td>
					<td>:</td>
					<td><?php echo $pendaftar[0]->PMB_TEMPAT_LAHIR_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Tgl. Lahir</td>
					<td>:</td>
					<td><?php echo $pendaftar[0]->PMB_TGL_LAHIR_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Alamat</td>
					<td>:</td>
					<td><?php echo $pendaftar[0]->PMB_ALAMAT_LENGKAP_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >No. Telp / HP</td>
					<td>:</td>
					<td><?php echo $pendaftar[0]->PMB_TELP_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Email</td>
					<td>:</td>
					<td><?php echo $pendaftar[0]->PMB_EMAIL_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Agama</td>
					<td>:</td>
					<td><?php 
						$agama=$pendaftar[0]->PMB_AGAMA_PENDAFTAR;
						switch($agama){
							case 1: echo "ISLAM"; break;
							case 2: echo "KHATOLIK"; break;
							case 3: echo "PROTESTAN"; break;
							case 4: echo "HINDU"; break;
							case 5: echo "BUDDHA"; break;
							default : echo $pendaftar[0]->PMB_AGAMA_PENDAFTAR; break;
						}
					#echo $pendaftar[0]->PMB_AGAMA_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Jenis Kelamin</td>
					<td>:</td>
					<td><?php 
						$jk=$pendaftar[0]->PMB_JENIS_KELAMIN_PENDAFTAR;
						switch($jk){
							case 0: echo "Laki - Laki"; break;
							case 1: echo "Perempuan"; break;
						}
					#echo $pendaftar[0]->PMB_JENIS_KELAMIN_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Kesehatan</td>
					<td>:</td>
					<td><?php
					foreach($penyakit as $value){
						$jenis_penyakit=$value->PMB_ID_JENIS_KESEHATAN;
						switch($jenis_penyakit){
							case 1: echo "Normal<br />"; break;
							case 2: echo "Tuna Daksa<br />"; break;
							case 3: echo "Tuna Netra<br />"; break;
							case 4: echo "Tuna Rungu<br />"; break;
							case 5: echo "Tuna Wicara<br />"; break;
							case 6: echo "Buta Warna Parsial<br />"; break;
							case 7: echo "Buta Warna Total<br />"; break;
						}
					}
					#foreach($penyakit as $value){
					#echo $value->PMB_ID_JENIS_KESEHATAN; }?></td>
				</tr>
				<tr>
					<td >Warga Negara</td>
					<td>:</td>
					<td><?php 
					$negara=$pendaftar[0]->PMB_WARGA_NEGARA_PENDAFTAR;
						switch($negara){
							case 0: echo "Warga Negara Indonesia"; break;
							case 1: echo "Warga Negara Asing"; break;
						}
					#echo $pendaftar[0]->PMB_WARGA_NEGARA_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td colspan='3'><br /><br /><strong>Pendidikan Sebelumnya</strong><br /></td>
				</tr>
				<?php if($this->session->userdata('status') == 'pmb'){?>
				
				<tr>
					<td>Jenis Sekolah</td>
					<td>:</td>
					<td>Jenis Sekolah</td>
				</tr>
				<tr>
					<td >Jurusan Sekolah</td>
					<td>:</td>
					<td>Jurusan Sekolah</td>
				</tr>
				<tr>
					<td >Nama Sekolah</td>
					<td>:</td>
					<td>Nama Sekolah</td>
				</tr>
				<tr>
					<td >Alamat Sekolah</td>
					<td>:</td>
					<td><textarea name='pmb1_alamat_sekolah'></textarea></td>
				</tr>
				<tr>
					<td >Tahun Lulus</td>
					<td>:</td>
					<td>Lulusan Tahu</td>
				</tr>
				<?php }elseif($this->session->userdata('status')=='s2' || $this->session->userdata('status')=='s3'){ ?>
				<tr>
					<td >Lulusan Dari</td>
					<td>:</td>
					<td><?php 
						$lulusan=$pendidikan[0]->PMB_LULUSAN_DARI;
						switch($lulusan){
							case 1: echo "UIN"; break;
							case 2: echo "IAIN"; break;
							case 3: echo "STAIN"; break;
							case 4: echo "PTAIS"; break;
							case 5: echo "PTN"; break;
							case 6: echo "PTS"; break;
							case 7: echo "PT LUAR NEGERI"; break;
							default: echo $pendidikan[0]->PMB_LULUSAN_DARI; break;
						}
					#echo $pendidikan[0]->PMB_LULUSAN_DARI; ?></td>
				</tr>
				<tr>
					<td >Nama Perguruan Tinggi</td>
					<td>:</td>
					<td><?php echo $pendidikan[0]->PMB_NAMA_PERGURUAN_TINGGI; ?></td>
				</tr>
				<tr>
					<td >Tahun Ijazah</td>
					<td>:</td>
					<td><?php echo $pendidikan[0]->PMB_TAHUN_IJAZAH; ?></td>
				</tr>
				<tr>
					<td >IPK</td>
					<td>:</td>
					<td><?php echo $pendidikan[0]->PMB_IPK_CPASCA; ?></td>
				</tr>
				<tr>
					<td colspan='3'><br /><br /><strong>Pekerjaan</strong><br /></td>
				</tr>
				<tr>
					<td >Status Pekerjaan</td>
					<td>:</td>
					<td><?php 
						$status_pekerjaan=$pekerjaan[0]->PMB_STATUS_PEKERJAAN;
						switch($status_pekerjaan){
							case 1: echo "Dosen / Guru / Pengajar"; break;
							case 2: echo "Karyawan"; break;
							case 3: echo "Belum Bekerja / Alumni"; break;
							default: echo $pekerjaan[0]->PMB_STATUS_PEKERJAAN; break;
						}
					#echo $pekerjaan[0]->PMB_STATUS_PEKERJAAN; ?></td>
				</tr>
				<tr>
					<td >Alamat Kantor</td>
					<td>:</td>
					<td><?php echo $pekerjaan[0]->PMB_ALAMAT_KANTOR; ?></td>
				</tr>
				<tr>
					<td >No. Telp./Fax</td>
					<td>:</td>
					<td><?php echo $pekerjaan[0]->PMB_TELP_FAX_KANTOR; ?></td>
				</tr>
				<tr>
					<td >Rencana Biaya Studi</td>
					<td>:</td>
					<td><?php 
						$rencana_biaya=$pekerjaan[0]->PMB_RENCANA_BIAYA_STUDI;
						switch($rencana_biaya){
							case 1: echo "Ditanggung Sendiri"; break;
							case 2: echo "Beasiswa Instansi Tempat Bekerja"; break;
							case 3: echo "Beasiswa Yayasan"; break;
							case 4: echo "Beasiswa Kemenag"; break;
							default: echo $pekerjaan[0]->PMB_RENCANA_BIAYA_STUDI; break;
						}
					#echo $pekerjaan[0]->PMB_RENCANA_BIAYA_STUDI; ?></td>
				</tr>
				<?php } ?>	
		</tbody>
	</table>
<?php
	break;
}

?>
</div>
