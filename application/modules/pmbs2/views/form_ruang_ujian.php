<div>

	<table>
		<?php echo form_open(base_url('admin/input_data_c/ruang_ujian_post'),array('name'=>'form_ruang_ujian','method'=>'POST')); ?>
		<tr>
			<td>
				<h>ID RUANG UJIAN</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'id_ruang_ujian')); ?>
			</td>
		</tr>

		<tr>
			<td>
				<h>ID URUT GEDUNG</h>
			</td>
			<td>
				<?php 
				echo form_open(base_url('admin/input_data_c/ruang_ujian_post'),array('name'=>'form_gedung','method'=>'POST'));
				echo form_dropdown('id_urut_gedung',$nama_gedung,array('onchange'=>'this.form.submit()')); 

				?>
				
			</td>
		</tr>
		
		<tr>
			<td>
				<h>ID RUANG</h>
			</td>
			<td>
				<?php echo form_dropdown('id_ruang',array('kosong 1','kosong 2')); ?>
			</td>
		</tr>

		<tr>
			<td>
				<h>KAPASITAS RUANG</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'kapasitas_ruang')); ?>
			</td>
		</tr>

		<tr>
			<td>
				<h>NO UJIAN AWAL</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'no_ujian_awal')); ?>
			</td>
		</tr>
		<tr>
			<td>
				<h>NO UJAIN AKHIR</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'no_ujian_akhir')); ?>
			</td>
		</tr>
		<tr>
			<td>
				<h>KODE JALUR</h>
			</td>
			<td>
				<?php 
				echo form_dropdown('kode_jalur',$jalur_masuk); 
				?>
			</td>
		</tr>
		<tr>
			<td>
				<h>STATUS RUANG UJIAN</h>
			</td>
			<td>
				<?php 	echo form_label('Tersedia'); 
						echo form_radio('status_ruang_ujian','1',True);
						echo form_label('Penuh');
						echo form_radio('status_ruang_ujian','0');
				?>
			</td>
		</tr>
		<tr>
			<td>
				<h>TAHUN RUANG UJIAN</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'tahun_ruang_ujian')); ?>
			</td>
		</tr>
		<tr>
			<td>
				<h>JADWAL</h>
			</td>
			<td>
				<?php 
				echo form_dropdown('kode_jadwal',$tanggal_ujian); 
				?>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				<?php echo form_submit(array('name'=>'btn_simpan_ruang_ujian','value'=>'SIMPAN')); ?>
			</td>
		</tr>
		<?php echo form_close(); ?>
		</table>
	
</div>