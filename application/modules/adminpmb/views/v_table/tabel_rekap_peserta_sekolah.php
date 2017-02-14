<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NO
			</td>
			<td>
				NAMA SEKOLAH
			</td>
			<td>
				KABUPATEN
			</td>
			<td>
				PROVINSI
			</td>
			<td>
				JUMLAH
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		$total=0;
		if(!is_null($data_sek))
		{
			$num=0;
			foreach ($data_sek as $ds) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo $ds->nama_sekolah;
				echo "</td>";
				echo "<td>";
				if(strlen($ds->nama_kabupaten)<2)
				{
					echo "KAB. LAIN-LAIN";
				}
				echo $ds->nama_kabupaten;
				echo "</td>";
				echo "<td>";
				if(strlen($ds->nama_kabupaten)<2)
				{
					echo "PROV. LAIN-LAIN";
				}
				echo $ds->nama_provinsi;
				echo "</td>";
				echo "<td>";
				echo $ds->jumlah;
				$total+=$ds->jumlah;
				echo "</td>";
				echo "</tr>";
			}
		}
		?>
		<tr>
			<td colspan="4" align="center">
				<b>JUMLAH</b>
			</td>
			<td>
				<b><?php echo $total; ?></b>
			</td>
		</tr>
	</tbody>
</table>