<table class="table table-bordered">
	<thead>
		<th>
			NO
		</th>
		<th>
			NO PMB / NO UJIAN
		</th>
		<th>
			NAMA
		</th>
		<th>
			RUANG
		</th>
		<th>
			HP
		</th>
	</thead>
	<tbody>
		<?php
		
		if(!is_null($duplikat))
		{
			$num=0;
			foreach ($duplikat as $dup) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo $dup->nomor_pendaftar." / ".$dup->nomor_peserta;
				echo "</td>";
				echo "<td>";
				echo $dup->nama_lengkap;
				echo "</td>";
				echo "<td>";
				echo $dup->nama_ruang;
				echo "</td>";
				echo "<td>";
				echo $dup->nohp;
				echo "</td>";
				echo "</tr>";
			}
		}
		?>
	</tbody>
</table>