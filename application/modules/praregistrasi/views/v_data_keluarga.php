<?php 
	$this->load->view('v_mod_header');
	$param=array('Data Keluarga'=>site_url('praregistrasi/data_keluarga'));
	$this->lib_reg_fungsi->crumb($param);
?>
<div class="system-content-sia">
	<h2><?php echo $judul_halaman?></h2>
	<?php
	if($err){
		?>
		<div class="bs-callout bs-callout-error"><ul><?php echo $err; ?></ul></div>
		<?php
	}
	?>
	<form action='' name='form_sakti' method='POST'>
	<?php
	$this->load->view("praregistrasi/v_mod_registrasi_tombol",$TOMBOL);
	$this->load->view("praregistrasi/v_mod_cek_kelengkapan",$TOMBOL);
	?>
	<input type='hidden' name='id_step_tujuan' value='' id='id_step_tujuan'/>
	<div class="bs-callout bs-callout-info">
	Tanda *) bermakna bahwa isian harus diisi.
	</div>
	<table class="table-snippet">
	<tbody>
	<tr>
		<td class="reg-label">Anak Nomor Ke</td>
		<td class="reg-input">
			<input size='2' style='width:50px; display: inline; margin-bottom: 5px' maxlength='2' onkeypress="return isNumberKey(event)" name='ANAK_KE' value='<?php echo $ANAK_KE; ?>' type='text' class='form-control'/> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Dari Jumlah Saudara</td>
		<td class="reg-input">
			<input size='2' style='width:50px; display: inline; margin-bottom: 5px' maxlength='2' onkeypress="return isNumberKey(event)" name='JUM_SAUDARA' value='<?php echo $JUM_SAUDARA; ?>' type='text' class='form-control'/> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Tanggungan Orang Tua</td>
		<td class="reg-input">
			<input size='2' style='width:50px; display: inline; margin-bottom: 5px' maxlength='2' onkeypress="return isNumberKey(event)" name='JUM_TANGGUNGAN' value='<?php echo $JUM_TANGGUNGAN; ?>' type='text' class='form-control'/> *)
		</td>
	</tr>
	<tr>
		<td class="reg-label">Gaji Ibu (per bulan)</td>
		<td class="reg-input">
			<input size='12' style='width:125px; display: inline; margin-bottom: 5px' id='ID_GAJI_IBU' name='GAJI_IBU' value='<?php echo $GAJI_IBU; ?>' onkeypress="return isNumberKey(event)" maxlength='12' type='text' class='form-control'/> *)
			<div class='reg-info'>Silahkan diisi dengan angka <b>0</b> jika tidak ada.</div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Gaji Bapak (per bulan)</td>
		<td class="reg-input">
			<input size='12'  style='width:125px; display: inline; margin-bottom: 5px' id='ID_GAJI_BAPAK' maxlength='12' type='text' name='GAJI_BAPAK' onkeypress="return isNumberKey(event)" value='<?php echo $GAJI_BAPAK; ?>' class='form-control'/> *)
			<div class='reg-info'>Silahkan diisi dengan angka <b>0</b> jika tidak ada.</div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Gaji Wali (per bulan)</td>
		<td class="reg-input">
			<input size='12'  style='width:125px; display: inline; margin-bottom: 5px' id='ID_GAJI_WALI' maxlength='12' type='text' name='GAJI_WALI' onkeypress="return isNumberKey(event)" value='<?php echo $GAJI_WALI; ?>' class='form-control'/> *)
			<div class='reg-info'>Silahkan diisi dengan angka <b>0</b> jika tidak ada.</div>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Status Perkawinan</td>
		<td class="reg-input">
			<select style='width:100px; margin-bottom: 5px' name='STATUS_KAWIN' class='form-control'>
				<option value='K' <?php if($STATUS_KAWIN=='K') echo 'selected';?>>Kawin</option>
				<option value='B' <?php if($STATUS_KAWIN=='B' or empty($STATUS_KAWIN)) echo 'selected';?>>Belum</option>
				<option value='J' <?php if($STATUS_KAWIN=='J') echo 'selected';?>>Janda</option>
				<option value='D' <?php if($STATUS_KAWIN=='D') echo 'selected';?>>Duda</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="reg-label">Nama Suami / Istri</td>
		<td class="reg-input"><input name='NM_PASANGAN' style='width:200px; display: inline; margin-bottom: 5px' maxlength="72" value="<?php echo $NM_PASANGAN; ?>" type='text' class='form-control'/></td>
	</tr>
	<tr>
		<td class="reg-label" valign='top'>Keterangan</td>
		<td class="reg-input">
			<textarea name='KETERANGAN' style='width:400px;height:100px' class='form-control'><?php echo $KETERANGAN; ?></textarea>
		</td>
	</tr>
	</tbody>
</table>
<?php
	$this->load->view("praregistrasi/v_mod_registrasi_tombol",$TOMBOL);
?>
</form>
</div>