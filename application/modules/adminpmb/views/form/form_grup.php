<form method="POST" id='setting_grup' name="table_grup_form">
<?php		
		echo "<table class='table table-hover'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Nama Form</th>";
		echo "<th>Pilih</th>";
		echo "</tr>";
		echo "</thead>";
		$pilih=array();
		if(!is_null($pilih_form))
		{
			foreach ($pilih_form as $form_ambil) {
				array_push($pilih, $form_ambil->kode_form);
			}
		}
			if(!is_null($form))
			{	
				foreach ($form as $dataform) {

					echo "<tr>";
					echo "<td>";
					echo strtoupper(str_replace("_"," ",$dataform->nama_form));
					echo "</td>";
					echo "<td>";			
					echo "<input "; 
					if(count($pilih)>0)
					{
						for($i=0; $i<count($pilih); $i++)
						{
							if($pilih[$i]==$dataform->kode_form)
							{
								echo "checked";
							}
						}
					}

					echo "<input type='checkbox' id='".$dataform->kode_form."' onchange='pilih_form(this)' name='nama_form' value='".$dataform->kode_form."'>";
					echo "</td>";
					echo "</tr>";
				}
				
			}
		?>
			<tr>
			<input type='hidden' id='id_grup' name='kode_grup' value='<?php echo $pilih_grup; ?>'>
			<td></td>
		</tr>
		</table>
		</form>
		

	
</div>