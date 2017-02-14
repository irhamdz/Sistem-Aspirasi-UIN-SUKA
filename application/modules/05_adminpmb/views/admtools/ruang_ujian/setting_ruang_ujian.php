<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div id='tampil'>
<table>
	<tbody>
		<tr>
			<td width="100px">NAMA GEDUNG / LOKASI</td>
			<td>RUANG</td>
			<td>KAPASISTAS</td> 	
			<td>NO AWAL</td>
			<td>NO AKHIR</td>
			<td>ID GEDUNG</td>
			<td>ID RUANG</td>
			<td>TAHUN</td>
			<td>KODE JALUR</td>
		</tr>
	</tbody>
	<tbody>
<?php
// print_r($master_urut_gedung);
// print_r($master_ruang);


foreach($master_urut_gedung as $gedung){
	$id_gedung=$gedung->PMB_KD_GEDUNG;
	foreach($master_ruang as $ruang){
		$kd_gedung=$ruang->PMB_KD_GEDUNG;
		if($id_gedung==$kd_gedung){
			$id_ruang=$ruang->PMB_ID_RUANG;
			$tahun=$gedung->PMB_TAHUN_URUT_GEDUNG;
			$gelombang=$gedung->PMB_JALUR_UJIAN;
		echo	
		
		"
		<tr>
			<td>".$gedung->PMB_NAMA_GEDUNG."</td>
			<td>".$ruang->PMB_NAMA_RUANG."</td>
			<td></td>
			<td></td>
			<td></td>
			<td>".$id_gedung."</td>
			<td>".$id_ruang."</td>
			<td>".$tahun."</td>
			<td>".$gelombang."</td>
		</tr>";
		}
		
	}
	
	
	
}
echo "
</tbody></table>";
?>
</div>