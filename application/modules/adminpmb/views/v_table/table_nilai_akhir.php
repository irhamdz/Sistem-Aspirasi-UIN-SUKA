<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NO
			</td>
			<td>
				NO. PMB
			</td>
			<td>
				NAMA
			</td>
			<td>
				NAMA TES
			</td>
		</tr>
	</thead>
	<tbody>
		<?php  
		$num=0;
		if(!is_null($nilai))
		{
			$temp="";
			foreach ($nilai as $n) {
				echo "<tr>";
				echo "<td>";
				if($n->nomor_peserta!=$temp)
				{
					echo $num+=1;	
				}
				echo "</td>";
				echo "<td>";
				if($n->nomor_peserta!=$temp)
				{
					echo $n->nomor_peserta;
				}
				echo "</td>";
				echo "<td>";
				if($n->nomor_peserta!=$temp)
				{
					echo $n->nama_lengkap;
				}
				echo "</td>";
				echo "<td>";
				
					echo $n->nama_tes." : ".round($n->nilai_tes);
				
				$temp=$n->nomor_peserta;
				echo "</td>";
				echo "</tr>";
			}
		}
		?>
	</tbody>
</table>