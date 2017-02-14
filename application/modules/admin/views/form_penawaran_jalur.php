<div>

	<table>
		<?php echo form_open(base_url('admin/input_data_c/penawaran_jalur_post'),array('name'=>'form_penawaran_jalur','method'=>'POST')); ?>
		
		<tr>
			<td>
				<h>KODE_JALUR</h>
			</td>
			<td>
				<?php 
				
				echo form_dropdown('kode_jalur',$jalur_masuk); 

				?>
			</td>
		</tr>

		<tr>
			<td>
				<h>TAHUN</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'tahun')); ?>
			</td>
		</tr>
		
		<tr>
			<td colspan='2'>
				<?php echo form_submit(array('name'=>'btn_simpan_rpenawaran_jalur','value'=>'SIMPAN')); ?>
			</td>
		</tr>
		<?php echo form_close(); ?>
		</table>
	
</div>