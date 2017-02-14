<select name="id_ruang" class="form-control input-md">
	<option value="">Pilih Ruang</option>
		<?php 
		if(!is_null($data_ruang))
			{
				foreach ($data_ruang as $valruang) 
				{
					
					echo "<option value='".$valruang->id_ruang."'>".$valruang->nama_ruang."</option>";
				
				}
			}
		?>	
</select>		