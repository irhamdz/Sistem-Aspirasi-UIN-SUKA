<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td>Nomor PIN Anda : <br />
				<strong><?php echo $this->session->userdata('id_user'); ?></strong><br /><br />
				
				Jalur Pendaftran : <br />
				<strong>Anda merupakan calon Mahasiswa <?php echo $this->session->userdata('siapa_aku'); echo ' '.$this->config->item('app_owner');?> </strong><br /><br />
				
				Status Kelengkapan * :
				<?php print_r($status); ?>
			</td>
		</tr>
		<tr>
			<td><br />Infomasi : <hr />
				Cetak Data Pribadi dan Kartu Peserta Ujian PMB, hanya dapat dilakukan ketika semua data sudah dilengkapi,<br /><br />
				Anda tetap bisa <em>Login</em> ke dalam Sistem PMB ini walaupun sudah mencetak Kartu Peserta Ujian, tetapi tidak dapat merubah data. </br /><br />
				Foto -> <strong>Laki-laki</strong> -> Latar Belakang <font color="blue"><strong>Biru</strong></font>,<br /> 
				Foto -> <strong>Perempuan</strong> -> Latar Belakang <font color="red"><strong>Merah</font></strong>.<br /> 
				File -> TYPE = JPG, Ukuran = Minimal 50 KB, Maksimal 1 MB</br />
			</td>
		</tr>
</table><hr />