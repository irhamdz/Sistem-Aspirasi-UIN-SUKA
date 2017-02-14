<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				NO
			</td>
			<td>
				PRODI
			</td>
			<td>
				KELAS
			</td>
			<td>
				LAKI-LAKI
			</td>
			<td>
				PEREMPUAN
			</td>
			<td>
				JUMLAH
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		if(!is_null($mhs_jk))
		{
			$num=0;
			$total=0;
			$laki=0;
			$pr=0;
			foreach ($mhs_jk as $m) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo $m->nama_prodi;
				echo "</td>";
				echo "<td>";
				echo $m->nama_kelas;
				echo "</td>";
				echo "<td>";
				if(strlen($m->lk)>0)
				{
					echo $m->lk;
					$laki+=$m->lk;
				}
				else
				{
					echo "0";
				}
				
				echo "</td>";
				echo "<td>";
				if(strlen($m->pr)>0)
				{
					echo $m->pr;
					$pr+=$m->pr;
				}
				else
				{
					echo "0";
				}
				echo "</td>";
				echo "<td>";
				echo $m->lk+$m->pr;
				$total+=$m->lk+$m->pr;
				echo "</td>";
				echo "</tr>";
			}
		}
		?>
		<tr>
			<td colspan="3" align="center">
				<b>JUMLAH<b>	
			</td>
			<td>
				<b><?php echo $laki; ?></b>
			</td>
			<td>
				<b><?php echo $pr; ?></b>
			</td>
			<td>
				<b><?php  echo $total; ?></b>
			</td>
		</tr>
	</tbody>
</table>