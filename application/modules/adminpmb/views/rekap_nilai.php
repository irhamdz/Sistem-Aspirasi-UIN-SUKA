<div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td colspan="2">
					NO
				</td>
				<td colspan="2">
					NO. PMB
				</td>
				<td colspan="2">
					NAMA
				</td>
				<td>
					NILAI
				</td>
				<td>
					TOTAL
				</td>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!is_null($mhs))
			{
				$num=0;
				foreach ($mhs as $m) {
					echo "<tr>";
					echo "<td>";
					echo $num+=1;
					echo "</td>";
					echo "<td>";
					echo $m->nomor_pendaftaran;
					echo "</td>";
					echo "<td>";
					echo strtoupper($m->nama_lengkap);
					echo "</td>";
					if(!is_null($nilai))
					{
						foreach ($nilai as $n) {
							if($n->nomor_pendaftaran==$m->nomor_pendaftaran)
							{
								echo "<td>";
								echo $n->nilai;
								echo "</td>";
							}
						}
					}
					echo "<td>";

					echo "</td>";
					echo "</tr>";
				}
			}
			?>
		</tbody>
	</table>
</div>