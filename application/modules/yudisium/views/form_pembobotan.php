<tr id="pembobotan">
		<?php  $persen=0; if(!is_null($pembobotan)){ foreach($pembobotan as $db){ $persen+=$db->bobot; ?>	
			
			<td>
				<?php echo strtoupper($db->nama_pembobotan);  ?>
			</td>
			<td><div class="input-group">
				<input type="text" name="bobotx[]" class="form-control input-md" readonly="" value="<?php echo $db->bobot; ?>" style="width:50px">
				<span class="input-group-addon" id="basic-addon2"> % </span>
				</div>
			</td>
			<!---
			<td>
				<select name="status" class="form-control input-md">
					<option <?php// if($db->status=='1'){echo " selected ";}  ?> value="1">Aktif</option>
					<option <?php //if($db->status=='0'){echo " selected ";}  ?> value="0">Tidak Aktif</option>
				</select>
			</td>
			-->
		</tr>	
		<?php } 
			echo "<tr>";
			echo "<td>";
			echo "</td>";
			echo "<td>";
			echo "<strong>".$persen." %</strong>";
			echo "</td>";
			echo "</tr>";
			}  
			else
			{
				echo "<td><strong>Pembobotan belum ditambahkan.</strong></td></tr>";
			}

		?>
	