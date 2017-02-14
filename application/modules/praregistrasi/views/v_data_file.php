<?php 
	$this->load->view('v_mod_header');
	$param=array('Data File'=>site_url('praregistrasi/data_keluarga'));
	$this->lib_reg_fungsi->crumb($param);
	$LOKASI_FILE=$this->lib_reg_fungsi->dokumen_lokasi();
?>
<div class="system-content-sia">
	<h2><?php echo $judul_halaman?></h2>
	<?php
	if($sukses){
		?>
		<div style='margin-bottom:10px;text-align:left;padding:20px' class="bs-callout bs-callout-success">
			<ul><?php echo $sukses ?></ul>
		</div>
		<?php
	}
	if($err){
		?>
		<div class="bs-callout bs-callout-error">		
			<?php
			if($err_global_penghasilan) echo "<b>Untuk surat keterangan penghasilan, wajib meng-upload minimal salah satu (Ibu atau Bapak atau Wali)</b><br/>";
			if($err_1 && $_FILES['DOC_PENGHASILAN_IBU']['name']) echo "<b>Surat Penghasilan Ibu</b><br/>".$err_1;
			if($err_2 && $_FILES['DOC_PENGHASILAN_BPK']['name']) echo "<br/><b>Surat Penghasilan Bapak</b><br/>".$err_2;
			if($err_3 && $_FILES['DOC_PENGHASILAN_WALI']['name']) echo "<br/><b>Surat Penghasilan Wali</b><br/>".$err_3;
			if($err_4) echo "<br/><b>Bukti Pembayaran PBB</b><br/>".$err_4;
			if($err_5) echo "<br/><b>Bukti Pembayaran Rekening Listrik</b><br/>".$err_5;
			if($err_6) echo "<br/><b>Bukti Kartu keluarga</b><br/>".$err_6;
			if($err_7) echo "<br/><b>Bukti Surat Keterangan Tidak Mampu / Kartu miskin</b><br/>".$err_7;
			?>
		
		</div>
		<?php
	}
	?>
	<form action="" method="post" enctype="multipart/form-data" name='form_sakti'>
	<?php
	$this->load->view("praregistrasi/v_mod_registrasi_tombol",$TOMBOL);
	$this->load->view("praregistrasi/v_mod_cek_kelengkapan",$TOMBOL);
	?>
	<input type='hidden' name='id_step_tujuan' value='' id='id_step_tujuan'/>
	<div class="bs-callout bs-callout-info">
		<ul>
			<li>Silakan pastikan file yang anda upload berekstensi <b>gif, jpg, jpeg</b> atau <b>pdf</b>. Dan berukuran maksimum 1 MB.<br/><br/></li>
			<li>Untuk lebih memastikan file terupload, silahkan melakukan upload file satu persatu. Kemudian silakan klik tombol <b>Simpan File</b>.<br/><br/></li>
			<li>Untuk surat keterangan penghasilan, wajib meng-upload minimal salah satu (Ibu atau Bapak atau Wali).</li>
			<li>Surat keterangan penghasilan bagi PNS, TNI/POLRI atau Karyawan harap dimintakan dari instansi tempat kerja.</li>
			<li>Surat keterangan penghasilan bagi Wiraswasta/Pekerja Bebas harap dibuat sendiri dan dimintakan pengesahan kepada 
				ketua RT setempat.</li>
		</ul>
	</div>
	<table class="table">
	<tbody>
	<tr>
		<td>Upload Surat Penghasilan Ibu</td>
		<td class="reg-input2">
			<input type='file' name='DOC_PENGHASILAN_IBU'/>
			<input type='hidden' name='DOC_PENGHASILAN_IBU_HIDDEN' value="<?php echo $DOC_PENGHASILAN_IBU_HIDDEN ?>"/> 
			<?php if($DOC_PENGHASILAN_IBU_HIDDEN) 
				echo "<a target='blank' class='link' href='".site_url("praregistrasi/data_file/download/?kolom=1")."'>
					<input type='button' class='btn-uin btn btn-inverse btn btn-small' value='file'/>
				</a>";
			?>
		</td>
	</tr>
	<tr>
		<td>Upload Surat Penghasilan Bapak</td>
		<td class="reg-input2">
			<input type='file' name='DOC_PENGHASILAN_BPK'/>
			<input type='hidden' name='DOC_PENGHASILAN_BPK_HIDDEN' value='<?php echo $DOC_PENGHASILAN_BPK_HIDDEN ?>'/>
			<?php if($DOC_PENGHASILAN_BPK_HIDDEN) 
				echo "<a target='blank' class='link' href='".site_url("praregistrasi/data_file/download/?kolom=2")."'>
					<input type='button' class='btn-uin btn btn-inverse btn btn-small' value='file'/>
				</a>";
			?>
		</td>
	</tr>
	<tr>
		<td>Upload Surat Penghasilan Wali</td>
		<td class="reg-input2">
			<input type='file' name='DOC_PENGHASILAN_WALI'/>
			<input type='hidden' name='DOC_PENGHASILAN_WALI_HIDDEN' value='<?php echo $DOC_PENGHASILAN_WALI_HIDDEN ?>'/>
			<?php if($DOC_PENGHASILAN_WALI_HIDDEN) 
				echo "<a target='blank' class='link' href='".site_url("praregistrasi/data_file/download/?kolom=3")."'>
					<input type='button' class='btn-uin btn btn-inverse btn btn-small' value='file'/>
				</a>";
			?>
		</td>
	</tr>
	<tr>
		<td>Upload Bukti Pembayaran Pajak Bumi dan Bangunan tahun terakhir (jika tidak punya, upload Surat Pernyataan Tidak memiliki Rumah / Lahan milik sendiri)</td>
		<td class="reg-input2">
			<input type='file' name='DOC_PBB'/>
			<input type='hidden' name='DOC_PBB_HIDDEN' value='<?php echo $DOC_PBB_HIDDEN ?>'/>
			<?php if($DOC_PBB_HIDDEN) 
				echo "<a target='blank' class='link' href='".site_url("praregistrasi/data_file/download/?kolom=4")."'>
					<input type='button' class='btn-uin btn btn-inverse btn btn-small' value='file'/>
				</a>";
			?>
		</td>
	</tr>
	<tr>
		<td>Upload Bukti Pembayaran Rekening Listrik bulan terakhir (jika tidak punya, upload Surat Pernyataan Tidak berlangganan Listrik)</td>
		<td class="reg-input2">
			<input type='file' name='DOC_REK_LISTRIK'/>
			<input type='hidden' name='DOC_REK_LISTRIK_HIDDEN' value='<?php echo $DOC_REK_LISTRIK_HIDDEN ?>'/>
			<?php if($DOC_REK_LISTRIK_HIDDEN) 
				echo "<a target='blank' class='link' href='".site_url("praregistrasi/data_file/download/?kolom=5")."'>
					<input type='button' class='btn-uin btn btn-inverse btn btn-small' value='file'/>
				</a>";
			?>
		</td>
	</tr>
	<tr>
		<td>Upload Kartu keluarga Yang Masih Berlaku</td>
		<td class="reg-input2">
			<input type='file' name='DOC_KK'/>
			<input type='hidden' name='DOC_KK_HIDDEN' value='<?php echo $DOC_KK_HIDDEN ?>'/>
			<?php if($DOC_KK_HIDDEN) 
				echo "<a target='blank' class='link' href='".site_url("praregistrasi/data_file/download/?kolom=6")."'>
					<input type='button' class='btn-uin btn btn-inverse btn btn-small' value='file'/>
				</a>";
			?>
		</td>
	</tr>
	<tr>
		<td>Upload Surat Keterangan Tidak Mampu / Kartu miskin (bagi calon mahasiswa dari keluarga tidak mampu.) <b>(bagi yang memiliki)</b></td>
		<td class="reg-input2">
			<input type='file' name='DOC_KARTU_MISKIN'/>
			<input type='hidden' name='DOC_KARTU_MISKIN_HIDDEN' value='<?php echo $DOC_KARTU_MISKIN_HIDDEN ?>'/>
			<?php if($DOC_KARTU_MISKIN_HIDDEN) 
				echo "<a target='blank' class='link' href='".site_url("praregistrasi/data_file/download/?kolom=7")."'>
					<input type='button' class='btn-uin btn btn-inverse btn btn-small' value='file'/>
				</a>";
			?>
		</td>
	</tr>
	</tbody>
</table>
<input onclick="tab_tujuan('data_file');return false;" class="btn btn-small btn-inverse btn-uin-left" id="btnSimpan" type="button" value="Simpan File"><br/><br/>
<?php
	$this->load->view("praregistrasi/v_mod_registrasi_tombol",$TOMBOL);
	?>
</form>
</div>