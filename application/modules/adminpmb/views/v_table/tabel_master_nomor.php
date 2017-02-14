<?php
$total_tersedia=0;
			$total_penuh=0;
if(!is_null($nomor))
		{
			
			foreach ($nomor as $no) {
				if($no->status=='0')
				{
					$total_penuh+=1;
				}
				elseif($no->status=='1')
				{
					$total_tersedia+=1;
				}
			}
		}
echo "NOMOR PESERTA TERSEDIA : ".$total_tersedia." TOTAL NOMOR PESERTA PENUH : ".$total_penuh.".";
?>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NO
			</td>
			<td>
				NOMOR
			</td>
			<td>GEDUNG / 
				RUANG
			</td>
			<td>
				STATUS DIAMBIL
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($nomor))
		{
			$num=0;
			foreach ($nomor as $n) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo $n->nomor_peserta;
				echo "</td>";
				echo "<td>";
				echo $n->nama_gedung;
				echo " / ";
				echo $n->nama_ruang;
				echo "</td>";
				echo "<td>";
				switch ($n->status) {
					case '1':
						echo "<font color='#ff0000'>TIDAK TERSEDIA</font>";
						break;
					
					default:
						echo "<font color='#00ff00'>TERSEDIA</font>";
						break;
				}
				echo "</td>";
				echo "</tr>";
			}
		}

		?>
	</tbody>
</table>