<?php 
	$this->load->view('v_mod_header');
	$param=array('Data Bapak'=>site_url('praregistrasi/data_ibu'));
	$this->lib_reg_fungsi->crumb($param);
?>
<script src="<?php echo base_url("asset/js/bootstrap-datetimepicker.min.js")?>"></script>
<h2><?php echo $judul_halaman; ?></h2>
<?php
if($err){
	?>
	<div class="bs-callout bs-callout-error"><ul><?php echo $err; ?></ul></div>
	<?php
}
?>
<div class="bs-callout bs-callout-info">
	Apabila data bapak tidak ada, maka isikan tulisan <b>TIDAK ADA</b> pada kolom Nama Bapak Kandung.
</div>
<form action='' name='form_sakti' method='POST'>
<input type='hidden' name='id_step_tujuan' value='' id='id_step_tujuan'/>
<?php
$this->load->view("praregistrasi/v_mod_registrasi_tombol",$TOMBOL);
$this->load->view("praregistrasi/v_mod_cek_kelengkapan",$TOMBOL);
?>
<table class="table-snippet">
	<tbody>
	<tr>
		<td class="reg-label">Nama Bapak Kandung</td>
		<td class="reg-input">
			<input type='text' class='form-control' style='width: 300px; display: inline; margin-bottom: 5px' maxlength="75" name='NM_BPK_KANDUNG' value="<?php echo $NM_BPK_KANDUNG; ?>"/> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Tempat Lahir Bapak</td>
		<td class="reg-input">
			<input type='text' class='form-control' style='width: 200px; display: inline; margin-bottom: 5px' maxlength="75" name='TMP_LAHIR_BPK' value="<?php echo $TMP_LAHIR_BPK; ?>"/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Tanggal Lahir Bapak</td>
		<td class="reg-input">
			<div id="date_tgl_lahir" class="input-append date">
				<input name='TGL_LAHIR_BPK' class="form-control"  style='display: inline; width: 100px' value='<?php echo $TGL_LAHIR_BPK ?>' data-format="dd-MM-yyyy" type="text"></input>
				<span class="add-on" style='height: 34px; line-height: 35px'><i class="icon-calendar"></i></span>
			</div>
			<script type="text/javascript">
			  $(function() {
				$('#date_tgl_lahir').datetimepicker({
				  pickTime: false
				});
			  });
			</script>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Agama Bapak</td>
		<td class="reg-input">
			<select class='form-control' style='width: 200px; margin-bottom: 5px' name='KD_AGAMA_BPK'>
			<?php
			foreach($MASTER_DATA_AGAMA as $key => $val){
				if($val['KD_AGAMA']=='10'){
					continue;
				}
				?>
				<option value="<?php echo $val['KD_AGAMA']?>" <?php if($KD_AGAMA_BPK==$val['KD_AGAMA']) echo "selected";?>><?php echo $val['NM_AGAMA'];?></option>
				<?php
			}
			?>
				<option value='10' <?php if($KD_AGAMA_BPK=='10') echo 'selected';?>>LAINNYA</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Pendidikan Bapak</td>
		<td class="reg-input">
			<select class='form-control' style='width: 100px; margin-bottom: 5px' name='KD_PEND_BPK'>
			<?php
			foreach($MASTER_DATA_PENDIDIKAN as $key => $val){
				?>
				<option value="<?php echo $val['KD_PEND']?>" <?php if($KD_PEND_BPK==$val['KD_PEND']) echo "selected";?>><?php echo $val['NM_PEND'];?></option>
				<?php
			}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Pekerjaan Bapak</td>
		<td class="reg-input">
			<select name='KD_KERJA_BPK' class='form-control' style='width: 150px; margin-bottom: 5px; display: inline' onchange="pekerjaan_pilih(this.value,'ket')">
			<?php
			foreach($MASTER_DATA_PEKERJAAN as $key => $val){
				?>
				<option value="<?php echo $val['KD_PEKERJAAN']?>" <?php if($KD_KERJA_BPK==$val['KD_PEKERJAAN']) echo "selected";?>>
					<?php echo strtoupper($val['NM_PEKERJAAN']);?>
				</option>
				<?php
			}
			?>
			</select>
			<span id='ket'><?php echo $this->lib_reg_fungsi->pekerjaan_label($KD_KERJA_BPK)?></span>
			<input class='form-control' style='display: inline; width:250px' type='text' value='<?=$KERJA_BPK_DETAIL?>' name='KERJA_BPK_DETAIL'/> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Alamat Rumah</td>
		<td class="reg-input">
			<input maxlength="75" name='ALAMAT_BPK' value='<?php echo $ALAMAT_BPK; ?>' class='form-control' style='display: inline; margin-bottom: 5px; width:350px;' type='text'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">RT</td>
		<td class="reg-input">
			<input maxlength="5" name='RT_BPK' value='<?php echo $RT_BPK; ?>' type='text' class='form-control' style='width:50px; margin-bottom: 5px'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">RW</td>
		<td class="reg-input">
			<input maxlength="5" name='RW_BPK' value='<?php echo $RW_BPK; ?>' type='text' class='form-control' style='width:50px; margin-bottom: 5px'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kelurahan/Desa</td>
		<td class="reg-input">
			<input maxlength="25" name='DESA_BPK' value='<?php echo $DESA_BPK; ?>' type='text' class='form-control' style='width: 200px; display: inline; margin-bottom: 5px'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kecamatan</td>
		<td class="reg-input">
			<input maxlength="25" name='NM_KEC_BPK' value='<?php echo $NM_KEC_BPK; ?>' type='text' class='form-control' style='width: 200px; display: inline; margin-bottom: 5px'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kabupaten</td>
		<td class="reg-input">
			<input type='hidden' name='KD_KAB_BPK' id='KD_KAB' value='<?php echo $KD_KAB_BPK ?>'/>
			<input type='text' autocomplete="off" id="nama_kabupaten" value='<?php echo $NM_KAB_BPK; ?>' class='form-control' style='width: 200px; display: inline; margin-bottom: 5px' onkeyup="kabupaten_cari(this.value,'suggestions2','KD_KAB','nama_kabupaten');return false;" onblur="hilangkan_ajax('suggestions2')"/>
			<span id='suggestions2Loading'></span>
			<div class="suggestionsBox" id="suggestions2" style="display: none"> 
				<div class="ac_results" id="suggestions2List"> &nbsp; </div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Propinsi</td>
		<td class="reg-input">
			<input type='hidden' id='KD_PROP' name='KD_PROP_BPK' value='<?php echo $KD_PROP_BPK?>'/>
			<input type='text' value='<?php echo $NM_PROP_BPK;?>'  disabled id="NM_PROP" class='form-control' style='width: 200px; display: inline; margin-bottom: 5px'/><br/>
			<div class='reg-info'>(terisi otomatis oleh sistem)</div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Negara</td>
		<td class="reg-input">
			<select class='form-control' style='display: inline; margin-bottom: 5px; width: 500px' name='KD_NEGARA_BPK'>
			<?php
			foreach($this->lib_reg_fungsi->data_negara() as $key => $val){
				//lainnya
				if(trim($val['KD_NEGARA'])=='237'){
					$NM_LAINNYA=$val['NM_NEGARA'];
					continue;
				}
				?>
				<option <?php if(empty($KD_NEGARA_BPK) and $val['KD_NEGARA']=='99') echo "selected";?><?php if($KD_NEGARA_BPK==$val['KD_NEGARA']) echo "selected";?> value='<?php echo $val['KD_NEGARA'] ?>'><?php echo $val['NM_NEGARA'] ?></option>
				<?php
			}
			?>
				<option value='237'><?php echo $NM_LAINNYA ?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kode Pos</td>
		<td class="reg-input">
			<input name='KODE_POS_BPK' value='<?php echo $KODE_POS_BPK;?>' maxlength='6' style='width:50px; margin-bottom: 5px; width: 50px' class='form-control' type='text'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Nomor Telepon</td>
		<td class="reg-input">
			<input maxlength="25" name='TELP_BPK' value='<?php echo $TELP_BPK; ?>' type='text' class='form-control' style='width:150px; margin-bottom: 5px'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Nomor Handphone</td>
		<td class="reg-input">
			<input maxlength="25" name='HP_BPK' value='<?php echo $HP_BPK; ?>' type='text' style='margin-bottom: 5px; width: 50px' class='form-control'/>
			<div class='reg-info'>
			Jika tidak punya ditulis <b>TIDAK ADA</b>.
			</div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Email</td>
		<td class="reg-input">
			<input maxlength="50" name='EMAIL_BPK' style='width:250px' value='<?php echo $EMAIL_BPK; ?>' type='text' class='form-control'/>
		</td>
	</tr>
	</tbody>
</table>

	<br/><br/>
<?php
$this->load->view("praregistrasi/v_mod_registrasi_tombol",$TOMBOL);
?>
</form>