<?php
#error_reporting(0);
#echo "<pre>"; print_r($negara); echo "</pre>"; die();
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
				<div class="bs-callout bs-callout-warning"><font color="red"><strong>Isian untuk NISN, harus berupa angka yang terdiri dari 10 digit angka,</strong></font><br /><br />Tanyakan Ke Sekolah Anda, jika tidak memiliki NISN, karena Nomor NISN Anda nantinya akan digunakan untuk Pra Registrasi. Atau Anda juga bisa mencari NISN melalui laman <strong><a href='http://nisn.data.kemdiknas.go.id/' target="_blank">http://nisn.data.kemdiknas.go.id/</a></strong></div>
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
	?>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='2'><strong>Biodata Pribadi</strong><br /></td>
		</tr>
		<tr>
			<td>NISN </td>
			
			<td><div class="col-xs-7"><input type='text' class="form-control input-sm" name='pmb1_nisn' maxlength="10" required value="<?php echo $pendaftar[0]->PMB_NISN_PENDAFTAR; ?>" /></div> *)</td>
		</tr>
		<tr>
		<td class="reg-label">Gelar Depan Non Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7"><input maxlength="25"  class="form-control input-sm" style="width:100px" type="text" name="GELAR_DEPAN_NA" value="<?php echo $pendaftar[0]->GELAR_DEPAN_NA; ?>"  class="inputx"></div>
		<div class="col-xs-12"><d	iv class="reg-info">contoh: Raden, R.A., H., Hj., Kyai, dll. Jika tidak ada mohon dikosongkan.</div></div></td>
	</tr>
	<tr>
		<td class="reg-label">Gelar Depan Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7"><input maxlength="25"  class="form-control input-sm" style="width:100px" type="text" name="GELAR_DEPAN" value="<?php echo $pendaftar[0]->GELAR_DEPAN; ?>" class="inputx"></div>
		<div class="col-xs-12"><div class="reg-info">contoh: Drs., Ir., DR., dll. Jika tidak ada mohon dikosongkan.</div></div>
		</td>
	</tr>
		<tr>
			<td>Nama Sesuai Ijazah Terakhir</td>
			
			<td>
			<?php 
			$nama_pendaftar=$pendaftar[0]->PMB_NAMA_LENGKAP_PENDAFTAR;
			// $nama_pendaftar=str_replace("&#39;", "'", $nama_pendaftar);
			?>
			<div class="col-xs-7"><input type='text'  class="form-control input-sm"   name='pmb1_nama_lengkap' required value="<?php echo $nama_pendaftar; ?>" /></div>  *) </td>
		</tr>
	<tr>
		<td class="reg-label">Gelar Belakang Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7"><input maxlength="25"  class="form-control input-sm" style="width:100px" type="text" name="GELAR_BELAKANG" value="<?php echo $pendaftar[0]->GELAR_BELAKANG; ?>" class="inputx"></div>
			<div class="col-xs-12"><div class="reg-info">contoh: S.Ag., S.H., S.E., dll. Jika tidak ada mohon dikosongkan.</div></div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Gelar Belakang Non Akademik</td>
		
		<td class="reg-input"><div class="col-xs-7"><input maxlength="25"  class="form-control input-sm" style="width:100px" type="text" name="GELAR_BELAKANG_NA" value="<?php echo $pendaftar[0]->GELAR_BELAKANG_NA; ?>" class="inputx"></div>
			<div class="col-xs-12"><div class="reg-info">contoh: CCNA, CPA, CPM, dll. Jika tidak ada mohon dikosongkan.</div></div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Tempat Lahir  </td>
		
		<td class="reg-input"><div class="col-xs-7"><input id="dd_tempatlahir"   class="form-control input-sm" name="TMP_LAHIR" maxlength="72"  type="text" class="inputx" value="<?php echo $pendaftar[0]->PMB_TEMPAT_LAHIR_PENDAFTAR; ?>"></div> *)
		<div class="col-xs-12"><div class="reg-info">
		Diisi sesuai nama tempat lahir yang tertera pada Akta Kelahiran / Kartu Keluarga / Ijazah Terakhir.<br>Maksimum 72 karakter.
		</div></div>
		</td>
	</tr>
		<tr>
		<td class="reg-label">Nama Kabupaten Lahir  </td>
		
		<td class="reg-input">
			<input type="hidden" name="KD_KAB_LAHIR" id="KD_KAB_LAHIR" value='<?php echo $pendaftar[0]->KD_KAB_LAHIR; ?>'>
			<div class="col-xs-7"><input type="text"  class="form-control input-sm"  autocomplete="off" class="inputx" id="nama_kabupaten_lahir" value='<?php echo $NAMA_KAB_LAHIR; ?>'  style="width:200px" onkeyup="kabupaten_cari(this.value,'suggestions','KD_KAB_LAHIR','nama_kabupaten_lahir');return false;" onblur="hilangkan_ajax('suggestions')"></div> *)
			<span id="suggestionsLoading"></span>
			<div class="suggestionsBox" id="suggestions" style="display: none"> 
				<div class="ac_results" id="suggestionsList"> &nbsp; </div>
			</div>
			<div class="col-xs-12"><div class="reg-info">Bagi yang tidak menemukan Nama Kabupaten, silakan diketik lainnya dan pilih sesuai Kabupaten Lahir. Bagi yang lahir di Luar Negeri, silakan diketik Luar Negeri.</div></div>
		</td>
	</tr>
		<tr>
			<td >Tgl. Lahir </td>
			
			<td>
					<div class="col-xs-7">
					<div class='input-group date' id='datetimepicker1'><div id="tgl" class="input-append">
					<input type="text" class="form-control input-sm" style="width:200px" name="pmb1_tgl_lahir" value='<?php echo $pendaftar[0]->PMB_TGL_LAHIR_PENDAFTAR; ?>'>
					<span class="add-on"><i data-time-icon="icon-timeq" data-date-icon="icon-calendar"></i></span> 
					</div></div></div> *)</td>
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
			<td >Golongan Darah </td>
			
			<td>
				<div class="col-xs-7"><select style='width:80px' class="form-control input-sm" name='GOL_DARAH' class='inputx'>
				<option value='A' <?php if($pendaftar[0]->GOL_DARAH=='A') echo "selected";?>>A</option>
				<option value='B' <?php if($pendaftar[0]->GOL_DARAH=='B') echo "selected";?>>B</option>
				<option value='O' <?php if($pendaftar[0]->GOL_DARAH=='O') echo "selected";?>>O</option>
				<option value='AB' <?php if($pendaftar[0]->GOL_DARAH=='AB') echo "selected";?>>AB</option>
			</select> </div><br />
			</td>
		</tr>
		
		<tr>
			<td width='200'>No. Telp / HP </td>
			
			<td><div class="col-xs-7"><input type='text' name='pmb1_nohp'  class="form-control input-sm" required value="<?php echo $pendaftar[0]->PMB_TELP_PENDAFTAR; ?>" /></div> *) </td>
		</tr>
		<tr>
			<td>Email</td>
			
			<td><div class="col-xs-7"><input type='text'  class="form-control input-sm" name='pmb1_email' value="<?php echo $pendaftar[0]->PMB_EMAIL_PENDAFTAR; ?>" /></div>
			<div class="col-xs-12"><div class="reg-info">Apabila tidak punya ditulis <STRONG>TIDAK ADA</STRONG>.</div></div></td>
		</tr>
		<tr>
			<td >Agama</td>
			
			<td><div class="col-xs-7"><select name='pmb1_agama' class="form-control input-sm" id='agama' >
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
				  ?></div>
				 <option  class="form-control input-sm" value='agama_lain'>Lainnya</option></select> <br />
				<input type="text"  class="form-control input-sm" id="pmb1_agama" name="agama_lain" value="" style="display: none;"> *)	
			</td>
		</tr>
	<?php /*
		<tr>
			<td >Kesehatan</td>
			
			<td>Status Kesehatan Anda saat ini :<hr />
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
					}else{
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="1"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Normal<br />';
					}
				}
				
				
						echo '<br />Beri Tanda Centang untuk merubah Status Kesehatan :<hr />';
						foreach($jenis_kesehatan as $value){ 
					 ?><input type="checkbox" name="pmb1_kesehatan_baru[]" value="<?php echo $value->PMB_ID_JENIS_KESEHATAN; ?>" required>
					 <?php echo $value->PMB_NAMA_JENIS_KESEHATAN."<br />";
					 }
				 ?> *)
				 </td>
		</tr> */?>
		<tr>
			<td >Warga Negara </td>
			
			<td><div class="col-xs-7"><select name='pmb1_warga_negara' class="form-control input-sm"  required>
					<option value=''>Pilih</option>
					<?php 
					$wa=$pendaftar[0]->PMB_WARGA_NEGARA_PENDAFTAR;
						switch($wa){
							case 1: echo "<option value='0'>Warga Negara Indonesia</option>
										  <option value='1' selected>Warga Negara Asing</option>"; break;
							default: echo "<option value='0' selected>Warga Negara Indonesia</option>
										  <option value='1'>Warga Negara Asing</option>"; break;
						}
						?>
					
				</select> </div> *)</td>
		</tr>
		<tr>
			<td >Alamat Asal </td>
			
			<td><div class="col-xs-7"><textarea name='pmb1_alamat'  class="form-control input-sm" style="width:400px;height:100px" required><?php echo $pendaftar[0]->PMB_ALAMAT_LENGKAP_PENDAFTAR; ?></textarea></div>  *) </td>
		</tr>
		<tr>
		<td class="reg-label">RT Asal </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><input style="width:50px" name="RT_ASAL"  class="form-control input-sm" maxlength="5" type="text" value='<?php echo $pendaftar[0]->RT; ?>' class="inputx"></div>  *)
			
		</td>
	</tr>
	<tr>
		<td class="reg-label">RW Asal </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><input style="width:50px" name="RW_ASAL" class="form-control input-sm" maxlength="5" type="text" value='<?php echo $pendaftar[0]->RW; ?>' class="inputx"></div>   *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kelurahan / Desa Asal </td>
		
		<td class="reg-input">	
			<div class="col-xs-7"><input name="DESA" maxlength="25" type="text" class="form-control input-sm" value='<?php echo $pendaftar[0]->DESA; ?>' class="inputx"> </div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Propinsi Asal </td>
		
		<td class="reg-input">
			<div class="col-xs-7"><select name='KD_PROP' class="form-control input-sm" onchange="OnChangeProp2(this)">
				<option>-</option>
				<?php
				foreach($PROP_LIST as $k => $v){
					$KD_PROPX=$v['KD_PROP'];
					$NM_PROPX=$v['NM_PROP'];
					?>
					<option <?php if($pendaftar[0]->KD_PROP==$KD_PROPX) echo 'selected'; ?> value='<?php echo $KD_PROPX ?>'><?php echo $NM_PROPX ?></option>
					<?php
				}
				?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kabupaten Asal  </td>
		
		<td class="reg-input">
			<div class="col-xs-7">
			<select name='KD_KAB' class="form-control input-sm" id="kab2" onchange="OnChangeKab2(this)">
			<?php
				foreach($KAB_LIST as $k2 => $v2){
					$KD_KABX=$v2['KD_KAB'];
					$NM_KABX=$v2['NM_KAB'];
					// if(ereg("LAINNYA",strtoupper($NM_KABX))){
						// $KD_KABX_LAIN=$KD_KABX;
						// continue;
					// }
					?>
					<option <?php if($pendaftar[0]->KD_KAB==$KD_KABX) echo 'selected'; ?> value='<?php echo $KD_KABX ?>'><?php echo $NM_KABX ?></option>
					<?php
				}
				?>
			</select></div>*)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kecamatan Asal  </td>
		
		<td class="reg-input">
		<div class="col-xs-7">
			<select name='KD_KEC' class="form-control input-sm" id="kec2">
				<?php
				foreach($KEC_LIST as $k3 => $v3){
					$KD_KECX=$v3['KD_KEC'];
					$NM_KECX=$v3['NM_KEC'];
					?>
					<option <?php if($pendaftar[0]->KD_KEC==$KD_KECX) echo 'selected'; ?> value='<?php echo $KD_KECX ?>'><?php echo strtoupper($NM_KECX) ?></option>
					<?php
				}
				if($KD_KEC){
					?>
					<option <?php if($pendaftar[0]->KD_KEC=='999999') echo 'selected'; ?> value='999999'>KEC. LAINNYA</option>
					<?php
				}
				?>	

			</select></div> *)
		</td>
	</tr>
	
	<tr>
		<td class="reg-label">Negara Asal   </td>
		
		<td class="reg-input">
				<div class="col-xs-7"><select name="NEGARA_ASAL" class="form-control input-sm">
				<?php 
					foreach($negara as $value){
						if($NEGARA_ASAL==$value->KD_NEGARA){
							echo "<option selected value='".$value->KD_NEGARA."'>".$value->NM_NEGARA."</option>";
						}else{
							echo "<option value='".$value->KD_NEGARA."'>".$value->NM_NEGARA."</option>";
						}
					}		
				?>
			</select></div> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kode Pos Asal  </td>
		
		<td class="reg-input" >
			<div class="col-xs-7"><input name="KODE_POS"	 class="form-control input-sm" maxlength="5" value='<?php echo $KODE_POS; ?>' type="text" class="inputx"></div> *)
		</td>
	</tr>
	<tr>
			<td >Foto</td>
			
			<td><div class="col-xs-7"><div class='btn-uin btn btn-inverse btn btn-small'>
						<img height='200' src='<?php echo base_url().'img_pendaftar/'.$this->session->userdata('status').'/'.$pendaftar[0]->PMB_TAHUN_PENDAFTARAN.'/'.$pendaftar[0]->PMB_GELOMBANG_PENDAFTAR.'/'.$pendaftar[0]->PMB_FOTO_PENDAFTAR.''; ?>' />
						</div><input type='hidden' name='pmb1_foto_lama' value="<?php echo $pendaftar[0]->PMB_FOTO_PENDAFTAR; ?>" /><br /><br />
						<a href='<?php echo $url_base."/data-ubah_foto" ?>'><strong>Ganti Foto</strong><a/></div></td>
		</tr>
		<tr> <?php if(1>10): ?>
			<td >Ganti Foto</td>
			
			<td><div class="col-xs-7"><input type='file' class="form-control input-sm" name='userfile' /></div></td>
		</tr> <?php endif; ?>
		<?php /*
		<tr>
			<td colspan='3'><br /><strong>Pendidikan Sebelumnya</strong><br /></td>
		</tr>
		<tr>
			<td >Jenis Sekolah</td>
			
			<td>
				<?php 
				#$jenis_sekolah=$pendidikan_s1d3[0]->PMB_JENIS_SEKOLAH; 
				#echo $jenis_sekolah; ?>
			
				<select  name='pmb1_jenis_sekolah' id='jenis_sekolah' required>
					<option value=''>Pilih</option>
					<?php 
				$js=$pendidikan_s1d3[0]->PMB_JENIS_SEKOLAH;
				switch($js){
					case 1: 
					case 2: 
					case 3: 
					case 4: 
					case 5: 
					case 6: 
						foreach($jenis_sekolah as $value){ 
								if($value->PMB_ID_JENIS_SEKOLAH==$pendidikan_s1d3[0]->PMB_JENIS_SEKOLAH){
									echo "<option value=".$value->PMB_ID_JENIS_SEKOLAH." selected>".$value->PMB_NAMA_JENIS_SEKOLAH."</option>";
								}else{
									echo "<option value=".$value->PMB_ID_JENIS_SEKOLAH.">".$value->PMB_NAMA_JENIS_SEKOLAH."</option>";
								}
						}
					break;
					default : foreach($jenis_sekolah as $value){ 
						echo "<option value=".$value->PMB_ID_JENIS_SEKOLAH.">".$value->PMB_NAMA_JENIS_SEKOLAH."</option>";
					}
					echo "<option value='$js' selected>$js</option>";
					break;
					}
					?>
					<option value='jenis_sekolah_lain'>LAINNYA</option>
				
				</select>	*)
				<br />
				<input type="text" id="pmb1_jenis_sekolah" name="jenis_sekolah_lain" style="display: none;">
				</td>
		</tr>
		<tr>
			<td >Jurusan Sekolah</td>
			
			<td><?php 
				#$jurusan_sekolah=$pendidikan_s1d3[0]->PMB_JURUSAN_SEKOLAH; 
				#echo $jurusan_sekolah; ?>
				<select name='pmb1_jurusan_sekolah' id='jurusan_sekolah' required>
					<option value=''>Pilih</option>
				<?php
				$jus=$pendidikan_s1d3[0]->PMB_JURUSAN_SEKOLAH;
				switch($jus){
					case 1: 
					case 2: 
					case 3: 
					case 4: 
					case 5: 
					case 6: 
					foreach($jurusan_sekolah as $value){ 
								if($value->PMB_ID_JURUSAN_SEKOLAH==$pendidikan_s1d3[0]->PMB_JURUSAN_SEKOLAH){
									echo "<option value=".$value->PMB_ID_JURUSAN_SEKOLAH." selected>".$value->PMB_NAMA_JURUSAN_SEKOLAH."</option>";
								}else{
									echo "<option value=".$value->PMB_ID_JURUSAN_SEKOLAH.">".$value->PMB_NAMA_JURUSAN_SEKOLAH."</option>";
								}
						}
					break;
					default : foreach($jurusan_sekolah as $value){ 
						echo "<option value=".$value->PMB_ID_JURUSAN_SEKOLAH.">".$value->PMB_NAMA_JURUSAN_SEKOLAH."</option>";
					}
					echo "<option value='$jus' selected>$jus</option>";
					break;
					}
				?>
					<option value='jurusan_lain'>LAINNYA</option>
				</select>	*)
				<br />
				<input type="text" id="pmb1_jurusan_sekolah" name="jurusan_lain" style="display: none;"></td>
		</tr>
		<tr>
			<td>Nama Sekolah</td>
			
			<td>
			<?php 
				$kode_sekolah=$pendidikan_s1d3[0]->PMB_KODE_SEKOLAH;
				$kd_s=substr($kode_sekolah,4,4);
				if($kd_s==9999){
					$nama_sekolah = $pendidikan_s1d3[0]->PMB_SEKOLAH_LAIN;
					echo "<input type='hidden'  name='nama_sekolah' value='$nama_sekolah'>";
				}else{
					$nama_sekolah = $nama_sekolah_peserta[0]->NAMA_SEKOLAH;
					echo "<input type='hidden'  name='nama_sekolah' value='$nama_sekolah'>";
				}
				
				$nama_sekolah=str_replace("#39;", "'", $nama_sekolah);
			?>
			<input type="hidden"  name="sekolah_lama" value='<?php echo $kode_sekolah; ?>'>
			<select id="ubah_sekolah" name="u_s">
				<option value='<?php echo $kode_sekolah ?>'><?php echo $nama_sekolah; ?></option>
				<option value='ubah_s'>Ubah Nama Sekolah</option>
			</select> *)<br />
			<select class="wil" id="prop" name='propinsi' style="display: none;">
					<option value=''>-Pilih Propinsi-</option>
					<?php 
						foreach($propinsi as $value){ 
								echo "<option value=".$value->KODE_PROPINSI.">".$value->NAMA_PROPINSI."</option>";
						}?>
			</select>
						<br />
						<select class="wil" id="kab" name='kabupaten' style="display: none;">
							<option value="">-Pilih Kabupaten-</option>
						</select>
						<br />
						<select class="wil" id="sek" name='sekolah' style="display: none;">
							<option value="">-Pilih Sekolah-</option>
							</select><br />
						<input type="text" id="sekolah" name="sekolah_lain" class='required' style="display: none;">	
			</td>
		</tr>
		<tr>
			<td >Alamat Sekolah</td>
			
			<td><textarea name='pmb1_alamat_sekolah' required><?php echo $pendidikan_s1d3[0]->PMB_ALAMAT_SEKOLAH; ?></textarea>	*)</td>
		</tr>
		<tr>
			<td >Tahun Lulus</td>
			
			<td><input type='text' name='pmb1_tahun_lulus' required value='<?php echo $pendidikan_s1d3[0]->PMB_TAHUN_LULUS; ?>' />	*)</td>
		</tr>
		*/ ?>
		<tr>
			<td colspan='3'><input type='hidden' name='current_page' value='<?php echo $this->security->xss_clean($this->uri->segment(1)).'/'.$this->security->xss_clean($this->uri->segment(2)); ?>' /><input type="hidden" name="step" value="11">
			</td>
		</tr>	
		<tr>
			<td></td>
			<td align='right'>
			
			<?php echo form_submit('pmb1_simpan', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
		</tr>
	</tbody>
	</table>
	
	<?php echo form_close();
$url_base=base_url().$this->session->userdata('status'); 	?>
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
				window.location = '<?php echo "$url_base/data-kesehatan"; ?>';
			}, 1000);
		}
    });
 
    return false;
        });
		
	
});
</script>
<script type="text/javascript">
function kabupaten_cari(inputString,param_lokasi,param_lokasi_balik,param_lokasi_tampil){
	if(inputString.length == 0) {
		$('#'+param_lokasi).fadeOut();
	} else {
		$('#'+param_lokasi+"Loading").html("&nbsp;<img src='http://akademik.uin-suka.ac.id/asset/img/loading.gif'/>");
		$.ajax({
		type: "POST",
		cache:false,
		url: "data-kabupaten_cari",
		data: {katakunci: ""+inputString+"",lokasi_balik:""+param_lokasi_balik+"",lokasi:""+param_lokasi+"",lokasi_tampil:""+param_lokasi_tampil+""}
		}).done(function( data ) {
			if(data.length >0) {
				$('#'+param_lokasi).fadeIn();
				$('#'+param_lokasi+"List").html(data);
				$('#'+param_lokasi+"Loading").html(' ');
				//$('#nama_kabupaten').removeClass('load');
			}
		});
	}
}

function kabupaten_isi(lokasi,isi){
	//LOKASI 
	var explode=lokasi.split('#');
	var x=explode[0];
	var y=explode[1];
	var lokasi_tampil=explode[2];
	//ISI
	var isinya=isi.split("#");
	var kd=isinya[0];
	var nm=isinya[1];
	/////
	document.getElementById(lokasi_tampil).value=nm;
	document.getElementById(y).value=kd;	
	setTimeout("$('#"+x+"').fadeOut();", 600);
}

function hilangkan_ajax(param){
	setTimeout("$('#"+param+"').fadeOut();", 600);
}



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
			}else {
				$('#pmb1_agama').hide();
			}
	});
	


	
	});
	

function OnChangeProp2(sel){
	$.ajax({
		url 	: "data-ajax_wilayah",
		type	: "POST",            
		data    : "aksi=prop&kd_prop="+sel.value,
		success: function(r){
			var obk = $.parseJSON(r);
			document.getElementById("kab2").innerHTML = obk['kab'];
			document.getElementById("kec2").innerHTML = '<option value="999999">KEC. LAINNYA</option>';
		}
	});
}

function OnChangeKab2(sel){
	$.ajax({
		url 	: "data-ajax_wilayah",
		type	: "POST",            
		data    : "aksi=kab&kd_kab="+sel.value,
		success: function(r){
			var obk = $.parseJSON(r);
			document.getElementById("kec2").innerHTML = obk['kec'];
		}
	});
}


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
					
					<td><?php echo $pendaftar[0]->PMB_TEMPAT_LAHIR_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Tgl. Lahir</td>
					
					<td><?php echo $pendaftar[0]->PMB_TGL_LAHIR_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Alamat</td>
					
					<td><?php echo $pendaftar[0]->PMB_ALAMAT_LENGKAP_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >No. Telp / HP</td>
					
					<td><?php echo $pendaftar[0]->PMB_TELP_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Email</td>
					
					<td><?php echo $pendaftar[0]->PMB_EMAIL_PENDAFTAR; ?></td>
				</tr>
				<tr>
					<td >Agama</td>
					
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
					
					<td>Jenis Sekolah</td>
				</tr>
				<tr>
					<td >Jurusan Sekolah</td>
					
					<td>Jurusan Sekolah</td>
				</tr>
				<tr>
					<td >Nama Sekolah</td>
					
					<td>Nama Sekolah</td>
				</tr>
				<tr>
					<td >Alamat Sekolah</td>
					
					<td><textarea name='pmb1_alamat_sekolah'></textarea></td>
				</tr>
				<tr>
					<td >Tahun Lulus</td>
					
					<td>Lulusan Tahu</td>
				</tr>
				<?php }elseif($this->session->userdata('status')=='s2' || $this->session->userdata('status')=='s3'){ ?>
				<tr>
					<td >Lulusan Dari</td>
					
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
					
					<td><?php echo $pendidikan[0]->PMB_NAMA_PERGURUAN_TINGGI; ?></td>
				</tr>
				<tr>
					<td >Tahun Ijazah</td>
					
					<td><?php echo $pendidikan[0]->PMB_TAHUN_IJAZAH; ?></td>
				</tr>
				<tr>
					<td >IPK</td>
					
					<td><?php echo $pendidikan[0]->PMB_IPK_CPASCA; ?></td>
				</tr>
				<tr>
					<td colspan='3'><br /><br /><strong>Pekerjaan</strong><br /></td>
				</tr>
				<tr>
					<td >Status Pekerjaan</td>
					
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
					
					<td><?php echo $pekerjaan[0]->PMB_ALAMAT_KANTOR; ?></td>
				</tr>
				<tr>
					<td >No. Telp./Fax</td>
					
					<td><?php echo $pekerjaan[0]->PMB_TELP_FAX_KANTOR; ?></td>
				</tr>
				<tr>
					<td >Rencana Biaya Studi</td>
					
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
