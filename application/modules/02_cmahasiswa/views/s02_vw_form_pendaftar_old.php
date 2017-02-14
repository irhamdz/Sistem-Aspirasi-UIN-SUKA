<?php
$crumbs = array(array('Beranda'=>base_url()),array('FORM >  Data Pribadi'=>''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<?php #print_r($jenis_kesehatan); die(); 
#$this->load->view('02_cmahasiswa/02_vw_step_by_step'); 
#$attributes = array('id'=> 'id=frm-input');
echo "<div id='notif-upsbp'></div>";
echo form_open_multipart(''.$this->session->userdata('status').'/data-actionform" id="frm-input'); 
?><div class="bs-callout bs-callout-info"><strong>Infomasi : </strong><br />
				Foto -> <strong>Laki-laki</strong> -> Latar Belakang <font color="blue"><strong>Biru</strong></font>,<br /> 
				Foto -> <strong>Perempuan</strong> -> Latar Belakang <font color="red"><strong>Merah</font></strong>.<br /> 
				File -> TYPE = JPG, Ukuran = Minimal 50 KB, Maksimal 1 MB</br /></font> </div>
				<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div> 
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='3'><strong>Biodata Pribadi</strong><br /></td>
		</tr>
		<tr>
			<td width=200>Nama Sesuai Ijazah Terakhir</td>
			<td>:</td>
			<td><input type='text' name='pmb1_nama_lengkap' class="required" /> *)</td>
		</tr>
		<tr>
			<td >Tempat Lahir</td>
			<td>:</td>
			<td><input type='text' name='pmb1_tempat_lahir' class="required" /> *)</td>
		</tr>
		<tr>
			<td >Tgl. Lahir</td>
			<td>:</td>
			<td><div id="tgl" class="input-append">
				<?php
					$fdata = array(
					'name'        => 'pmb1_tgl_lahir',
					'value'       => '',
					'maxlength'   => '10',
					'class'       => 'required',
					);
				echo form_input($fdata); unset($fdata); ?>
				<span class="add-on"><i data-time-icon="icon-timeq" data-date-icon="icon-calendar"></i></span>
			</div> *)</td>
		</tr>
		<tr>
			<td >Alamat</td>
			<td>:</td>
			<td><textarea style="width:400px;height:100px" name='pmb1_alamat' class="required"></textarea> *)<br />** Format Pengisian : Alamat Rumah / Nama Jalan, RT, RW, Kelurahan, Kecamatan, Kabupaten, Propinsi, Negara, Kodepos</td>
		</tr>
		<tr>
			<td >No. Telp / HP</td>
			<td>:</td>
			<td><input type='text' name='pmb1_nohp' class="required" /> *)</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><input type='text' name='pmb1_email' /> *)</td>
		</tr>
		<tr>
			<td >Agama</td>
			<td>:</td>
			<td><select name='pmb1_agama' id='agama' class="required">\
					<option value='1'>Pilih</option>
					<?php foreach($master_agama as $value){ 	
							echo "<option value=".$value->PMB_ID_AGAMA.">".$value->PMB_NAMA_AGAMA."</option>";
						}
					?>
					<option value='agama_lain'>Lainnya</option>
				</select><br />
				<input type="text" id="pmb1_agama" name="agama_lain" style="display: none;"> *)
			</td>
		</tr>
		<tr>
			<td >Jenis Kelamin</td>
			<td>:</td>
			<td>
					<input type='radio' name='pmb1_jenis_kelamin' value='0' checked />Laki - Laki
					<input type='radio' name='pmb1_jenis_kelamin' value='1'/>Perempuan *)
					
			</td>
		</tr>
		<tr>
			<td >Kesehatan</td>
			<td>:</td>
			<td>
				<?php foreach($jenis_kesehatan as $value){ ?>
				<input type="checkbox" name="pmb1_kesehatan[]" value="<?php echo $value->PMB_ID_JENIS_KESEHATAN; ?>" class="required"><?php echo $value->PMB_NAMA_JENIS_KESEHATAN; ?><br />
				
				<?php } ?> *)
				</td>
		</tr>
		<tr>
			<td >Warga Negara</td>
			<td>:</td>
			<td><select name='pmb1_warga_negara' class="required">
					<option value=''>Pilih</option>
					<option value='0'>Warga Negara Indonesia</option>
					<option value='1'>Warga Negara Asing</option>
				</select> *)</td>
		</tr>
		<tr>
			<td >Foto</td>
			<td>:</td>
			<td><input type='file' name='userfile' class="required" /> *)</td>
		</tr>
		<tr>
			<td colspan='3'><br /><strong>Verifikasi Data Pribadi</strong><br /></td>
		</tr>
		<tr>
			<td colspan='3'>
			<div class="bs-callout bs-callout-warning">
			<input type='hidden' name='current_page' value='<?php echo $this->security->xss_clean($this->uri->segment(1)).'/'.$this->security->xss_clean($this->uri->segment(2)); ?>' /><input type="hidden" name="step" value="1"><strong> <font color="#4A991D">Yakinkan kami bahwa <font color="#FF0000">Data</font> yang Anda inputkan adalah benar adanya.</font>
			<br />
			<input type="checkbox" name="lisensi" value="1"> Ya, Saya Yakin *) </div></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td align='right'><?php echo form_submit('pmb1_simpan', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
		</tr>
	</tbody>
	</table>
	<?php echo form_close(); 
	$url_base=base_url().$this->session->userdata('status'); ?>
</div>
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
	<script type="text/javascript">
		$(document).ready(function() {
			$('#frm-input').validate({
				rules: {
					email: {
						email: true
					},
                   	TxtPost: {
                   	    digits: true,
     			        minlength:5,
						maxlength:5
					},
					pmb1_nohp: {
                   	    digits: true,
						maxlength:15
					}
				},
				messages: {
				   	pmb1_nama_lengkap: {
						required: "Nama Tidak Boleh Kosong",
					},
					
					pmb1_tempat_lahir: {
						required: "Tempat Lahir Tidak Boleh Kosong",
					},
					
					pmb1_tgl_lahir: {
						required: "Tanggal Lahir Tidak Boleh Kosong",
					},
					
					pmb1_alamat: {
						required: "Alamat Tidak Boleh Kosong",
					},
					
					pmb1_nohp: {
						required: "No Telpon Tidak Boleh Kosong",
					},
					
					pmb1_agama: {
						required: "Agama Tidak Boleh Kosong",
					},
					
					pmb1_kesehatan: {
						required: "Status Kesehatan Tidak Boleh Kosong",
					},
					pmb1_warga_negara: {
						required: "Warga Negara Tidak Boleh Kosong",
					},
					userfile: {
						required: "Foto Tidak Boleh Kosong",
					},
					email: {
						required: "Alamat email belum diisi",
						email: "Format email tidak valid"
					}
				}
			});
		});
		</script>

