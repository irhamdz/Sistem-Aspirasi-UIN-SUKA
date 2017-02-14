<table>
<?php 
	foreach($nilai_akhir as $value){
		echo "<tr>
			<td>".$value->PMB_NO_PMB."</td>
			<td>".round($value->NILAI_TOTAL)."</td>
			<td>".$value->PMB_PILJUR_1."</td>
			<td>".$value->PMB_PILJUR_2."</td>
			<td>".$value->PMB_KELAS_JURUSAN."</td>
		</tr>";
	}
?>
</table>
