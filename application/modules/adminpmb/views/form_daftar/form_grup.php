<?php echo form_open(base_url('adminpmb/form_control/simpan_setting_grup_form'),array('name'=>'table_grup_form','method'=>'POST','class'=>'form-horizontal')); ?>

<?php		
		echo "<table class='table table-hover'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Nama Form</th>";
		echo "<th>Pilih</th>";
		echo "</tr>";
		echo "</thead>";
		
			if(!is_null($data_form_aktif))
			{	
				foreach ($data_form_aktif as $dataform) {

						
					
					echo "<tr>";
					echo "<td>";
					echo strtoupper(str_replace("_"," ",$dataform->nama_form));
					echo "</td>";
					
					echo "<input type='hidden' name='kode_grup[]' value='".$pilih_grup."'>";
				
					echo "<td>";
					echo "<input type='checkbox' name='nama_form[]' value='".$dataform->kode_form."' id='".$dataform->nama_form."'>";
					echo "</td>";
					echo "</tr>";
				}
				
			}
		?>
			<tr>
			<td></td>
			<td align="left">
				<?php echo form_submit(array('name'=>'btn_simpan','value'=>'SIMPAN','class'=>'btn btn-inverse btn-uin btn-small')); ?>
			</td>
		</tr>
		</table>
	
</div>