<div>

	<table>
		<?php echo form_open(base_url('admin/input_data_c/ruang_post'),array('name'=>'form_ruang','method'=>'POST')); ?>
		<tr>
			<td>
				<h>ID RUANG</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'id_ruang')); ?>
			</td>
		</tr>

		<tr>
			<td>
				<h>ID GEDUNG</h>
			</td>
			<td>
				<?php
				echo form_dropdown('id_gedung',$nama_gedung); 

				?>
			</td>
		</tr>

		<tr>
			<td>
				<h>NAMA RUANG</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'nama_ruang')); ?>
			</td>
		</tr>
		
		<tr>
			<td>
				<h>STATUS RUANG</h>
			</td>
			<td>
				<?php 	echo form_label('Tersedia'); 
						echo form_radio('status_ruang','1',True);
						echo form_label('Penuh');
						echo form_radio('status_ruang','0');
				?>
			</td>
		</tr>

		<tr>
			<td colspan='2'>
				<?php echo form_submit(array('name'=>'btn_simpan_ruang','value'=>'SIMPAN')); ?>
			</td>
		</tr>
		<?php echo form_close(); ?>
		</table>
	
</div>