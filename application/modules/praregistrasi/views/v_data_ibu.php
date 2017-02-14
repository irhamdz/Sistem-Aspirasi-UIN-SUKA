<?php 
	$this->load->view('v_mod_header');
	$param=array('Data Ibu'=>site_url('praregistrasi/data_ibu'));
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

<form action='' name='form_sakti' method='POST'>
<input type='hidden' name='id_step_tujuan' value='' id='id_step_tujuan'/>
<?php
$this->load->view("praregistrasi/v_mod_registrasi_tombol",$TOMBOL);
$this->load->view("praregistrasi/v_mod_cek_kelengkapan",$TOMBOL);
?>
<div class="bs-callout bs-callout-info">
	Tanda *) bermakna bahwa isian harus diisi.
</div>
<table class="table-snippet">
	<tbody>
	<tr>
		<td class="reg-label">Nama Ibu Kandung</td>
		<td class="reg-input">
			<input type='text' class='form-control' style='width: 300px; display: inline; margin-bottom: 5px' maxlength="75" name='NM_IBU_KANDUNG' value="<?php echo $NM_IBU_KANDUNG; ?>"/> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Tempat Lahir Ibu</td>
		<td class="reg-input">
			<input type='text' class='form-control' style='width: 200px; display: inline; margin-bottom: 5px' maxlength="75" name='TMP_LAHIR_IBU' value="<?php echo $TMP_LAHIR_IBU; ?>"/>
		
		</td>
	</tr>
	<tr>
		<td class="reg-label">Tanggal Lahir Ibu</td>
		<td class="reg-input">
			<div id="date_tgl_lahir" class="input-append date">
				<input name='TGL_LAHIR_IBU' class="form-control"  style='display: inline; width: 100px' value='<?php echo $TGL_LAHIR_IBU ?>' data-format="dd-MM-yyyy" type="text"></input>				
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
		<td class="reg-label">Agama Ibu</td>
		<td class="reg-input">
			<select class='form-control' style='width: 200px; margin-bottom: 5px' name='KD_AGAMA_IBU'>
			<?php
			foreach($MASTER_DATA_AGAMA as $key => $val){
				if($val['KD_AGAMA']=='10'){
					continue;
				}
				?>
				<option value="<?php echo $val['KD_AGAMA']?>" <?php if($KD_AGAMA_IBU==$val['KD_AGAMA']) echo "selected";?>><?php echo $val['NM_AGAMA'];?></option>
				<?php
			}
			?>
				<option value='10' <?php if($KD_AGAMA_IBU=='10') echo 'selected';?>>LAINNYA</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Pendidikan Ibu</td>
		<td class="reg-input">
			<select class='form-control' style='width: 100px; margin-bottom: 5px' name='KD_PEND_IBU'>
			<?php
			foreach($MASTER_DATA_PENDIDIKAN as $key => $val){
				?>
				<option value="<?php echo $val['KD_PEND']?>" <?php if($KD_PEND_IBU==$val['KD_PEND']) echo "selected";?>><?php echo $val['NM_PEND'];?></option>
				<?php
			}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Pekerjaan Ibu</td>
		<td class="reg-input">
			<select name='KD_KERJA_IBU' class='form-control' style='width: 150px; margin-bottom: 5px; display: inline' onchange="pekerjaan_pilih(this.value,'ket')">
			<?php
			foreach($MASTER_DATA_PEKERJAAN as $key => $val){
				?>
				<option value="<?php echo $val['KD_PEKERJAAN']?>" <?php if($KD_KERJA_IBU==$val['KD_PEKERJAAN']) echo "selected";?>>
					<?php echo strtoupper($val['NM_PEKERJAAN']);?>
				</option>
				<?php
			}
			?>
			</select>
			<span id='ket'><?php echo $this->lib_reg_fungsi->pekerjaan_label($KD_KERJA_IBU)?></span>
			<input class='form-control' style='display: inline; width:250px' type='text' value="<?=$KERJA_IBU_DETAIL?>" name='KERJA_IBU_DETAIL'/> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Alamat Rumah</td>
		<td class="reg-input">
			<input maxlength="75" name='ALAMAT_IBU' value="<?php echo $ALAMAT_IBU; ?>" class='form-control' style='display: inline; margin-bottom: 5px; width:350px;' type='text' class='inputx'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">RT</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px; margin-bottom: 5px' name='RT_IBU' value='<?php echo $RT_IBU; ?>' type='text' class='form-control'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">RW</td>
		<td class="reg-input">
			<input maxlength="5" style='width:50px; margin-bottom: 5px' name='RW_IBU' value='<?php echo $RW_IBU; ?>' type='text' class='form-control'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kelurahan/Desa</td>
		<td class="reg-input">
			<input maxlength="25" name='DESA_IBU' value="<?php echo $DESA_IBU; ?>" type='text' class='form-control' style='width: 200px; display: inline; margin-bottom: 5px' />
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kecamatan</td>
		<td class="reg-input">
			<input maxlength="25" name='NM_KEC_IBU' value="<?php echo $NM_KEC_IBU; ?>" type='text' class='form-control' style='width: 200px; display: inline; margin-bottom: 5px'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Kabupaten</td>
		<td class="reg-input">
			<input type='hidden' name='KD_KAB_IBU' id='KD_KAB' value='<?php echo $KD_KAB_IBU ?>'/>
			<input type='text' autocomplete="off" id="nama_kabupaten" value='<?php echo $NM_KAB_IBU; ?>' class='form-control' style='width: 200px; display: inline; margin-bottom: 5px' onkeyup="kabupaten_cari(this.value,'suggestions2','KD_KAB','nama_kabupaten');return false;" onblur="hilangkan_ajax('suggestions2')"/>
			<span id='suggestions2Loading'></span>
			<div class="suggestionsBox" id="suggestions2" style="display: none"> 
				<div class="ac_results" id="suggestions2List"> &nbsp; </div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Propinsi</td>
		<td class="reg-input">
			<input type='hidden' id='KD_PROP' name='KD_PROP_IBU' value='<?php echo $KD_PROP_IBU?>'/>
			<input type='text' value='<?php echo $NM_PROP_IBU;?>'  disabled id="NM_PROP" class='form-control' style='width: 200px; display: inline; margin-bottom: 5px'/><br/>
			<div class='reg-info'>(terisi otomatis oleh sistem)</div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Negara</td>
		<td class="reg-input">
			<select class='form-control' style='display: inline; margin-bottom: 5px; width: 500px' name='KD_NEGARA_IBU'>
			<?php
			foreach($this->lib_reg_fungsi->data_negara() as $key => $val){
				//lainnya
				if(trim($val['KD_NEGARA'])=='237'){
					$NM_LAINNYA=$val['NM_NEGARA'];
					continue;
				}
				?>
				<option <?php if(empty($KD_NEGARA_IBU) and $val['KD_NEGARA']=='99') echo "selected";?><?php if($KD_NEGARA_IBU==$val['KD_NEGARA']) echo "selected";?> value='<?php echo $val['KD_NEGARA'] ?>'><?php echo $val['NM_NEGARA'] ?></option>
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
			<input name='KODE_POS_IBU' value='<?php echo $KODE_POS_IBU;?>' maxlength='6' style='width:50px; margin-bottom: 5px; width: 50px' class='form-control' type='text'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Nomor Telepon</td>
		<td class="reg-input">
			<input maxlength="25" style='width:150px; margin-bottom: 5px' name='TELP_IBU' value="<?php echo $TELP_IBU; ?>" type='text' class='form-control'/>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Nomor Handphone</td>
		<td class="reg-input">
			<input maxlength="25" name='HP_IBU' value="<?php echo $HP_IBU; ?>" type='text' style='margin-bottom: 5px; width: 50px' class='form-control'/>
			<div class='reg-info'>
			Jika tidak punya ditulis <b>TIDAK ADA</b>.
			</div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Email</td>
		<td class="reg-input">
			<input maxlength="50" name='EMAIL_IBU' style='width:250px' value="<?php echo $EMAIL_IBU; ?>" type='text' class='form-control'/>
		</td>
	</tr>
	</tbody>
</table>
<?php
$this->load->view("praregistrasi/v_mod_registrasi_tombol",$TOMBOL);
?>
</form>