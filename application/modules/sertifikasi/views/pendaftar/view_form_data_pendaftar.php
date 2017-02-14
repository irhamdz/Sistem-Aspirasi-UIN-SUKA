<style>
	thead th{
		text-transform: uppercase;
	}
	div.b128{
	    border-left: 1px black solid;
		height: 60px;
	}	
	table.tb128{
		border:1px solid;
		width:100px;
	}
	.add_tgl{
		width:80px;
	}
	td.reg-label{
		padding-right:20px;
		text-align:left;
		line-height:30px;
		vertical-align:top;
		width:180px;
	}
	td.reg-input{
		line-height:30px;
		vertical-align:top;
	}
	.reg-kolom-kanan{
		float:right;
		width:45%;
		text-align:right;
	}
	.reg-kolom-kiri{
		float:left;
		width:45%;
	}
	.ganjel{
		clear:both;
	}
	.ac_results ul {
		width: 100%;
		list-style-position: outside;
		list-style: none;
		padding: 0;
		margin: 0;
	}
	.ac_results li {
		margin: 0px;		
		cursor: default;
		display: block;
		font: menu;		
		overflow: hidden;
		display:block;
		padding: 3px 5px;
		cursor:pointer;
	}
	.ac_results li a{
		display:block;
		padding: 3px 5px;
	}
	.ac_results li:hover{
		background:#dedede;
	}
	.ac_results li.nope{
		cursor:auto;
	}
	.ac_results li.nope:hover{
		background:none;
	}
	.suggestionsBox{
		border:1px solid #cccccc;
		position:absolute;
		z-index:5;	
		width: 250px;
		padding:0px;
		background:#FFFFFF;
		margin-top:-5px;
		color:#333;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}
	.reg-info{
		font-size:11px;
		line-height:15px;
		margin-bottom:10px;
        color:#777777;
	}
	
	.error-message ul{
		text-align:left;
		padding:0px 15px 0px 15px;
	}
	.error-message{
		margin-bottom:5px;
	}
	a.link,a.link:visited  { text-decoration: underline;color:#333333}

	.bootstrap-datetimepicker-widget table td{
		font-size:12px;
		font-weight:normal;
	}
</style>

<script type="text/javascript">
	$(function() {
		$(".reg-info").attr('style','margin-bottom:0px;');
		
		$("form#fdatadiri").submit(function() {

			var formData = new FormData($(this)[0]);
			//console.log(formData);
			
			$.ajax({
				type: 'POST',
		        data: formData,
		        contentType: false,
		       	dataType: 'json',
		        processData: false

			})
			.done(function(x) {
				var hasil = $.parseJSON(x);
				$("#notif").html(x.pesan);
				$("html,body").animate({ scrollTop: $("#notif").offset().top }, "slow");
				if(x.st == 1){
					setTimeout(function() {location.reload();}, 1000);
				}
				//console.log(x);
			});
			
			return false;
		});
	});
</script>
<?php $this->load->view('sertifikasi/pendaftar/v_registrasi_script'); ?>
<h2><?php echo "<h2>Data Diri Pendaftar Ujian Sertifikasi ICT</h2>";#$judul_halaman; ?></h2>
<?php if(isset($st_daftar) && $st_daftar == true): ?>
	<div class="bs-callout bs-callout-error">Data diri tidak dapat diubah karena Anda sudah mengambil jadwal. Jika ingin mengubah data diri, silakan membatalkan jadwal terlebih dahulu atau menghubungi petugas.</div>
<?php endif; ?>
<form action="" method="post" enctype="multipart/form-data" name='form_sakti' id="fdatadiri">
<input type='hidden' name='OP' value='INS' id='id_step_tujuan'/>
<div class="bs-callout bs-callout-info"><strong>Infomasi : </strong><br />
				Foto -> <strong>Laki-laki</strong> -> Latar Belakang <font color="blue"><strong>Biru</strong></font>,<br /> 
				Foto -> <strong>Perempuan</strong> -> Latar Belakang <font color="red"><strong>Merah</font></strong>.<br /> 
				File -> TYPE = JPG, Ukuran = Minimal 50 KB, Maksimal 1 MB</br /></font> </div>
				<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div> 
<div id="notif"></div>
<table class="table">
	<tr>
		<td class="col-md-3">Nomor Registrasi</td>
		<td ><input type='hidden' name='PRE_USER' value='<?=$isi[0]['PRE_USER']?>'/><input type='hidden' name='PRE_PIN' value='<?=$isi[0]['PRE_PIN']?>'/>
		<b><?=$isi[0]['PRE_USER']?></b>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Gelar Depan Akademik</td>
		<td ><input maxlength="25" style='width:100px' type='text'  name='GELAR_DEPAN' value='<?php echo $isi[0]['GELAR_DEPAN']; ?>' class="form-control"/>
			<div class='reg-info'>contoh: Drs., Ir., DR., dll. Jika tidak ada mohon dikosongkan.</div>
		</td>
	</tr>
<tr>
		<td class="col-md-3">Gelar Depan Non Akademik</td>
		<td ><input maxlength="25" style='width:100px' type='text'  name='GELAR_DEPAN_NA' value='<?php echo $isi[0]['GELAR_DEPAN_NA']; ?>' class="form-control"/>
		<div class='reg-info'>contoh: Raden, R.A., H., Hj., Kyai, dll. Jika tidak ada mohon dikosongkan.</div>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Nama Pendaftar</td>
		<td >
		<input type='text'  name='NAMA' value='<?php echo $isi[0]['NAMA']; ?>' class="form-control"  />
        <div class='reg-info'>Apabila nama di atas tidak sesuai dengan nama yang tertera pada ijazah pendidikan terakhir, silakan menghubungi petugas dengan membawa fotokopi ijazah pendidikan terakhir untuk dilakukan perbaikan data.</div>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Gelar Belakang Non Akademik</td>
		<td ><input maxlength="25" style='width:100px' type='text'  name='GELAR_BELAKANG_NA' value='<?php echo $isi[0]['GELAR_BELAKANG_NA']; ?>' class="form-control"/>
			<div class='reg-info'>contoh: CCNA, CPA, CPM, dll. Jika tidak ada mohon dikosongkan.</div>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Gelar Belakang Akademik</td>
		<td ><input maxlength="25" style='width:100px' type='text'  name='GELAR_BELAKANG' value='<?php echo $isi[0]['GELAR_BELAKANG']; ?>' class="form-control"/>
			<div class='reg-info'>contoh: S.Ag., S.H., S.E., dll. Jika tidak ada mohon dikosongkan.</div>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Tempat Lahir</td>
		<td ><input  id="dd_tempatlahir" name='TMP_LAHIR' maxlength="72" value='<?php echo $isi[0]['TMP_LAHIR'];?>' style='width:350px' type='text' class="form-control"/> *)
		<div class='reg-info'>
		Diisi sesuai nama tempat lahir yang tertera pada Akta Kelahiran / Kartu Keluarga / Ijazah Terakhir.<br/>Maksimum 72 karakter.
		</div>
		</td>
	</tr>	
	<tr>
		<td class="col-md-3">Nama Kabupaten Lahir</td>
		<td >
			<input type='hidden' name='KD_KAB_LAHIR' id='KD_KAB_LAHIR' value='<?php echo $isi[0]['KD_KAB_LAHIR'] ?>'/>
			<input  type='text' autocomplete="off" class="form-control" id="nama_kabupaten_lahir" value='<?php echo $isi[0]['NM_KAB_LAHIR']; ?>' style="width:200px" 
			onkeyup="kabupaten_cari(this.value,'suggestions','KD_KAB_LAHIR','nama_kabupaten_lahir');return false;" onblur="hilangkan_ajax('suggestions')"/>
			<span id='suggestionsLoading'></span>
			<div class="suggestionsBox" id="suggestions" style="display: none"> 
				<div class="ac_results" id="suggestionsList"> &nbsp; </div>
			</div>
			*)
			<div class='reg-info'>Bagi yang tidak menemukan Nama Kabupaten, silakan diketik lainnya dan pilih sesuai Kabupaten Lahir. Bagi yang lahir di Luar Negeri, silakan diketik Luar Negeri.</div>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Tanggal Lahir</td>
		<td>
			   <div class="input-group date col-md-4" id="dp3" data-date="<?php if(!isset($isi[0]['TGL_LAHIR']) or $isi[0]['TGL_LAHIR'] == false){echo ""; } else{ echo date('d-m-Y',strtotime($isi[0]['TGL_LAHIR'])); } ?>" data-date-format="dd-mm-yyyy">
						<input class="form-control" size="16" type="text" value="<?php if(!isset($isi[0]['TGL_LAHIR']) or $isi[0]['TGL_LAHIR'] == false){echo ""; } else{ echo date('d-m-Y',strtotime($isi[0]['TGL_LAHIR'])); } ?>" name="TGL_LAHIR" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
		*)
		</td>
		  <script type="text/javascript">
		  $(function() {
				var tgl = $("#dp3").datepicker({
					format : 'dd-mm-yyyy',
					onRender: function(date) {
						return date.valueOf() > new Date().valueOf() ? 'disabled' : '';
					}
				}).on('changeDate', function(ev) {
					tgl.hide();
				}).data('datepicker');
		  });
		</script>
	</tr>
	<tr>
		<td class="col-md-3">Jenis Kelamin</td>
		<td >
			<select name='J_KELAMIN' class="form-control col-md-5">
				<option <?php if($isi[0]['J_KELAMIN']=='') echo 'selected';?> value=''>PILIH JENIS KELAMIN</option>
				<option <?php if($isi[0]['J_KELAMIN']=='L') echo 'selected';?> value='L'>LAKI-LAKI</option>
				<option <?php if($isi[0]['J_KELAMIN']=='P') echo 'selected';?> value='P'>PEREMPUAN</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Agama</td>
		<td >
			<select class="form-control col-md-3" name='KD_AGAMA'>
			<?php echo $dd_agama;	?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Kewarganegaraan</td>
		<td>
			<select name="WARGANEGARA" class="form-control col-md-6"><?php echo $dd_wn;?>	</select>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Nomor KTP / Paspor</td>
		<td >
			<input maxlength="25" type='text'  name='NO_KTP' id="dd_nomorktp" value='<?php echo $isi[0]['NO_KTP']; ?>' class="form-control col-md-5"/>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Tanggal berakhir</td>
		<td>
			   <div class="input-group date col-md-4" id="tgl_ktp" data-date="<?php if(!isset($isi[0]['TGL_KTP']) or $isi[0]['TGL_KTP'] == false){echo ""; } else{ echo date('d-m-Y',strtotime($isi[0]['TGL_KTP'])); } ?>" data-date-format="dd-mm-yyyy">
						<input class="form-control" size="16" type="text" value="<?php if(!isset($isi[0]['TGL_KTP']) or $isi[0]['TGL_KTP'] == false){echo ""; } else{ echo date('d-m-Y',strtotime($isi[0]['TGL_KTP'])); } ?>" name="TGL_KTP" readonly="">
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
		*)
		</td>
		  <script type="text/javascript">
		  $(function() {
				var tgl = $("#tgl_ktp").datepicker({
					format : 'dd-mm-yyyy',
					
				}).on('changeDate', function(ev) {
					tgl.hide();
				}).data('datepicker');
		  });
		</script>
	</tr>
	<tr>
			<td class="col-md-3">Alamat Rumah Asal</td>
			<td ><input name='ALAMAT_MHS' maxlength="72" class="form-control" value='<?php echo $isi[0]['ALAMAT_MHS'];?>' type='text' style='width:350px'/> *)
			<div class='reg-info'>
            Diisi dengan alamat asal mahasiswa (bukan alamat kos).<br/>
			Maksimum 72 karakter.</div>
			</td>
	</tr>
	<tr>
		<td class="col-md-3">RT Asal</td>
		<td >
			<input style='width:50px' name='RT_MHS' maxlength="5" value='<?php echo $isi[0]['RT_MHS']?>' type='text' class="form-control"/> *)
			
		</td>
	</tr>
	<tr>
		<td class="col-md-3">RW Asal</td>
		<td >
			<input style='width:50px' name='RW_MHS' maxlength="5" value='<?php echo $isi[0]['RW_MHS']?>' type='text' class="form-control"/> *)
		</td>
	</tr>
	
	<tr>
		<td class="col-md-3">Kelurahan / Desa Asal</td>
		<td >	
			<input name='DESA' maxlength="25" value='<?php echo $isi[0]['DESA'];?>' type='text' class="form-control"/> *)
		</td>
	</tr>
<tr>
		<td class="reg-label">Propinsi Asal</td>
		<td class="reg-input">
			<select name='KD_PROP' class="form-control col-md-6" onchange="OnChangeProp2(this)">
				<option>-</option>
				<?php
				foreach($PROP_LIST as $k => $v){
					$KD_PROPX=$v['KD_PROP'];
					$NM_PROPX=$v['NM_PROP'];
					?>
					<option <?php if($isi[0]['KD_PROP']==$KD_PROPX) echo 'selected'; ?> value='<?php echo $KD_PROPX ?>'><?php echo $NM_PROPX ?></option>
					<?php
				}
				?>
			</select> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kabupaten Asal</td>
		<td class="reg-input">
			<?php 
			if($isi[0]['KD_PROP']){
				$KAB_LIST=$this->lib_reg_fungsi->data_kabupaten_list($isi[0]['KD_PROP']);
			}
			?>
			<select name='KD_KAB' id="kab2" class="form-control col-md-6" onchange="OnChangeKab2(this)">
				<?php
				foreach($KAB_LIST as $k2 => $v2){
					$KD_KABX=$v2['KD_KAB'];
					$NM_KABX=$v2['NM_KAB'];
					if(ereg("LAINNYA",strtoupper($NM_KABX))){
						$KD_KABX_LAIN=$KD_KABX;
						continue;
					}
					?>
					<option <?php if($isi[0]['KD_KAB']==$KD_KABX) echo 'selected'; ?> value='<?php echo $KD_KABX ?>'><?php echo $NM_KABX ?></option>
					<?php
				}
				if($KAB_LIST){
				?>
				<option <?php if($isi[0]['KD_KAB']==$KD_KABX_LAIN) echo 'selected'; ?> value='<?php echo $KD_KABX_LAIN?>'>KABUPATEN LAINNYA</option>
				<?php } ?>
			</select> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kecamatan Asal</td>
		<td class="reg-input">
		<?php
			if($isi[0]['KD_KAB']){
				$KEC_LIST=$this->lib_reg_fungsi->data_kecamatan_list($isi[0]['KD_KAB']);
			}
			?>
			<select name='KD_KEC' id="kec2" class="form-control col-md-6">
				<?php
				foreach($KEC_LIST as $k3 => $v3){
					$KD_KECX=$v3['KD_KEC'];
					$NM_KECX=$v3['NM_KEC'];
					?>
					<option <?php if($isi[0]['KD_KEC']==$KD_KECX) echo 'selected'; ?> value='<?php echo $KD_KECX ?>'><?php echo strtoupper($NM_KECX) ?></option>
					<?php
				}
				if($isi[0]['KD_KEC']){
					?>
					<option <?php if($isi[0]['KD_KEC']=='999999') echo 'selected'; ?> value='999999'>KEC. LAINNYA</option>
					<?php
				}
				?>

			</select> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Negara Asal</td>
		<td class="reg-input">
			<select class="form-control col-md-6" name='KD_NEGARA'><?php echo $dd_neg;?></select>
		</td>
	</tr>	
	<tr>
		<td class="col-md-3">Kode Pos Asal</td>
		<td >
			<input name='KODE_POS' maxlength="5" value='<?php echo $isi[0]['KODE_POS']?>' type='text' class="form-control col-md-3"/>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">No. Telp. / Handphone</td>
		<td >
			<input type='text' style='width:150px' maxlength="25" name='TELP_MHS' value='<?php echo $isi[0]['TELP_MHS']; ?>' class="form-control"/> *) 
			<div class='reg-info'>
			Apabila tidak punya ditulis <b>TIDAK ADA</b>.
			</div>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Email</td>
		<td >
			<input maxlength="50" name='EMAIL_MHS' value='<?php echo $isi[0]['EMAIL_MHS']; ?>' type='email' class="form-control"/>
		</td>
	</tr>
	<tr>
		<td class="col-md-3">Foto</td>
		<td>
			<img style="width:150px; margin-bottom:10px;" src="<?php echo base_url('pendaftar/foto_pendaftar');?>">
			<input type='file' name='userfile'  /> *)
		</td>
	</tr>
	<?php if(isset($st_daftar) && $st_daftar == false): ?>
	<tr>
		<td></td>
		<td><button class="btn btn-small btn-inverse"><i class="icon icon-hdd icon-white"></i>  Simpan</button></td>
	</tr>
<?php endif; ?>
</table>
<br/>
</form>