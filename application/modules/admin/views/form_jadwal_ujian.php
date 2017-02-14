<div>

	<table>
		<?php echo form_open(base_url('admin/input_data_c/jadwal_ujian_post'),array('name'=>'form_jadwal_ujian','method'=>'POST')); ?>
		<tr>
			<td>
				<h>KODE JADWAL</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'kode_jadwal')); ?>
			</td>
		</tr>

		<tr>
			<td>
				<h>HARI</h>
			</td>
			<td>
				<?php echo form_dropdown('hari',array('SENIN'=>'SENIN','SELASA'=>'SELASA','RABU'=>'RABU','KAMIS'=>'KAMIS','JUMAT'=>'JUMAT','SABTU'=>'SABTU','MINGGU'=>'MINGGU')); ?>
			</td>
		</tr>

		<tr>
			<td>
				<h>TANGGAL UJIAN</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'tanggal_ujian','type'=>'date')); ?>
			</td>
		</tr>
		
		<tr>
			<td>
				<h>JAM MULAI UJIAN</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'jam_mulai_ujian','type'=>'time')); ?>
			</td>
		</tr>

		<tr>
			<td>
				<h>JAM SELESAI UJIAN</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'jam_selesai_ujian','type'=>'time')); ?>
			</td>
		</tr>

		<tr>
			<td>
				<h>KODE PENAWARAN</h>
			</td>
			<td>
				<?php

				 echo form_dropdown('kode_penawaran',$jalur_masuk);

				  ?>
			</td>
		</tr>

		<tr>
			<td colspan='2'>
				<?php echo form_submit(array('name'=>'btn_simpan_jadwal','value'=>'SIMPAN')); ?>
			</td>
		</tr>
		<?php echo form_close(); ?>
		</table>
	
</div>