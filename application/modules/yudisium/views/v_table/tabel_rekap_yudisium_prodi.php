<?php


if(!is_null($terima))
{
	
	$temp="";

	foreach ($terima as $tr) 
	{
		if($temp != $tr->nama_fakultas)
		{
			$temp=$tr->nama_fakultas;
	
			?>
		
			<table class="table table-bordered table-hover">
			<thead>
			<tr>
				<td>
				<b>Jurusan/Program Studi</b>
				</td>
				<td>
					<b>KELAS</b>
				</td>
				<td>
				<b>PILIHAN 1</b>
				</td>
				<td>
				<b>PILIHAN 2</b>
				</td>
				<td>
				<b>PILIHAN 3</b>
				</td>
				<td>
				<b>PILIHAN 4</b>
				</td>
				<td>
				<b>JUMLAH</b>
				</td>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td colspan="7" align="center">
					<b><?php echo $temp; ?><b>
				</td>
			</tr>
			<?php
		}
		
			?>
				<tr>
				<td>
				<?php echo $tr->nama_prodi; ?>
				</td>
				<td>
				<?php echo $tr->nama_kelas; ?>
				</td>
				<td>
				<?php if($tr->pilih1==''){echo "0";} else{echo $tr->pilih1;} ?>
				</td>
				<td>
				<?php if($tr->pilih2==''){echo "0";} else{echo $tr->pilih2;} ?>
				</td>
				<td>
				<?php if($tr->pilih3==''){echo "0";} else{ echo $tr->pilih3;} ?>
				</td>
				<td>
				<?php if($tr->pilih4==''){echo "0";} else{ echo $tr->pilih4;} ?>
				</td>
				<td>
				<?php  echo $tr->pilih1+$tr->pilih2+$tr->pilih3+$tr->pilih4; ?>
				</td>
			</td>
			</tr>
			<?php
	}
}

?>	
		</tbody>
	</table>
	<br>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>
					PRODI
				</td>
				<td>
					KELAS
				</td>
				<td>
					JUMLAH
				</td>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!is_null($terima_kelas))
			{
				foreach ($terima_kelas as $tk) {
					echo "<tr>";
					echo "<td>";
					echo $tk->nama_prodi;
					echo "</td>";
					echo "<td>";
					echo $tk->nama_kelas;
					echo "</td>";
					echo "<td>";	
					if(!is_null($tk->pilih1))
					{
						echo $tk->pilih1;
					}
					else
					{
						echo "0";
					}
					
					echo "</td>";
					echo "</tr>";
				}
			}
			?>
		</tbody>
	</table>