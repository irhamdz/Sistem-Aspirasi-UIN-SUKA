<table class="table table-bordered table-striped">
	<thead>
		<tr >
			<td align="center">
				<b>PROGRAM STUDI</b>
			</td>
			<td align="center">
				<b>KELAS</b>
			</td>
			<td align="center">
				<b>PILIHAN</b>
			</td>
			<td align="center">
				<b>RATA</b>
			</td>
			<td align="center">
				<b>SD</b>
			</td>
			<td align="center">
				<b>MAKS</b>
			</td>
			<td align="center">
				<b>MIN</b>
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($rekap_nilai))
		{
			foreach ($rekap_nilai as $rn) {
				echo "<tr>";
				echo "<td>";
				echo $rn->nama_prodi;
				echo "</td>";
				echo "<td>";
				echo $rn->nama_kelas;
				echo "</td>";
				echo "<td>";
				echo $rn->urutan_prodi;
				echo "</td>";
				echo "<td>";
				echo round($rn->rata,2);
				echo "</td>";
				echo "<td>";
				echo round($rn->sd,2);
				echo "</td>";
				echo "<td>";
				echo round($rn->maks,2);
				echo "</td>";
				echo "<td>";
				echo round($rn->mins,2);
				echo "</td>";
				echo "</tr>";
			}
		}
		?>
	</tbody>
</table>