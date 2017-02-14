<br>
<h3>Rekap Perkabupaten</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NO
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
		$JML=0;
		if(!is_null($mhs_kab))
		{
			$num=0;
			foreach ($mhs_kab as $mk) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo $mk->nama_kabupaten;
				echo "</td>";
				echo "<td>";
				echo $mk->nama_provinsi;
				echo "</td>";
				echo "<td>";
				echo $mk->jumlah;
				$JML+=$mk->jumlah;
				echo "</td>";
				echo "</tr>";
			}
		}

		?>
		<td colspan="3" align="center"><b>JUMLAH<b></td>
		<td><b>
			<?php
			echo $JML;
			?></b>
		</td>
	</tbody>
</table>