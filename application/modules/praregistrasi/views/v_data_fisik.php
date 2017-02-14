<?php 
	$this->load->view('v_mod_header');
	$param=array('Data Fisik'=>site_url('praregistrasi/data_keluarga'));
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
	Tanda *) bermakna bahwa isian harus diisi.<br/>
	Silahkan diisi dengan angka <b>0</b> jika tidak ada.
	</div>
	<table class="table-snippet">
	<tbody>
	<tr>
		<td>Jumlah Kendaraan Roda 2 yang dimiliki Ibu, Bapak atau wali</td>
		<td class="reg-input2">
			<input size='2' style='width:50px; display: inline; margin-bottom: 5px;' maxlength='5' onkeypress="return isNumberKey(event)" name='JUM_KENDARAAN_RODA2' 
			value="<?php echo $JUM_KENDARAAN_RODA2; ?>" type='text' class='form-control'/> *)
		</td>
	</tr>
	<tr>
		<td>Jumlah Kendaraan Roda 4 yang dimiliki Ibu, Bapak atau wali</td>
		<td class="reg-input2">
			<input size='2' style='width:50px; display: inline; margin-bottom: 5px;' maxlength='5' onkeypress="return isNumberKey(event)" name='JUM_KENDARAAN_RODA4' 
			value="<?php echo $JUM_KENDARAAN_RODA4; ?>" type='text' class='form-control'/> *)
		</td>
	</tr>
	<tr>
		<td>Luas total tanah yang dimiliki Ibu, Bapak atau wali (dalam meter persegi)</td>
		<td class="reg-input2">
			<input size='2' style='width:50px; display: inline; margin-bottom: 5px;' maxlength='5' onkeypress="return isNumberKey(event)" name='LUAS_TANAH_ORTU' 
			value="<?php echo $LUAS_TANAH_ORTU; ?>" type='text' class='form-control'/> *)
		</td>
	</tr>
	<tr>
		<td>Total daya listrik yang dilanggan di rumah Ibu, Bapak atau wali (dalam volt ampere / watt)</td>
		<td class="reg-input2">
			<input size='2' style='width:50px; display: inline; margin-bottom: 5px;' maxlength='5' onkeypress="return isNumberKey(event)" name='DAYA_LISTRIK_ORTU' 
			value="<?php echo $DAYA_LISTRIK_ORTU; ?>" type='text' class='form-control'/> *)
		</td>
	</tr>
	<tr>
		<td>Total pembayaran PBB terakhir</td>
		<td class="reg-input2">
			<input size='2' style='width:100px; display: inline; margin-bottom: 5px;' maxlength='10' onkeypress="return isNumberKey(event)" name='PEMBAYARAN_PBB_AKHIR' 
			value="<?php echo $PEMBAYARAN_PBB_AKHIR; ?>" type='text' class='form-control'/> *)
		</td>
	</tr>
	<tr>
		<td>Total pembayaran Listrik terakhir</td>
		<td class="reg-input2">
			<input size='2' style='width:100px; display: inline; margin-bottom: 5px;' maxlength='10' onkeypress="return isNumberKey(event)" name='PEMBAYARAN_LISTRIK_AKHIR' 
			value="<?php echo $PEMBAYARAN_LISTRIK_AKHIR; ?>" type='text' class='form-control'/> *)
		</td>
	</tr>
	
	</tbody>
</table>
<?php
	$this->load->view("praregistrasi/v_mod_registrasi_tombol",$TOMBOL);
	?>
</form>
</div>